<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use App\Models\ActionItem;
use App\Models\Capa;
use App\Models\CC;
use App\Models\EffectivenessCheck;
use App\Models\Extension;
use App\Models\InternalAudit;
use App\Models\ManagementReview;
use App\Models\RiskManagement;
use App\Models\LabIncident;
use App\Models\Auditee;
use App\Models\AuditProgram;
use App\Models\RootCauseAnalysis;
use App\Models\Observation;
use App\Models\QMSDivision;
use App\Models\User;
use Carbon\Carbon;
use Helpers;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class DesktopController extends Controller
{
    public function rcms_desktop()
    {
        $table = [];
        $change_control = CC::orderByDesc('id')->get();
        $action_item = ActionItem::orderByDesc('id')->get();
        $extention = Extension::orderByDesc('id')->get();
        $effectiveness_check = EffectivenessCheck::orderByDesc('id')->get();
        $internal_audit = InternalAudit::orderByDesc('id')->get();
        $capa = Capa::orderByDesc('id')->get();
        $risk_management = RiskManagement::orderByDesc('id')->get();
        $management_review = ManagementReview::orderByDesc('id')->get();
        $labincident = LabIncident::orderByDesc('id')->get();
        $external_audit = Auditee::orderByDesc('id')->get();
        $audit_pragram = AuditProgram::orderByDesc('id')->get();
        $root_cause_analysis = RootCauseAnalysis::orderByDesc('id')->get();
        $observation = Observation::orderByDesc('id')->get();

        foreach ($change_control as $data) {

            $data->record_number = Helpers::recordFormat($data->record);
            $data->process = "Change-Control";
            $data->assign_to = "Amit guru";
            $data->open_date = Helpers::getdateFormat($data->initiation_date);
            $data->due_date = Helpers::getdateFormat($data->due_date);
            $data->division_name = Helpers::divisionNameForQMS($data->division_id);
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
        }

        foreach ($action_item as $data) {
            $data->record_number = Helpers::recordFormat($data->record);
            $data->process = "Action-item";
            $data->assign_to = "Amit guru";
            $data->open_date = Helpers::getdateFormat($data->initiation_date);
            $data->due_date = Helpers::getdateFormat($data->due_date);
            $data->division_name = Helpers::divisionNameForQMS($data->division_id);
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
        }
        foreach ($extention as $data) {
            $data->record_number = Helpers::recordFormat($data->record);
            $data->process = "Extention";
            $data->assign_to = "Amit guru";
            $data->open_date = Helpers::getdateFormat($data->initiation_date);
            $data->due_date = Helpers::getdateFormat($data->due_date);
            $data->division_name = Helpers::divisionNameForQMS($data->division_id);
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
        }
        foreach ($effectiveness_check as $data) {
            $data->record_number = Helpers::recordFormat($data->record);
            $data->process = "Effectiveness-check";
            $data->assign_to = "Amit guru";
            $data->open_date = Helpers::getdateFormat($data->initiation_date);
            $data->due_date = Helpers::getdateFormat($data->due_date);
            $data->division_name = Helpers::divisionNameForQMS($data->division_id);
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
        }
        foreach ($internal_audit as $data) {
            $data->record_number = Helpers::recordFormat($data->record);
            $data->process = "Internal-Audit";
            $data->assign_to = "Amit guru";
            $data->open_date = Helpers::getdateFormat($data->initiation_date);
            $data->due_date = Helpers::getdateFormat($data->due_date);
            $data->division_name = Helpers::divisionNameForQMS($data->division_id);
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
        }
        foreach ($capa as $data) {
            $data->record_number = Helpers::recordFormat($data->record);
            $data->process = "Capa";
            $data->assign_to = "Amit guru";
            $data->open_date = Helpers::getdateFormat($data->initiation_date);
            $data->due_date = Helpers::getdateFormat($data->due_date);
            $data->division_name = Helpers::divisionNameForQMS($data->division_id);
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
        }
        foreach ($risk_management as $data) {
            $data->record_number = Helpers::recordFormat($data->record);
            $data->process = "Risk-Assesment";
            $data->assign_to = "Amit guru";
            $data->open_date = Helpers::getdateFormat($data->initiation_date);
            $data->due_date = Helpers::getdateFormat($data->due_date);
            $data->division_name = Helpers::divisionNameForQMS($data->division_id);
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
        }
        foreach ($management_review as $data) {
            $data->record_number = Helpers::recordFormat($data->record);
            $data->process = "Management-Review";
            $data->assign_to = "Amit guru";
            $data->open_date = Helpers::getdateFormat($data->initiation_date);
            $data->due_date = Helpers::getdateFormat($data->due_date);
            $data->division_name = Helpers::divisionNameForQMS($data->division_id);
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
        }
        foreach ($labincident as $data) {
            $data->record_number = Helpers::recordFormat($data->record);
            $data->process = "Lab-Incident";
            $data->assign_to = "Amit guru";
            $data->open_date = Helpers::getdateFormat($data->initiation_date);
            $data->due_date = Helpers::getdateFormat($data->due_date);
            $data->division_name = Helpers::divisionNameForQMS($data->division_id);
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
        }
        foreach ($external_audit as $data) {
            $data->record_number = Helpers::recordFormat($data->record);
            $data->process = "External-Audit";
            $data->assign_to = "Amit guru";
            $data->open_date = Helpers::getdateFormat($data->initiation_date);
            $data->due_date = Helpers::getdateFormat($data->due_date);
            $data->division_name = Helpers::divisionNameForQMS($data->division_id);
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
        }
        foreach ($audit_pragram as $data) {
            $data->record_number = Helpers::recordFormat($data->record);
            $data->process = "Audit-Program";
            $data->assign_to = "Amit guru";
            $data->open_date = Helpers::getdateFormat($data->initiation_date);
            $data->due_date = Helpers::getdateFormat($data->due_date);
            $data->division_name = Helpers::divisionNameForQMS($data->division_id);
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
        }
        foreach ($root_cause_analysis as $data) {
            $data->record_number = Helpers::recordFormat($data->record);
            $data->process = "Root-Cause-Analysis";
            $data->assign_to = "Amit guru";
            $data->open_date = Helpers::getdateFormat($data->initiation_date);
            $data->due_date = Helpers::getdateFormat($data->due_date);
            $data->division_name = Helpers::divisionNameForQMS($data->division_id);
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
        }
        foreach ($observation as $data) {
            $data->record_number = Helpers::recordFormat($data->record);
            $data->process = "Observation";
            $data->assign_to = "Amit guru";
            $data->open_date = Helpers::getdateFormat($data->initiation_date);
            $data->due_date = Helpers::getdateFormat($data->due_date);
            $data->division_name = Helpers::divisionNameForQMS($data->division_id);
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
        }

        //   return $table;

        return view('frontend.rcms.desktop', compact(
            'observation',
            'root_cause_analysis',
            'audit_pragram',
            'external_audit',
            'management_review',
            'labincident',
            'risk_management',
            'capa',
            'internal_audit',
            'effectiveness_check',
            'extention',
            'action_item',
            'observation',
            'change_control',
        ));
    }


    public function dashboard_search(Request $request)
    {
        // return $request;

        if ($request->form == "internal_audit") {
            $data = InternalAudit::where('status', $request->stage)->get();
            return $data;
            return view('frontend.rcms.desktop', compact('data'));
        }
    }
    public function fetchChartData(Request $request)
    {
        $allDivisionCodes = QMSDivision::Where('q_m_s_divisions.status',1)
        ->pluck('name')->toArray();
        $internalAuditData = collect();
        if ($request->value == 'Internal-Audit') {
            $internalAuditData = QMSDivision::Join('internal_audits', 'internal_audits.division_id', '=', 'q_m_s_divisions.id')
                ->select('q_m_s_divisions.name as division_code')
                ->get();
        } else if ($request->value == 'External-Audit') {
            $internalAuditData = QMSDivision::Join('auditees', 'auditees.division_id', '=', 'q_m_s_divisions.id')
                ->select('q_m_s_divisions.name as division_code')
                ->get();
        } else if ($request->value == 'Extension') {
            $internalAuditData = QMSDivision::Join('extensions', 'extensions.division_id', '=', 'q_m_s_divisions.id')
                ->select('q_m_s_divisions.name as division_code')
                ->get();
        } else if ($request->value == 'Capa') {
            $internalAuditData = QMSDivision::Join('capas', 'capas.division_id', '=', 'q_m_s_divisions.id')
                ->select('q_m_s_divisions.name as division_code')
                ->get();
        } else if ($request->value == 'Audit-Program') {
            $internalAuditData = QMSDivision::Join('audit_programs', 'audit_programs.division_id', '=', 'q_m_s_divisions.id')
                ->select('q_m_s_divisions.name as division_code')
                ->get();
        } else if ($request->value == 'Lab Incident') {
            $internalAuditData = QMSDivision::Join('lab_incidents', 'lab_incidents.division_id', '=', 'q_m_s_divisions.id')
                ->select('q_m_s_divisions.name as division_code')
                ->get();
        } else if ($request->value == 'Risk Assesment') {
            $internalAuditData = QMSDivision::Join('risk_management', 'risk_management.division_id', '=', 'q_m_s_divisions.id')
                ->select('q_m_s_divisions.name as division_code')
                ->get();
        } else if ($request->value == 'Root-Cause-Analysis') {
            $internalAuditData = QMSDivision::Join('root_cause_analyses', 'root_cause_analyses.division_id', '=', 'q_m_s_divisions.id')
                ->select('q_m_s_divisions.name as division_code')
                ->get();
        } else if ($request->value == 'Management Review') {
            $internalAuditData = QMSDivision::Join('management_reviews', 'management_reviews.division_id', '=', 'q_m_s_divisions.id')
                ->select('q_m_s_divisions.name as division_code')
                ->get();
        } else if ($request->value == 'Change Control') {
            $internalAuditData = QMSDivision::Join('c_c_s', 'c_c_s.division_id', '=', 'q_m_s_divisions.id')
                ->select('q_m_s_divisions.name as division_code')
                ->get();
        } else if ($request->value == 'Action Item') {
            $internalAuditData = QMSDivision::Join('action_items', 'action_items.division_id', '=', 'q_m_s_divisions.id')
                ->select('q_m_s_divisions.name as division_code')
                ->get();
        } else if ($request->value == 'Effectiveness Check') {
            $internalAuditData = QMSDivision::Join('effectiveness_checks', 'effectiveness_checks.division_id', '=', 'q_m_s_divisions.id')
                ->select('q_m_s_divisions.name as division_code')
                ->get();
        } else if ($request->value == 'Document') {
            $internalAuditData = QMSDivision::Join('documents', 'documents.division_id', '=', 'q_m_s_divisions.id')
                ->select('q_m_s_divisions.name as division_code')
                ->get();
        } else if ($request->value == 'Observation') {
            $internalAuditData = QMSDivision::Join('observations', 'observations.division_code', '=', 'q_m_s_divisions.name')
                ->select('q_m_s_divisions.name as division_code')
                ->get();
        } else {
            $internalAuditData = [];
        }
        // $chartData = [];
        $divisionCounts = $internalAuditData->groupBy('division_code')->map->count();

        $chartData = collect($allDivisionCodes)->map(function ($divisionCode) use ($divisionCounts) {
            return [
                'division' => $divisionCode,
                'value' => $divisionCounts->get($divisionCode, 0) // Get count or default to 0 if not present
            ];
        });

        return response()->json($chartData);
    }
}
