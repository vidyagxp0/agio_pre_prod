<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Document;
use App\Models\DocumentContent;

use App\Models\DocumentLanguage;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class DocumentContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $documents = DocumentContent::all();

        return view('frontend.documents.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $departments = Department::all();
        $documentTypes = DocumentType::all();
        $documentLanguages = DocumentLanguage::all();
        return view('frontend.documents.create', compact('departments', 'documentTypes', 'documentLanguages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        if ($request->submit == "save") {

            $document = new DocumentContent();
            $documentid = mt_rand(1000, 9999);
            $document->document_id = $documentid;
            $document->purpose = $document->purpose;
            $document->scope = $document->scope;
            $document->responsibility = $document->responsibility;
            $document->abbreviation = $document->abbreviation;
            $document->defination = $document->defination;
            $document->materials_and_equipments = $document->materials_and_equipments;
            $document->procedure = $document->procedure;
            $document->reporting = $document->reporting;
            $document->references = $document->references;
            
            $document->save();
            toastr()->success('Document Content created');
            return redirect()->route('documentcontents.index');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $document = DocumentContent::where('document_id',$id)->value('document_id');
        return response()->json(['success' => true, 'document' => $document]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $document = DocumentContent::find($id);
        $documentid = mt_rand(1000, 9999);
        $document->document_id = $documentid;
        $document->purpose = $document->purpose;
        $document->scope = $document->scope;
        $document->responsibility = $document->responsibility;
        $document->abbreviation = $document->abbreviation;
        $document->defination = $document->defination;
        $document->materials_and_equipments = $document->materials_and_equipments;
        $document->procedure = $document->procedure;
        $document->reporting = $document->reporting;
        $document->references = $document->references;

        $document->save();

        toastr()->success('Document Content Updated');
        return redirect()->route('documentcontent.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $document = DocumentContent::find($id);
        $document->delete();
        toastr()->success('Deleted successfully');
        return redirect()->back();
    }

    public function createPDF($id)
    {
        // $document = Document::where('id', $id)->get();
        $pdf = PDF::loadView('frontend.documents.pdfpage')->setOptions(['defaultFont' => 'sans-serif']);
        // download PDF file with download method
        return $pdf->download('SOP' . $id . '.pdf');
    }
}