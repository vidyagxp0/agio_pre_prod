<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Print Document</title>

    <style>
        html,
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background: #f1f1f1;
            font-family: Arial, sans-serif;
        }

        #print-frame {
            width: 100%;
            height: 100vh;
            border: 0;
            display: block;
        }

        #print-loading {
            position: fixed;
            inset: 0;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
        }

        .loading-box {
            padding: 25px 35px;
            border: 1px solid #dddddd;
            border-radius: 6px;
            background: #ffffff;
            text-align: center;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.08);
        }

        .loading-title {
            margin-bottom: 8px;
            font-size: 18px;
            font-weight: bold;
        }

        .loading-description {
            color: #666666;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div id="print-loading">
        <div class="loading-box">
            <div class="loading-title">
                Preparing Print Preview...
            </div>

            <div class="loading-description">
                Please wait while the document is loaded.
            </div>
        </div>
    </div>

    <iframe
        id="print-frame"
        title="Document Print Preview"
        src="data:application/pdf;base64,{{ $pdfBase64 }}">
    </iframe>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const printFrame =
                document.getElementById('print-frame');

            const loading =
                document.getElementById('print-loading');

            let printTriggered = false;

            const openPrintDialog = function () {
                if (printTriggered) {
                    return;
                }

                printTriggered = true;

                if (loading) {
                    loading.style.display = 'none';
                }

                setTimeout(function () {
                    try {
                        printFrame.focus();

                        if (
                            printFrame.contentWindow &&
                            typeof printFrame.contentWindow.print ===
                                'function'
                        ) {
                            printFrame.contentWindow.focus();
                            printFrame.contentWindow.print();
                        } else {
                            window.focus();
                            window.print();
                        }
                    } catch (error) {
                        console.error(
                            'Automatic print preview failed:',
                            error
                        );

                        window.focus();
                        window.print();
                    }
                }, 1000);
            };

            /*
            |--------------------------------------------------------------------------
            | PDF iframe loaded
            |--------------------------------------------------------------------------
            */

            printFrame.addEventListener(
                'load',
                function () {
                    setTimeout(
                        openPrintDialog,
                        1200
                    );
                }
            );

            /*
            |--------------------------------------------------------------------------
            | Fallback
            |--------------------------------------------------------------------------
            |
            | Browser PDF viewer sometimes iframe load event late fire karta hai.
            |--------------------------------------------------------------------------
            */

            setTimeout(
                openPrintDialog,
                4000
            );
        });
    </script>

</body>

</html>