<?php

namespace App\Helpers;

use DOMDocument;
use DOMElement;
use DOMNode;
use DOMXPath;

class ProcedureHtml
{
    private const ALLOWED_TAGS = [
        'p', 'br', 'div', 'span', 'strong', 'b', 'em', 'i', 'u', 's', 'strike', 'sub', 'sup',
        'ul', 'ol', 'li', 'table', 'thead', 'tbody', 'tfoot', 'tr', 'td', 'th', 'colgroup', 'col',
        'caption', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'blockquote', 'pre', 'code', 'a', 'img', 'hr',
    ];

    private const DROP_TAGS = [
        'script', 'style', 'meta', 'link', 'xml', 'head', 'title', 'object', 'embed',
        'iframe', 'form', 'input', 'button', 'select', 'textarea', 'svg',
    ];

    private const ALLOWED_STYLE = [
        'color', 'background', 'background-color', 'font-weight', 'font-style',
        'text-decoration', 'text-align', 'vertical-align', 'list-style-type',
    ];

    private const ALLOWED_ATTRS = [
        'a'   => ['href'],
        'img' => ['src', 'alt'],
        'td'  => ['colspan', 'rowspan'],
        'th'  => ['colspan', 'rowspan'],
        'ol'  => ['start', 'type'],
        'li'  => ['value'],
        'col' => ['span'],
    ];

    public static function clean(?string $html): string
    {
        if ($html === null || trim($html) === '') {
            return '';
        }

        $html = preg_replace('/<!--.*?-->/s', '', $html);
        $html = preg_replace('#<(style|script)\b[^>]*>.*?</\1>#is', '', $html);
        $html = preg_replace('#</?o:p[^>]*>#i', '', $html);

        // bekaar <span> wrappers (bina attribute wale) hata do
        $html = preg_replace('#<span>(.*?)</span>#is', '$1', $html);
        // khali <span style=...></span>
        $html = preg_replace('#<span[^>]*>\s*</span>#i', '', $html);

        libxml_use_internal_errors(true);
        $dom = new DOMDocument('1.0', 'UTF-8');

        $dom->loadHTML(
            '<?xml encoding="UTF-8"><div id="__root">' . $html . '</div>',
            LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | LIBXML_PARSEHUGE
        );
        libxml_clear_errors();

        $xp   = new DOMXPath($dom);
        $root = $xp->query('//div[@id="__root"]')->item(0);
        if (!$root) {
            return '';
        }

        // 1) Tables pehle (original widths chahiye)
        foreach ($xp->query('//table') as $table) {
            self::fixTable($table, $xp);
        }

        // 2) Har element ko whitelist se saaf karo
        $nodes = iterator_to_array($xp->query('//div[@id="__root"]//*'));
        foreach ($nodes as $el) {
            if ($el->parentNode) {
                self::sanitizeElement($el);
            }
        }

        // 2a) bina style wale span unwrap karo
        foreach (iterator_to_array($xp->query('//div[@id="__root"]//span[not(@style)]')) as $sp) {
            while ($sp->firstChild) {
                $sp->parentNode->insertBefore($sp->firstChild, $sp);
            }
            $sp->parentNode->removeChild($sp);
        }
        // 2a2) Word ki layout tables ko divs me badlo
        self::unwrapLayoutTables($dom, $xp);

        // 2b) Bade single-cell rows ko todo
        self::splitTallCells($dom, $xp);

        // 3) Faltu khali paragraphs hatao (table ke bahar)
        foreach (iterator_to_array($xp->query('//div[@id="__root"]//div')) as $div) {
            self::collapseEmpty($div);
        }
        self::collapseEmpty($root);

        $out = '';
        foreach ($root->childNodes as $n) {
            $out .= $dom->saveHTML($n);
        }
        return trim($out);
    }

    public static function flattenRowspans(?string $html): string
    {
        $html = (string) $html;

        if (stripos($html, 'rowspan') === false) {
            return $html;
        }

        libxml_use_internal_errors(true);

        $dom = new \DOMDocument('1.0', 'UTF-8');
        $dom->loadHTML(
            '<?xml encoding="UTF-8"><div id="w">' . $html . '</div>',
            LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
        );
        $xp = new \DOMXPath($dom);

        foreach ($xp->query('//table') as $table) {
            $pending = []; // col index => ['left' => baaki rows, 'cs' => colspan]

            foreach ($xp->query('.//tr', $table) as $tr) {
                // nested table ki rows skip karo
                $p = $tr->parentNode;
                if (strtolower($p->nodeName) !== 'table') {
                    $p = $p->parentNode;
                }
                if (!$p->isSameNode($table)) {
                    continue;
                }

                $cells = [];
                foreach ($tr->childNodes as $n) {
                    if ($n->nodeType === XML_ELEMENT_NODE && in_array(strtolower($n->nodeName), ['td', 'th'])) {
                        $cells[] = $n;
                    }
                }

                $col = 0;

                $fill = function ($before) use (&$pending, &$col, $dom, $tr) {
                    while (!empty($pending[$col]) && $pending[$col]['left'] > 0) {
                        $at = $col;
                        $td = $dom->createElement('td');

                        if ($pending[$at]['cs'] > 1) {
                            $td->setAttribute('colspan', $pending[$at]['cs']);
                        }

                        $pending[$at]['left']--;
                        $td->setAttribute('class', $pending[$at]['left'] > 0 ? 'rs-mid' : 'rs-last');
                        $td->appendChild($dom->createTextNode("\xC2\xA0"));

                        $before ? $tr->insertBefore($td, $before) : $tr->appendChild($td);
                        $col += $pending[$at]['cs'];
                    }
                };

                foreach ($cells as $cell) {
                    $fill($cell);

                    $cs = max(1, (int) $cell->getAttribute('colspan'));
                    $rs = max(1, (int) $cell->getAttribute('rowspan'));

                    if ($rs > 1) {
                        $pending[$col] = ['left' => $rs - 1, 'cs' => $cs];
                        $cell->removeAttribute('rowspan');
                        $cell->setAttribute('class', trim($cell->getAttribute('class') . ' rs-first'));
                    }

                    $col += $cs;
                }

                $fill(null);
            }
        }

        $out = '';
        foreach ($xp->query('//div[@id="w"]')->item(0)->childNodes as $n) {
            $out .= $dom->saveHTML($n);
        }

        return $out;
    }
    
    /* ---------------- TABLE ---------------- */

    private static function fixTable(DOMElement $table, DOMXPath $xp): void
    {
        if (!self::tableHasBorders($table, $xp)) {
            $table->setAttribute('class', 'pdf-borderless');
        }
        $rows = $xp->query('./tbody/tr | ./thead/tr | ./tfoot/tr | ./tr', $table);

        // colgroup widths (Froala yahi banata hai)
        $colW = [];
        foreach ($xp->query('./colgroup/col', $table) as $col) {
            $w    = self::readWidth($col);
            $span = max(1, (int) $col->getAttribute('span'));
            for ($k = 0; $k < $span; $k++) {
                $colW[] = $w;
            }
        }

        // Sabse zyada cells wali row (colspan ke bina)
        $best = null;
        $max  = 0;
        foreach ($rows as $tr) {
            $cells = $xp->query('./td | ./th', $tr);
            $plain = true;
            foreach ($cells as $c) {
                if ((int) $c->getAttribute('colspan') > 1) {
                    $plain = false;
                    break;
                }
            }
            if ($plain && $cells->length > $max) {
                $max  = $cells->length;
                $best = $cells;
            }
        }

        $cellW = [];
        if ($best) {
            foreach ($best as $c) {
                $cellW[] = self::readWidth($c);
            }
        }

        // Saare direct cells ki purani width/height hatao
        $allCells = $xp->query(
            './tbody/tr/td | ./tbody/tr/th | ./thead/tr/td | ./thead/tr/th | ' .
            './tfoot/tr/td | ./tfoot/tr/th | ./tr/td | ./tr/th',
            $table
        );
        foreach ($allCells as $c) {
            $st = self::parseStyle($c->getAttribute('style'));
            unset($st['width'], $st['height'], $st['min-width'], $st['max-width']);
            self::setStyle($c, $st);
            $c->removeAttribute('width');
            $c->removeAttribute('height');
        }

        // Percent widths nikalo
        $n = $best ? $max : count($colW);
        $raw = [];
        for ($i = 0; $i < $n; $i++) {
            $w = $colW[$i] ?? null;
            if ($w === null || $w <= 0) {
                $w = $cellW[$i] ?? null;
            }
            $raw[] = ($w !== null && $w > 0) ? $w : null;
        }

        $known = array_filter($raw, fn ($v) => $v !== null);

        foreach ($xp->query('./colgroup', $table) as $cg) {
            $table->removeChild($cg);
        }

        if ($n > 0 && $known) {
            $avg   = array_sum($known) / count($known);
            $raw   = array_map(fn ($v) => $v ?? $avg, $raw);
            $total = array_sum($raw) ?: 1;

            $doc      = $table->ownerDocument;
            $colgroup = $doc->createElement('colgroup');
            foreach ($raw as $i => $v) {
                $p   = round($v / $total * 100, 2);
                $col = $doc->createElement('col');
                $col->setAttribute('style', "width:{$p}%");
                $colgroup->appendChild($col);

                if ($best && $best->item($i)) {
                    $cell = $best->item($i);
                    $st   = self::parseStyle($cell->getAttribute('style'));
                    $st['width'] = "{$p}%";
                    self::setStyle($cell, $st);
                }
            }
            $table->insertBefore($colgroup, $table->firstChild);
        }
    }

    private static function readWidth(DOMElement $el): ?float
    {
        $style = self::parseStyle($el->getAttribute('style'));
        $w     = $style['width'] ?? $el->getAttribute('width');
        if ($w === null || $w === '') {
            return null;
        }
        if (preg_match('/^\s*([\d.]+)\s*(px|pt|%|mm|cm|in)?/i', $w, $m)) {
            $v    = (float) $m[1];
            $unit = strtolower($m[2] ?? '');
            switch ($unit) {
                case 'pt': return $v * 1.3333;
                case 'mm': return $v * 3.7795;
                case 'cm': return $v * 37.795;
                case 'in': return $v * 96;
                default:   return $v;
            }
        }
        return null;
    }

    /* ---------------- SANITIZE ---------------- */

    private static function sanitizeElement(DOMElement $el): void
    {
        $tag = strtolower($el->nodeName);

        if (in_array($tag, self::DROP_TAGS, true)) {
            $el->parentNode->removeChild($el);
            return;
        }

        if (!in_array($tag, self::ALLOWED_TAGS, true)) {
            while ($el->firstChild) {
                $el->parentNode->insertBefore($el->firstChild, $el);
            }
            $el->parentNode->removeChild($el);
            return;
        }

        $style = self::parseStyle($el->getAttribute('style'));

        // Purane HTML attributes ko CSS mein badlo (Excel / old HTML)
        if ($el->hasAttribute('bgcolor') && !isset($style['background-color'])) {
            $style['background-color'] = $el->getAttribute('bgcolor');
        }
        if ($el->hasAttribute('align') && !isset($style['text-align'])
            && in_array($tag, ['p', 'div', 'td', 'th', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'], true)) {
            $style['text-align'] = strtolower($el->getAttribute('align'));
        }

        $keep = self::ALLOWED_STYLE;
        if (in_array($tag, ['td', 'th', 'col'], true)) {
            $keep[] = 'width';
        }

        $clean = [];
        foreach ($style as $prop => $val) {
            if (!in_array($prop, $keep, true)) {
                continue;
            }
            $lv = strtolower($val);
            if (strpos($lv, 'url(') !== false || strpos($lv, 'expression') !== false) {
                continue;
            }
            if (in_array($prop, ['color', 'background-color'], true)
                && in_array($lv, ['windowtext', 'currentcolor', 'inherit', 'initial', 'transparent'], true)) {
                continue;
            }
            $clean[$prop] = $val;
        }

        if (isset($clean['text-align']) && $clean['text-align'] === 'center'
            && in_array($tag, ['div'], true)) {
            unset($clean['text-align']);
        }

        // Attributes
        $allowed = self::ALLOWED_ATTRS[$tag] ?? [];
        $names   = [];
        foreach ($el->attributes as $attr) {
            $names[] = $attr->name;
        }
        foreach ($names as $name) {
            if ($name === 'style' || $name === 'class') {
                continue;
            }
            if (!in_array($name, $allowed, true)) {
                $el->removeAttribute($name);
            }
        }

        // Sirf apni classes (Quill / proc-heading) rakho
        if ($el->hasAttribute('class')) {
            $keepCls = [];
            foreach (preg_split('/\s+/', trim($el->getAttribute('class'))) as $c) {
                if ($c !== '' && preg_match('/^(ql-|proc-|pdf-)/', $c)) {
                    $keepCls[] = $c;
                }
            }
            $keepCls ? $el->setAttribute('class', implode(' ', $keepCls)) : $el->removeAttribute('class');
        }

        // Safe links / images
        if ($tag === 'a' && $el->hasAttribute('href')
            && !preg_match('#^(https?:|mailto:|\#)#i', trim($el->getAttribute('href')))) {
            $el->removeAttribute('href');
        }
        if ($tag === 'img') {
            $src = trim($el->getAttribute('src'));
            if (!preg_match('#^(https?:|data:image/)#i', $src)) {
                $el->parentNode->removeChild($el);
                return;
            }
        }

        self::setStyle($el, $clean);
    }

    /* ---------------- EMPTY PARAGRAPHS ---------------- */

    private static function isBlank(DOMNode $n): bool
    {
        if ($n->nodeType === XML_TEXT_NODE) {
            return trim(str_replace("\xC2\xA0", ' ', $n->textContent)) === '';
        }
        if (!($n instanceof DOMElement)) {
            return true;
        }
        $tag = strtolower($n->nodeName);
        if ($tag === 'br') {
            return true;
        }
        if (!in_array($tag, ['p', 'div', 'span', 'strong', 'b', 'em', 'i', 'u'], true)) {
            return false;
        }
        if ($n->getElementsByTagName('img')->length
            || $n->getElementsByTagName('table')->length
            || $n->getElementsByTagName('hr')->length) {
            return false;
        }
        return trim(str_replace("\xC2\xA0", ' ', $n->textContent)) === '';
    }

    private static function collapseEmpty(DOMNode $parent): void
    {
        $prevEmpty = true; // shuru ke khali hata do
        foreach (iterator_to_array($parent->childNodes) as $k) {
            if ($k->nodeType === XML_TEXT_NODE && self::isBlank($k)) {
                continue;
            }
            if (self::isBlank($k)) {
                if ($prevEmpty) {
                    $parent->removeChild($k);
                } else {
                    $prevEmpty = true;
                }
                continue;
            }
            $prevEmpty = false;
        }
        // end ke khali hata do
        while ($parent->lastChild && self::isBlank($parent->lastChild)) {
            $parent->removeChild($parent->lastChild);
        }
    }

    /* ---------------- STYLE HELPERS ---------------- */

    private static function parseStyle(string $style): array
    {
        $out = [];
        foreach (explode(';', $style) as $decl) {
            if (strpos($decl, ':') === false) {
                continue;
            }
            [$k, $v] = array_map('trim', explode(':', $decl, 2));
            if ($k !== '' && $v !== '') {
                $out[strtolower($k)] = $v;
            }
        }
        return $out;
    }

    private static function setStyle(DOMElement $el, array $style): void
    {
        if (!$style) {
            $el->removeAttribute('style');
            return;
        }
        $s = '';
        foreach ($style as $k => $v) {
            $s .= "$k:$v;";
        }
        $el->setAttribute('style', $s);
    }

    private static function tableHasBorders(DOMElement $table, DOMXPath $xp): bool
    {
        $cells    = $xp->query('.//td | .//th', $table);
        $explicit = false;

        foreach ($cells as $c) {
            $st = self::parseStyle($c->getAttribute('style'));
            foreach ($st as $prop => $val) {
                if (strpos($prop, 'border') !== 0) {
                    continue;
                }
                if ($prop === 'border-width' || $prop === 'border-color' || $prop === 'border-image') {
                    continue;
                }
                $explicit = true;
                if (self::isRealBorder($prop, $val)) {
                    return true;
                }
            }
        }

        if ($explicit) {
            return false; // cells mein border likhi thi, par sab none/0 thi
        }

        // Cells mein koi info nahi: table ka border attribute dekho
        $attr = $table->getAttribute('border');
        if ($attr !== '' && (float) $attr == 0) {
            return false;
        }

        return true; // default: bordered (editor se insert hui normal table)
    }

    private static function isRealBorder(string $prop, string $val): bool
    {
        $v = strtolower(trim($val));
        if ($v === '' || $v === '0' || strpos($v, 'none') !== false || strpos($v, 'hidden') !== false) {
            // "border-style: solid solid solid none" jaisa mixed case
            if ($prop === 'border-style') {
                foreach (preg_split('/\s+/', $v) as $t) {
                    if ($t !== 'none' && $t !== 'hidden') {
                        return true;
                    }
                }
            }
            return false;
        }
        if (preg_match('/^0(\.0+)?(px|pt|cm|mm)?(\s|$)/', $v)) {
            return false;
        }
        return true;
    }

    private static function blocksOf(DOMElement $cell): array
    {
        $filter = function (DOMNode $parent): array {
            $out = [];
            foreach (iterator_to_array($parent->childNodes) as $n) {
                if ($n->nodeType === XML_TEXT_NODE && trim(str_replace("\xC2\xA0", ' ', $n->textContent)) === '') {
                    continue;
                }
                $out[] = $n;
            }
            return $out;
        };

        $blocks = $filter($cell);

        // Ek hi div/span wrapper ho to uske andar ke blocks lo
        while (count($blocks) === 1
            && $blocks[0] instanceof DOMElement
            && in_array(strtolower($blocks[0]->nodeName), ['div', 'span'], true)) {
            $inner = $filter($blocks[0]);
            if (!$inner) {
                break;
            }
            $blocks = $inner;
        }
        return $blocks;
    }

    private static function splitTallCells(DOMDocument $dom, DOMXPath $xp): void
    {
        foreach (iterator_to_array($xp->query('//table')) as $table) {
            foreach (iterator_to_array($xp->query('./tbody/tr | ./tr', $table)) as $tr) {
                $cells = iterator_to_array($xp->query('./td | ./th', $tr));
                if (!$cells) {
                    continue;
                }

                foreach ($cells as $c) {
                    if ((int) $c->getAttribute('rowspan') > 1) {
                        continue 2; // rowspan wali rows nahi todte
                    }
                }

                // Sabse zyada blocks wala cell dhundo
                $big = null;
                $bigBlocks = [];
                foreach ($cells as $c) {
                    $b = self::blocksOf($c);
                    if (count($b) > count($bigBlocks)) {
                        $big = $c;
                        $bigBlocks = $b;
                    }
                }
                $expanded = [];
                foreach ($bigBlocks as $b) {
                    if ($b instanceof DOMElement && strtolower($b->nodeName) === 'table') {
                        foreach (self::chunkTable($b, 6) as $part) {
                            $expanded[] = $part;
                        }
                    } else {
                        $expanded[] = $b;
                    }
                }
                $bigBlocks = $expanded;
                if (!$big || count($bigBlocks) < 2) {
                    continue;
                }

                $last = count($bigBlocks) - 1;
                foreach ($bigBlocks as $i => $node) {
                    $cls   = $i === 0 ? 'pdf-cont-first' : ($i === $last ? 'pdf-cont-last' : 'pdf-cont-mid');
                    $newTr = $tr->cloneNode(false);

                    foreach ($cells as $c) {
                        if ($c === $big) {
                            $nc = $c->cloneNode(false);
                            $nc->appendChild($node);
                        } elseif ($i === 0) {
                            $nc = $c; // asli cell (jaise "1.") pehli row mein
                        } else {
                            $nc = $c->cloneNode(false);
                            $nc->appendChild($dom->createTextNode("\xC2\xA0"));
                        }
                        $nc->setAttribute('class', $cls);
                        $newTr->appendChild($nc);
                    }
                    $tr->parentNode->insertBefore($newTr, $tr);
                }
                $tr->parentNode->removeChild($tr);
            }
        }
    }

    private static function chunkTable(DOMElement $table, int $n = 6): array
    {
        $xp   = new DOMXPath($table->ownerDocument);
        $rows = iterator_to_array($xp->query('./tbody/tr | ./thead/tr | ./tr', $table));

        if (count($rows) <= $n + 1) {
            return [$table];
        }
        foreach ($xp->query('.//td | .//th', $table) as $c) {
            if ((int) $c->getAttribute('rowspan') > 1) {
                return [$table]; // rowspan wali table nahi todte
            }
        }

        $header   = array_shift($rows);              // pehli row header maan lo
        $colgroup = $xp->query('./colgroup', $table)->item(0);
        $out      = [];

        foreach (array_chunk($rows, $n) as $i => $chunk) {
            $t = $table->cloneNode(false);
            $t->setAttribute('class', 'pdf-chunk');
            if ($colgroup) {
                $t->appendChild($colgroup->cloneNode(true));
            }
            $tb = $table->ownerDocument->createElement('tbody');
            $tb->appendChild($i === 0 ? $header : $header->cloneNode(true));
            foreach ($chunk as $r) {
                $tb->appendChild($r);
            }
            $t->appendChild($tb);
            $out[] = $t;
        }
        return $out;
    }

    private static function unwrapLayoutTables(DOMDocument $dom, DOMXPath $xp): void
    {
        foreach (iterator_to_array($xp->query('//table[contains(@class,"pdf-borderless")]')) as $table) {
            if (!$table->parentNode) {
                continue;
            }

            $rows = iterator_to_array($xp->query('./tbody/tr | ./thead/tr | ./tfoot/tr | ./tr', $table));
            if (!$rows) {
                continue;
            }

            // sirf 1-2 cell wali, bina colspan/rowspan wali tables unwrap karo
            $ok = true;
            foreach ($rows as $tr) {
                $cells = $xp->query('./td | ./th', $tr);
                if ($cells->length < 1 || $cells->length > 2) { $ok = false; break; }
                foreach ($cells as $c) {
                    if ((int) $c->getAttribute('colspan') > 1 || (int) $c->getAttribute('rowspan') > 1) { $ok = false; break 2; }
                }
            }
            if (!$ok) {
                continue;
            }

            $wrap = $dom->createElement('div');

            foreach ($rows as $tr) {
                $cells = iterator_to_array($xp->query('./td | ./th', $tr));
                $row   = $dom->createElement('div');

                if (count($cells) === 2) {
                    $row->setAttribute('class', 'lrow');
                    $num = $dom->createElement('div');
                    $num->setAttribute('class', 'lnum');
                    while ($cells[0]->firstChild) { $num->appendChild($cells[0]->firstChild); }
                    $row->appendChild($num);

                    while ($cells[1]->firstChild) { $row->appendChild($cells[1]->firstChild); }
                } else {
                    while ($cells[0]->firstChild) { $row->appendChild($cells[0]->firstChild); }
                }
                $wrap->appendChild($row);
            }

            $table->parentNode->replaceChild($wrap, $table);
        }
    }
}