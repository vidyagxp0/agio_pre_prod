<?php

namespace App\Http\Controllers;
use Spatie\PdfToText\PdfToText;

use setasign\Fpdi\Fpdi;
use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentContent;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function PDFimport(Request $request)
    {
        $pdfFile = $request->file('meta');
        $pdfToText = new PdfToText($pdfFile);
        $text = $pdfToText->text();
return $text;

            $data1 = [
                'column1' => 'value1',
                'column2' => 'value2',
                // ...
            ];
            $data2 = [
                'column1' => 'value3',
                'column2' => 'value4',
                // ...
            ];

            // Store data in Table1
            Document::create($data1);

            // Store data in Table2
            DocumentContent::create($data2);

            return 'PDF data imported successfully!';
        }


}
