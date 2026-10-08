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

        libxml_use_internal_errors(true);
        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->loadHTML(
            '<?xml encoding="UTF-8"><div id="__root">' . $html . '</div>',
            LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
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
}