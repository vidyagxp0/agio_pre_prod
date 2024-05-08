<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentSubtype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocSubtypeController extends Controller
{
    /**     
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $document = DB::table('document_subtypes')
            ->leftJoin("document_types", "document_types.id", "=", "document_subtypes.docType_id")
            ->select(
                'document_types.name as dname',
                'document_subtypes.*'
            )->orderBy('id', "desc")->get();
        $department = DB::table('document_types')->get();

        return view('admin.documentSubtype.document', compact('document', 'department'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //


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
        $document = new DocumentSubtype();
        $document->docSubtype = $request->name;
        $document->doctype_id = $request->departmentid;
        $document->code = $request->typecode;


        if ($document->save()) {
            toastr()->success('Added successfully');
            return redirect()->route('document_subtypes.index');
        } else {
            toastr()->error('Something went wrong');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)

    {
        $document = DocumentSubType::find($id);
        $department = DB::table('document_types')->get();


        return view('admin.documentSubtype.edit', ['document' => $document], ['department' => $department]);

        //  return redirect()->route('image')->wtih('result',$result);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)

    {
        $document = DocumentSubType::find($id);
        $document->docSubtype = $request->name;
        $document->doctype_id = $request->departmentid;
        $document->code = $request->typecode;
        if ($document->update()) {
            toastr()->success('Updated successfully');
            return redirect()->route('document_subtypes.index');
        } else {
            toastr()->error('Something went wrong');
            return redirect()->back();
        }

        // return redirect()->route('banner-list.index');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {

        $document = DocumentSubType::find($id);

        if ($document->delete()) {
            toastr()->success('Deleted successfully');
            return redirect()->back();
        } else {
            toastr()->error('Something went wrong');
            return redirect()->back();
        }
    }
}
