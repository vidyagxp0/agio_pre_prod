<?php

namespace App\Http\Controllers;

use App\Models\ChangeProposalJust;
use App\Models\ChangeProposalJustGrid;
use App\Models\RecordNumber;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\RoleGroup;
use App\Models\ChangeProposalAuditTrial;
use Helpers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\QMSDivision;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;
use App\Jobs\SendMail;
use Illuminate\Support\Facades\Mail;




class ChangeProposalJustController extends Controller
{
    
    public function index()
    {
        
    }

    
    public function create()
    {

     $old_record = ChangeProposalJust::select('id', 'division_id', 'record')->get();
        $record = ((RecordNumber::first()->value('counter')) + 1);
        $record = str_pad($record, 4, '0', STR_PAD_LEFT);
        $division = QMSDivision::where('name', Helpers::getDivisionName(session()->get('division')))->first();

        
        if ($division) {
            $last_cp = ChangeProposalJust::where('division_id', $division->id)->latest()->first();

            if ($last_cp) {
                $record_number = $last_cp->record ? str_pad($last_cp->record + 1, 4, '0', STR_PAD_LEFT) : '0001';
            } else {
                $record_number = '0001';
            }
        }
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        
        return view('frontend.changePropaslJust.create', compact('record', 'old_record'));
    }

    
    public function store(Request $request)
    {
        if (!$request->cpdescription) {
            toastr()->error("Short description is required");
            return redirect()->back();
        }

        
        $lastCaprecord = ChangeProposalJust::orderBy('record', 'desc')->first();
        $record = $lastCaprecord ? $lastCaprecord->record + 1 : 1;
        // 🔹 Main Save
        $data = new ChangeProposalJust();
        $data->initiator_id = Auth::id();
        $data->record = $record;
        $data->division_code = $request->division_code;
        $data->department = Helpers::getUserDepartmentFromDB(Auth::user()->departmentid);
        $data->division_id = $request->division_id;
        $data->intiation_date = $request->intiation_date;
        $data->cpdescription = $request->cpdescription;
        $data->impassesment = $request->impassesment;
        $data->status = 'Opened';
        $data->stage = 1;

        // 🔹 File Upload

        if ($request->hasFile('cpAttachment')) {
            $files = [];
            foreach ($request->file('cpAttachment') as $file) {
                $name = time() . uniqid(). '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/'), $name);
                $files[] = $name;
            }
            $data->cpAttachment = json_encode($files);
        }

        $data->save();

        // =========================
        // 🔹 GRID SAVE
        // =========================
        if ($request->has('change_proposal_grid')) {

       // GRID SAVE
            if (!empty($request->change_proposal_grid))  {
                ChangeProposalJustGrid::updateOrCreate(
                    [
                        'cpjg_id' => $data->id,
                        'identifier' => 'change_proposal_grid'
                    ],
                    [
                        'data' => $request->change_proposal_grid
                    ]
                );
            }



 
            if (!empty($request->checklist)) {

                $cleanData = [];

                foreach ($request->checklist as $key => $value) {
                    $cleanData[$key] = $value['response'] ?? null;
                }

                ChangeProposalJustGrid::updateOrCreate(
                    [
                        'cpjg_id' => $data->id,
                        'identifier' => 'stage3_checklist'
                    ],
                    [
                        'data' => $cleanData
                    ]
                );
            }

        // =========================
        // 🔹 AUDIT TRAIL
        // =========================
        if ($request->has('change_proposal_grid')) {

            $fields = [
                'existing_system' => 'Existing System',
                'proposed_change' => 'Proposed Change',
                'justification' => 'Justification'
            ];
        }

        $history = new ChangeProposalAuditTrial();
        $history->cpjg_id = $data->id;
        $history->activity_type = 'Record Number';
        $history->previous = "Null";
        $history->current = Helpers::getDivisionName(session()->get('division')) . "/CPJ/" . Helpers::year($data->created_at) . "/" . str_pad($data->record, 4, '0', STR_PAD_LEFT);
        $history->comment = "Not Applicable";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $data->status;
        $history->change_to =   "Opened";
        $history->change_from = "Initiation";
        $history->action_name = 'Create';
        $history->save();


        if (!empty($data->division_id)) {
            $history = new ChangeProposalAuditTrial();
            $history->cpjg_id = $data->id;
            $history->activity_type = 'Site/Location Code';
            $history->previous = "Null";
            $history->current = Helpers::getDivisionName($data->division_id);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

         if (!empty($data->intiation_date)) {
            $history = new ChangeProposalAuditTrial();
            $history->cpjg_id = $data->id;
            $history->activity_type = 'Date of Initiation';
            $history->previous = "Null";
            $history->current =  Helpers::getdateFormat($data->intiation_date);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

            $history = new ChangeProposalAuditTrial();
            $history->cpjg_id = $data->id;
            $history->activity_type = 'Initiator';
            $history->previous = "Null";
            $history->current = Auth::user()->name;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();

            $history = new ChangeProposalAuditTrial();
            $history->cpjg_id = $data->id;
            $history->activity_type = 'Initiation Department';
            $history->previous = 'Null';
            $history->current = $data->department;
            $history->comment = 'Not Applicable';
            $history->user_id = Auth::id();
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = 'Opened';
            $history->change_from = 'Initiation';
            $history->action_name = 'Create';
            $history->save();


         if (!empty($request->cpdescription)) {
            $history = new ChangeProposalAuditTrial();
            $history->cpjg_id = $data->id;
            $history->activity_type = 'Short Description';
            $history->previous = "Null";
            $history->current = $data->cpdescription;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

         if (!empty($request->impassesment)) {
            $history = new ChangeProposalAuditTrial();
            $history->cpjg_id = $data->id;
            $history->activity_type = 'Description of Change';
            $history->previous = "Null";
            $history->current = $data->impassesment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($request->cpAttachment)) {
            $history = new ChangeProposalAuditTrial();
            $history->cpjg_id = $data->id;
            $history->activity_type = 'Attachment';
            $history->previous = "Null";
            $history->current = $data->cpAttachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

                
            }



        toastr()->success('Document created');
        return redirect('rcms/qms-dashboard');
    }

  
    public function show($id)
    {

    $data = ChangeProposalJust::find($id);

    $changeProposalGrid = ChangeProposalJustGrid::where('cpjg_id', $id)->where('identifier', 'change_proposal_grid')->first();

    $checklistData = ChangeProposalJustGrid::where('cpjg_id', $id)->where('identifier', 'stage3_checklist')->first();

    $savedChecklist = $checklistData->data ?? [];

    // dd($checklistData);

    return view('frontend.changePropaslJust.view',compact('data','changeProposalGrid','checklistData'));

    }

  
    public function edit(ChangeProposalJust $changeProposalJust)
    {
        //
    }

  
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $data = ChangeProposalJust::find($id);
        $lastDocument = ChangeProposalJust::find($id);

        // $data->division_code = $request->division_code;
        $data->cpdescription = $request->cpdescription;
        $data->impassesment = $request->impassesment;
        $data->hod_comment = $request->hod_comment;
        $data->qa_comment = $request->qa_comment;
        $data->qa_cqa_head_comment = $request->qa_cqa_head_comment;

      
        

     if (!empty($request->cpAttachment) || !empty($request->deleted_cpAttachment)) {
            $existingFiles = json_decode($data->cpAttachment, true) ?? [];

            // Handle deleted files
            if (!empty($request->deleted_cpAttachment)) {
                $filesToDelete = explode(',', $request->deleted_cpAttachment);
                $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
                    return !in_array($file, $filesToDelete);
                });
            }

            // Handle new files
            $newFiles = [];
            if ($request->hasFile('cpAttachment')) {
                foreach ($request->file('cpAttachment') as $file) {
                   // $name = $request->name . 'summary_response_attachment' . uniqid() . '.' . $file->getClientOriginalExtension();
                     $name = $request->name . 'Initiator Attachment' . date('d-m-Y_H-i-s') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                
                    $file->move(public_path('upload/'), $name);
                    $newFiles[] = $name;
                }
            }

            // Merge existing and new files
            $allFiles = array_merge($existingFiles, $newFiles);
            $data->cpAttachment = json_encode($allFiles);
        }

        if (!empty($request->hodAttachment) || !empty($request->deleted_hodAttachment)) {
            $existingFiles = json_decode($data->hodAttachment, true) ?? [];

            // Handle deleted files
            if (!empty($request->deleted_hodAttachment)) {
                $filesToDelete = explode(',', $request->deleted_hodAttachment);
                $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
                    return !in_array($file, $filesToDelete);
                });
            }

            // Handle new files
            $newFiles = [];
            if ($request->hasFile('hodAttachment')) {
                foreach ($request->file('hodAttachment') as $file) {
                     $name = $request->name . 'hodAttachment' . date('d-m-Y_H-i-s') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                
                    $file->move(public_path('upload/'), $name);
                    $newFiles[] = $name;
                }
            }

            // Merge existing and new files
            $allFiles = array_merge($existingFiles, $newFiles);
            $data->hodAttachment = json_encode($allFiles);
        }



           if (!empty($request->qaAttachment) || !empty($request->deleted_qaAttachment)) {
            $existingFiles = json_decode($data->qaAttachment, true) ?? [];

            // Handle deleted files
            if (!empty($request->deleted_qaAttachment)) {
                $filesToDelete = explode(',', $request->deleted_qaAttachment);
                $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
                    return !in_array($file, $filesToDelete);
                });
            }

            // Handle new files
            $newFiles = [];
            if ($request->hasFile('qaAttachment')) {
                foreach ($request->file('qaAttachment') as $file) {
                   // $name = $request->name . 'summary_response_attachment' . uniqid() . '.' . $file->getClientOriginalExtension();
                     $name = $request->name . 'qaAttachment' . date('d-m-Y_H-i-s') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                
                    $file->move(public_path('upload/'), $name);
                    $newFiles[] = $name;
                }
            }

            // Merge existing and new files
            $allFiles = array_merge($existingFiles, $newFiles);
            $data->qaAttachment = json_encode($allFiles);
        }


         if (!empty($request->qa_cqa_head_Attachment) || !empty($request->deleted_qa_cqa_head_Attachment)) {
            $existingFiles = json_decode($data->qa_cqa_head_Attachment, true) ?? [];

            // Handle deleted files
            if (!empty($request->deleted_qa_cqa_head_Attachment)) {
                $filesToDelete = explode(',', $request->deleted_qa_cqa_head_Attachment);
                $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
                    return !in_array($file, $filesToDelete);
                });
            }

            // Handle new files
            $newFiles = [];
            if ($request->hasFile('qa_cqa_head_Attachment')) {
                foreach ($request->file('qa_cqa_head_Attachment') as $file) {
                   // $name = $request->name . 'summary_response_attachment' . uniqid() . '.' . $file->getClientOriginalExtension();
                     $name = $request->name . 'qa_cqa_head_Attachment' . date('d-m-Y_H-i-s') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                
                    $file->move(public_path('upload/'), $name);
                    $newFiles[] = $name;
                }
            }

            // Merge existing and new files
            $allFiles = array_merge($existingFiles, $newFiles);
            $data->qa_cqa_head_Attachment = json_encode($allFiles);
        }
       
        $data->save();

         
           $cpjg_id = $data->id;

        // $changeProposalGridData = ChangeProposalJustGrid::where([
        //     'cpjg_id' => $cpjg_id,
        //     'identifier' => 'change_proposal_grid'
        // ])->firstOrNew();

        // $changeProposalGridData->cpjg_id = $cpjg_id; // 🔥 IMPORTANT
        // $changeProposalGridData->identifier = 'change_proposal_grid';
        // $changeProposalGridData->data = $request->change_proposal_grid;
        // $changeProposalGridData->save();

        /////////////////////////////////




        // Get Old Data
        $existingGrid = ChangeProposalJustGrid::where([
            'cpjg_id' => $cpjg_id,
            'identifier' => 'change_proposal_grid'
        ])->first();

        $existingGridData = $existingGrid ? $existingGrid->data : [];

        // Field Names
        $fieldNames = [
            'existing_system' => 'Current Practice',
            'proposed_change' => 'Proposed Change',
            'justification'   => 'Justification / Reason for Change',
        ];


        // dd($request->change_proposal_grid ,$existingGrid->data);
        


        if (is_array($request->change_proposal_grid)) {

            foreach ($request->change_proposal_grid as $index => $newRow) {

                $oldRow = $existingGridData[$index] ?? [];

                foreach (['existing_system', 'proposed_change', 'justification'] as $field) {

                    $oldValue = $oldRow[$field] ?? '';
                    $newValue = $newRow[$field] ?? '';

                    if ($oldValue != $newValue) {

                        $audit = new ChangeProposalAuditTrial();

                        $audit->cpjg_id = $cpjg_id;
                        $audit->activity_type = $fieldNames[$field] . ' (Row ' . ($index + 1) . ')';
                        $audit->previous = $oldValue ?: 'Null';
                        $audit->current = $newValue ?: 'Null';
                        $audit->comment = '';

                        $audit->user_id = Auth::id();
                        $audit->user_name = Auth::user()->name;
                        $audit->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

                        $audit->origin_state = $data->status;
                        $audit->change_from = $data->status;
                        $audit->change_to = 'Not Applicable';

                        $audit->action_name = empty($oldValue) ? 'New' : 'Update';

                        $audit->save();
                    }
                }
            }
        }

        // ==========================
        // Save Grid
        // ==========================

        $grid = ChangeProposalJustGrid::firstOrNew([
            'cpjg_id' => $cpjg_id,
            'identifier' => 'change_proposal_grid'
        ]);

        $grid->cpjg_id = $cpjg_id;
        $grid->identifier = 'change_proposal_grid';
        $grid->data = $request->change_proposal_grid;
        $grid->save();




        /////////////////////////////









            //    if ($request->has('checklist')) {

            //         ChangeProposalJustGrid::updateOrCreate(
            //             [
            //                 'cpjg_id' => $cpjg_id,
            //                 'identifier' => 'stage3_checklist'
            //             ],
            //             [
            //                 'data' => $request->checklist
            //             ]
            //         );
            //     }




        $existingChecklist = ChangeProposalJustGrid::where([
            'cpjg_id' => $cpjg_id,
            'identifier' => 'stage3_checklist'
        ])->first();

        $existingChecklistData = $existingChecklist ? $existingChecklist->data : [];



        if ($request->has('checklist')) {

            foreach ($request->checklist as $key => $newItem) {

                $oldItem = $existingChecklistData[$key] ?? [];

                // Question
                $question = $newItem['question'] ?? ($oldItem['question'] ?? $key);

                // YES / NO Questions
                if (isset($newItem['response'])) {

                    $oldValue = $oldItem['response'] ?? '';
                    $newValue = $newItem['response'] ?? '';

                    if ($oldValue != $newValue) {

                        $audit = new ChangeProposalAuditTrial();

                        $audit->cpjg_id = $cpjg_id;
                        // $audit->activity_type = $question;
                        $audit->activity_type = "Impact Assessment ({$question})";
                        $audit->previous = $oldValue ?: 'Null';
                        $audit->current = $newValue ?: 'Null';
                        $audit->comment = '';
                        $audit->user_id = Auth::id();
                        $audit->user_name = Auth::user()->name;
                        $audit->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $audit->origin_state = $data->status;
                        $audit->change_from = $data->status;
                        $audit->change_to = 'Not Applicable';
                        $audit->action_name = empty($oldValue) ? 'New' : 'Update';
                        $audit->save();
                    }
                }

                // Last Question (Manual Response)
                if (isset($newItem['manual_response'])) {

                    $oldValue = $oldItem['manual_response'] ?? '';
                    $newValue = $newItem['manual_response'] ?? '';

                    if ($oldValue != $newValue) {

                        $audit = new ChangeProposalAuditTrial();

                        $audit->cpjg_id = $cpjg_id;
                        // $audit->activity_type = $question;
                        $audit->activity_type = "Impact Assessment ({$question})";
                        $audit->previous = $oldValue ?: 'Null';
                        $audit->current = $newValue ?: 'Null';
                        $audit->comment = '';
                        $audit->user_id = Auth::id();
                        $audit->user_name = Auth::user()->name;
                        $audit->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $audit->origin_state = $data->status;
                        $audit->change_from = $data->status;
                        $audit->change_to = 'Not Applicable';
                        $audit->action_name = empty($oldValue) ? 'New' : 'Update';
                        $audit->save();
                    }
                }
            }

            // =========================
            // SAVE CHECKLIST
            // =========================

            ChangeProposalJustGrid::updateOrCreate(
                [
                    'cpjg_id' => $cpjg_id,
                    'identifier' => 'stage3_checklist'
                ],
                [
                    'data' => $request->checklist
                ]
            );
        }


        if ($lastDocument->cpdescription != $data->cpdescription) {

            $history = new ChangeProposalAuditTrial();
            $history->cpjg_id = $data->id;
            $history->activity_type = 'Short Description';
            $history->previous = $lastDocument->cpdescription;
            $history->current = $data->cpdescription;
            $history->comment = $request->cpdescription_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = is_null($lastDocument->cpdescription) ? "New" : "Update";

            $history->save();
        }

       
       if ($lastDocument->impassesment != $data->impassesment) {

            $history = new ChangeProposalAuditTrial();
            $history->cpjg_id = $id;
            $history->activity_type = 'Description of Change';
            $history->previous = $lastDocument->impassesment;
            $history->current = $data->impassesment;
            $history->comment = $request->impassesment_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = is_null($lastDocument->impassesment) ? "New" : "Update";

            $history->save();
        }


        if ($lastDocument->cpAttachment != $data->cpAttachment || !empty($request->cpAttachment_comment)) {
            $history = new ChangeProposalAuditTrial;
            $history->cpjg_id = $id;
            $history->activity_type = 'Initiator Attachment';
            $history->previous =   str_replace(',', ', ', $lastDocument->cpAttachment);
            $history->current =str_replace(',', ', ',  $data->cpAttachment);
            $history->comment = $request->cpAttachment_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
           $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->cpAttachment)) {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->hod_comment != $data->hod_comment) {

            $history = new ChangeProposalAuditTrial();
            $history->cpjg_id = $id;
            $history->activity_type = 'HOD Review Comment';
            $history->previous = $lastDocument->hod_comment;
            $history->current = $data->hod_comment;
            $history->comment = $request->hod_comment_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = is_null($lastDocument->hod_comment) ? "New" : "Update";

            $history->save();
        }

        if ($lastDocument->hodAttachment != $data->hodAttachment || !empty($request->hodAttachment_comment)) {
            $history = new ChangeProposalAuditTrial;
            $history->cpjg_id = $id;
            $history->activity_type = 'HOD Attachment';
            $history->previous =   str_replace(',', ', ', $lastDocument->hodAttachment);
            $history->current =str_replace(',', ', ',  $data->hodAttachment);
            $history->comment = $request->hodAttachment_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
           $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->hodAttachment)) {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

         if ($lastDocument->qa_comment != $data->qa_comment) {

            $history = new ChangeProposalAuditTrial();
            $history->cpjg_id = $id;
            $history->activity_type = 'QA/CQA Review Comments';
            $history->previous = $lastDocument->qa_comment;
            $history->current = $data->qa_comment;
            $history->comment = $request->qa_comment_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = is_null($lastDocument->qa_comment) ? "New" : "Update";

            $history->save();
        }

        if ($lastDocument->qaAttachment != $data->qaAttachment || !empty($request->qaAttachment_comment)) {
            $history = new ChangeProposalAuditTrial;
            $history->cpjg_id = $id;
            $history->activity_type = 'QA/CQA Review Attachments';
            $history->previous =   str_replace(',', ', ', $lastDocument->qaAttachment);
            $history->current =str_replace(',', ', ',  $data->qaAttachment);
            $history->comment = $request->qaAttachment_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
           $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->qaAttachment)) {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->qa_cqa_head_comment != $data->qa_cqa_head_comment) {

            $history = new ChangeProposalAuditTrial();
            $history->cpjg_id = $id;
            $history->activity_type = 'QA/CQA Head Approval Comments';
            $history->previous = $lastDocument->qa_cqa_head_comment;
            $history->current = $data->qa_cqa_head_comment;
            $history->comment = $request->qa_cqa_head_comment_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = is_null($lastDocument->qa_cqa_head_comment) ? "New" : "Update";

            $history->save();
        }

        if ($lastDocument->qa_cqa_head_Attachment != $data->qa_cqa_head_Attachment || !empty($request->qa_cqa_head_Attachment_comment)) {
            $history = new ChangeProposalAuditTrial;
            $history->cpjg_id = $id;
            $history->activity_type = 'QA/CQA Head Approval Attachments';
            $history->previous =   str_replace(',', ', ', $lastDocument->qa_cqa_head_Attachment);
            $history->current =str_replace(',', ', ',  $data->qa_cqa_head_Attachment);
            $history->comment = $request->qa_cqa_head_Attachment_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
           $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->qa_cqa_head_Attachment)) {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        toastr()->success("Record is updated Successfully");
        return redirect()->back();
    }

    
        
    
    public function destroy(ChangeProposalJust $changeProposalJust)
    {
        //
    }

     public function cpsendstage(Request $request, $id)
    {

            if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
                $data = ChangeProposalJust::find($id);
                $lastDocument = ChangeProposalJust::find($id);
                $changeProposalGrid = ChangeProposalJustGrid::where('cpjg_id', $id)->where('identifier', 'change_proposal_grid')->first();

                $checklistData = ChangeProposalJustGrid::where('cpjg_id', $id)
                    ->where('identifier', 'stage3_checklist')
                  ->first();

                
                if ($data->stage == 1) {
              
             
           

                // Main fields validation
                        if (empty($data->cpdescription) || empty($data->impassesment)) {

                            Session::flash('swal', [
                                'type' => 'warning',
                                'title' => 'Mandatory Fields!',
                                'message' => 'Please fill all required fields.'
                            ]);

                            return back();
                        }

                        // Grid record check
                        $changeProposalGrid = ChangeProposalJustGrid::where('cpjg_id', $id)
                            ->where('identifier', 'change_proposal_grid')
                            ->first();

                        if (!$changeProposalGrid) {

                            Session::flash('swal', [
                                'type' => 'warning',
                                'title' => 'Mandatory Fields!',
                                'message' => 'Please add at least one row in the Change Proposal Details Grid.'
                            ]);

                            return back();
                        }



                    if (!$checklistData || empty($checklistData->data)) {

                        Session::flash('swal', [
                            'type'    => 'warning',
                            'title'   => 'Mandatory Fields!',
                            'message' => 'Please complete the Impact Assessment Checklist.'
                        ]);

                        return back();
                    }

                    $checklist = is_array($checklistData->data)
                        ? $checklistData->data
                        : json_decode($checklistData->data, true);

                    foreach ($checklist as $key => $item) {

                        // Validate "Any Other" field
                        if ($key === 'q1_103') {

                            $manualResponse = trim($item['manual_response'] ?? '');

                            if ($manualResponse === '') {

                                Session::flash('swal', [
                                    'type'    => 'warning',
                                    'title'   => 'Mandatory Fields!',
                                    'message' => 'Please fill the Any Other field of Impact Assessment.'
                                ]);

                                return back();
                            }

                            continue;
                        }

                        // Validate Yes / No response
                        $response = trim($item['response'] ?? '');

                        if ($response === '') {

                            Session::flash('swal', [
                                'type'    => 'warning',
                                'title'   => 'Mandatory Fields!',
                                'message' => 'Please answer all Impact Assessment questions.'
                            ]);

                            return back();
                        }
                    }

              
                    $data->stage = "2";
                    $data->status = "HOD/Designee Review";
                    $data->submit_by = Auth::user()->name;
                    $data->submit_on = Carbon::now()->format('d-M-Y');
                    $data->submit_comment = $request->comment;

                    $history = new ChangeProposalAuditTrial();
                    $history->cpjg_id = $id;
                    $history->activity_type = 'Submit By, Submit On';
                    if (is_null($lastDocument->submit_by) || $lastDocument->submit_by === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->submit_by . ' , ' . $lastDocument->submit_on;
                    }
                    $history->current = $data->submit_by . ' , ' . $data->submit_on;
                    $history->action = 'Submit';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "HOD/Designee Review";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'HOD/Designee Review';
                    if (is_null($lastDocument->submit_by) || $lastDocument->submit_by === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();

                    $list = Helpers::getHodUserList($data->division_id);

                        foreach ($list as $u) {
                            $email = Helpers::getUserEmail($u->user_id);
                        
                            if ($email !== null) {
                                try {
                                    $maildata = [
                                        'data' => $data,
                                        'site' => "CPJ",
                                        'history' => "submit",
                                        'process' => 'Change Proposal And Justification',
                                        'comment' => $request->comment,
                                        'user'=> Auth::user()->name
                                    ];

                                    SendMail::dispatch($maildata, $email, $data, 'Change Proposal And Justification');

                                } catch (\Exception $e) {
                                    \Log::error('Mail Error: ' . $e->getMessage());
                                }
                            }
                        }

                   

                    $data->update();
                    return back();
                }

                if ($data->stage == 2) {

                if (empty($data->hod_comment))
                 {
                    Session::flash('swal', [
                        'type' => 'warning',
                        'title' => 'Mandatory Fields!',
                        'message' => 'HOD/Designee Review Tab is yet to be filled'
                    ]);

                    return redirect()->back();
                }
                 else {
                    Session::flash('swal', [
                        'type' => 'success',
                        'title' => 'Success',
                        'message' => 'Sent for QA/CQA Review state'
                    ]);
                }
                
                    $data->stage = "3";
                    $data->status = "QA/CQA Review";
                    $data->HOD_Review_Complete_By = Auth::user()->name;
                    $data->HOD_Review_Complete_On = Carbon::now()->format('d-M-Y');
                    $data->HOD_Review_Comments = $request->comment;

                    $history = new ChangeProposalAuditTrial();
                    $history->cpjg_id = $id;
                    $history->activity_type = 'HOD/Designee Review By, HOD/Designee Review On';
                    if (is_null($lastDocument->HOD_Review_Complete_By) || $lastDocument->HOD_Review_Complete_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->HOD_Review_Complete_By . ' , ' . $lastDocument->HOD_Review_Complete_On;
                    }
                    $history->current = $data->HOD_Review_Complete_By . ' , ' . $data->HOD_Review_Complete_On;
                    $history->comment = $request->comment;
                    $history->action = 'HOD Review Complete';
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "QA/CQA Review";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'QA/CQA Review';
                    if (is_null($lastDocument->HOD_Review_Complete_By) || $lastDocument->HOD_Review_Complete_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();

                    $QARevlist = Helpers::getQAUserList($data->division_id);

                    $CQARevlist = Helpers::getCQAUsersList($data->division_id);

                    $usersmerge = collect($QARevlist)->merge($CQARevlist);

                    $usersmerge = $usersmerge->unique('user_id');

                    foreach ($usersmerge as $u) 
                    {

                        $email = Helpers::getUserEmail($u->user_id);

                        if ($email !== null) {

                            try {

                                $Maildata = [
                                        'data' => $data,
                                        'site' => "CPJ",
                                        'history' => "Hod Review Complete",
                                        'process' => 'Change Proposal And Justification',
                                        'comment' => $request->comment,
                                        'user'=> Auth::user()->name
                                ];

                                SendMail::dispatch(
                                    $Maildata,
                                    $email,
                                    $data,
                                    'Change Proposal And Justification'
                                );

                            } catch (\Exception $e) {
                                \Log::error('Mail Error: ' . $e->getMessage());
                            }
                        }
                    }

                    $data->update();
                    return back();
                }

                if ($data->stage == 3) {

                if (empty($data->qa_comment))
                 {
                    Session::flash('swal', [
                        'type' => 'warning',
                        'title' => 'Mandatory Fields!',
                        'message' => 'QA CQA Review Tab is yet to be filled'
                    ]);

                    return redirect()->back();
                }
                 else {
                    Session::flash('swal', [
                        'type' => 'success',
                        'title' => 'Success',
                        'message' => 'Sent for QA/CQA Head / Designe Review state'
                    ]);
                }
                    
                    $data->stage = "4";
                    $data->status = "QA/CQA Head / Designee Approval";
                    $data->qa_cqa_Review_Complete_By = Auth::user()->name;
                    $data->qa_cqa__Review_Complete_On = Carbon::now()->format('d-M-Y');
                    $data->qa_cqa__Review_Comments = $request->comment;

                    $history = new ChangeProposalAuditTrial();
                    $history->cpjg_id = $id;
                    $history->activity_type = 'QA/CQA Review Complete By, QA/CQA Review Complete By On';
                    if (is_null($lastDocument->qa_cqa_Review_Complete_By) || $lastDocument->qa_cqa_Review_Complete_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->qa_cqa_Review_Complete_By . ' , ' . $lastDocument->qa_cqa__Review_Complete_On;
                    }
                    $history->current = $data->qa_cqa_Review_Complete_By . ' , ' . $data->qa_cqa__Review_Complete_On;
                    $history->comment = $request->comment;
                    $history->action = 'QA/CQA Review Complete';
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "QA/CQA Head / Designee Approval";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'QA/CQA Head / Designee Approval';
                    if (is_null($lastDocument->qa_cqa_Review_Complete_By) || $lastDocument->qa_cqa_Review_Complete_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();


                      $QARevlist = Helpers::getCQAHeadDesignUsersList($data->division_id);

                    $CQARevlist = Helpers::getCQAHeadUserList($data->division_id);

                    $usersmerge = collect($QARevlist)->merge($CQARevlist);

                    $usersmerge = $usersmerge->unique('user_id');

                    foreach ($usersmerge as $u) 
                    {

                        $email = Helpers::getUserEmail($u->user_id);

                        if ($email !== null) {

                            try {

                                $Maildata = [
                                        'data' => $data,
                                        'site' => "CPJ",
                                        'history' => "QA/CQA Review Complete",
                                        'process' => 'Change Proposal And Justification',
                                        'comment' => $request->comment,
                                        'user'=> Auth::user()->name
                                ];

                                SendMail::dispatch(
                                    $Maildata,
                                    $email,
                                    $data,
                                    'Change Proposal And Justification'
                                );

                            } catch (\Exception $e) {
                                \Log::error('Mail Error: ' . $e->getMessage());
                            }
                        }
                    }

                  

                    $data->update();
                    return back();
                }

                if ($data->stage == 4) {


                if (empty($data->qa_cqa_head_comment))
                 {
                    Session::flash('swal', [
                        'type' => 'warning',
                        'title' => 'Mandatory Fields!',
                        'message' => 'QA/CQA Head / Designe Tab is yet to be filled'
                    ]);

                    return redirect()->back();
                }
                 else {
                    Session::flash('swal', [
                        'type' => 'success',
                        'title' => 'Success',
                        'message' => 'Sent for Closed-Done state'
                    ]);
                }
                    
                    $data->stage = "5";
                    $data->status = "Closed - Done";
                    $data->qa_cqa_head_Review_Complete_By = Auth::user()->name;
                    $data->qa_cqa_head_Review_Complete_On = Carbon::now()->format('d-M-Y');
                    $data->qa_cqa_head_Review_Comments = $request->comment;

                    $history = new ChangeProposalAuditTrial();
                    $history->cpjg_id = $id;
                    $history->activity_type = 'QA/CQA Head/Designee Approval Complete By, QA/CQA Head/Designee Approval Complete On';
                    if (is_null($lastDocument->qa_cqa_head_Review_Complete_By) || $lastDocument->qa_cqa_head_Review_Complete_By === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->qa_cqa_head_Review_Complete_By . ' , ' . $lastDocument->qa_cqa_head_Review_Complete_On;
                    }
                    $history->current = $data->qa_cqa_head_Review_Complete_By . ' , ' . $data->qa_cqa_head_Review_Complete_On;
                    $history->comment = $request->comment;
                    $history->action = 'QA/CQA Head/Designee Approval Complete';
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "Closed - Done";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Closed - Done';
                    if (is_null($lastDocument->qa_cqa_head_Review_Complete_By) || $lastDocument->qa_cqa_head_Review_Complete_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();


                      $usersmerge = collect()
                      
                ->merge(Helpers::getCQAUsersList($data->division_id))
                ->merge(Helpers::getHodUserList($data->division_id))
                ->merge(Helpers::getQAHeadUserList($data->division_id))
                ->merge(Helpers::getCQAHeadUserList($data->division_id))
                ->merge(Helpers::getQAUserList($data->division_id))
                ->merge(Helpers::getInitiatorUserList($data->division_id))
              
                ->unique('user_id');

                $emails = $usersmerge
                ->map(function ($u) {
                    return Helpers::getUserEmail($u->user_id);
                })
                ->filter()    
                ->unique()     
                ->values();

               foreach ($emails as $email) {
                  try {

                                $maildata = [
                                    'data'    => $data,
                                    'site'    => "CPJ",
                                    'history' => "QA/CQA Head / Designee Approval Complete",
                                    'process' => 'Change Proposal And Justification',
                                    'comment' => $request->comment,
                                    'user'    => Auth::user()->name
                                ];

                                SendMail::dispatch(
                                    $maildata,
                                    $email,
                                    $data,
                                    'Change Proposal And Justification'
                                );

                            } catch (\Exception $e) {
                                \Log::error('Mail Error: ' . $e->getMessage());
                            }
            }


                  

                    $data->update();
                    return back();
                }


            } else {
                toastr()->error('E-signature Not match');
                return back();
            }

    }


    public function moreinfoStateChange(Request $request, $id)
    {
        try {
            if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
                $data = ChangeProposalJust::find($id);
                $lastDocument = ChangeProposalJust::find($id);
                if ($data->stage == 4) {
                    $data->stage = "3";
                    $data->status = "QA/CQA Review";
                    $data->more_info_by_qa_head_review = Auth::user()->name;
                    $data->more_info_qa_head_review_on = Carbon::now()->format('d-M-Y');
                    $data->more_info_qa_head_comment = $request->comment;

                    $history = new ChangeProposalAuditTrial();
                    $history->cpjg_id = $id;
                    $history->activity_type = 'Not Applicable';
                    // $history->activity_type = 'More Info Required By, More Info Required On';
                    // if (is_null($lastDocument->more_info_inapproved_by) || $lastDocument->more_info_inapproved_by === '') {
                    //     $history->previous = "Null";
                    // } else {
                    //     $history->previous = $lastDocument->more_info_inapproved_by . ' , ' . $lastDocument->more_info_inapproved_on;
                    // }
                    // $history->current = $data->more_info_inapproved_by . ' , ' . $data->more_info_inapproved_on;
                    $history->previous = 'Not Applicable';
                    $history->current = 'Not Applicable';
                    $history->action = 'More Info Required';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "QA/CQA Review";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'QA/CQA Review';
                    // if (is_null($lastDocument->more_info_inapproved_by) || $lastDocument->more_info_inapproved_by === '') {
                    // $history->action_name = 'New';
                    // } else {
                    //     $history->action_name = 'Update';
                    // }
                    $history->action_name = 'Not Applicable';
                    $history->save();

                    $usersmerge = collect()
                      
                        ->merge(Helpers::getCQAUsersList($data->division_id))
                        ->merge(Helpers::getQAUserList($data->division_id))
                       
                        ->unique('user_id');

                        $emails = $usersmerge
                        ->map(function ($u) {
                            return Helpers::getUserEmail($u->user_id);
                        })
                        ->filter()    
                        ->unique()     
                        ->values();

                    foreach ($emails as $email) {
                        try {

                                $maildata = [
                                    'data'    => $data,
                                    'site'    => "CPJ",
                                    'history' => "More Info Required",
                                    'process' => 'Change Proposal And Justification',
                                    'comment' => $request->comment,
                                    'user'    => Auth::user()->name
                                ];

                                SendMail::dispatch(
                                    $maildata,
                                    $email,
                                    $data,
                                    'Change Proposal And Justification'
                                );

                            } catch (\Exception $e) {
                                \Log::error('Mail Error: ' . $e->getMessage());
                            }
            }


                    // $list = Helpers::getHodUserList($data->division_id)->unique('user_id')
                    // ->values();
                    // foreach ($list as $u) {
                    //    // if($u->q_m_s_divisions_id == $changeControl->division_id){
                    //        $email = Helpers::getUserEmail($u->user_id);
                    //            if ($email !== null) {
                    //                try{

                    //                     $data = [
                    //                         'data'    => $data,
                    //                         'site'    => "Extension",
                    //                         'history' => "More Info Required",
                    //                         'process' => 'Extension',
                    //                         'comment' => $request->comment,
                    //                         'user'    => Auth::user()->name
                    //                     ];

                    //                     SendMail::dispatch(
                    //                         $data,
                    //                         $email,
                    //                         $data,
                    //                         'Extension'
                    //                     );

                    //                 } catch (\Exception $e) {
                    //                     \Log::error('Mail Error: ' . $e->getMessage());
                    //                 }
                    //        }
                    //    // }
                    // }
                    $data->update();
                    toastr()->success('Document Sent');
                    return back();
                }
                
                if ($data->stage == 3) {


                    $data->stage = "2";
                    $data->status = "HOD Review";
                    $data->more_info_by_qa_review = Auth::user()->name;
                    $data->more_info_qa_review_on = Carbon::now()->format('d-M-Y');
                    $data->more_info_qa_comment = $request->comment;

                    $history = new ChangeProposalAuditTrial();
                    $history->cpjg_id = $id;
                    $history->activity_type = 'Not Applicable';
                    // $history->activity_type = 'More Info Required By, More Info Required On';
                    // if (is_null($lastDocument->more_info_inapproved_by) || $lastDocument->more_info_inapproved_by === '') {
                    //     $history->previous = "Null";
                    // } else {
                    //     $history->previous = $lastDocument->more_info_inapproved_by . ' , ' . $lastDocument->more_info_inapproved_on;
                    // }
                    // $history->current = $data->more_info_inapproved_by . ' , ' . $data->more_info_inapproved_on;
                    $history->previous = 'Not Applicable';
                    $history->current = 'Not Applicable';
                    $history->action = 'More Info Required';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "HOD/Designee Review";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'HOD/Designee Review';
                    // if (is_null($lastDocument->more_info_inapproved_by) || $lastDocument->more_info_inapproved_by === '') {
                    // $history->action_name = 'New';
                    // } else {
                    //     $history->action_name = 'Update';
                    // }
                    $history->action_name = 'Not Applicable';
                    $history->save();

                     $list = Helpers::getHodUserList($data->division_id);

                        foreach ($list as $u) {
                            $email = Helpers::getUserEmail($u->user_id);
                        
                            if ($email !== null) {
                                try {
                                    $maildata = [
                                        'data' => $data,
                                        'site' => "CPJ",
                                        'history' => "More Info Required",
                                        'process' => 'Change Proposal And Justification',
                                        'comment' => $request->comment,
                                        'user'=> Auth::user()->name
                                    ];

                                    SendMail::dispatch($maildata, $email, $data, 'Change Proposal And Justification');

                                } catch (\Exception $e) {
                                    \Log::error('Mail Error: ' . $e->getMessage());
                                }
                            }
                        }


                    
                    $data->update();
                    toastr()->success('Document Sent');
                    return back();
                }
                if ($data->stage == 2) {

                    $data->stage = "1";
                    $data->status = "Opened";
                    $data->more_info_review_by = Auth::user()->name;
                    $data->more_info_review_on = Carbon::now()->format('d-M-Y');
                    $data->more_info_review_comment = $request->comment;

                    $history = new ChangeProposalAuditTrial();
                    $history->cpjg_id = $id;
                    $history->activity_type = 'Not Applicable';
                    // if (is_null($lastDocument->more_info_review_by) || $lastDocument->more_info_review_by === '') {
                    //     $history->previous = "Null";
                    // } else {
                    //     $history->previous = $lastDocument->more_info_review_by . ' , ' . $lastDocument->more_info_review_on;
                    // }
                    // $history->current = $data->more_info_review_by . ' , ' . $data->more_info_review_on;
                    $history->previous = 'Not Applicable';
                    $history->current = 'Not Applicable';
                    $history->action = 'More Info Required';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "Opened";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Opened';
                    // if (is_null($lastDocument->more_info_review_by) || $lastDocument->more_info_review_by === '') {
                    //     $history->action_name = 'New';
                    // } else {
                    //     $history->action_name = 'Update';
                    // }
                    $history->action_name = 'Not Applicable';
                    $history->save();

                    $list = Helpers::getInitiatorUserList($data->division_id);

                        foreach ($list as $u) {
                            $email = Helpers::getUserEmail($u->user_id);
                        
                            if ($email !== null) {
                                try {
                                    $maildata = [
                                        'data' => $data,
                                        'site' => "CPJ",
                                        'history' => "More Info Required",
                                        'process' => 'Change Proposal And Justification',
                                        'comment' => $request->comment,
                                        'user'=> Auth::user()->name
                                    ];

                                    SendMail::dispatch($maildata, $email, $data, 'Change Proposal And Justification');

                                } catch (\Exception $e) {
                                    \Log::error('Mail Error: ' . $e->getMessage());
                                }
                            }
                        }



                    // $list = Helpers::getInitiatorUserList($data->division_id)->unique('user_id')
                    // ->values();
                    // foreach ($list as $u) {
                    //    // if($u->q_m_s_divisions_id == $changeControl->division_id){
                    //        $email = Helpers::getUserEmail($u->user_id);
                    //            if (!empty($email)) {
                    //               try{

                    //                     $data = [
                    //                         'data'    => $data,
                    //                         'site'    => "Extension",
                    //                         'history' => "More Info Required",
                    //                         'process' => 'Extension',
                    //                         'comment' => $request->comment,
                    //                         'user'    => Auth::user()->name
                    //                     ];

                    //                     SendMail::dispatch(
                    //                         $data,
                    //                         $email,
                    //                         $data,
                    //                         'Extension'
                    //                     );

                    //                 } catch (\Exception $e) {
                    //                     \Log::error('Mail Error: ' . $e->getMessage());
                    //                 }
                    //        }
                    //    // }
                    // }
                    $data->update();
                    toastr()->success('Document Sent');
                    return back();
                }
            } else {
                toastr()->error('E-signature Not match');
                return back();
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function cpjCancle(Request $request, $id)
    {
        try {
            if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
                $cpjdata = ChangeProposalJust::find($id);
                $lastDocument = ChangeProposalJust::find($id);

                if ($cpjdata->stage == 1) {

                    $cpjdata->stage = "0";
                    $cpjdata->status = "Closed Cancelled";
                    $cpjdata->cancelled_by = Auth::user()->name;
                    $cpjdata->cancelled_on = Carbon::now()->format('d-M-Y');
                    $cpjdata->cancel_comment = $request->comment;

                    $history = new ChangeProposalAuditTrial();
                    $history->cpjg_id = $id;
                    $history->activity_type = 'Cancel By, Cancel On';
                    if (is_null($lastDocument->cancelled_by) || $lastDocument->cancelled_by === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->cancelled_by . ' , ' . $lastDocument->cancelled_on;
                    }
                    $history->current = $cpjdata->cancelled_by . ' , ' . $cpjdata->cancelled_on;
                    $history->action = 'Cancel';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "Closed - Cancelled";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Closed - Cancelled';
                    if (is_null($lastDocument->cancelled_by) || $lastDocument->cancelled_by === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();

                      $list = Helpers::getHodUserList($cpjdata->division_id);

                        foreach ($list as $u) {
                            $email = Helpers::getUserEmail($u->user_id);
                        
                            if ($email !== null) {
                                try {
                                    $maildata = [
                                        'data' => $cpjdata,
                                        'site' => "CPJ",
                                        'history' => "Cancel",
                                        'process' => 'Change Proposal And Justification',
                                        'comment' => $request->comment,
                                        'user'=> Auth::user()->name
                                    ];

                                    SendMail::dispatch($maildata, $email, $cpjdata, 'Change Proposal And Justification');

                                } catch (\Exception $e) {
                                    \Log::error('Mail Error: ' . $e->getMessage());
                                }
                            }
                        }
                //  $list = Helpers::getInitiatorUserList($cpjdata->division_id)
                //     ->unique('user_id')
                //     ->values(); // Notify HOD
                //     foreach ($list as $u) {
                //        // if($u->q_m_s_divisions_id == $changeControl->division_id){
                //            $email = Helpers::getUserEmail($u->user_id);
                //                if (!empty($email)) {
                //             try{

                //                 $data = [
                //                     'data'    => $cpjdata,
                //                     'site'    => "Extension",
                //                     'history' => "Cancel",
                //                     'process' => 'Extension',
                //                     'comment' => $request->comment,
                //                     'user'    => Auth::user()->name
                //                 ];

                //                 SendMail::dispatch(
                //                     $data,
                //                     $email,
                //                     $cpjdata,
                //                     'Extension'
                //                 );

                //             } catch (\Exception $e) {
                //                 \Log::error('Mail Error: ' . $e->getMessage());
                //             }
                //            }
                //        // }
                //     }
                    $cpjdata->update();
                    return back();
                }
            } else {
                toastr()->error('E-signature Not match');
                return back();
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function hodCancle(Request $request, $id)
    {
        try {
            if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
                $cpjdata = ChangeProposalJust::find($id);
                $lastDocument = ChangeProposalJust::find($id);

                if ($cpjdata->stage == 2) {

                    $cpjdata->stage = "0";
                    $cpjdata->status = "Closed Cancelled";
                    $cpjdata->hod_cancelled_by = Auth::user()->name;
                    $cpjdata->hod_cancelled_on = Carbon::now()->format('d-M-Y');
                    $cpjdata->hod_cancel_comment = $request->comment;

                    $history = new ChangeProposalAuditTrial();
                    $history->cpjg_id = $id;
                    $history->activity_type = 'HOD Cancel By, HOD Cancel On';
                    if (is_null($lastDocument->hod_cancelled_by) || $lastDocument->hod_cancelled_by === '') {
                        $history->previous = "Null";
                    } else {
                        $history->previous = $lastDocument->hod_cancelled_by . ' , ' . $lastDocument->hod_cancelled_on;
                    }
                    $history->current = $cpjdata->hod_cancelled_by . ' , ' . $cpjdata->hod_cancelled_on;
                    $history->action = 'Cancel';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "Closed - Cancelled";
                    $history->change_from = $lastDocument->status;
                    $history->stage = 'Closed - Cancelled';
                    if (is_null($lastDocument->hod_cancelled_by) || $lastDocument->hod_cancelled_by === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();

                     $list = Helpers::getHodUserList($cpjdata->division_id);

                        foreach ($list as $u) {
                            $email = Helpers::getUserEmail($u->user_id);
                        
                            if ($email !== null) {
                                try {
                                    $maildata = [
                                        'data' => $cpjdata,
                                        'site' => "CPJ",
                                        'history' => "Cancel",
                                        'process' => 'Change Proposal And Justification',
                                        'comment' => $request->comment,
                                        'user'=> Auth::user()->name
                                    ];

                                    SendMail::dispatch($maildata, $email, $cpjdata, 'Change Proposal And Justification');

                                } catch (\Exception $e) {
                                    \Log::error('Mail Error: ' . $e->getMessage());
                                }
                            }
                        }
                //  $list = Helpers::getInitiatorUserList($cpjdata->division_id)
                //     ->unique('user_id')
                //     ->values(); // Notify HOD
                //     foreach ($list as $u) {
                //        // if($u->q_m_s_divisions_id == $changeControl->division_id){
                //            $email = Helpers::getUserEmail($u->user_id);
                //                if (!empty($email)) {
                //             try{

                //                 $data = [
                //                     'data'    => $cpjdata,
                //                     'site'    => "Extension",
                //                     'history' => "Cancel",
                //                     'process' => 'Extension',
                //                     'comment' => $request->comment,
                //                     'user'    => Auth::user()->name
                //                 ];

                //                 SendMail::dispatch(
                //                     $data,
                //                     $email,
                //                     $cpjdata,
                //                     'Extension'
                //                 );

                //             } catch (\Exception $e) {
                //                 \Log::error('Mail Error: ' . $e->getMessage());
                //             }
                //            }
                //        // }
                //     }
                    $cpjdata->update();
                    return back();
                }
            } else {
                toastr()->error('E-signature Not match');
                return back();
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function cpjrejectStage(Request $request, $id)
    {

        try {
            if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
                $cpjdata = ChangeProposalJust::find($id);
                $lastDocument = ChangeProposalJust::find($id);

        if ($cpjdata->stage == 4) {
                
            $cpjdata->stage = "6";
            $cpjdata->status = "Closed - Reject";


            $cpjdata->rejected_by = Auth::user()->name;
            $cpjdata->rejected_on = Carbon::now()->format('d-M-Y');
            $cpjdata->reject_comment = $request->comment;

            $history = new ChangeProposalAuditTrial();
            $history->cpjg_id = $id;
            $history->activity_type = 'Reject By, Reject On';
            if (is_null($lastDocument->rejected_by) || $lastDocument->rejected_by === '') {
                $history->previous = "Null";
            } else {
                $history->previous = $lastDocument->rejected_by . ' , ' . $lastDocument->rejected_on;
            }
            $history->current = $cpjdata->rejected_by . ' , ' . $cpjdata->rejected_on;
            $history->action = 'Reject';
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->change_to =   "Closed - Reject";
            $history->change_from = $lastDocument->status;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->stage = 'Closed - Reject';
            if (is_null($lastDocument->rejected_by) || $lastDocument->rejected_by === '') {
                $history->action_name = 'New';
            } else {
                $history->action_name = 'Update';
            }
            $history->save();


                 $usersmail = collect()
                    ->merge(Helpers::getQAApproverUserList($cpjdata->division_id))
                    ->merge(Helpers::getInitiatorUserList($cpjdata->division_id))
                    ->unique('user_id')
                    ->values();
                    foreach ($usersmail as $u) {
                       // if($u->q_m_s_divisions_id == $changeControl->division_id){
                           $email = Helpers::getUserEmail($u->user_id);
                               if (!empty($email)) {
                                   try{

                                        $data = [
                                            'data'    => $cpjdata,
                                            'site' => "CPJ",
                                            'history' => "Reject",
                                            'process' => 'Change Proposal And Justification',
                                            'comment' => $request->comment,
                                            'user'    => Auth::user()->name
                                        ];

                                        SendMail::dispatch(
                                            $data,
                                            $email,
                                            $cpjdata,
                                            'Change Proposal And Justification'
                                        );

                                    } catch (\Exception $e) {
                                        \Log::error('Mail Error: ' . $e->getMessage());
                                    }
                           }
                       // }
                    }

            $cpjdata->update();
            toastr()->success('Document Sent');
            return back();
        }

        }else {
            toastr()->error('E-signature Not match');
            return back();
        }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function changePropsalNewAuditTrail($id)
    {
        $audit = ChangeProposalAuditTrial::where('cpjg_id', $id)->orderByDesc('id')->paginate(5);
        // dd($audit);
        $today = Carbon::now()->format('d-m-y');
        $document = ChangeProposalJust::where('id', $id)->first();
        $document->initiator = User::where('id', $document->initiator)->value('name');
        $users = User::all();
        // dd($document);
        return view('frontend.changePropaslJust.auditTrial', compact('audit', 'document', 'today', 'users'));
    }

    public function cpjSingleReport($id)
    {
        $data = ChangeProposalJust::find($id);
        $changeProposalGrid = ChangeProposalJustGrid::where('cpjg_id', $id)->where('identifier', 'change_proposal_grid')->first();
        $checklistData = ChangeProposalJustGrid::where('cpjg_id', $id)->where('identifier', 'stage3_checklist')->first();

        // dd($checklistData);

    if (!empty($data)) {
        $data->originator = User::where('id', $data->initiator_id)->value('name');
        $pdf = App::make('dompdf.wrapper');
        $time = Carbon::now();
        $pdf = PDF::loadview('frontend.changePropaslJust.singleReport', compact('data','changeProposalGrid','checklistData'))
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
            $canvas->page_script(function ($pageNumber, $pageCount, $canvas, $fontMetrics) {
                $text = "$pageNumber of $pageCount";
                $font = $fontMetrics->getFont('sans-serif');
                $size = 9;
                $width = $fontMetrics->getTextWidth($text, $font, $size);

                $canvas->text(($canvas->get_width() - $width - 110), ($canvas->get_height() - 763), $text, $font, $size);
            });
        return $pdf->stream('Change Proposal Justification' . $id . '.pdf');
    }
    }

    public function auditReport($id)
{
    $doc = ChangeProposalJust::find($id);
    $audit = ChangeProposalAuditTrial::where('cpjg_id', $id)->paginate(500);
    $doc->originator = User::where('id', $doc->initiator_id)->value('name');
    $data = ChangeProposalAuditTrial::where('cpjg_id', $doc->id)->orderByDesc('id')->get();
    $pdf = App::make('dompdf.wrapper');
    $time = Carbon::now();
    $pdf = PDF::loadview('frontend.changePropaslJust.auditReport', compact('data','audit' ,'doc'))
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

    $canvas->page_script(function ($pageNumber, $pageCount, $canvas, $fontMetrics) {
        $text = " $pageNumber of $pageCount";
        $font = $fontMetrics->getFont('sans-serif', 'normal');
        $size = 9;
        $width = $fontMetrics->getTextWidth($text, $font, $size);

        $canvas->text(($canvas->get_width() - $width - 110), ($canvas->get_height() - 26), $text, $font, $size);
    });
    return $pdf->stream('SOP' . $id . '.pdf');
}
}
