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
use Illuminate\Support\Facades\Cache;
use App\Models\OOS;
use App\Models\errata;
use App\Models\MarketComplaint;
use App\Models\OOS_micro;
use App\Models\ChangeProposalJust;


class DashboardController extends Controller
{


    public function index(Request $request)
    {
        $uniqueProcessNames = Cache::remember('qms_dashboard_process_names', 3600, function () {
            return QMSProcess::select('process_name')->distinct()->pluck('process_name');
        });

        if ($request->has('ajax_load')) {
            $html = view('frontend.rcms.dashboard', compact('uniqueProcessNames'))->render();
            return response()->json(['html' => $html]);
        }

        return view('frontend.rcms.dashboard', compact('uniqueProcessNames'));

        $table = [];
        $limit = min(max((int) $request->get('limit', 50), 50), 2000);

        $datas = CC::orderByDesc('id')->limit($limit)->get();
        $datas1 = ActionItem::orderByDesc('id')->limit($limit)->get();
        $datas2 = extension_new::orderByDesc('id')->limit($limit)->get();
        $datas3 = EffectivenessCheck::orderByDesc('id')->limit($limit)->get();
        $datas4 = InternalAudit::orderByDesc('id')->limit($limit)->get();
        $datas5 = Capa::orderByDesc('id')->limit($limit)->get();
        $datas6 = RiskManagement::orderByDesc('id')->limit($limit)->get();
        $datas7 = ManagementReview::orderByDesc('id')->limit($limit)->get();
        $datas8 = LabIncident::orderByDesc('id')->limit($limit)->get();
        $datas9 = Auditee::orderByDesc('id')->limit($limit)->get();
        $datas10 = AuditProgram::orderByDesc('id')->limit($limit)->get();
        $datas11 = RootCauseAnalysis::orderByDesc('id')->limit($limit)->get();
        $datas12 = Observation::orderByDesc('id')->limit($limit)->get();
        $datas13 = OOS::orderByDesc('id')->limit($limit)->get();
        $datas14 = MarketComplaint::orderByDesc('id')->limit($limit)->get();

        $deviation = Deviation::orderByDesc('id')->limit($limit)->get();
        $ooc = OutOfCalibration::orderByDesc('id')->limit($limit)->get();
        $failureInvestigation = FailureInvestigation::orderByDesc('id')->limit($limit)->get();
        $datas15 = Ootc::orderByDesc('id')->limit($limit)->get();
        $datas16 = errata::orderByDesc('id')->limit($limit)->get();
        $datas17 = OOS_micro::orderByDesc('id')->limit($limit)->get();

        $datas25 = NonConformance::orderByDesc('id')->limit($limit)->get();
        $incident = Incident::orderByDesc('id')->limit($limit)->get();
        $resampling = Resampling::orderByDesc('id')->limit($limit)->get();
        $changeProposalData = ChangeProposalJust::orderByDesc('id')->limit($limit)->get();
        foreach ($datas as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
            $recordNumber = $data->record ? Helpers::CCRecordNumber($data->id) : '-';
            array_push($table, [
                "id" => $data->id,
                "parent" => $data->cc_id ? $data->cc_id : "-",
                // "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "due_date" => $data->due_date,
                "type" => "Change-Control",
                "record_number" => $recordNumber,
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
            $recordNumber = $data->record ? Helpers::ActionItemRecordNumber($data->id) : '-';

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->cc_id ? $data->cc_id : "-",
                "record" => $data->record,
                "type" => "Action-Item",
                "record_number" => $recordNumber,
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
            $recordNumber = $data->record ? Helpers::ExtensionRecordNumber($data->id) : '-';

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->cc_id ? $data->cc_id : "-",
                "record" => $data->record_number,
                "type" => "Extension",
                "record_number" => $recordNumber,
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
            $recordNumber = $data->record ? Helpers::EffectivenessCheckRecordNumber($data->id) : '-';

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "type" => "Effectiveness-Check",
                "record_number" => $recordNumber,
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
            $recordNumber = $data->record ? Helpers::InternalAuditRecordNumber($data->id) : '-';

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "type" => "Internal-Audit",
                "record_number" => $recordNumber,
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
            $recordNumber = $data->record ? Helpers::CapaRecordNumber($data->id) : '-';

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "type" => "Capa",
                "record_number" => $recordNumber,
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
            $recordNumber = $data->record ? Helpers::RiskAssessmentRecordNumber($data->id) : '-';

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "type" => "risk-assesment",
                "record_number" => $recordNumber,
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
            $recordNumber = $data->record ? Helpers::ManagmentReviewRecordNumber($data->id) : '-';

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "type" => "Management-Review",
                "record_number" => $recordNumber,
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
            $recordNumber = $data->record ? Helpers::LabincidentRecordNumber($data->id) : '-';

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "type" => "Lab-Incident",
                "record_number" => $recordNumber,
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
            $recordNumber = $data->record ? Helpers::ExternalAuditRecordNumber($data->id) : '-';

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "type" => "External-Audit",
                "record_number" => $recordNumber,
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
            $recordNumber = $data->record ? Helpers::AuditproRecordNumber($data->id) : '-';

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "type" => "Audit-Program",
                "record_number" => $recordNumber,
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
            $recordNumber = $data->record ? Helpers::RCARecordNumber($data->id) : '-';

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "due_date" => $data->due_date,
                "division_id" => $data->division_id,
                "type" => "Root-Cause-Analysis",
                "record_number" => $recordNumber,
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
            $recordNumber = $data->record ? Helpers::ObservationRecordNumber($data->id) : '-';

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_code,
                "type" => "Observation",
                "record_number" => $recordNumber,
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
            $recordNumber = $data->record ? Helpers::OOSRecordNumber($data->id) : '-';

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "OOS/OOT",
                "record_number" => $recordNumber,
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
            $recordNumber = $data->record ? Helpers::MarketComplaintRecordNumber($data->id) : '-';

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "due_date" => $data->due_date_gi,
                "division_id" => $data->division_id,
                "type" => "Market Complaint",
                "record_number" => $recordNumber,
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
            $recordNumber = $data->record ? Helpers::OOTRecordNumber($data->id) : '-';

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record_number,
                "division_id" => $data->division_id,
                "type" => "OOT",
                "record_number" => $recordNumber,
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
            $recordNumber = $data->record ? Helpers::ERRATARecordNumber($data->id) : '-';

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "ERRATA",
                "record_number" => $recordNumber,
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
                // "record_number" => $recordNumber,
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
            $recordNumber = $data->record ? Helpers::DeviaitonRecordNumber($data->id) : '-';

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "Deviation",
                "record_number" => $recordNumber,
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
            $recordNumber = $data->record ? Helpers::OOCRecordNumber($data->id) : '-';

            array_push($table, [
                "id" => $data->id,
                "due_date" => $data->due_date,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "type" => "Out Of Calibration",
                "record_number" => $recordNumber,
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
            // $recordNumber = $data->record ? Helpers::DeviaitonRecordNumber($data->id) : '-';

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->cc_id ? $data->cc_id : "-",
                "record" => $data->record,
                "type" => "Failure Investigation",
                // "record_number" => $recordNumber,
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
            // $recordNumber = $data->record ? Helpers::DeviaitonRecordNumber($data->id) : '-';

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->cc_id ? $data->cc_id : "-",
                "record" => $data->record,
                "type" => "Non Conformance",
                // "record_number" => $recordNumber,
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
            $recordNumber = $data->record ? Helpers::IncidentRecordNumber($data->id) : '-';

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->cc_id ? $data->cc_id : "-",
                "record" => $data->record,
                "type" => "Incident",
                "record_number" => $recordNumber,
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
            $recordNumber = $data->record ? Helpers::ResamplingRecordNumber($data->id) : '-';

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->cc_id ? $data->cc_id : "-",
                "record" => $data->record,
                "type" => "Resampling",
                "record_number" => $recordNumber,
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
        foreach ($changeProposalData as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
            $recordNumber = $data->record ? Helpers::getChangeProposalJustificationRecordNumber($data->id) : '-';

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->cc_id ? $data->cc_id : "-",
                "record" => $data->record,
                "type" => "Change Proposal And Justification",
                "record_number" => $recordNumber,
                "due_date" => $data->due_date ? $data->due_date : "-",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "division_id" => $data->division_id,
                "short_description" => $data->cpdescription ? $data->cpdescription : "-",
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
        if ($request->ajax()) {
            return response()->json(['data' => $datag->items()]);
        }
        // dd($datag);
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
                        "dashboard_unique_id" => $data->dashboard_unique_id,
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
                        "type" => "Audit_Program",
                        "parent_id" => $data2->parent_id,
                        "parent_type" => $data2->parent_type,
                        "division_id" => $data2->division_id,
                        "short_description" => $data2->short_description ? $data2->short_description : "-",
                        "initiator_id" => $data->initiator_id,
                        "intiation_date" => $data2->intiation_date,
                        "stage" => $data2->status,
                        "date_open" => $data2->create,
                        "date_close" => $data2->updated_at,
                        "dashboard_unique_id" => $data->dashboard_unique_id,
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
        /**
         * PHASE-1 PERFORMANCE OPTIMIZATION
         * --------------------------------
         * Same route/function/output, but reduced repeated if/elseif + repeated
         * division queries. Modal click now performs one record query + one cached
         * division-name lookup instead of record query + QMSDivision::find() for
         * every branch. No data update/delete is performed here.
         */

        $typeKey = $type == 'OOS_OOT' ? 'OOS_OOT' : $type;

        $config = [
            'OOT' => [
                'model' => Ootc::class,
                'single' => fn ($id) => "ootcSingleReport/{$id}",
                'audit' => fn ($id) => "audit_pdf/{$id}",
                'family' => fn ($id) => '#',
            ],
            'Failure Investigation' => [
                'model' => FailureInvestigation::class,
                'single' => fn ($id) => "failure-investigation-single-report/{$id}",
                'audit' => fn ($id) => "failure-investigation-audit-pdf/{$id}",
                'family' => fn ($id) => '#',
            ],
            'ERRATA' => [
                'model' => errata::class,
                'single' => fn ($id) => "errata_single_pdf/{$id}",
                'audit' => fn ($id) => "errata_audit/{$id}",
                'family' => fn ($id) => '#',
            ],
            'Capa' => [
                'model' => Capa::class,
                'display_type' => 'CAPA',
                'single' => fn ($id) => "capaSingleReport/{$id}",
                'audit' => fn ($id) => "capaAuditReport/{$id}",
                'family' => fn ($id) => "capaFamilyReport/{$id}",
            ],
            'Lab-Incident' => [
                'model' => LabIncident::class,
                'single' => fn ($id) => "LabIncidentSingleReport/{$id}",
                'audit' => fn ($id) => "LabIncidentAuditReport/{$id}",
                'family' => fn ($id) => "labfamilyreport/{$id}",
            ],
            'Deviation' => [
                'model' => Deviation::class,
                'single' => fn ($id) => "deviationSingleReport/{$id}",
                'audit' => fn ($id) => "DeviationAuditTrialPdf/{$id}",
                'family' => fn ($id) => "deviationfamilyReport/{$id}",
                'summary' => fn ($id) => "deviation_summary/{$id}",
            ],
            'Internal-Audit' => [
                'model' => InternalAudit::class,
                'single' => fn ($id) => "internalSingleReport/{$id}",
                'audit' => fn ($id) => "internalauditReport/{$id}",
                'family' => fn ($id) => "internalFamilyReport/{$id}",
            ],
            'risk-assesment' => [
                'model' => RiskManagement::class,
                'single' => fn ($id) => "riskSingleReport/{$id}",
                'audit' => fn ($id) => "riskAuditReport/{$id}",
                'family' => fn ($id) => "riskManagementfamily/{$id}",
            ],
            'Out Of Calibration' => [
                'model' => OutOfCalibration::class,
                'single' => fn ($id) => "OOCSingleReport/{$id}",
                'audit' => fn ($id) => "ooc_Audit_Report/{$id}",
                'family' => fn ($id) => "ooc_family_Report/{$id}",
            ],
            'External-Audit' => [
                'model' => Auditee::class,
                'single' => fn ($id) => "ExternalAuditSingleReport/{$id}",
                'audit' => fn ($id) => "ExternalAuditTrialReport/{$id}",
                'family' => fn ($id) => "external_family_report/{$id}",
                'summary' => fn ($id) => "SummaryResponseReport/{$id}",
            ],
            'Audit-Program' => [
                'model' => AuditProgram::class,
                'single' => fn ($id) => "auditProgramSingleReport/{$id}",
                'audit' => fn ($id) => "auditProgramAuditReport/{$id}",
                'family' => fn ($id) => "auditProgramFamilyReport/{$id}",
            ],
            'Action-Item' => [
                'model' => ActionItem::class,
                'single' => fn ($id) => "actionitemSingleReport/{$id}",
                'audit' => fn ($id) => "actionitemauditTrailPdf/{$id}",
                'family' => fn ($id) => '#',
            ],
            'Extension' => [
                'model' => extension_new::class,
                'division_field' => 'site_location_code',
                'record_field' => 'record_number',
                'single' => fn ($id) => "singleReportNew/{$id}",
                'audit' => fn ($id) => "extensionAuditReport/{$id}",
                'family' => fn ($id) => '#',
            ],
            'Observation' => [
                'model' => Observation::class,
                'single' => fn ($id) => "ObservationSingleReport/{$id}",
                'audit' => fn ($id) => "ObservationAuditTrialShow/{$id}",
                'family' => fn ($id) => "ObservationfamilyReport/{$id}",
            ],
            'Effectiveness-Check' => [
                'model' => EffectivenessCheck::class,
                'single' => fn ($id) => "effectiveSingleReport/{$id}",
                'audit' => fn ($id) => "effectiveAuditReport/{$id}",
                'family' => fn ($id) => "effectiveFamilyReport/{$id}",
            ],
            'Management-Review' => [
                'model' => ManagementReview::class,
                'single' => fn ($id) => "managementReview/{$id}",
                'audit' => fn ($id) => "managementReviewReport/{$id}",
                'family' => fn ($id) => "managementReFamily_report/{$id}",
            ],
            'OOS_OOT' => [
                'model' => OOS::class,
                'display_type' => 'OOS/OOT',
                'single' => fn ($id) => "oos/single_report/{$id}",
                'audit' => fn ($id) => "oos/audit_report/{$id}",
                'family' => fn ($id) => "oos/family_report/{$id}",
            ],
            'OOS Microbiology' => [
                'model' => OOS_micro::class,
                'single' => fn ($id) => "oos_micro/single_report/{$id}",
                'audit' => fn ($id) => "oos_micro/audit_report/{$id}",
                'family' => fn ($id) => '#',
            ],
            'Root-Cause-Analysis' => [
                'model' => RootCauseAnalysis::class,
                'single' => fn ($id) => "rootSingleReport/{$id}",
                'audit' => fn ($id) => "rootAuditReport/{$id}",
                'family' => fn ($id) => "rootFamilyReport/{$id}",
            ],
            'Market demo' => [
                'model' => MarketComplaint::class,
                'single' => fn ($id) => "marketComplaintSingleReport/{$id}",
                'audit' => fn ($id) => "MarketComplaintAuditReport/{$id}",
                'family' => fn ($id) => '#',
            ],
            'Market Complaint' => [
                'model' => MarketComplaint::class,
                'single' => fn ($id) => "pdf-report/{$id}",
                'audit' => fn ($id) => "marketcomplaint/marketauditTrailPdf/{$id}",
                'family' => fn ($id) => "pdf-family-report/{$id}",
            ],
            'Change-Control' => [
                'model' => CC::class,
                'single' => fn ($id) => "change_control_single_pdf/{$id}",
                'audit' => fn ($id) => "audit/{$id}",
                'family' => fn ($id) => "cc_family_report/{$id}",
                'summary' => fn ($id) => "summary/{$id}",
            ],
            'Incident' => [
                'model' => Incident::class,
                'single' => fn ($id) => "incident-single-report/{$id}",
                'audit' => fn ($id) => "incident-audit-pdf/{$id}",
                'family' => fn ($id) => "incident-family-report/{$id}",
                "summary" => fn ($id) => "incident_summary/{$id}"
            ],
            'Non Conformance' => [
                'model' => NonConformance::class,
                'single' => fn ($id) => "non-conformance-single-report/{$id}",
                'audit' => fn ($id) => "non-conformance-audit-pdf/{$id}",
                'family' => fn ($id) => '#',
            ],
            'Resampling' => [
                'model' => Resampling::class,
                'single' => fn ($id) => "resamplingSingleReport/{$id}",
                'audit' => fn ($id) => "resamplingAuditReport/{$id}",
                'family' => fn ($id) => '#',
            ],
            'Change Proposal And Justification' => [
                'model' => ChangeProposalJust::class,
                'single' => fn ($id) => "cpjsingleReport/{$id}",
                'audit' => fn ($id) => "cpjauditReport/{$id}",
                'family' => fn ($id) => '#',
            ],
        ];

        if (!isset($config[$typeKey])) {
            return response()->json(['html' => '<div class="block"><div class="status">Record type not found.</div></div>'], 404);
        }

        $cfg = $config[$typeKey];
        $data = $cfg['model']::find($id);

        if (!$data) {
            return response()->json(['html' => '<div class="block"><div class="status">Record not found.</div></div>'], 404);
        }

        // Preserve old Extension behavior where record_number was assigned to record.
        if (($cfg['record_field'] ?? null) === 'record_number') {
            $data->record = $data->record_number;
        }

        $displayType = $cfg['display_type'] ?? $type;
        $recordValue = $data->record ?? ($data->record_number ?? 0);
        $divisionField = $cfg['division_field'] ?? 'division_id';
        $divisionId = $data->{$divisionField} ?? ($data->division_id ?? null);
        $divisionName = Helpers::getDivisionName($divisionId);

        $single = $cfg['single']($data->id);
        $audit = $cfg['audit']($data->id);
        $family = $cfg['family']($data->id);
        $summaryResponse = isset($cfg['summary']) ? $cfg['summary']($data->id) : '';

        $html = '<div class="block">
        <div class="record">
            Record No. ' . str_pad($recordValue, 4, '0', STR_PAD_LEFT) .
            '</div>
        <div class="division">
        ' . $divisionName . '/ ' . $displayType . '

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
                            <a target="__blank" href="' . $single . '" class="inner-item">' . $displayType . ' Single Report</a>
                            <a target="__blank" href="' . $family . '" class="inner-item">' . $displayType . ' Family Report</a>


                            ' . ($displayType == 'External-Audit' ? '<a target="__blank" href="' . $summaryResponse . '" class="inner-item">' . $displayType . ' Audit Response Report</a>' : '') . '
                            ' . ($displayType == 'Change-Control' ? '<a target="__blank" href="' . $summaryResponse . '" class="inner-item">' . $displayType . ' Summary Report</a>' : '') . '
                            ' . ($displayType == 'Deviation' ? '<a target="__blank" href="' . $summaryResponse . '" class="inner-item">' . $displayType . ' Summary Report</a>' : '') . '
                            ' . ($displayType == 'Incident' ? '<a target="__blank" href="' . $summaryResponse . '" class="inner-item">' . $displayType . ' Summary Report</a>' : '') . '

                        </div>
                    </div>
                </div>
            </div>';

        return response()->json(['html' => $html]);
    }

    //----------PAginator

    public function paginate($items, $perPage = 100000, $page = null, $options = ['path' => 'mytaskdata'])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
