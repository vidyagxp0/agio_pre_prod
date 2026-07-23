<?php

if (!function_exists('quillEditor')) {
    function quillEditor(
        $name,
        $value = '',
        $label = '',
        $readonly = false,
        $height = '300px'
    ) {
        $uniqueId = str_replace('.', '_', uniqid('', true));

        $editorId  = 'editor_' . $uniqueId;
        $toolbarId = 'toolbar_' . $uniqueId;
        $modalId   = 'modal_' . $uniqueId;
        $hiddenId  = 'hidden_' . $uniqueId;

        $template = <<<'HTML'
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">

<style>
    .quill-smart-editor .ql-editor {
        overflow-y: auto;
        overflow-x: auto;
    }

    .quill-smart-editor .ql-html-table-embed {
        display: block;
        width: 100%;
        max-width: 100%;
        margin: 8px 0;
        overflow-x: auto;
        white-space: normal;
    }

    .quill-smart-editor .ql-html-table-embed table {
        width: 100% !important;
        max-width: 100% !important;
        border-collapse: collapse !important;
        border-spacing: 0 !important;
        table-layout: fixed !important;
    }

    .quill-smart-editor .ql-html-table-embed th,
    .quill-smart-editor .ql-html-table-embed td {
        border: 1px solid #000 !important;
        padding: 5px !important;
        vertical-align: top !important;
        text-align: left !important;
        white-space: normal !important;
        word-break: break-word !important;
        overflow-wrap: anywhere !important;
        box-sizing: border-box !important;
    }

    .quill-smart-editor .ql-html-table-embed tr:first-child th,
    .quill-smart-editor .ql-html-table-embed tr:first-child td {
        font-weight: 700 !important;
        text-align: center !important;
    }

    .quill-smart-editor .ql-html-table-embed p,
    .quill-smart-editor .ql-html-table-embed div {
        margin: 0 !important;
        padding: 0 !important;
    }

    .quill-smart-editor .ql-html-table-embed img {
        display: block;
        width: auto !important;
        max-width: 100% !important;
        height: auto !important;
        margin: 5px auto !important;
    }
</style>

<div class="group-input quill-smart-editor">
    __LABEL__

    <div id="__TOOLBAR_ID__">
        <span class="ql-formats">
            <select class="ql-font"></select>
            <select class="ql-size"></select>
        </span>

        <span class="ql-formats">
            <button class="ql-bold"></button>
            <button class="ql-italic"></button>
            <button class="ql-underline"></button>
            <button class="ql-strike"></button>
        </span>

        <span class="ql-formats">
            <select class="ql-color"></select>
            <select class="ql-background"></select>
        </span>

        <span class="ql-formats">
            <button class="ql-header" value="1"></button>
            <button class="ql-header" value="2"></button>
            <button class="ql-blockquote"></button>
            <button class="ql-code-block"></button>
        </span>

        <span class="ql-formats">
            <button class="ql-list" value="ordered"></button>
            <button class="ql-list" value="bullet"></button>
            <button class="ql-indent" value="-1"></button>
            <button class="ql-indent" value="+1"></button>
        </span>

        <span class="ql-formats">
            <select class="ql-align"></select>
        </span>

        <span class="ql-formats">
            <button class="ql-link"></button>
            <button class="ql-image"></button>
            <button class="ql-video"></button>
        </span>

        <span class="ql-formats">
            <button class="ql-clean"></button>

            <button
                type="button"
                id="clear___EDITOR_ID__"
                style="
                    color:#dc3545;
                    padding:2px 10px;
                    margin-left:5px;
                    cursor:pointer;
                    background:white;
                    font-size:13px;
                "
            >
                Clear
            </button>
        </span>
    </div>

    <div
        id="__EDITOR_ID__"
        style="height:__HEIGHT__; background:white;"
    >__VALUE__</div>

    <input
        type="hidden"
        name="__NAME__"
        id="__HIDDEN_ID__"
    >
</div>

<div
    id="__MODAL_ID__"
    style="
        display:none;
        position:fixed;
        inset:0;
        width:100%;
        height:100%;
        background:rgba(0,0,0,0.5);
        z-index:999999;
        justify-content:center;
        align-items:center;
    "
>
    <div style="
        background:white;
        width:420px;
        max-width:90%;
        border-radius:12px;
        overflow:hidden;
        box-shadow:0 10px 30px rgba(0,0,0,0.2);
    ">
        <div style="
            padding:18px 20px;
            border-bottom:1px solid #eee;
            display:flex;
            align-items:center;
            gap:10px;
        ">
            <div style="
                width:40px;
                height:40px;
                border-radius:50%;
                background:#fff5f5;
                color:#dc3545;
                display:flex;
                align-items:center;
                justify-content:center;
                font-size:18px;
                font-weight:bold;
            ">!</div>

            <div>
                <h5 style="margin:0; font-size:18px; color:#222;">
                    Clear Editor Content
                </h5>
                <small style="color:#777;">
                    This action will remove all editor content
                </small>
            </div>
        </div>

        <div style="padding:20px; color:#555; line-height:1.6; font-size:14px;">
            Are you sure you want to clear all content from this editor?
        </div>

        <div style="
            padding:15px 20px;
            border-top:1px solid #eee;
            display:flex;
            justify-content:flex-end;
            gap:10px;
        ">
            <button
                type="button"
                id="cancel___EDITOR_ID__"
                style="
                    border:none;
                    background:#f1f3f5;
                    color:#333;
                    padding:8px 16px;
                    border-radius:6px;
                    cursor:pointer;
                "
            >Cancel</button>

            <button
                type="button"
                id="confirm___EDITOR_ID__"
                style="
                    border:none;
                    background:#dc3545;
                    color:white;
                    padding:8px 16px;
                    border-radius:6px;
                    cursor:pointer;
                "
            >Yes, Clear</button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const editorElement = document.getElementById("__EDITOR_ID__");

    if (!editorElement || typeof Quill === "undefined") {
        return;
    }

    /*
    |--------------------------------------------------------------------------
    | Custom HTML table blot
    |--------------------------------------------------------------------------
    | Quill 2 does not natively preserve arbitrary Word/Excel HTML tables.
    | This embed keeps the complete table as one protected HTML block.
    */
    if (!window.__quillHtmlTableBlotRegistered) {
        const BlockEmbed = Quill.import("blots/block/embed");

        class HtmlTableBlot extends BlockEmbed {
            static create(value) {
                const node = super.create();

                node.setAttribute("contenteditable", "false");
                node.setAttribute("data-html-table", "1");
                node.innerHTML = typeof value === "string" ? value : "";

                return node;
            }

            static value(node) {
                return node.innerHTML;
            }
        }

        HtmlTableBlot.blotName = "htmlTable";
        HtmlTableBlot.tagName = "div";
        HtmlTableBlot.className = "ql-html-table-embed";

        Quill.register(HtmlTableBlot, true);
        window.__quillHtmlTableBlotRegistered = true;
    }

    const quill = new Quill(editorElement, {
        theme: "snow",
        modules: {
            toolbar: "#__TOOLBAR_ID__",
            history: {
                delay: 1000,
                maxStack: 100,
                userOnly: true
            }
        },
        readOnly: __READONLY__
    });

    const hiddenInput = document.getElementById("__HIDDEN_ID__");

    function updateHiddenInput() {
        hiddenInput.value = quill.root.innerHTML;
    }

    updateHiddenInput();

    quill.on("text-change", function () {
        updateHiddenInput();
    });

    function escapeHtml(value) {
        const div = document.createElement("div");
        div.textContent = value == null ? "" : String(value);
        return div.innerHTML;
    }

    function parseTabSeparatedTable(text) {
        return text
            .trim()
            .split(/\r?\n/)
            .filter(function (row) {
                return row.trim() !== "";
            })
            .map(function (row) {
                return row.split("\t").map(function (cell) {
                    return cell.trim();
                });
            });
    }

    function isMarkdownTable(text) {
        if (!text) {
            return false;
        }

        const lines = text
            .trim()
            .split(/\r?\n/)
            .filter(function (line) {
                return line.trim() !== "";
            });

        if (lines.length < 2) {
            return false;
        }

        return lines.some(function (line) {
            const cleaned = line
                .replace(/^\s*\|/, "")
                .replace(/\|\s*$/, "");

            return /^(\s*:?-+:?\s*\|)+\s*:?-+:?\s*$/.test(cleaned);
        });
    }

    function parseMarkdownTable(text) {
        return text
            .trim()
            .split(/\r?\n/)
            .map(function (line) {
                return line.trim();
            })
            .filter(function (line) {
                if (line === "") {
                    return false;
                }

                const cleaned = line
                    .replace(/^\|/, "")
                    .replace(/\|$/, "");

                return !/^(\s*:?-+:?\s*\|)+\s*:?-+:?\s*$/.test(cleaned);
            })
            .map(function (line) {
                return line
                    .replace(/^\|/, "")
                    .replace(/\|$/, "")
                    .split("|")
                    .map(function (cell) {
                        return cell.trim();
                    });
            });
    }

    /*
    |--------------------------------------------------------------------------
    | FIX 1: trim trailing empty columns for plain-text tables (Excel/Markdown)
    |--------------------------------------------------------------------------
    | Excel/Sheets clipboard sometimes adds a trailing empty column (extra tab
    | at end of row). Without trimming, that shows up as an unlabeled blank
    | column at the far right of the pasted table.
    */
    function trimEmptyTrailingColumns(rows) {
        if (!rows.length) return rows;

        let maxCols = Math.max.apply(null, rows.map(function (r) { return r.length; }));

        rows = rows.map(function (r) {
            const copy = r.slice();
            while (copy.length < maxCols) copy.push("");
            return copy;
        });

        while (maxCols > 1) {
            const lastColEmpty = rows.every(function (r) {
                return (r[maxCols - 1] || "").toString().trim() === "";
            });

            if (!lastColEmpty) break;

            rows = rows.map(function (r) {
                r.pop();
                return r;
            });
            maxCols--;
        }

        return rows;
    }

    function createTableHtml(rows) {
        if (!Array.isArray(rows) || rows.length === 0) {
            return "";
        }

        rows = trimEmptyTrailingColumns(rows);

        const columnCount = Math.max.apply(
            null,
            rows.map(function (row) {
                return row.length;
            })
        );

        const colWidthPercent = (100 / columnCount).toFixed(4) + "%";
        let html = '<table><colgroup>';

        for (let c = 0; c < columnCount; c++) {
            html += '<col style="width:' + colWidthPercent + '">';
        }

        html += '</colgroup><tbody>';

        rows.forEach(function (row, rowIndex) {
            html += "<tr>";

            for (let columnIndex = 0; columnIndex < columnCount; columnIndex++) {
                const content = escapeHtml(row[columnIndex] || "");

                html += "<td>";
                html += rowIndex === 0
                    ? "<strong>" + content + "</strong>"
                    : content;
                html += "</td>";
            }

            html += "</tr>";
        });

        html += "</tbody></table>";

        return html;
    }

    function removeUnsupportedOfficeElements(documentObject) {
        documentObject
            .querySelectorAll("script, style, meta, link, xml")
            .forEach(function (element) {
                element.remove();
            });

        ["o:p", "v:shape", "v:imagedata", "w:sdt"].forEach(function (tagName) {
            Array.from(documentObject.getElementsByTagName(tagName))
                .forEach(function (element) {
                    element.remove();
                });
        });
    }

    /*
    |--------------------------------------------------------------------------
    | FIX 2: strip the "ghost" trailing spacer column that Word/Excel inject
    |--------------------------------------------------------------------------
    | Word/Excel HTML clipboard frequently appends one extra empty <td> at the
    | end of every row (used internally for right-border spacing). If left in
    | place it renders as an unlabeled blank column on the right of the table.
    | We only drop it when EVERY row's last cell is truly empty (no text, no
    | image, no colspan) — so we never accidentally delete real data.
    */
    function stripTrailingGhostColumn(table) {
        let rows = Array.from(table.rows);
        if (rows.length < 1) return;

        // Keep stripping as long as the outermost trailing column is empty
        // everywhere (handles cases where Word adds more than one).
        while (true) {
            rows = Array.from(table.rows);

            const totalColumns = Math.max.apply(null, rows.map(function (row) {
                return Array.from(row.cells).reduce(function (sum, cell) {
                    return sum + parseInt(cell.getAttribute("colspan") || "1", 10);
                }, 0);
            }));

            if (totalColumns <= 1) return;

            let allLastEmpty = true;

            rows.forEach(function (row) {
                const lastCell = row.cells[row.cells.length - 1];

                if (!lastCell) {
                    allLastEmpty = false;
                    return;
                }

                const text = lastCell.textContent.replace(/\u00a0/g, "").trim();
                const hasImage = lastCell.querySelector("img");
                const colspan = parseInt(lastCell.getAttribute("colspan") || "1", 10);
                const rowspan = parseInt(lastCell.getAttribute("rowspan") || "1", 10);

                if (text !== "" || hasImage || colspan > 1 || rowspan > 1) {
                    allLastEmpty = false;
                }
            });

            if (!allLastEmpty) return;

            rows.forEach(function (row) {
                const lastCell = row.cells[row.cells.length - 1];
                if (lastCell) row.removeChild(lastCell);
            });
        }
    }

    /*
    |--------------------------------------------------------------------------
    | FIX 3: read original column widths so proportions match the source
    |--------------------------------------------------------------------------
    */
    function buildColgroupFromSource(sourceTable, columnCount) {
        const widths = [];

        const sourceCols = sourceTable.querySelectorAll("colgroup > col");

        sourceCols.forEach(function (col) {
            const styleAttr = col.getAttribute("style") || "";
            const widthAttr = col.getAttribute("width") || "";

            const styleMatch = styleAttr.match(/width\s*:\s*([\d.]+)(px|pt|%)/i);

            if (styleMatch) {
                widths.push({ value: parseFloat(styleMatch[1]), unit: styleMatch[2].toLowerCase() });
            } else if (/^[\d.]+%$/.test(widthAttr)) {
                widths.push({ value: parseFloat(widthAttr), unit: "%" });
            } else if (/^[\d.]+$/.test(widthAttr)) {
                widths.push({ value: parseFloat(widthAttr), unit: "px" });
            } else {
                widths.push(null);
            }
        });

        // Fallback: read width from the first row's cells if no <col> data
        if (widths.length === 0 && sourceTable.rows.length > 0) {
            Array.from(sourceTable.rows[0].cells).forEach(function (cell) {
                const styleAttr = cell.getAttribute("style") || "";
                const widthAttr = cell.getAttribute("width") || "";
                const styleMatch = styleAttr.match(/width\s*:\s*([\d.]+)(px|pt|%)/i);
                const colspan = parseInt(cell.getAttribute("colspan") || "1", 10);

                let entry = null;
                if (styleMatch) {
                    entry = { value: parseFloat(styleMatch[1]) / colspan, unit: styleMatch[2].toLowerCase() };
                } else if (/^[\d.]+$/.test(widthAttr)) {
                    entry = { value: parseFloat(widthAttr) / colspan, unit: "px" };
                }

                for (let i = 0; i < colspan; i++) widths.push(entry);
            });
        }

        const usable = widths.filter(Boolean);

        if (usable.length === 0 || widths.length !== columnCount) {
            // No reliable source widths — fall back to equal columns
            const equal = (100 / columnCount).toFixed(4) + "%";
            let html = "<colgroup>";
            for (let i = 0; i < columnCount; i++) html += '<col style="width:' + equal + '">';
            return html + "</colgroup>";
        }

        const total = usable.reduce(function (sum, w) { return sum + w.value; }, 0);

        let html = "<colgroup>";
        widths.forEach(function (w) {
            const pct = w ? ((w.value / total) * 100).toFixed(4) : (100 / columnCount).toFixed(4);
            html += '<col style="width:' + pct + '%">';
        });
        html += "</colgroup>";

        return html;
    }

    function cleanCellHtml(sourceCell, documentObject) {
        const wrapper = documentObject.createElement("div");
        wrapper.innerHTML = sourceCell.innerHTML;

        wrapper.querySelectorAll("*").forEach(function (element) {
            element.removeAttribute("class");
            element.removeAttribute("id");
            element.removeAttribute("width");
            element.removeAttribute("height");
            element.removeAttribute("lang");
            element.removeAttribute("dir");

            if (element.tagName !== "IMG") {
                element.removeAttribute("style");
            }
        });

        wrapper.querySelectorAll("p").forEach(function (paragraph) {
            const block = documentObject.createElement("div");
            block.innerHTML = paragraph.innerHTML;
            paragraph.replaceWith(block);
        });

        wrapper.querySelectorAll("img").forEach(function (image) {
            const src = image.getAttribute("src") || "";

            const supported =
                src.startsWith("data:image/") ||
                src.startsWith("http://") ||
                src.startsWith("https://") ||
                src.startsWith("/");

            if (!supported) {
                image.remove();
                return;
            }

            image.removeAttribute("width");
            image.removeAttribute("height");
            image.setAttribute(
                "style",
                "display:block;width:auto;max-width:100%;height:auto;margin:5px auto;"
            );
        });

        const cleaned = wrapper.innerHTML.trim();
        return cleaned === "" ? "<br>" : cleaned;
    }

    function cleanHtmlTables(html) {
        const parser = new DOMParser();
        const documentObject = parser.parseFromString(html, "text/html");

        removeUnsupportedOfficeElements(documentObject);

        const tables = Array.from(
            documentObject.querySelectorAll("table")
        ).filter(function (table) {
            return !table.parentElement.closest("table");
        });

        tables.forEach(function (sourceTable) {
            // Fix 2: drop Word/Excel's ghost trailing spacer column first,
            // on the ORIGINAL table, before we read widths or rebuild rows.
            stripTrailingGhostColumn(sourceTable);

            const columnCount = Math.max.apply(null, Array.from(sourceTable.rows).map(function (row) {
                return Array.from(row.cells).reduce(function (sum, cell) {
                    return sum + parseInt(cell.getAttribute("colspan") || "1", 10);
                }, 0);
            }));

            const newTable = documentObject.createElement("table");

            // Fix 3: preserve original column proportions
            newTable.insertAdjacentHTML("afterbegin", buildColgroupFromSource(sourceTable, columnCount));

            const tbody = documentObject.createElement("tbody");

            Array.from(sourceTable.rows).forEach(function (sourceRow, rowIndex) {
                const newRow = documentObject.createElement("tr");

                Array.from(sourceRow.cells).forEach(function (sourceCell) {
                    const newCell = documentObject.createElement("td");

                    const colspan = parseInt(
                        sourceCell.getAttribute("colspan") || "1",
                        10
                    );

                    const rowspan = parseInt(
                        sourceCell.getAttribute("rowspan") || "1",
                        10
                    );

                    if (colspan > 1) {
                        newCell.setAttribute("colspan", String(colspan));
                    }

                    if (rowspan > 1) {
                        newCell.setAttribute("rowspan", String(rowspan));
                    }

                    const content = cleanCellHtml(
                        sourceCell,
                        documentObject
                    );

                    newCell.innerHTML = rowIndex === 0
                        ? "<strong>" + content + "</strong>"
                        : content;

                    newRow.appendChild(newCell);
                });

                if (newRow.children.length > 0) {
                    tbody.appendChild(newRow);
                }
            });

            newTable.appendChild(tbody);
            sourceTable.replaceWith(newTable);
        });

        return Array.from(
            documentObject.body.querySelectorAll("table")
        ).map(function (table) {
            return table.outerHTML;
        }).join("");
    }

    function insertTableEmbed(tableHtml) {
        if (!tableHtml) {
            return;
        }

        const selection = quill.getSelection(true);
        const index = selection
            ? selection.index
            : Math.max(0, quill.getLength() - 1);

        if (selection && selection.length > 0) {
            quill.deleteText(index, selection.length, "user");
        }

        quill.insertEmbed(index, "htmlTable", tableHtml, "user");
        quill.insertText(index + 1, "\n", "user");
        quill.setSelection(index + 2, 0, "silent");

        window.setTimeout(updateHiddenInput, 50);
    }

    if (!__READONLY__) {
        quill.root.addEventListener("paste", function (event) {
            const clipboardData =
                event.clipboardData || window.clipboardData;

            if (!clipboardData) {
                return;
            }

            const pastedHtml =
                clipboardData.getData("text/html") || "";

            const pastedText =
                clipboardData.getData("text/plain") || "";

            try {
                /*
                 * Word, browser and HTML table.
                 */
                if (
                    pastedHtml &&
                    /<table[\s>]/i.test(pastedHtml)
                ) {
                    const tableHtml = cleanHtmlTables(pastedHtml);

                    if (tableHtml) {
                        event.preventDefault();
                        event.stopPropagation();
                        insertTableEmbed(tableHtml);
                        return;
                    }
                }

                /*
                 * Excel / Google Sheets tabular data.
                 */
                if (
                    pastedText &&
                    pastedText.includes("\t") &&
                    pastedText.includes("\n")
                ) {
                    const rows = parseTabSeparatedTable(pastedText);

                    if (rows.length > 1) {
                        event.preventDefault();
                        event.stopPropagation();
                        insertTableEmbed(createTableHtml(rows));
                        return;
                    }
                }

                /*
                 * Markdown table.
                 */
                if (
                    pastedText &&
                    isMarkdownTable(pastedText)
                ) {
                    const rows = parseMarkdownTable(pastedText);

                    if (rows.length > 1) {
                        event.preventDefault();
                        event.stopPropagation();
                        insertTableEmbed(createTableHtml(rows));
                    }
                }

                /*
                 * Other text, lists and images use normal Quill paste.
                 */
            } catch (error) {
                console.error("Quill table paste failed:", error);
            }
        });
    }

    const clearBtn =
        document.getElementById("clear___EDITOR_ID__");

    const modal =
        document.getElementById("__MODAL_ID__");

    const cancelBtn =
        document.getElementById("cancel___EDITOR_ID__");

    const confirmBtn =
        document.getElementById("confirm___EDITOR_ID__");

    clearBtn.addEventListener("click", function () {
        modal.style.display = "flex";
    });

    cancelBtn.addEventListener("click", function () {
        modal.style.display = "none";
    });

    confirmBtn.addEventListener("click", function () {
        quill.setContents([]);
        hiddenInput.value = "";
        modal.style.display = "none";
    });

    modal.addEventListener("click", function (event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
});
</script>
HTML;

        return strtr($template, [
            '__LABEL__'      => $label ?: '',
            '__TOOLBAR_ID__' => $toolbarId,
            '__EDITOR_ID__'  => $editorId,
            '__MODAL_ID__'   => $modalId,
            '__HIDDEN_ID__'  => $hiddenId,
            '__HEIGHT__'     => $height,
            '__VALUE__'      => $value,
            '__NAME__'       => htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
            '__READONLY__'   => $readonly ? 'true' : 'false',
        ]);
    }
}
