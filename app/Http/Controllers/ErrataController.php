<?php

namespace App\Http\Controllers;

use App\Models\Errata;
use App\Models\ErrataGrid;
use Illuminate\Http\Request;

class ErrataController extends Controller
{
    public function index($id)
    {
        // return view('frontend.errata.errata_new', ['data' => Errata::latest()->get()]);
        $erratagridnew = ErrataGrid::where('id', $id)->latest()->first();
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $data = new Errata();
        $data->record_no = $request->record_no;
        $data->location_code = $request->location_code;
        $data->errata_date = $request->errata_date;
        $data->errata_issued_by = $request->errata_issued_by;
        $data->initiated_by = $request->initiated_by;
        $data->Department = $request->Department;
        $data->department_code = $request->department_code;
        $data->document_type = $request->document_type;
        $data->document_title = $request->document_title;
        // $data->reference_document = !empty($request->reference_document) ? implode(',', $request->reference_document) : '';

        $data->reference_document = is_array($request->reference_document)
            ? implode(',', $request->reference_document)
            : $request->reference_document;
        $data->Observation_on_Page_No = $request->Observation_on_Page_No;
        $data->brief_description = $request->brief_description;
        $data->type_of_error = $request->type_of_error;
        // $data->details = !empty($request->details) ? implode(',', $request->details) : '';

        // $data->details = $request->details;
        $data->Date_and_time_of_correction = $request->Date_and_time_of_correction;
        $data->QA_Feedbacks = $request->QA_Feedbacks;
        if (!empty($request->QA_Attachments)) {
            $files = [];
            if ($request->hasfile('QA_Attachments')) {
                foreach ($request->file('QA_Attachments') as $file) {
                    $name = $request->name . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $data->QA_Attachments = json_encode($files);
        }

        $data->HOD_Remarks = $request->HOD_Remarks;

        if (!empty($request->HOD_Attachments)) {
            $files = [];
            if ($request->hasfile('HOD_Attachments')) {
                foreach ($request->file('HOD_Attachments') as $file) {
                    $name = $request->name . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->HOD_Attachments = json_encode($files);
        }
        $data->Closure_Comments = $request->Closure_Comments;
        $data->All_Impacting_Documents_Corrected = $request->All_Impacting_Documents_Corrected;
        $data->Remarks = $request->Remarks;


        if (!empty($request->Closure_Attachments)) {
            $files = [];
            if ($request->hasfile('Closure_Attachments')) {
                foreach ($request->file('Closure_Attachments') as $file) {
                    $name = $request->name . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->Closure_Attachments = json_encode($files);
        }

        $data->save();



        //==================GRID=======================
        $errata_id = $data->id;
        $newDataGridErrata = ErrataGrid::where(['e_id' => $errata_id, 'identifier' => 'details'])->firstOrCreate();
        $newDataGridErrata->e_id = $errata_id;
        $newDataGridErrata->identifier = 'details';
        $newDataGridErrata->data = $request->details;
        $newDataGridErrata->save();
        //================================================================
        return back();
    }

    public function show($id)
    {
        $showdata = Errata::find($id);
        $errata_id = $id;
        $grid_Data = ErrataGrid::where(['e_id' => $errata_id, 'identifier' => 'details'])->first();
        return view('frontend.errata.errata_view', compact('showdata', 'grid_Data'));
    }



    // public function edit()
    // {
    //     return view('frontend.errata.errata_new', compact('showdata'));
    // }

    public function update(Request $request, $id)
    {
        $data = Errata::findOrFail($id);
        $data->record_no = $request->record_no;
        $data->location_code = $request->location_code;
        $data->errata_date = $request->errata_date;
        $data->errata_issued_by = $request->errata_issued_by;
        $data->initiated_by = $request->initiated_by;
        $data->Department = $request->Department;
        $data->department_code = $request->department_code;
        $data->document_type = $request->document_type;
        $data->document_title = $request->document_title;
        $data->reference_document = is_array($request->reference_document)
            ? implode(',', $request->reference_document)
            : $request->reference_document;
        $data->Observation_on_Page_No = $request->Observation_on_Page_No;
        $data->brief_description = $request->brief_description;
        $data->type_of_error = $request->type_of_error;
        $data->details = $request->details;
        $data->Date_and_time_of_correction = $request->Date_and_time_of_correction;
        $data->QA_Feedbacks = $request->QA_Feedbacks;


        if (!empty($request->QA_Attachments)) {
            $files = [];
            if ($request->hasfile('QA_Attachments')) {
                foreach ($request->file('QA_Attachments') as $file) {
                    $name = $request->name . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $data->QA_Attachments = json_encode($files);
        }


        $data->HOD_Remarks = $request->HOD_Remarks;

        if (!empty($request->HOD_Attachments)) {
            $files = [];
            if ($request->hasfile('HOD_Attachments')) {
                foreach ($request->file('HOD_Attachments') as $file) {
                    $name = $request->name . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->HOD_Attachments = json_encode($files);
        }
        $data->Closure_Comments = $request->Closure_Comments;
        $data->All_Impacting_Documents_Corrected = $request->All_Impacting_Documents_Corrected;
        $data->Remarks = $request->Remarks;


        if (!empty($request->Closure_Attachments)) {
            $files = [];
            if ($request->hasfile('Closure_Attachments')) {
                foreach ($request->file('Closure_Attachments') as $file) {
                    $name = $request->name . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->Closure_Attachments = json_encode($files);
        }

        $data->update();


        //==================GRID=======================
        $errata_id = $data->id;
        $newDataGridErrata = ErrataGrid::where(['e_id' => $errata_id, 'identifier' => 'details'])->firstOrCreate();
        $newDataGridErrata->e_id = $errata_id;
        $newDataGridErrata->identifier = 'details';
        $newDataGridErrata->data = $request->details;
        $newDataGridErrata->update();
        //================================================================
        return back();
    }
}
