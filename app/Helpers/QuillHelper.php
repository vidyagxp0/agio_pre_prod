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

                hiddenInput.value = quill.root.innerHTML;

                quill.on("text-change", function () {

                    hiddenInput.value = quill.root.innerHTML;
                });

                // Modal Elements
                const clearBtn = document.getElementById("clear_'.$editorId.'");
                const modal = document.getElementById("'.$modalId.'");
                const cancelBtn = document.getElementById("cancel_'.$editorId.'");
                const confirmBtn = document.getElementById("confirm_'.$editorId.'");

                // Open Modal
                clearBtn.addEventListener("click", function () {

                    modal.style.display = "flex";
                });

                // Cancel Modal
                cancelBtn.addEventListener("click", function () {

                    modal.style.display = "none";
                });

                // Confirm Clear
                confirmBtn.addEventListener("click", function () {

                    quill.setContents([]);

                    hiddenInput.value = "";

                    modal.style.display = "none";
                });

                // Outside Click Close
                modal.addEventListener("click", function(e) {

                    if(e.target === modal) {

                        modal.style.display = "none";
                    }
                });

            });

        </script>
        ';
    }
}