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
        'img' => ['src', 'alt', 'width', 'height'],
        'td'  => ['colspan', 'rowspan'],
        'th'  => ['colspan', 'rowspan'],
        'ol'  => ['start', 'type'],
        'li'  => ['value'],
        'col' => ['span'],
    ];

    private const BLOCK_TAGS = ['p', 'div', 'table', 'ul', 'ol', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'blockquote', 'pre', 'hr'];

    /* ====================================================================
       MAIN ENTRY
       ==================================================================== */
    public static function clean(?string $html): string
    {
        if ($html === null || trim($html) === '') {
            return '';
        }

        ini_set('pcre.backtrack_limit', '10000000');

        $html = preg_replace('/<!--.*?-->/s', '', $html) ?? $html;
        $html = preg_replace('#<(style|script)\b[^>]*>.*?</\1>#is', '', $html) ?? $html;
        $html = preg_replace('#</?(o|w|m):[^>]*>#i', '', $html) ?? $html;
        $html = preg_replace('#<span>(.*?)</span>#is', '$1', $html) ?? $html;
        $html = preg_replace('#<span[^>]*>\s*</span>#i', '', $html) ?? $html;

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

        // 1) Table widths (nested tables bhi)
        foreach (iterator_to_array($xp->query('//table')) as $table) {
            self::fixTable($table, $xp);
        }

        // 2) Whitelist sanitize
        foreach (iterator_to_array($xp->query('//div[@id="__root"]//*')) as $el) {
            if ($el->parentNode) {
                self::sanitizeElement($el);
            }
        }

        // 3) bina style wale span unwrap
        foreach (iterator_to_array($xp->query('//div[@id="__root"]//span[not(@style)]')) as $sp) {
            while ($sp->firstChild) {
                $sp->parentNode->insertBefore($sp->firstChild, $sp);
            }
            $sp->parentNode->removeChild($sp);
        }
        // 3b) Cell ke aage-peeche ki faltu khali lines (Word ka <p><br></p>)
        self::trimCellBlanks($xp);

        // 4) Images
        self::prepareImagesForPdf($xp);

        // 5a) 2-column "number | bada text" tables ko flow me badlo (dompdf page-split bug se bachne ke liye)
        self::flowifyNumberTables($dom, $xp);

        // 5b) NEW: rowspan hatao, har row me apna cell (dompdf page-split bug fix)
        self::flattenRowspansInDom($dom, $xp);

        // 5) Bade (Word ke) cells ko chhoti rows me todo, taaki page par fit ho
        self::splitTallRows($dom, $xp);

        // 6) Faltu khali paragraphs
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

    /* ====================================================================
       flattenRowspans (RMS specification ke liye, pehle jaisa)
       ==================================================================== */
    public static function flattenRowspans(?string $html): string
    {
        $html = (string) $html;
        if (stripos($html, 'rowspan') === false) {
            return $html;
        }

        libxml_use_internal_errors(true);
        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->loadHTML('<?xml encoding="UTF-8"><div id="w">' . $html . '</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $xp = new DOMXPath($dom);

        foreach ($xp->query('//table') as $table) {
            $pending = [];
            foreach ($xp->query('.//tr', $table) as $tr) {
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
                $col  = 0;
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

    /* ====================================================================
       IMAGES
       ==================================================================== */
    private static function prepareImagesForPdf(DOMXPath $xp): void
    {
        foreach (iterator_to_array($xp->query('//div[@id="__root"]//img')) as $img) {
            $src = trim($img->getAttribute('src'));
            if ($src === '') {
                continue;
            }
            $b64 = self::convertSrcToBase64($src);
            if ($b64) {
                $img->setAttribute('src', $b64);
            }
            // Asli size rakho, bas page se bahar na jaye (CSS max-width:100% sambhalega)
            $st = self::parseStyle($img->getAttribute('style'));
            unset($st['width'], $st['height'], $st['max-width'], $st['display'], $st['margin']);
            self::setStyle($img, $st);
        }
    }

    private static function convertSrcToBase64(string $src): ?string
    {
        if (stripos($src, 'data:image/') === 0) {
            return $src;
        }

        $pathOnly   = ltrim(parse_url($src, PHP_URL_PATH) ?? '', '/');
        $candidates = [
            public_path($pathOnly),
            public_path('upload/' . basename($pathOnly)),
            public_path('uploads/' . basename($pathOnly)),
            public_path('user/images/' . basename($pathOnly)),
        ];
        foreach ($candidates as $f) {
            if ($pathOnly !== '' && is_file($f)) {
                $mime = mime_content_type($f) ?: 'image/png';
                return 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($f));
            }
        }

        if (preg_match('#^https?://#i', $src)) {
            try {
                $ctx = stream_context_create([
                    'ssl'  => ['verify_peer' => false, 'verify_peer_name' => false],
                    'http' => ['timeout' => 5],
                ]);
                $content = @file_get_contents($src, false, $ctx);
                if ($content !== false && $content !== '') {
                    $mime = (new \finfo(FILEINFO_MIME_TYPE))->buffer($content) ?: 'image/png';
                    return 'data:' . $mime . ';base64,' . base64_encode($content);
                }
            } catch (\Throwable $e) {
            }
        }
        return null;
    }

    /* ====================================================================
       TABLE WIDTHS
       - har table (nested bhi) ko percent colgroup + class pdf-fixed
       - nowrap / height / bade px widths hatao
       ==================================================================== */
    private static function fixTable(DOMElement $table, DOMXPath $xp): void
    {
        $layout  = self::isLayoutTable($table, $xp);
        $classes = [];
        if ($layout || !self::tableHasBorders($table, $xp)) {
            $classes[] = 'pdf-borderless';
        }

        $colW = [];
        foreach ($xp->query('./colgroup/col', $table) as $col) {
            $w    = self::readWidth($col);
            $span = max(1, (int) $col->getAttribute('span'));
            for ($k = 0; $k < $span; $k++) {
                $colW[] = $w;
            }
        }

        $rows = $xp->query('./tbody/tr | ./thead/tr | ./tfoot/tr | ./tr', $table);
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

        $allCells = $xp->query(
            './tbody/tr/td | ./tbody/tr/th | ./thead/tr/td | ./thead/tr/th | ./tfoot/tr/td | ./tfoot/tr/th | ./tr/td | ./tr/th',
            $table
        );
        foreach ($allCells as $c) {
            $st = self::parseStyle($c->getAttribute('style'));
            unset($st['width'], $st['height'], $st['min-width'], $st['max-width'], $st['white-space']);
            self::setStyle($c, $st);
            $c->removeAttribute('width');
            $c->removeAttribute('height');
        }
        $table->removeAttribute('width');
        $table->removeAttribute('height');

        $n   = $best ? $max : count($colW);
        $raw = [];
        for ($i = 0; $i < $n; $i++) {
            $w = $colW[$i] ?? null;
            if ($w === null || $w <= 0) {
                $w = $cellW[$i] ?? null;
            }
            $raw[] = ($w !== null && $w > 0) ? $w : null;
        }
        $known = array_filter($raw, fn ($v) => $v !== null);

        if ($layout && $n === 2) {          // number | text layout table
            $raw   = [9, 91];
            $known = $raw;
        }

        foreach (iterator_to_array($xp->query('./colgroup', $table)) as $cg) {
            $table->removeChild($cg);
        }

        if ($n > 0 && $known) {
            $avg   = array_sum($known) / count($known);
            $raw   = array_map(fn ($v) => $v ?? $avg, $raw);
            $total = array_sum($raw) ?: 1;

            // har column kam se kam 6% (ya jitna fit ho)
            $minP = min(6.0, 100 / max($n, 1));
            $pcts = [];
            foreach ($raw as $v) {
                $pcts[] = max($minP, $v / $total * 100);
            }
            $sum = array_sum($pcts) ?: 1;

            $doc      = $table->ownerDocument;
            $colgroup = $doc->createElement('colgroup');
            foreach ($pcts as $i => $v) {
                $p   = round($v / $sum * 100, 2);
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
            $classes[] = 'pdf-fixed';
        }

        if ($classes) {
            $table->setAttribute('class', trim($table->getAttribute('class') . ' ' . implode(' ', $classes)));
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
            $v = (float) $m[1];
            switch (strtolower($m[2] ?? '')) {
                case 'pt': return $v * 1.3333;
                case 'mm': return $v * 3.7795;
                case 'cm': return $v * 37.795;
                case 'in': return $v * 96;
                default:   return $v;
            }
        }
        return null;
    }

    /* ====================================================================
       SANITIZE
       ==================================================================== */
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

        // Word ke wrapper div ka center hatao
        if ($tag === 'div' && ($clean['text-align'] ?? '') === 'center') {
            unset($clean['text-align']);
        }

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

        if ($el->hasAttribute('class')) {
            $keepCls = [];
            foreach (preg_split('/\s+/', trim($el->getAttribute('class'))) as $c) {
                if ($c !== '' && preg_match('/^(ql-|proc-|pdf-)/', $c)) {
                    $keepCls[] = $c;
                }
            }
            $keepCls ? $el->setAttribute('class', implode(' ', $keepCls)) : $el->removeAttribute('class');
        }

        if ($tag === 'a' && $el->hasAttribute('href')
            && !preg_match('#^(https?:|mailto:|\#)#i', trim($el->getAttribute('href')))) {
            $el->removeAttribute('href');
        }

        if ($tag === 'img') {
            $src = trim($el->getAttribute('src'));
            if (!preg_match('#^(/|\./|https?:|data:image/)#i', $src)) {
                \Log::warning('PDF img dropped: ' . substr($src, 0, 80));
                $el->parentNode->removeChild($el);
                return;
            }
            // width/height attributes px me rehne do (asli size)
        }

        self::setStyle($el, $clean);
    }

    /* ====================================================================
       BADE CELLS KO CHHOTI ROWS ME TODNA
       Word ke "Sr. No. | Test Methods" jaise table me ek cell me poora test
       hota hai. dompdf row ko beech se nahi todta, isliye us cell ke
       blocks (p / nested table) ko alag-alag rows me baant dete hain.
       Sirf top-level tables par. Nested tables jaise hain waise rehte hain.
       ==================================================================== */
    private static function splitTallRows(DOMDocument $dom, DOMXPath $xp): void
    {
        $rows = iterator_to_array($xp->query(
            '//div[@id="__root"]//table[not(ancestor::table)]/tbody/tr | //div[@id="__root"]//table[not(ancestor::table)]/tr'
        ));

        foreach ($rows as $tr) {
            if (!$tr->parentNode) {
                continue;
            }
            $cells = iterator_to_array($xp->query('./td | ./th', $tr));
            if (!$cells) {
                continue;
            }
            foreach ($cells as $c) {
                if ((int) $c->getAttribute('rowspan') > 1) {
                    continue 2;
                }
            }

            $big       = null;
            $bigBlocks = [];
            foreach ($cells as $c) {
                $b = self::blocksOf($dom, $c);
                if (count($b) > count($bigBlocks)) {
                    $big       = $c;
                    $bigBlocks = $b;
                }
            }
            if (!$big || count($bigBlocks) < 3) {
                continue;
            }

            // chhote blocks ko 3-3 ke group me, nested table akeli
            $chunks = [];
            $cur    = [];
            foreach ($bigBlocks as $b) {
                $isTable = $b instanceof DOMElement && strtolower($b->nodeName) === 'table';
                if ($isTable) {
                    if ($cur) { $chunks[] = $cur; $cur = []; }
                    $chunks[] = [$b];
                } else {
                    $cur[] = $b;
                    if (count($cur) >= 3) { $chunks[] = $cur; $cur = []; }
                }
            }
            if ($cur) {
                $chunks[] = $cur;
            }
            if (count($chunks) < 2) {
                continue;
            }

            $last = count($chunks) - 1;
            foreach ($chunks as $i => $chunk) {
                $cls   = $i === 0 ? 'pdf-cont-first' : ($i === $last ? 'pdf-cont-last' : 'pdf-cont-mid');
                $newTr = $tr->cloneNode(false);

                foreach ($cells as $c) {
                    if ($c === $big) {
                        $nc = $c->cloneNode(false);
                        if (count($chunk) === 1) {
                            $nc->appendChild($chunk[0]);
                        } else {
                            $wrap = $dom->createElement('div');
                            foreach ($chunk as $node) {
                                $wrap->appendChild($node);
                            }
                            $nc->appendChild($wrap);
                        }
                    } elseif ($i === 0) {
                        $nc = $c;
                    } else {
                        $nc = $c->cloneNode(false);
                        $nc->appendChild($dom->createTextNode("\xC2\xA0"));
                    }
                    $nc->setAttribute('class', trim($nc->getAttribute('class') . ' ' . $cls));
                    $newTr->appendChild($nc);
                }
                $tr->parentNode->insertBefore($newTr, $tr);
            }
            $tr->parentNode->removeChild($tr);
        }
    }

    private static function blocksOf(DOMDocument $dom, DOMElement $cell): array
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

        $countBr = function (array $nodes): int {
            $k = 0;
            foreach ($nodes as $n) {
                if ($n instanceof DOMElement && strtolower($n->nodeName) === 'br') {
                    $k++;
                }
            }
            return $k;
        };

        $blocks = $filter($cell);

        // ek hi wrapper (div/span, ya <br> wala p) ho to uske andar jao
        while (count($blocks) === 1 && $blocks[0] instanceof DOMElement) {
            $name  = strtolower($blocks[0]->nodeName);
            $inner = $filter($blocks[0]);
            if (!$inner) {
                break;
            }
            if (in_array($name, ['div', 'span'], true) || ($name === 'p' && $countBr($inner) >= 3)) {
                $blocks = $inner;
            } else {
                break;
            }
        }

        // <br> se alag hue lines ko alag blocks banao
        if ($countBr($blocks) >= 3) {
            $groups = [];
            $cur    = [];
            foreach ($blocks as $b) {
                if ($b instanceof DOMElement && strtolower($b->nodeName) === 'br') {
                    if ($cur) { $groups[] = $cur; $cur = []; }
                } else {
                    $cur[] = $b;
                }
            }
            if ($cur) {
                $groups[] = $cur;
            }

            $blocks = [];
            foreach ($groups as $g) {
                if (count($g) === 1 && $g[0] instanceof DOMElement
                    && in_array(strtolower($g[0]->nodeName), self::BLOCK_TAGS, true)) {
                    $blocks[] = $g[0];
                } else {
                    $d = $dom->createElement('div');
                    foreach ($g as $node) {
                        $d->appendChild($node);
                    }
                    $blocks[] = $d;
                }
            }
        }

        return $blocks;
    }

    /* ====================================================================
       EMPTY PARAGRAPHS
       ==================================================================== */
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
        $prevEmpty = true;
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
        while ($parent->lastChild && self::isBlank($parent->lastChild)) {
            $parent->removeChild($parent->lastChild);
        }
    }

    /* ====================================================================
       STYLE HELPERS / BORDER DETECTION
       ==================================================================== */
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
        $explicit = false;
        foreach ($xp->query('.//td | .//th', $table) as $c) {
            foreach (self::parseStyle($c->getAttribute('style')) as $prop => $val) {
                if (strpos($prop, 'border') !== 0 || in_array($prop, ['border-width', 'border-color', 'border-image'], true)) {
                    continue;
                }
                $explicit = true;
                if (self::isRealBorder($prop, $val)) {
                    return true;
                }
            }
        }
        if ($explicit) {
            return false;
        }
        $attr = $table->getAttribute('border');
        if ($attr !== '' && (float) $attr == 0) {
            return false;
        }
        return true;
    }

    private static function isRealBorder(string $prop, string $val): bool
    {
        $v = strtolower(trim($val));
        if ($v === '' || $v === '0' || strpos($v, 'none') !== false || strpos($v, 'hidden') !== false) {
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

    /**
     * Word ka "number | text" layout table pehchano:
     * 3+ rows, har row me max 2 cells, pehla cell chhota (3.1, 9.1.1 ya khali),
     * koi th / colspan / rowspan nahi, aur header row "Sr. No." jaisi nahi.
     */
    private static function isLayoutTable(DOMElement $table, DOMXPath $xp): bool
    {
        $rows = iterator_to_array($xp->query('./tbody/tr | ./thead/tr | ./tfoot/tr | ./tr', $table));
        if (count($rows) < 3) {
            return false;
        }
        if ($xp->query('./thead/tr/th | ./tbody/tr/th | ./tr/th', $table)->length) {
            return false;
        }

        $short = 0;
        foreach ($rows as $i => $tr) {
            $cells = $xp->query('./td | ./th', $tr);
            if ($cells->length < 1 || $cells->length > 2) {
                return false;
            }
            foreach ($cells as $c) {
                if ((int) $c->getAttribute('colspan') > 1 || (int) $c->getAttribute('rowspan') > 1) {
                    return false;
                }
            }
            if ($cells->length === 1) {
                $short++;
                continue;
            }
            $t = trim(str_replace("\xC2\xA0", ' ', $cells->item(0)->textContent));
            if ($i === 0 && preg_match('/^(sr\b|s\.?\s*no|no\b|sl\b)/i', $t)) {
                return false;                       // asli header wali table
            }
            if (mb_strlen($t) <= 8) {
                $short++;
            }
        }
        return ($short / count($rows)) >= 0.8;
    }

    /**
     * 2-column table jisme pehla column chhota (number / "Sr. No.") hai aur dusre
     * column mein bahut bada content (ya nested table) hai.
     */
    private static function isNumberTable(DOMElement $table, DOMXPath $xp): bool
    {
        $rows = iterator_to_array($xp->query('./tbody/tr | ./thead/tr | ./tfoot/tr | ./tr', $table));
        if (count($rows) < 2) {
            return false;
        }

        $short = 0;
        $tall  = false;
        foreach ($rows as $i => $tr) {
            $cells = $xp->query('./td | ./th', $tr);
            if ($cells->length < 1 || $cells->length > 2) {
                return false;
            }
            foreach ($cells as $k => $c) {
                // number wale cell par rowspan chalega (Word me "3." do rows ko cover karta hai),
                // par text cell par rowspan, ya number cell par colspan nahi
                if ($cells->length === 2 && $k === 0 && (int) $c->getAttribute('colspan') > 1) {
                    return false;
                }
                if ((int) $c->getAttribute('rowspan') > 1 && $k === $cells->length - 1) {
                    return false;
                }
            }

            $txt = $cells->item($cells->length - 1);
            if (mb_strlen(trim($txt->textContent)) > 400 || $xp->query('.//table', $txt)->length) {
                $tall = true;
            }

            if ($cells->length === 1) {
                $short++;
                continue;
            }
            $t = trim(str_replace("\xC2\xA0", ' ', $cells->item(0)->textContent));
            if ($i === 0 && preg_match('/^(sr\b|s\.?\s*no|no\b|sl\b)/i', $t)) {
                $short++;
                continue;
            }
            if (mb_strlen($t) <= 8) {
                $short++;
            }
        }

        return $tall && ($short / count($rows)) >= 0.8;
    }

    private static function flowifyNumberTables(DOMDocument $dom, DOMXPath $xp): void
    {
        foreach (iterator_to_array($xp->query('//div[@id="__root"]//table[not(ancestor::table)]')) as $table) {
            if (!$table->parentNode || !self::isNumberTable($table, $xp)) {
                continue;
            }

            $boxed = strpos($table->getAttribute('class'), 'pdf-borderless') === false;

            $wrap = $dom->createElement('div');
            $wrap->setAttribute('class', $boxed ? 'pdf-flow pdf-flow-boxed' : 'pdf-flow');

            $rows = iterator_to_array($xp->query('./tbody/tr | ./thead/tr | ./tfoot/tr | ./tr', $table));
            foreach ($rows as $tr) {
                $cells   = iterator_to_array($xp->query('./td | ./th', $tr));
                $numCell = count($cells) === 2 ? $cells[0] : null;
                $txtCell = end($cells);
                $isHead  = strtolower($txtCell->nodeName) === 'th'
                    || ($numCell && strtolower($numCell->nodeName) === 'th');

                $blocks = self::blocksOf($dom, $txtCell);
                $first  = array_shift($blocks);

                $box = $dom->createElement('div');
                $box->setAttribute('class', trim(($boxed ? 'pdf-fbox' : 'pdf-fplain') . ($isHead ? ' pdf-fhead' : '')));

                // pehli line: number | pehla block
                $lt = $dom->createElement('table');
                $lt->setAttribute('class', 'lt pdf-borderless pdf-fixed');
                $cg = $dom->createElement('colgroup');
                foreach ([9, 91] as $p) {
                    $col = $dom->createElement('col');
                    $col->setAttribute('style', "width:{$p}%");
                    $cg->appendChild($col);
                }
                $lt->appendChild($cg);
                $tb  = $dom->createElement('tbody');
                $r   = $dom->createElement('tr');
                $td1 = $dom->createElement('td');
                $td1->setAttribute('class', 'pdf-numc');
                if ($numCell) {
                    while ($numCell->firstChild) {
                        $td1->appendChild($numCell->firstChild);
                    }
                } else {
                    $td1->appendChild($dom->createTextNode("\xC2\xA0"));
                }
                $td2 = $dom->createElement('td');
                $td2->setAttribute('class', 'pdf-txtc');
                if ($first) {
                    $td2->appendChild($first);
                } else {
                    $td2->appendChild($dom->createTextNode("\xC2\xA0"));
                }
                $r->appendChild($td1);
                $r->appendChild($td2);
                $tb->appendChild($r);
                $lt->appendChild($tb);
                $box->appendChild($lt);

                // baaki blocks: normal flow (page ke beech aaraam se tootenge)
                foreach ($blocks as $b) {
                    $d = $dom->createElement('div');
                    $d->setAttribute('class', $boxed ? 'pdf-fcont pdf-fcb' : 'pdf-fcont');
                    $d->appendChild($b);
                    $box->appendChild($d);
                }

                $wrap->appendChild($box);
            }

            $table->parentNode->replaceChild($wrap, $table);
        }
    }

        /* ====================================================================
       ROWSPAN FLATTEN (DOM ke andar)
       "2." cell jo 3 rows cover karta tha -> ab har row me apna cell.
       Beech ki line CSS (.rs-first/.rs-mid/.rs-last) chhupati hai.
       ==================================================================== */
    private static function flattenRowspansInDom(DOMDocument $dom, DOMXPath $xp): void
    {
        foreach (iterator_to_array($xp->query('//div[@id="__root"]//table[.//*[@rowspan]]')) as $table) {
            if (!$table->parentNode) {
                continue;
            }
            $pending = [];

            foreach (iterator_to_array($xp->query('.//tr', $table)) as $tr) {
                // sirf is table ki apni rows (nested table ki nahi)
                $p = $tr->parentNode;
                if (strtolower($p->nodeName) !== 'table') {
                    $p = $p->parentNode;
                }
                if (!$p->isSameNode($table)) {
                    continue;
                }

                $cells = [];
                foreach ($tr->childNodes as $n) {
                    if ($n->nodeType === XML_ELEMENT_NODE
                        && in_array(strtolower($n->nodeName), ['td', 'th'], true)) {
                        $cells[] = $n;
                    }
                }

                $col  = 0;
                $fill = function (?DOMNode $before) use (&$pending, &$col, $dom, $tr) {
                    while (!empty($pending[$col]) && $pending[$col]['left'] > 0) {
                        $at = $col;
                        $ph = $dom->createElement($pending[$at]['tag']);
                        if ($pending[$at]['cs'] > 1) {
                            $ph->setAttribute('colspan', (string) $pending[$at]['cs']);
                        }
                        if ($pending[$at]['style'] !== '') {
                            $ph->setAttribute('style', $pending[$at]['style']);
                        }
                        $pending[$at]['left']--;
                        $ph->setAttribute('class', $pending[$at]['left'] > 0 ? 'rs-mid' : 'rs-last');
                        $ph->appendChild($dom->createTextNode("\xC2\xA0"));
                        $before ? $tr->insertBefore($ph, $before) : $tr->appendChild($ph);
                        $col += $pending[$at]['cs'];
                    }
                };

                foreach ($cells as $cell) {
                    $fill($cell);
                    $cs = max(1, (int) $cell->getAttribute('colspan'));
                    $rs = max(1, (int) $cell->getAttribute('rowspan'));
                    if ($rs > 1) {
                        // background same rakho taaki merged dikhe
                        $st   = self::parseStyle($cell->getAttribute('style'));
                        $keep = array_intersect_key($st, array_flip(['background', 'background-color', 'vertical-align']));
                        $css  = '';
                        foreach ($keep as $k => $v) {
                            $css .= "$k:$v;";
                        }
                        $pending[$col] = [
                            'left'  => $rs - 1,
                            'cs'    => $cs,
                            'tag'   => strtolower($cell->nodeName),
                            'style' => $css,
                        ];
                        $cell->removeAttribute('rowspan');
                        $cell->setAttribute('class', trim($cell->getAttribute('class') . ' rs-first'));
                    }
                    $col += $cs;
                }
                $fill(null);
            }
        }
    }

    /* ====================================================================
       Cell ke shuru/aakhir ki khali lines hatao (Word: <p><br></p>)
       Poora khali cell waisa hi rehta hai.
       ==================================================================== */
    private static function trimCellBlanks(DOMXPath $xp): void
    {
        foreach (iterator_to_array($xp->query('//div[@id="__root"]//td | //div[@id="__root"]//th')) as $cell) {
            $hasContent = false;
            foreach (iterator_to_array($cell->childNodes) as $k) {
                if (!self::isBlank($k)) {
                    $hasContent = true;
                    break;
                }
            }
            if (!$hasContent) {
                continue;
            }
            while ($cell->lastChild && self::isBlank($cell->lastChild)) {
                $cell->removeChild($cell->lastChild);
            }
            while ($cell->firstChild && self::isBlank($cell->firstChild)) {
                $cell->removeChild($cell->firstChild);
            }
        }
    }
}