<?php

namespace App\Http\Controllers;

use App\Models\Annexure;
use App\Models\ChangeControlLog;
use App\Models\ChangeControlStage;
use App\Models\Document;
use App\Models\DocumentContent;
use App\Models\OpenStage;
use App\Models\RoleGroup;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Helpers;
class OpenStageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function division(Request $request, $id)
    {
        $openStage = OpenStage::find($id);
        $document = Document::where('document_name', $openStage->title)->first();
        $document->division_id = $request->division_id;
        $document->process_id = $request->process_id;
        $document->update();

        return redirect()->route('documents.edit', $document->id);
    }

    public function index()
    {

        if (Helpers::checkRoles(4)) {
            $data = OpenStage::where('assign_to', Auth::user()->id)->where('stage', '>=', 2)->OrderByDesc('id')->get();
            foreach ($data as $temp) {
                $temp->assign_to_name = User::where('id', $temp->assign_to)->value('name');
                $temp->cft_name = User::where('id', $temp->cft)->value('name');
                $temp->recordNumber = str_pad($temp->record, 5, '0', STR_PAD_LEFT);
            }
        } elseif (Helpers::checkRoles(5)) {
            $array1 = [];
            $array2 = [];
            $data = OpenStage::where('stage', '>=', 4)->OrderByDesc('id')->get();
            foreach ($data as $datas) {
                $datas->assign_to_name = User::where('id', $datas->assign_to)->value('name');
                if ($datas->cft) {
                    $datauser = explode(',', $datas->cft);
                    for ($i = 0; $i < count($datauser); $i++) {
                        if ($datauser[$i] == Auth::user()->id) {
                            array_push($array2, $datas);
                        }
                    }
                }
                $datas->recordNumber = str_pad($datas->record, 5, '0', STR_PAD_LEFT);
            }

            return view('frontend.change-control.change-control-list', ['data' => $array2]);
        } else {
            $data = OpenStage::OrderByDesc('id')->get();
            foreach ($data as $temp) {
                $temp->assign_to_name = User::where('id', $temp->assign_to)->value('name');
                $temp->cft_name = User::where('id', $temp->cft)->value('name');
                $temp->recordNumber = str_pad($temp->record, 5, '0', STR_PAD_LEFT);
            }
        }

        return view('frontend.change-control.change-control-list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hod = User::where('role', 4)->get();
        $cft = User::where('role', 5)->get();

        return view('frontend.change-control.data-fields', compact('hod', 'cft'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:100|unique:open_stages,title',
            'short_description' => 'required|unique:open_stages,short_description',
            'assign_to' => 'required',

        ]);
        $openState = new OpenStage();
        $openState->initiator_id = Auth::user()->id;
        $openState->record = DB::table('record_numbers')->value('counter') + 1;
        $openState->title = $request->title;
        $openState->version = $request->version;
        $openState->short_description = $request->short_description;
        $openState->type = $request->type;
        $openState->assign_to = $request->assign_to;
        $openState->cft = implode(',', $request->cft);
        $openState->due_date = $request->due_date;
        $openState->document_required = $request->document_required;
        $openState->batch = $request->batch;
        $openState->owning_facility = $request->owning_facility;
        $openState->impacted_facilities = $request->impacted_facilities;
        $openState->owning_department = $request->owning_department;
        $openState->impacted_department = $request->title;
        $openState->doc_change_action = $request->doc_change_action;
        $openState->doc_change_type = $request->doc_change_type;
        $openState->doc_change_summary = $request->doc_change_summary;
        $openState->doc_change_summary_reason = $request->doc_change_summary_reason;
        if ($request->periodic_review) {
            $openState->periodic_review = $request->periodic_review;
        }
        $openState->current_state = $request->current_state;
        $openState->proposed_state = $request->proposed_state;
        $openState->justification = $request->justification;
        $openState->equipment_affected = $request->equipment_affected;
        $openState->equipment_id = $request->equipment_id;
        $openState->equipment_comment = $request->equipment_comment;
        $openState->document_affected = $request->document_affected;
        $openState->document_comment = $request->document_comment;
        if ($request->implemented_as_planned) {
            $openState->implemented_as_planned = $request->implemented_as_planned;
        }
        $openState->change_evalution = $request->change_evalution;
        $openState->justification_for_reject = $request->justification_for_reject;
        $openState->status = 'Open State';
        $openState->stage = 1;
        $openState->save();
        if ($request->document_required == 'yes') {
            $document = new Document();
            $document->record = DB::table('record_numbers')->value('counter') + 1;
            $document->originator_id = Auth::id();
            $document->document_name = $request->title;
            $document->short_description = $request->short_description;
            $document->due_date = $request->due_date;
            $document->status = 'Draft';
            $document->training_required = 'no';
            $document->save();
            $content = new DocumentContent();
            $content->document_id = $document->id;
            $content->purpose = $request->purpose;
            $content->scope = $request->scope;
            $content->procedure = $request->procedure;
            if (! empty($request->materials_and_equipments)) {
                $content->materials_and_equipments = serialize($request->materials_and_equipments);
            }
            if (! empty($request->responsibility)) {
                $content->responsibility = serialize($request->responsibility);
            }
            if (! empty($request->abbreviation)) {
                $content->abbreviation = serialize($request->abbreviation);
            }
            if (! empty($request->defination)) {
                $content->defination = serialize($request->defination);
            }
            if (! empty($request->reporting)) {
                $content->reporting = serialize($request->reporting);
            }
            if ($request->hasfile('references')) {

                $image = $request->file('references');

                $ext = $image->getClientOriginalExtension();

                $image_name = date('y-m-d').'-'.rand().'.'.$ext;

                $image->move('upload/document/', $image_name);

                $content->references = $image_name;
            }

            if (! empty($request->annexuredata)) {
                $content->annexuredata = serialize($request->annexuredata);
            }

            $content->save();
        }
        // Retrieve the current counter value
        $counter = DB::table('record_numbers')->value('counter');

        // Generate the record number with leading zeros
        $recordNumber = str_pad($counter, 5, '0', STR_PAD_LEFT);

        // Increment the counter value
        $newCounter = $counter + 1;
        DB::table('record_numbers')->update(['counter' => $newCounter]);

        $annexure = new Annexure();
        $annexure->document_id = $document->id;
        if (! empty($request->serial_number)) {
            $annexure->sno = serialize($request->serial_number);
        }
        if (! empty($request->annexure_number)) {
            $annexure->annexure_no = serialize($request->annexure_number);
        }
        if (! empty($request->annexure_data)) {
            $annexure->annexure_title = serialize($request->annexure_data);
        }
        $annexure->save();

        toastr()->success('Document created');

        return redirect()->route('change-control.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data = OpenStage::find($id);
        $openStage = OpenStage::find($id);
        $openStage->recordData = str_pad($openStage->record, 5, '0', STR_PAD_LEFT);
        $openStage->initiator = User::where('id', $openStage->initiator_id)->value('name');
        $openStage->year = Carbon::parse($openStage->created_at)->format('Y');
        $openStage->date = Carbon::parse($openStage->created_at)->format('d-M-Y');
        $hod = User::where('role', 4)->get();
        $cft = User::where('role', 5)->get();
        $data->assign_to_name = User::where('id', $data->assign_to)->value('name');
        $data->cft_name = User::where('id', $data->cft)->value('name');
        $dms = Document::where('document_name', $data->title)->first();
        $changeStage = ChangeControlStage::where('user_id', Auth::user()->id)->where('change_control_id', $id)->get();
        if (! empty($changeStage)) {
            $changeStage->approve = ChangeControlStage::where('user_id', Auth::user()->id)->where('change_control_id', $id)->where('stage', 5)->latest()->first();
            $changeStage->reject = ChangeControlStage::where('user_id', Auth::user()->id)->where('change_control_id', $id)->where('stage', 5)->latest()->first();
            $changeStage->review = ChangeControlStage::where('user_id', Auth::user()->id)->where('change_control_id', $id)->where('stage', 3)->latest()->first();

        }

        if (Auth::user()->role != 4 && Auth::user()->role != 5) {

            return view('frontend.change-control.change-control-view', compact('data', 'changeStage','hod', 'cft', 'openStage','dms'));

        } else {
            return view('frontend.change-control.reviewer-panel', compact('data', 'changeStage','hod', 'cft', 'openStage','dms'));

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $openStage = OpenStage::find($id);
        $openStage->recordData = str_pad($openStage->record, 5, '0', STR_PAD_LEFT);
        $openStage->initiator = User::where('id', $openStage->initiator_id)->value('name');
        $openStage->year = Carbon::parse($openStage->created_at)->format('Y');
        $openStage->date = Carbon::parse($openStage->created_at)->format('d-M-Y');
        $hod = User::where('role', 4)->get();
        $cft = User::where('role', 5)->get();

        return view('frontend.change-control.edit-data-fields', compact('hod', 'cft', 'openStage'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'title' => 'required|max:100',
            'assign_to' => 'required',

        ]);
        $lastContent = OpenStage::find($id);
        $openState = OpenStage::find($id);
         if($request->title)
        {
            if($openState->document_required == 'yes'){
                $document = Document::where('document_name', $openState->title)->first();
                $document->document_name = $request->title;
                $document->update();
            }
        }
        $openState->title = $request->title;

        $openState->version = $request->version;
        $openState->short_description = $request->short_description;
        $openState->type = $request->type;
        $openState->assign_to = $request->assign_to;
        $openState->cft = implode(',', $request->cft);
        $openState->due_date = $request->due_date;
        $openState->batch = $request->batch;
        $openState->owning_facility = $request->owning_facility;
        $openState->impacted_facilities = $request->impacted_facilities;
        $openState->owning_department = $request->owning_department;
        $openState->impacted_department = $request->title;
        $openState->doc_change_action = $request->doc_change_action;
        $openState->doc_change_type = $request->doc_change_type;
        $openState->doc_change_summary = $request->doc_change_summary;
        $openState->doc_change_summary_reason = $request->doc_change_summary_reason;
        if ($request->periodic_review) {
            $openState->periodic_review = $request->periodic_review;
        }
        $openState->current_state = $request->current_state;
        $openState->proposed_state = $request->proposed_state;
        $openState->justification = $request->justification;
        $openState->equipment_affected = $request->equipment_affected;
        $openState->equipment_id = $request->equipment_id;
        $openState->equipment_comment = $request->equipment_comment;
        $openState->document_affected = $request->document_affected;
        $openState->document_comment = $request->document_comment;
        if ($request->implemented_as_planned) {
            $openState->implemented_as_planned = $request->implemented_as_planned;
        }
        $openState->change_evalution = $request->change_evalution;
        $openState->justification_for_reject = $request->justification_for_reject;
        $openState->update();
        if ($lastContent->title != $openState->title || ! empty($request->title_comment)) {
            $history = new ChangeControlLog();
            $history->change_control_id = $id;
            $history->activity_type = 'Title';
            $history->previous = $lastContent->title;
            $history->current = $openState->title;
            $history->comment = $request->title_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastContent->status;
            $history->save();
        }
        if ($lastContent->short_description != $openState->short_description || ! empty($request->short_description_comment)) {
            $history = new ChangeControlLog();
            $history->change_control_id = $id;
            $history->activity_type = 'Short description';
            $history->previous = $lastContent->short_description;
            $history->current = $openState->short_description;
            $history->comment = $request->short_description_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastContent->status;
            $history->save();
        }
        if ($lastContent->version != $openState->version || ! empty($request->version_comment)) {
            $history = new ChangeControlLog();
            $history->change_control_id = $id;
            $history->activity_type = 'version';
            $history->previous = $lastContent->version;
            $history->current = $openState->version;
            $history->comment = $request->version_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastContent->status;
            $history->save();
        }
        if ($lastContent->batch != $openState->batch || ! empty($request->batch_comment)) {
            $history = new ChangeControlLog();
            $history->change_control_id = $id;
            $history->activity_type = 'batch';
            $history->previous = $lastContent->batch;
            $history->current = $openState->batch;
            $history->comment = $request->batch_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastContent->status;
            $history->save();
        }
        if ($lastContent->due_date != $openState->due_date || ! empty($request->due_date_comment)) {
            $history = new ChangeControlLog();
            $history->change_control_id = $id;
            $history->activity_type = 'due_date';
            $history->previous = $lastContent->due_date;
            $history->current = $openState->due_date;
            $history->comment = $request->due_date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastContent->status;
            $history->save();
        }
        if ($lastContent->assign_to != $openState->assign_to || ! empty($request->assign_to_comment)) {
            $history = new ChangeControlLog();
            $history->change_control_id = $id;
            $history->activity_type = 'assign_to';
            $history->previous = $lastContent->assign_to;
            $history->current = $openState->assign_to;
            $history->comment = $request->assign_to_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastContent->status;
            $history->save();
        }
        if ($lastContent->cft != $openState->cft || ! empty($request->cft_comment)) {
            $history = new ChangeControlLog();
            $history->change_control_id = $id;
            $history->activity_type = 'cft';
            $history->previous = $lastContent->cft;
            $history->current = $openState->cft;
            $history->comment = $request->cft_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastContent->status;
            $history->save();
        }
        toastr()->success('Document Updated');

        return redirect()->route('change-control.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int
     * id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = OpenStage::find($id);
        $data->delete();
        toastr()->success('Deleted successfully !!');

        return back();
    }

    public function notification($id)
    {
        $document = OpenStage::find($id);
        $document->assign_to = User::where('id', $document->assign_to)->first();
        $document->cft = explode(',', $document->cft);


        return view('frontend.send-notification', compact('document'));
    }

    public function auditTrial($id)
    {
        $audit = ChangeControlLog::where('change_control_id', $id)->orderByDESC('id')->get()->unique('activity_type');
        $today = Carbon::now()->format('d-m-y');
        $document = OpenStage::where('id', $id)->first();
        $document->originator = User::where('id', $document->initiator_id)->value('name');

        return view('frontend.change-control.audit-trial', compact('audit', 'document', 'today'));
    }

    public function auditDetails($id)
    {
        $detail = ChangeControlLog::find($id);
        $detail_data = ChangeControlLog::where('activity_type', $detail->activity_type)->where('change_control_id', $detail->change_control_id)->latest()->get();
        $doc = OpenStage::where('id', $detail->change_control_id)->first();

        $doc->origiator_name = User::find($doc->initiator_id);

        return view('frontend.change-control.audit-trial-inner', compact('detail', 'doc', 'detail_data'));
    }
}
