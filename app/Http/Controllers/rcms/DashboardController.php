<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use App\Models\ActionItem;
use App\Models\Capa;
use App\Models\QMSProcess;
use App\Models\CC;
use App\Models\EffectivenessCheck;
use App\Models\Extension;
use App\Models\InternalAudit;
use App\Models\ManagementReview;
use App\Models\OutOfCalibration;
use App\Models\Resampling;
use App\Models\RiskManagement;
use App\Models\LabIncident;
use App\Models\Auditee;
use App\Models\NonConformance;
use App\Models\AuditProgram;
use App\Models\{Division,Deviation, extension_new, Incident};
use App\Models\RootCauseAnalysis;
use App\Models\Observation;
use App\Models\QMSDivision;
use App\Models\FailureInvestigation;
use App\Models\Ootc;
use App\Models\RecordNumber;
use Helpers;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use App\Models\OOS;
use App\Models\errata;
use App\Models\MarketComplaint;
use App\Models\OOS_micro;


class DashboardController extends Controller
{
    // public function index(){
    //     if(Helpers::checkRoles(3)){
    //         $data = CC::where('initiator_id',Auth::user()->id)->orderbyDESC('id')->get();
    //         $child = [];
    //         $childs = [];
    //         foreach($data as $datas){
    //             $datas->originator = User::where('id',$datas->initiator_id)->value('name');
    //             $datas->actionItem = ActionItem::where('cc_id',$datas->id)->get();
    //             $datas->extension = Extension::where('cc_id',$datas->id)->get();


    //         }


    //         return view('frontend.rcms.dashboard',compact('data'));
    //     }
    // }

    public function index(Request $request)
    {
        $table = [];

        $datas = CC::orderByDesc('id')->get();
        $datas1 = ActionItem::orderByDesc('id')->get();
        $datas2 = extension_new::orderByDesc('id')->get();
        $datas3 = EffectivenessCheck::orderByDesc('id')->get();
        $datas4 = InternalAudit::orderByDesc('id')->get();
        $datas5 = Capa::orderByDesc('id')->get();
        $datas6 = RiskManagement::orderByDesc('id')->get();
        $datas7 = ManagementReview::orderByDesc('id')->get();
        $datas8 = LabIncident::orderByDesc('id')->get();
        $datas9 = Auditee::orderByDesc('id')->get();
        $datas10 = AuditProgram::orderByDesc('id')->get();
        $datas11 = RootCauseAnalysis::orderByDesc('id')->get();
        $datas12 = Observation::orderByDesc('id')->get();
        $datas13 = OOS::orderByDesc('id')->get();
        $datas14 = MarketComplaint::orderByDesc('id')->get();

        $deviation = Deviation::orderByDesc('id')->get();
        $ooc = OutOfCalibration::orderByDesc('id')->get();
        $failureInvestigation = FailureInvestigation::orderByDesc('id')->get();
        $datas15 = Ootc::orderByDesc('id')->get();
        $datas16 = errata::orderByDesc('id')->get();
        $datas17 = OOS_micro::orderByDesc('id')->get();

        $datas25 = NonConformance::orderByDesc('id')->get();
        $incident = Incident::orderByDesc('id')->get();
        $resampling = Resampling::orderByDesc('id')->get();
        foreach ($datas as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->cc_id ? $data->cc_id : "-",
                // "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "due_date" => $data->due_date,
                "type" => "Change-Control",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "division_id" => $data->division_id,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "initiated_through" => $data->initiated_through,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->created_at,
                "date_close" => $data->updated_at,
                "dashboard_unique_id" => $data->dashboard_unique_id,
            ]);
        }

        foreach ($datas1 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->cc_id ? $data->cc_id : "-",
                "record" => $data->record,
                "type" => "Action-Item",
                "due_date" => $data->due_date,
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "division_id" => $data->division_id,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "initiated_through" => $data->initiated_through,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->created_at,
                "date_close" => $data->updated_at,
                "dashboard_unique_id" => $data->dashboard_unique_id,

            ]);
        }
        foreach ($datas2 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
            // dd($data);
            array_push($table, [
                "id" => $data->id,
                "parent" => $data->cc_id ? $data->cc_id : "-",
                "record" => $data->record_number,
                "type" => "Extension",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "division_id" => $data->site_location_code,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator,
                "initiated_through" => $data->initiated_through,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->created_at,
                "due_date" => $data->due_date,
                "date_close" => $data->updated_at,
                "dashboard_unique_id" => $data->dashboard_unique_id,

            ]);
        }
        foreach ($datas3 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "type" => "Effectiveness-Check",
                "parent_id" => $data->parent_record,
                "parent_type" => $data->parent_type,
                "division_id" => $data->division_id,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "initiated_through" => $data->initiated_through,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->created_at,
                "date_close" => $data->updated_at,
                "due_date" => $data->due_date,
                "dashboard_unique_id" => $data->dashboard_unique_id,

            ]);
        }
        foreach ($datas4 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "type" => "Internal-Audit",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "division_id" => $data->division_id,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "initiated_through" => $data->initiated_through,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->created_at,
                "date_close" => $data->updated_at,
                "due_date" => $data->due_date,
                "dashboard_unique_id" => $data->dashboard_unique_id,

            ]);
        }
        foreach ($datas5 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
            $revised_date = Extension::where('parent_id', $data->id)->where('parent_type', "Capa")->value('revised_date');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "type" => "Capa",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "division_id" => $data->division_id,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "initiated_through" => $data->initiated_through,
                "intiation_date" => $revised_date ? $revised_date : $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->created_at,
                "date_close" => $data->updated_at,
                "due_date" => $data->due_date,
            ]);
        }
        foreach ($datas6 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "type" => "Risk-Assesment",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "division_id" => $data->division_id,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "initiated_through" => $data->initiated_through,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->created_at,
                "date_close" => $data->updated_at,
                "due_date" => $data->due_date,
                "dashboard_unique_id" => $data->dashboard_unique_id,

            ]);
        }
        foreach ($datas7 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "type" => "Management-Review",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "division_id" => $data->division_id,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "initiated_through" => $data->initiated_through,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->created_at,
                "date_close" => $data->updated_at,
                "due_date" => $data->due_date,
                "dashboard_unique_id" => $data->dashboard_unique_id,

            ]);
        }
        foreach ($datas8 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "type" => "Lab-Incident",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "division_id" => $data->division_id,
                "short_description" => $data->short_desc ? $data->short_desc : "-",
                "initiator_id" => $data->initiator_id,
                "initiated_through" => $data->initiated_through,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->created_at,
                "date_close" => $data->updated_at,
                "due_date" => $data->due_date,
                "dashboard_unique_id" => $data->dashboard_unique_id,

            ]);
        }
        foreach ($datas9 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "type" => "External-Audit",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "division_id" => $data->division_id,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "initiated_through" => $data->initiated_through,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->created_at,
                "date_close" => $data->updated_at,
                "due_date" => $data->due_date,
                "dashboard_unique_id" => $data->dashboard_unique_id,

            ]);
        }
        foreach ($datas10 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "type" => "Audit-Program",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "division_id" => $data->division_id,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "initiated_through" => $data->initiated_through,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->created_at,
                "date_close" => $data->updated_at,
                "due_date" => $data->due_date,
                "dashboard_unique_id" => $data->dashboard_unique_id,
            ]);
        }
        foreach ($datas11 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "due_date" => $data->due_date,
                "division_id" => $data->division_id,
                "type" => "Root-Cause-Analysis",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "initiated_through" => $data->initiated_through,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->created_at,
                "date_close" => $data->updated_at,
                "dashboard_unique_id" => $data->dashboard_unique_id,
            ]);
        }
        foreach ($datas12 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_code,
                "type" => "Observation",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "initiated_through" => $data->initiated_through,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->created_at,
                "date_close" => $data->updated_at,
                "due_date" => $data->due_date,
                "dashboard_unique_id" => $data->dashboard_unique_id,

            ]);
        }
        foreach ($datas13 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "OOS/OOT",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->description_gi ? $data->description_gi : "-",
                "initiator_id" => $data->initiator_id,
                "initiated_through" => $data->initiated_through_gi,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->created_at,
                "date_close" => $data->updated_at,
                "due_date" => $data->due_date,
                "dashboard_unique_id" => $data->dashboard_unique_id,
            ]);
        }
        foreach ($datas14 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "due_date" => $data->due_date_gi,
                "division_id" => $data->division_id,
                "type" => "Market Complaint",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->description_gi ? $data->description_gi : "-",
                "initiator_id" => $data->initiator_id,
                "initiated_through" => $data->initiated_through_gi,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->created_at,
                "date_close" => $data->updated_at,
                "dashboard_unique_id" => $data->dashboard_unique_id,
            ]);
        }
        foreach ($datas15 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record_number,
                "division_id" => $data->division_id,
                "type" => "OOT",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "due_date" => $data->due_date,
                "stage" => $data->status,
                "date_open" => $data->created_at,
                "initiated_through" => $data->initiated_through? $data->initiated_through : "-",
                "date_close" => $data->updated_at,
                "dashboard_unique_id" => $data->dashboard_unique_id,
            ]);
        }
        foreach ($datas16 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "ERRATA",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "initiated_through" => $data->initiated_by,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "due_date" => $data->due_date,
                "date_open" => $data->created_at,
                "date_close" => $data->updated_at,
                "dashboard_unique_id" => $data->dashboard_unique_id,
            ]);
        }
         foreach ($datas17 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "OOS Microbiology",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->description_gi ? $data->description_gi : "-",
                "initiator_id" => $data->initiator_id,
                "initiated_through" => $data->initiated_through_gi,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->created_at,
                "date_close" => $data->updated_at,
                "due_date" => $data->due_date,
                "dashboard_unique_id" => $data->dashboard_unique_id,
            ]);
        }
        foreach ($deviation as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "Deviation",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "initiated_through" => $data->initiated_through,
                "date_open" => $data->created_at,
                "date_close" => $data->updated_at,
                "due_date" => $data->due_date,
                "dashboard_unique_id" => $data->dashboard_unique_id,
            ]);
        }
        foreach ($ooc as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
            array_push($table, [
                "id" => $data->id,
                "due_date" => $data->due_date,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "type" => "Out Of Calibration",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "division_id" => $data->division_id,
                "short_description" => $data->description_ooc ? $data->description_ooc : "-",
                "initiator_id" => $data->initiator_id,
                "initiated_through" => $data->initiated_through_gi,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->created_at,
                "date_close" => $data->updated_at,
                "dashboard_unique_id" => $data->dashboard_unique_id,
            ]);
        }
        foreach ($failureInvestigation as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->cc_id ? $data->cc_id : "-",
                "record" => $data->record,
                "type" => "Failure Investigation",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "division_id" => $data->division_id,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "initiated_through" => $data->initiated_through,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->created_at,
                "due_date" => $data->due_date,
                "date_close" => $data->updated_at,
                "dashboard_unique_id" => $data->dashboard_unique_id,
            ]);
        }
        foreach ($datas25 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
            array_push($table, [
                "id" => $data->id,
                "parent" => $data->cc_id ? $data->cc_id : "-",
                "record" => $data->record,
                "type" => "Non Conformance",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "division_id" => $data->division_id,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "initiated_through" => $data->initiated_through,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->created_at,
                "due_date" => $data->due_date,
                "date_close" => $data->updated_at,
                "dashboard_unique_id" => $data->dashboard_unique_id,
            ]);
        }
        foreach ($incident as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
            array_push($table, [
                "id" => $data->id,
                "parent" => $data->cc_id ? $data->cc_id : "-",
                "record" => $data->record,
                "type" => "Incident",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "division_id" => $data->division_id,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "initiated_through" => $data->initiated_through,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->created_at,
                "due_date" => $data->due_date,
                "date_close" => $data->updated_at,
                "dashboard_unique_id" => $data->dashboard_unique_id,
            ]);
        }
        foreach ($resampling as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->cc_id ? $data->cc_id : "-",
                "record" => $data->record,
                "type" => "Resampling",
                "due_date" => $data->due_date,
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "division_id" => $data->division_id,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "initiated_through" => $data->initiated_through,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->created_at,
                "date_close" => $data->updated_at,
                "dashboard_unique_id" => $data->dashboard_unique_id,
            ]);
        }
        $table  = collect($table)->sortBy('record')->reverse()->toArray();
        $datag = $this->paginate($table);
        $uniqueProcessNames = QMSProcess::select('process_name')->distinct()->pluck('process_name');
        return view('frontend.rcms.dashboard', compact('datag', 'uniqueProcessNames'));
    }

    public function dashboard_child($id, $process)
    {
        $table = [];
        if ($process == 1) {
            $datas1 = ActionItem::where('cc_id', $id)->orderByDesc('id')->get();
            $datas2 = Extension::where('cc_id', $id)->orderByDesc('id')->get();
            foreach ($datas1 as $data) {
                array_push($table, [
                    "id" => $data->id,
                    "parent" => $data->cc_id ? $data->cc_id : "-",
                    "record" => $data->record,
                    "type" => "Action-Item",
                    "short_description" => $data->short_description ? $data->short_description : "-",
                    "initiator_id" => $data->initiator_id,
                    "intiation_date" => $data->intiation_date,
                    "stage" => $data->status,
                    "date_open" => $data->created_at,
                    "date_close" => $data->updated_at,
                ]);
            }

            foreach ($datas2 as $data) {
                array_push($table, [
                    "id" => $data->id,
                    "parent" => $data->cc_id ? $data->cc_id : "-",
                    "record" => $data->record,
                    "type" => "Extension",
                    "short_description" => $data->short_description ? $data->short_description : "-",
                    "initiator_id" => $data->initiator_id,
                    "intiation_date" => $data->intiation_date,
                    "stage" => $data->status,
                    "date_open" => $data->created_at,
                    "date_close" => $data->updated_at,
                ]);
            }
        } else {
            if ($process == 2) {
                $ab = ActionItem::find($id);
                $data = CC::where('id', $ab->cc_id)->orderByDesc('id')->first();
                $datas1 = ActionItem::where('cc_id', $ab->cc_id)->orderByDesc('id')->get();
                $datas2 = Extension::where('cc_id', $ab->cc_id)->orderByDesc('id')->get();
                foreach ($data as $datas) {
                    array_push($table, [
                        "id" => $data->id,
                        "parent" => $data->cc_id ? $data->cc_id : "-",
                        "record" => $data->record,
                        "type" => "Change-Control",
                        "short_description" => $data->short_description ? $data->short_description : "-",
                        "initiator_id" => $data->initiator_id,
                        "intiation_date" => $data->intiation_date,
                        "stage" => $data->status,
                        "date_open" => $data->created_at,
                        "date_close" => $data->updated_at,
                    ]);
                }

                foreach ($datas1 as $data) {
                    array_push($table, [
                        "id" => $data->id,
                        "parent" => $data->cc_id ? $data->cc_id : "-",
                        "record" => $data->record,
                        "type" => "Action-Item",
                        "short_description" => $data->short_description ? $data->short_description : "-",
                        "initiator_id" => $data->initiator_id,
                        "intiation_date" => $data->intiation_date,
                        "stage" => $data->status,
                        "date_open" => $data->created_at,
                        "date_close" => $data->updated_at,
                    ]);
                }

                foreach ($datas2 as $data) {
                    array_push($table, [
                        "id" => $data->id,
                        "parent" => $data->cc_id ? $data->cc_id : "-",
                        "record" => $data->record,
                        "type" => "Extension",
                        "short_description" => $data->short_description ? $data->short_description : "-",
                        "initiator_id" => $data->initiator_id,
                        "intiation_date" => $data->intiation_date,
                        "stage" => $data->status,
                        "date_open" => $data->created_at,
                        "date_close" => $data->updated_at,
                    ]);
                }
            } elseif ($process == 3) {
                $ab = Extension::find($id);
                $data = CC::where('id', $ab->cc_id)->orderByDesc('id')->first();
                $datas1 = ActionItem::where('cc_id', $ab->cc_id)->orderByDesc('id')->get();
                $datas2 = Extension::where('cc_id', $ab->cc_id)->orderByDesc('id')->get();
                foreach ($data as $datas) {
                    array_push($table, [
                        "id" => $data->id,
                        "parent"            => $data->cc_id ? $data->cc_id : "-",
                        "record"            => $data->record,
                        "type"              => "Change-Control",
                        "short_description" => $data->short_description ? $data->short_description : "-",
                        "initiator_id"      => $data->initiator_id,
                        "intiation_date"    => $data->intiation_date,
                        "stage"             => $data->status,
                        "date_open"         => $data->created_at,
                        "date_close"        => $data->updated_at,
                    ]);
                }

                foreach ($datas1 as $data) {
                    array_push($table, [
                        "id" => $data->id,
                        "parent"            => $data->cc_id ? $data->cc_id : "-",
                        "record"            => $data->record,
                        "type"              => "Action-Item",
                        "short_description" => $data->short_description ? $data->short_description : "-",
                        "initiator_id"      => $data->initiator_id,
                        "intiation_date"    => $data->intiation_date,
                        "stage"             => $data->status,
                        "date_open"         => $data->created_at,
                        "date_close"        => $data->updated_at,
                    ]);
                }

                foreach ($datas2 as $data) {
                    array_push($table, [
                        "id" => $data->id,
                        "parent"            => $data->cc_id ? $data->cc_id : "-",
                        "record"            => $data->record,
                        "type"              => "Extension",
                        "short_description" => $data->short_description ? $data->short_description : "-",
                        "initiator_id"      => $data->initiator_id,
                        "intiation_date"    => $data->intiation_date,
                        "stage"             => $data->status,
                        "date_open"         => $data->created_at,
                        "date_close"        => $data->updated_at,
                    ]);
                }
            }
        }
        $table = collect($table)->sortBy('date_open')->reverse()->toArray();
        $datag = json_encode($table);
        return view('frontend.rcms.dashboard', compact('datag'));
    }
    public function dashboard_child_new($id, $process)
    {
        $table = [];

        if ($process == "extension") {

            $data = Extension::where('id', $id)->orderByDesc('id')->first();

            if ($data->parent_type == "Capa") {
                $data2 = Capa::where('id', $data->parent_id)->first();
                $data2->create = Carbon::parse($data2->created_at)->format('d-M-Y h:i A');
                array_push(
                    $table,
                    [
                        "id" => $data2->id,
                        "parent" => $data2->parent_record ? $data2->parent_record : "-",
                        "record" => $data2->record,
                        "type" => "Capa",
                        "parent_id" => $data2->parent_id,
                        "parent_type" => $data2->parent_type,
                        "division_id" => $data2->division_id,
                        "short_description" => $data2->short_description ? $data2->short_description : "-",
                        "initiator_id" => $data->initiator_id,
                        "intiation_date" => $data2->intiation_date,
                        "stage" => $data2->status,
                        "date_open" => $data2->create,
                        "date_close" => $data2->updated_at,
                    ]
                );
            }
            if ($data->parent_type == "Internal_audit") {
                $data2 = InternalAudit::where('id', $data->parent_id)->first();
                $data2->create = Carbon::parse($data2->created_at)->format('d-M-Y h:i A');
                array_push(
                    $table,
                    [
                        "id" => $data2->id,
                        "parent" => $data2->parent_record ? $data2->parent_record : "-",
                        "record" => $data2->record,
                        "type" => "Internal-Audit",
                        "parent_id" => $data2->parent_id,
                        "parent_type" => $data2->parent_type,
                        "division_id" => $data2->division_id,
                        "short_description" => $data2->short_description ? $data2->short_description : "-",
                        "initiator_id" => $data->initiator_id,
                        "intiation_date" => $data2->intiation_date,
                        "stage" => $data2->status,
                        "date_open" => $data2->create,
                        "date_close" => $data2->updated_at,
                    ]
                );
            }
            if ($data->parent_type == "External_audit") {
                $data2 = Auditee::where('id', $data->parent_id)->first();
                $data2->create = Carbon::parse($data2->created_at)->format('d-M-Y h:i A');
                array_push(
                    $table,
                    [
                        "id" => $data2->id,
                        "parent" => $data2->parent_record ? $data2->parent_record : "-",
                        "record" => $data2->record,
                        "type" => "External-Audit",
                        "parent_id" => $data2->parent_id,
                        "parent_type" => $data2->parent_type,
                        "division_id" => $data2->division_id,
                        "short_description" => $data2->short_description ? $data2->short_description : "-",
                        "initiator_id" => $data->initiator_id,
                        "intiation_date" => $data2->intiation_date,
                        "stage" => $data2->status,
                        "date_open" => $data2->create,
                        "date_close" => $data2->updated_at,
                    ]
                );
            }
            if ($data->parent_type == "Action_item") {
                $data2 = ActionItem::where('id', $data->parent_id)->first();
                $data2->create = Carbon::parse($data2->created_at)->format('d-M-Y h:i A');
                array_push(
                    $table,
                    [
                        "id" => $data2->id,
                        "parent" => $data2->parent_record ? $data2->parent_record : "-",
                        "record" => $data2->record,
                        "type" => "Action-Item",
                        "parent_id" => $data2->parent_id,
                        "parent_type" => $data2->parent_type,
                        "division_id" => $data2->division_id,
                        "short_description" => $data2->short_description ? $data2->short_description : "-",
                        "initiator_id" => $data->initiator_id,
                        "intiation_date" => $data2->intiation_date,
                        "stage" => $data2->status,
                        "date_open" => $data2->create,
                        "date_close" => $data2->updated_at,
                    ]
                );
            }
            if ($data->parent_type == "Audit_program") {
                $data2 = AuditProgram::where('id', $data->parent_id)->first();
                $data2->create = Carbon::parse($data2->created_at)->format('d-M-Y h:i A');
                array_push(
                    $table,
                    [
                        "id" => $data2->id,
                        "parent" => $data2->parent_record ? $data2->parent_record : "-",
                        "record" => $data2->record,
                        "type" => "Audit-Program",
                        "parent_id" => $data2->parent_id,
                        "parent_type" => $data2->parent_type,
                        "division_id" => $data2->division_id,
                        "short_description" => $data2->short_description ? $data2->short_description : "-",
                        "initiator_id" => $data->initiator_id,
                        "intiation_date" => $data2->intiation_date,
                        "stage" => $data2->status,
                        "date_open" => $data2->create,
                        "date_close" => $data2->updated_at,
                    ]
                );
            }
            if ($data->parent_type == "Observation") {
                $data2 = Observation::where('id', $data->parent_id)->first();
                $data2->create = Carbon::parse($data2->created_at)->format('d-M-Y h:i A');
                array_push(
                    $table,
                    [
                        "id" => $data2->id,
                        "parent" => $data2->parent_record ? $data2->parent_record : "-",
                        "record" => $data2->record,
                        "type" => "Observation",
                        "parent_id" => $data2->parent_id,
                        "parent_type" => $data2->parent_type,
                        "division_id" => $data2->division_id,
                        "short_description" => $data2->short_description ? $data2->short_description : "-",
                        "initiator_id" => $data->initiator_id,
                        "intiation_date" => $data2->intiation_date,
                        "stage" => $data2->status,
                        "date_open" => $data2->create,
                        "date_close" => $data2->updated_at,
                    ]
                );
            }
            if ($data->parent_type == "Change_control") {
                $data2 = CC::where('id', $data->parent_id)->first();
                $data2->create = Carbon::parse($data2->created_at)->format('d-M-Y h:i A');
                array_push(
                    $table,
                    [
                        "id" => $data2->id,
                        "parent" => $data2->parent_record ? $data2->parent_record : "-",
                        "record" => $data2->record,
                        "type" => "Change-Control",
                        "parent_id" => $data2->parent_id,
                        "parent_type" => $data2->parent_type,
                        "division_id" => $data2->division_id,
                        "short_description" => $data2->short_description ? $data2->short_description : "-",
                        "initiator_id" => $data->initiator_id,
                        "intiation_date" => $data2->intiation_date,
                        "stage" => $data2->status,
                        "date_open" => $data2->create,
                        "date_close" => $data2->updated_at,
                    ]
                );
            }
            if ($data->parent_type == "ERRATA") {
                $data2 = errata::where('id', $data->parent_id)->first();
                $data2->create = Carbon::parse($data2->created_at)->format('d-M-Y h:i A');
                array_push(
                    $table,
                    [
                        "id" => $data2->id,
                        "parent" => $data2->parent_record ? $data2->parent_record : "-",
                        "record" => $data2->record,
                        "type" => "ERRATA",
                        "parent_id" => $data2->parent_id,
                        "parent_type" => $data2->parent_type,
                        "division_id" => $data2->division_id,
                        "short_description" => $data2->short_description ? $data2->short_description : "-",
                        "initiator_id" => $data->initiator_id,
                        "intiation_date" => $data2->intiation_date,
                        "stage" => $data2->status,
                        "date_open" => $data2->create,
                        "date_close" => $data2->updated_at,
                    ]
                );
            }
        } else {
            return redirect(url('rcms/qms-dashboard'));
        }

        $table  = collect($table)->sortBy('record')->reverse()->toArray();
        $datag = $this->paginate($table);



        // return redirect(url('rcms/qms-dashboard'));
        return view('frontend.rcms.dashboard', compact('datag'));
    }

    public function ccView($id, $type)
    {

        

        $division_name = "NA";

        $summaryResponse = '';

        if ($type == "OOT") {
            $data = Ootc::find($id);
            $single = "ootcSingleReport/" . $data->id;
            $audit = "audit_pdf/".$data->id;
            $division = QMSDivision::find($data->division_id);
            $division_name = $division->name;
        } elseif ($type == "Failure Investigation") {
            $data = FailureInvestigation::find($id);
            $single = "failure-investigation-single-report/" . $data->id;
            $audit = "failure-investigation-audit-pdf/".$data->id;
            $division = QMSDivision::find($data->division_id);
            $division_name = $division->name;
        } elseif ($type == "ERRATA") {
            $data = errata::find($id);
            $single = "errata_single_pdf/" . $data->id;
            $audit = "errata_audit/" . $data->id;
            $division = QMSDivision::find($data->division_id);
            $division_name = $division->name;
        } elseif ($type == "Capa") {
            $data = Capa::find($id);
            $single = "capaSingleReport/" . $data->id;
            $audit = "capaAuditReport/" . $data->id;
            $division = QMSDivision::find($data->division_id);
            $division_name = $division->name;
        } elseif ($type == "Lab-Incident") {
            $data = LabIncident::find($id);
            $single = "LabIncidentSingleReport/" . $data->id;
            $audit = "LabIncidentAuditReport/" . $data->id;
            $division = QMSDivision::find($data->division_id);
            $division_name = $division->name;
        } elseif ($type == "Deviation") {
            $data = Deviation::find($id);
            $single = "deviationSingleReport/" . $data->id;
            $audit = "DeviationAuditTrialPdf/" . $data->id;
            $division = QMSDivision::find($data->division_id);
            $division_name = $division->name;
        } elseif ($type == "Internal-Audit") {
            $data = InternalAudit::find($id);
            $single = "internalSingleReport/" . $data->id;
            $audit = "internalauditReport/" . $data->id;
            $division = QMSDivision::find($data->division_id);
            $division_name = $division->name;
        } elseif ($type == "Risk-Assesment") {
            $data = RiskManagement::find($id);
            $single = "riskSingleReport/" . $data->id;
            $audit = "riskAuditReport/" . $data->id;
            $division = QMSDivision::find($data->division_id);
            $division_name = $division->name;
        } elseif ($type == "Out Of Calibration") {
            $data = OutOfCalibration::find($id);
            $recordno = ((RecordNumber::first()->value('counter')) + 1);
            $single = "OOCSingleReport/" . $data->id;
            $audit = "ooc_Audit_Report/" . $data->id;
            $division = QMSDivision::find($data->division_id);
            $division_name = $division->name;
        }elseif ($type == "Lab-Incident") {
            $data = LabIncident::find($id);
            $single = "LabIncidentSingleReport/" . $data->id;
            $audit = "LabIncidentAuditReport/" . $data->id;
            $division = QMSDivision::find($data->division_id);
            $division_name = $division->name;
        } elseif ($type == "External-Audit") {
            $data = Auditee::find($id);
            $single = "ExternalAuditSingleReport/" . $data->id;
            $audit = "ExternalAuditTrialReport/" . $data->id;
            $summaryResponse = "SummaryResponseReport/" . $data->id;
            $division = QMSDivision::find($data->division_id);
            $division_name = $division->name;
        } elseif ($type == "Audit-Program") {
            $data = AuditProgram::find($id);
            $single = "auditProgramSingleReport/" . $data->id;
            $audit = "auditProgramAuditReport/" . $data->id;
            $division = QMSDivision::find($data->division_id);
            $division_name = $division->name;
        } elseif ($type == "Action-Item") {
            $data = ActionItem::find($id);
            $single = "actionitemSingleReport/"  . $data->id;
            $audit = "actionitemauditTrailPdf/" . $data->id;
            $division = QMSDivision::find($data->division_id);
            $division_name = $division->name;



        }
        elseif ($type == "Extension") {
            $data = extension_new::find($id);
            $data->record = $data->record_number;
            $single = "singleReportNew/" .$data->id;
            $audit = "extensionAuditReport/" .$data->id;
            $division = QMSDivision::find($data->site_location_code);
            $division_name = $division->name;
        }


        elseif ($type == "Observation") {
            $data = Observation::find($id);
            $single = "ObservationSingleReport/" .$data->id;
            $audit = "ObservationAuditTrialShow/" .$data->id;
            $division = QMSDivision::find($data->division_id);
            $division_name = $division ? $division->name : '';
        } elseif ($type == "Effectiveness-Check") {
            $data = EffectivenessCheck::find($id);
            $single = "effectiveSingleReport/" .$data->id;
            $audit = "effectiveAuditReport/" .$data->id;
            $division = QMSDivision::find($data->division_id);
            $division_name = $division->name;
        } elseif ($type == "Management-Review") {
            $data = ManagementReview::find($id);
            $single = "managementReview/" . $data->id;
            $audit = "managementReviewReport/" . $data->id;
            $division = QMSDivision::find($data->division_id);
            $division_name = $division->name;
        }elseif ($type == "OOS_OOT") {
            $data = OOS::find($id);
            $single = "oos/single_report/" . $data->id;
            $audit = "oos/audit_report/" . $data->id;
            $division = QMSDivision::find($data->division_id);
            $division_name = $division->name;
        }elseif ($type == "OOS Microbiology") {
            $data = OOS_micro::find($id);
            $single = "oos_micro/single_report/" . $data->id;
            $audit = "oos_micro/audit_report/" . $data->id;
            $division = QMSDivision::find($data->division_id);
            $division_name = $division->name;
        }
        elseif ($type == "Root-Cause-Analysis") {
            $data = RootCauseAnalysis::find($id);
            $single = "rootSingleReport/" . $data->id;
            $audit = "rootAuditReport/" . $data->id;
            $division = QMSDivision::find($data->division_id);
            $division_name = $division->name;
        }
        elseif ($type == "Market demo") {
            $data = MarketComplaint::find($id);
            $single = "marketComplaintSingleReport/" . $data->id;
            $audit = "MarketComplaintAuditReport/" . $data->id;
            $division = QMSDivision::find($data->division_id);
            $division_name = $division->name;

        }

        elseif ($type == "Market Complaint") {
            $data = MarketComplaint::find($id);
            $audit = "marketcomplaint/marketauditTrailPdf/" . $data->id;
            $single = "pdf-report/" . $data->id;
            $division = QMSDivision::find($data->division_id);
            $division_name = $division->name;

        }

        elseif ($type == "Change-Control") {
            $data = CC::find($id);
            $audit = "audit/" . $data->id;
            $single = "change_control_single_pdf/" . $data->id;
            $division = QMSDivision::find($data->division_id);
            $division_name = $division->name;
        }

        elseif ($type == "Incident") {
            $data = Incident::find($id);
            $single = "incident-single-report/" . $data->id;
            $audit = "incident-audit-pdf/" . $data->id;
            $division = QMSDivision::find($data->division_id);
            $division_name = $division->name;
        }
        elseif ($type == "Non Conformance") {
            $data = NonConformance::find($id);
            $single = "non-conformance-single-report/" . $data->id;
            $audit = "non-conformance-audit-pdf/" . $data->id;
            $division = QMSDivision::find($data->division_id);
            $division_name = $division->name;
        }
        elseif ($type == "Resampling") {
            $data = Resampling::find($id);
            $single = "resamplingSingleReport/" . $data->id;
            $audit = "resamplingAuditReport/" . $data->id;
            $parent = "#";
            $division = QMSDivision::find($data->division_id);
            $division_name = $division->name;
        }


        $type = $type == 'Capa' ? 'CAPA' : $type;

        $html = '';
        $html = '<div class="block">
        <div class="record">
            Record No. ' . str_pad($data->record, 4, '0', STR_PAD_LEFT) .
            '</div>
        <div class="division">
        ' . Helpers::getDivisionName($data->division_id) . '/ ' . $type . '

        </div>
        <div class="status">' .
            $data->status . '
        </div>
            </div>
            <div class="block">
                <div class="block-head">
                    Actions
                </div>
                <div class="block-list">
                    <a href="send-notification" class="list-item">Send Notification</a>
                    <div class="list-drop">
                        <div class="list-item" onclick="showAction()">
                            <div>Run Report</div>
                            <div><i class="fa-solid fa-angle-down"></i></div>
                        </div>
                        <div class="drop-list">
                            <a target="__blank" href="' . $audit . '" class="inner-item">Audit Trail</a>
                            <a target="__blank" href="' . $single . '" class="inner-item">' . $type . ' Single Report</a>
                           
                            ' . ($type == 'External-Audit' ? '<a target="__blank" href="' . $summaryResponse . '" class="inner-item">' . $type . ' Audit Response Report</a>' : '') . '

                        </div>
                    </div>
                </div>
            </div>';
        $response['html'] = $html;

        return response()->json($response);
    }

    //----------PAginator

    public function paginate($items, $perPage = 100000, $page = null, $options = ['path' => 'mytaskdata'])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
