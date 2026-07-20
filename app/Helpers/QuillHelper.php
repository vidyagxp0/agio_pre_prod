<?php

if (!function_exists('quillEditor')) {

    function quillEditor(
        $name,
        $value = '',
        $label = '',
        $readonly = false,
        $height = '300px'
    ) {

        $editorId = 'editor_' . uniqid();
        $toolbarId = 'toolbar_' . uniqid();
        $modalId = 'modal_' . uniqid();

        return '

        <!-- Quill CSS -->
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">

        <div class="group-input">

            '.($label ? $label : '').'

            <!-- Toolbar -->
            <div id="'.$toolbarId.'">

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

                    <button type="button"
                            id="clear_'.$editorId.'"
                            style="
                                color:#dc3545;
                                padding:2px 10px;
                                margin-left:5px;
                                cursor:pointer;
                                background:white;
                                font-size:13px;
                            ">
                        Clear
                    </button>

                </span>

            </div>

            <!-- Editor -->
            <div id="'.$editorId.'"
                 style="
                    height: '.$height.';
                    background: white;
                 ">
                 '.$value.'
            </div>

            <!-- Hidden Input -->
            <input type="hidden"
                   name="'.$name.'"
                   id="'.$name.'">

        </div>

        <!-- Modal -->
        <div id="'.$modalId.'"
             style="
                display:none;
                position:fixed;
                top:0;
                left:0;
                width:100%;
                height:100%;
                background:rgba(0,0,0,0.5);
                z-index:999999;
                justify-content:center;
                align-items:center;
             ">

            <div style="
                background:white;
                width:420px;
                max-width:90%;
                border-radius:12px;
                overflow:hidden;
                box-shadow:0 10px 30px rgba(0,0,0,0.2);
                animation:fadeIn 0.2s ease;
            ">

                <!-- Header -->
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
                    ">
                        !
                    </div>

                    <div>
                        <h5 style="
                            margin:0;
                            font-size:18px;
                            color:#222;
                        ">
                            Clear Editor Content
                        </h5>

                        <small style="color:#777;">
                            This action will remove all editor content
                        </small>
                    </div>

                </div>

                <!-- Body -->
                <div style="
                    padding:20px;
                    color:#555;
                    line-height:1.6;
                    font-size:14px;
                ">

                    Are you sure you want to clear all content from this editor?

                    <br><br>

                </div>

                <!-- Footer -->
                <div style="
                    padding:15px 20px;
                    border-top:1px solid #eee;
                    display:flex;
                    justify-content:flex-end;
                    gap:10px;
                ">

                    <button type="button"
                            id="cancel_'.$editorId.'"
                            style="
                                border:none;
                                background:#f1f3f5;
                                color:#333;
                                padding:8px 16px;
                                border-radius:6px;
                                cursor:pointer;
                            ">
                        Cancel
                    </button>

                    <button type="button"
                            id="confirm_'.$editorId.'"
                            style="
                                border:none;
                                background:#dc3545;
                                color:white;
                                padding:8px 16px;
                                border-radius:6px;
                                cursor:pointer;
                            ">
                        Yes, Clear
                    </button>

                </div>

            </div>

        </div>

        <!-- Quill JS -->
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {

                const quill = new Quill("#'.$editorId.'", {

                    theme: "snow",

                    modules: {

                        toolbar: "#'.$toolbarId.'",

                        history: {
                            delay: 1000,
                            maxStack: 100,
                            userOnly: true
                        }
                    },

                    readOnly: '.($readonly ? 'true' : 'false').'
                });

                const hiddenInput = document.getElementById("'.$name.'");

                /*
                |--------------------------------------------------------------------------
                | Update hidden input
                |--------------------------------------------------------------------------
                */

                function updateHiddenInput() {
                    hiddenInput.value = quill.root.innerHTML;
                }

                updateHiddenInput();

                quill.on("text-change", function () {
                    updateHiddenInput();
                });

                /*
                |--------------------------------------------------------------------------
                | Escape plain text before creating HTML table
                |--------------------------------------------------------------------------
                */

                function escapeTableHtml(value) {

                    const temporaryDiv = document.createElement("div");

                    temporaryDiv.textContent = value ?? "";

                    return temporaryDiv.innerHTML;
                }

                /*
                |--------------------------------------------------------------------------
                | Convert row array into Quill-compatible table
                |--------------------------------------------------------------------------
                |
                | Important:
                | TH/THEAD are intentionally not used because Quill sometimes combines
                | all TH cells into one cell. First row is represented using TD + STRONG.
                |
                */

                function createTableHtml(rows) {

                    if (!Array.isArray(rows) || rows.length === 0) {
                        return "";
                    }

                    const columnCount = Math.max(
                        ...rows.map(function (row) {
                            return row.length;
                        })
                    );

                    let html = `
                        <table style="
                            width:100%;
                            border-collapse:collapse;
                            table-layout:fixed;
                        ">
                            <tbody>
                    `;

                    rows.forEach(function (row, rowIndex) {

                        html += "<tr>";

                        for (
                            let columnIndex = 0;
                            columnIndex < columnCount;
                            columnIndex++
                        ) {

                            const cellValue = escapeTableHtml(
                                row[columnIndex] ?? ""
                            );

                            html += `
                                <td style="
                                    border:1px solid #000;
                                    padding:5px;
                                    vertical-align:top;
                                    text-align:left;
                                    word-break:break-word;
                                    overflow-wrap:break-word;
                                    white-space:normal;
                                ">
                                    ${
                                        rowIndex === 0
                                            ? "<strong>" + cellValue + "</strong>"
                                            : cellValue
                                    }
                                </td>
                            `;
                        }

                        html += "</tr>";
                    });

                    html += `
                            </tbody>
                        </table>
                        <p><br></p>
                    `;

                    return html;
                }

                /*
                |--------------------------------------------------------------------------
                | Parse Excel / Google Sheets tab-separated table
                |--------------------------------------------------------------------------
                */

                function parseTabSeparatedTable(text) {

                    return text
                        .trim()
                        .split(/\r?\n/)
                        .filter(function (row) {
                            return row.trim() !== "";
                        })
                        .map(function (row) {

                            return row
                                .split("\t")
                                .map(function (cell) {
                                    return cell.trim();
                                });
                        });
                }

                /*
                |--------------------------------------------------------------------------
                | Detect Markdown table
                |--------------------------------------------------------------------------
                */

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

                    const pipeRows = lines.filter(function (line) {
                        return line.includes("|");
                    });

                    const separatorRowExists = lines.some(function (line) {

                        const cleanedLine = line
                            .replace(/^\s*\|/, "")
                            .replace(/\|\s*$/, "");

                        return /^(\s*:?-+:?\s*\|)+\s*:?-+:?\s*$/.test(
                            cleanedLine
                        );
                    });

                    return pipeRows.length >= 2 && separatorRowExists;
                }

                /*
                |--------------------------------------------------------------------------
                | Parse Markdown table
                |--------------------------------------------------------------------------
                */

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

                            const cleanedLine = line
                                .replace(/^\|/, "")
                                .replace(/\|$/, "");

                            /*
                            * Remove Markdown separator:
                            * | --- | --- | --- |
                            */

                            return !/^(\s*:?-+:?\s*\|)+\s*:?-+:?\s*$/.test(
                                cleanedLine
                            );
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
                | Clean HTML tables copied from ChatGPT, Word or browser
                |--------------------------------------------------------------------------
                */

                function cleanPastedHtmlTables(html) {

                    const parser = new DOMParser();

                    const parsedDocument = parser.parseFromString(
                        html,
                        "text/html"
                    );

                    const tables = parsedDocument.querySelectorAll("table");

                    tables.forEach(function (oldTable) {

                        const rows = [];

                        oldTable.querySelectorAll("tr").forEach(function (oldRow) {

                            const cells = [];

                            oldRow.querySelectorAll(":scope > th, :scope > td")
                                .forEach(function (oldCell) {

                                    cells.push({
                                        html: oldCell.innerHTML.trim(),
                                        colspan: oldCell.getAttribute("colspan"),
                                        rowspan: oldCell.getAttribute("rowspan")
                                    });
                                });

                            if (cells.length > 0) {
                                rows.push(cells);
                            }
                        });

                        if (rows.length === 0) {
                            return;
                        }

                        /*
                        * Rebuild table without THEAD and TH.
                        * This prevents header merging inside Quill.
                        */

                        const newTable = parsedDocument.createElement("table");

                        newTable.setAttribute(
                            "style",
                            "width:100%;" +
                            "border-collapse:collapse;" +
                            "table-layout:fixed;"
                        );

                        const tbody = parsedDocument.createElement("tbody");

                        rows.forEach(function (row, rowIndex) {

                            const tr = parsedDocument.createElement("tr");

                            row.forEach(function (cellData) {

                                const td = parsedDocument.createElement("td");

                                td.setAttribute(
                                    "style",
                                    "border:1px solid #000;" +
                                    "padding:5px;" +
                                    "vertical-align:top;" +
                                    "text-align:left;" +
                                    "word-break:break-word;" +
                                    "overflow-wrap:break-word;" +
                                    "white-space:normal;"
                                );

                                if (cellData.colspan) {
                                    td.setAttribute(
                                        "colspan",
                                        cellData.colspan
                                    );
                                }

                                if (cellData.rowspan) {
                                    td.setAttribute(
                                        "rowspan",
                                        cellData.rowspan
                                    );
                                }

                                /*
                                * First row is table heading.
                                */

                                if (rowIndex === 0) {

                                    td.innerHTML =
                                        "<strong>" +
                                        cellData.html +
                                        "</strong>";

                                } else {

                                    td.innerHTML = cellData.html;
                                }

                                tr.appendChild(td);
                            });

                            tbody.appendChild(tr);
                        });

                        newTable.appendChild(tbody);

                        oldTable.replaceWith(newTable);
                    });

                    /*
                    * Remove unsafe pasted scripts/styles.
                    */

                    parsedDocument
                        .querySelectorAll("script, style, meta, link")
                        .forEach(function (element) {
                            element.remove();
                        });

                    return parsedDocument.body.innerHTML;
                }

                /*
                |--------------------------------------------------------------------------
                | Paste generated HTML at current cursor
                |--------------------------------------------------------------------------
                */

                function pasteHtmlInQuill(html) {

                    const selection = quill.getSelection(true);

                    const index = selection
                        ? selection.index
                        : Math.max(0, quill.getLength() - 1);

                    const selectionLength = selection
                        ? selection.length
                        : 0;

                    if (selectionLength > 0) {

                        quill.deleteText(
                            index,
                            selectionLength,
                            "user"
                        );
                    }

                    quill.clipboard.dangerouslyPasteHTML(
                        index,
                        html,
                        "user"
                    );

                    setTimeout(function () {
                        updateHiddenInput();
                    }, 50);
                }

                /*
                |--------------------------------------------------------------------------
                | Smart table paste handler
                |--------------------------------------------------------------------------
                */

                '.(!$readonly ? '

                quill.root.addEventListener(
                    "paste",
                    function (event) {

                        const clipboardData =
                            event.clipboardData ||
                            window.clipboardData;

                        if (!clipboardData) {
                            return;
                        }

                        const pastedHtml =
                            clipboardData.getData("text/html");

                        const pastedText =
                            clipboardData.getData("text/plain");

                        /*
                        * Case 1:
                        * HTML table copied from ChatGPT, Word or browser.
                        *
                        * TH cells are converted to TD + STRONG.
                        */

                        if (
                            pastedHtml &&
                            /<table[\s>]/i.test(pastedHtml)
                        ) {

                            event.preventDefault();
                            event.stopPropagation();
                            event.stopImmediatePropagation();

                            const cleanedHtml =
                                cleanPastedHtmlTables(pastedHtml);

                            pasteHtmlInQuill(cleanedHtml);

                            return;
                        }

                        /*
                        * Case 2:
                        * Excel / Google Sheets table.
                        */

                        if (
                            pastedText &&
                            pastedText.includes("\t") &&
                            pastedText.includes("\n")
                        ) {

                            const rows =
                                parseTabSeparatedTable(pastedText);

                            if (rows.length > 1) {

                                event.preventDefault();
                                event.stopPropagation();
                                event.stopImmediatePropagation();

                                pasteHtmlInQuill(
                                    createTableHtml(rows)
                                );

                                return;
                            }
                        }

                        /*
                        * Case 3:
                        * Markdown table.
                        */

                        if (
                            pastedText &&
                            isMarkdownTable(pastedText)
                        ) {

                            const rows =
                                parseMarkdownTable(pastedText);

                            if (rows.length > 1) {

                                event.preventDefault();
                                event.stopPropagation();
                                event.stopImmediatePropagation();

                                pasteHtmlInQuill(
                                    createTableHtml(rows)
                                );
                            }
                        }

                        /*
                        * Normal text, images, paragraphs and other content
                        * use Quill default paste handling.
                        */
                    },
                    true
                );

                ' : '').'

                /*
                |--------------------------------------------------------------------------
                | Clear modal logic — existing behavior unchanged
                |--------------------------------------------------------------------------
                */

                const clearBtn =
                    document.getElementById("clear_'.$editorId.'");

                const modal =
                    document.getElementById("'.$modalId.'");

                const cancelBtn =
                    document.getElementById("cancel_'.$editorId.'");

                const confirmBtn =
                    document.getElementById("confirm_'.$editorId.'");

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
        ';
    }
}