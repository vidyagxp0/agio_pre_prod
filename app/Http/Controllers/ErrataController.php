<?php

namespace App\Http\Controllers;

use App\Models\errata;
use App\Models\ErrataGrid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use PDF;
class ErrataController extends Controller
{
    public function index($id)
    {
        $record_number = ((errata::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        // return view('frontend.errata.errata_new', ['data' => Errata::latest()->get()]);
        // $erratagridnew = ErrataGrid::where('id', $id)->latest()->first();

    }

    public function store(Request $request)
    {
        // dd($request->all());
        $data = new errata();
        $data->record_no = $request->record_no;
        $data->division_id = $request->division_id;
        $data->initiator_id = Auth::user()->id;
        $data->intiation_date = $request->intiation_date;
        $data->initiated_by = $request->initiated_by;
        $data->Department = $request->Department;
        $data->department_code = $request->department_code;
        $data->document_type = $request->document_type;
        $data->short_description = $request->short_description;
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



        $data->status = 'Opened';
        $data->stage = 1;
        $data->save();

        $data->save();



        //==================GRID=======================
        $errata_id = $data->id;
        $newDataGridErrata = ErrataGrid::where(['e_id' => $errata_id, 'identifier' => 'details'])->firstOrCreate();
        $newDataGridErrata->e_id = $errata_id;
        $newDataGridErrata->identifier = 'details';
        $newDataGridErrata->data = $request->details;
        $newDataGridErrata->save();
        //================================================================

        toastr()->success("Record is created Successfully");
        return redirect(url('rcms/qms-dashboard'));
    }

    public function show($id)
    {
        $showdata = errata::find($id);
        // dd($showdata);
        $errata_id = $id;
        $grid_Data = ErrataGrid::where(['e_id' => $errata_id, 'identifier' => 'details'])->first();
        return view('frontend.errata.errata_view', compact('showdata', 'grid_Data', 'errata_id'));
    }

    public function stageChange(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $ErrataControl = errata::find($id);
            $lastDocument = errata::find($id);
            // $evaluation = Evaluation::where('cc_id', $id)->first();
            if ($ErrataControl->stage == 1) {
                $ErrataControl->stage = "2";
                $ErrataControl->status = "Pending Review";
                $ErrataControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($ErrataControl->stage == 2) {
                $ErrataControl->stage = "3";
                $ErrataControl->status = "Pending Correction";
                $ErrataControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($ErrataControl->stage == 3) {
                $ErrataControl->stage = "4";
                $ErrataControl->status = "Pending HOD Review";
                $ErrataControl->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($ErrataControl->stage == 4) {
                $ErrataControl->stage = "5";
                $ErrataControl->status = "Pending QA Head Approval";
                $ErrataControl->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($ErrataControl->stage == 5) {
                $ErrataControl->stage = "6";
                $ErrataControl->status = "Closed-Done";
                $ErrataControl->update();
                toastr()->success('Document Sent');
                return back();
            }
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function stageReject(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $ErrataControl = errata::find($id);
            $lastDocument = errata::find($id);
            if ($ErrataControl->stage == 1) {
                $ErrataControl->stage = "0";
                $ErrataControl->status = "Closed-Cancelled";
                $ErrataControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($ErrataControl->stage == 2) {
                $ErrataControl->stage = "1";
                $ErrataControl->status = "Opened";
                $ErrataControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($ErrataControl->stage == 3) {
                $ErrataControl->stage = "2";
                $ErrataControl->status = "Pending Review";
                $ErrataControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($ErrataControl->stage == 4) {
                $ErrataControl->stage = "3";
                $ErrataControl->status = "Pending Correction";
                $ErrataControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($ErrataControl->stage == 5) {
                $ErrataControl->stage = "4";
                $ErrataControl->status = "Pending HOD Review";
                $ErrataControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($ErrataControl->stage == 6) {
                $ErrataControl->stage = "5";
                $ErrataControl->status = "Pending QA Head Approval";
                $ErrataControl->update();
                toastr()->success('Document Sent');
                return back();
            }
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }


    public function update(Request $request, $id)
    {
        $data = errata::find($id);
        $data->record_no = $request->record_no;
        $data->division_id = $request->division_id;
        $data->initiator_id = Auth::user()->id;
        $data->intiation_date = $request->intiation_date;
        $data->initiated_by = $request->initiated_by;
        $data->Department = $request->Department;
        $data->department_code = $request->department_code;
        $data->document_type = $request->document_type;
        $data->short_description = $request->short_description;
        $data->reference_document = is_array($request->reference_document)
            ? implode(',', $request->reference_document)
            : $request->reference_document;
        $data->Observation_on_Page_No = $request->Observation_on_Page_No;
        $data->brief_description = $request->brief_description;
        $data->type_of_error = $request->type_of_error;
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

        $data->update();


        //==================GRID=======================
        $errata_id = $data->id;
        $newDataGridErrata = ErrataGrid::where(['e_id' => $errata_id, 'identifier' => 'details'])->firstOrCreate();
        $newDataGridErrata->e_id = $errata_id;
        $newDataGridErrata->identifier = 'details';
        $newDataGridErrata->data = $request->details;
        $newDataGridErrata->save();
        //================================================================
        toastr()->success("Record is created Successfully");
        return redirect(url('rcms/qms-dashboard'));
    }

    public function singleReports(Request $request, $id){
        $data = errata::find($id);
        $grid_Data = ErrataGrid::where(['e_id' => $id, 'identifier' => 'details'])->first();
        if (!empty($data)) {
            $data->data = ErrataGrid::where('e_id', $id)->where('identifier', "details")->first();
            // $data->Instruments_Details = ErrataGrid::where('e_id', $id)->where('type', "Instruments_Details")->first();
            // $data->Material_Details = Erratagrid::where('e_id', $id)->where('type', "Material_Details")->first();
            // dd($data->all());
            $data->originator = User::where('id', $data->initiator_id)->value('name');
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.errata.errata_single_pdf', compact('data','grid_Data'))
                ->setOptions([
                    'defaultFont' => 'sans-serif',
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                    'isPhpEnabled' => true,
                ]);
            $pdf->setPaper('A4');
            $pdf->render();
            $canvas = $pdf->getDomPDF()->getCanvas();
            $height = $canvas->get_height();
            $width = $canvas->get_width();
            $canvas->page_script('$pdf->set_opacity(0.1,"Multiply");');
            $canvas->page_text($width / 4, $height / 2, $data->status, null, 25, [0, 0, 0], 2, 6, -20);
            return $pdf->stream('errata' . $id . '.pdf');
        }
    }
}
