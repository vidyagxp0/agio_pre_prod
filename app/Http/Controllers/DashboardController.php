<?php

namespace App\Http\Controllers;

use App\Models\Deviation;
use App\Models\QMSDivision;
use App\Models\errata;
use App\Models\extension_new;
use App\Models\FailureInvestigation;
use App\Models\Incident;
use App\Models\MarketComplaint;
use App\Models\NonConformance;
use App\Models\OOS;
use App\Models\OOS_micro;
use App\Models\Ootc;
use App\Models\Resampling;
use App\Models\RiskAssessment;
use App\Models\User;
use App\Models\Grouppermission;
use App\Http\Controllers\Controller;
use App\Models\Recipent;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Helpers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use App\Models\CC;
use App\Models\ActionItem;
use App\Models\Extension;
use App\Models\EffectivenessCheck;
use App\Models\InternalAudit;
use App\Models\Capa;
use App\Models\RiskManagement;
use App\Models\ManagementReview;
use App\Models\LabIncident;
use App\Models\Auditee;
use App\Models\AuditProgram;
use App\Models\RootCauseAnalysis;
use App\Models\Observation;
use App\Models\ChangeProposalJust;


class DashboardController extends Controller
{

    function random_color_part()
    {
        return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
    }

    function random_color()
    {
        return $this->random_color_part() . $this->random_color_part() . $this->random_color_part();
    }

    public function index(Request $request)
    {
        $due_dates = [];
        $today = \Carbon\Carbon::today();
        $year = $request->get('year', date('Y'));
        $type = $request->get('type', 'yearly'); 
        $dueDateLimit = min(max((int) $request->get('limit', 500), 50), 2000);

        $excludedStatus = [
            'closed-done',
            'closed done',
            'closed - done',
            'closed-cancel',
            'closed cancel',
            'closed - cancel',
            'closed-reject',
            'closed reject',
            'closed - reject',
        ];

        $processRecords = function ($model, $type, $titleFormat, $urlPath) use (&$due_dates, $today, $excludedStatus, $dueDateLimit) {
            $records = $model::query()
                ->whereNotNull('due_date')
                ->orderByDesc('id')
                ->limit($dueDateLimit)
                ->get(['id', 'record', 'record_number', 'division_id', 'status', 'due_date']);

            foreach ($records as $query) {

                $status = strtolower(trim($query->status ?? ''));
                $status = preg_replace('/\s+/', ' ', $status);

                if (in_array($status, $excludedStatus, true)) {
                    continue;
                }

                if (empty($query->due_date)) {
                    continue;
                }

                $due_date = \Carbon\Carbon::parse($query->due_date);
                $daysLeft = $today->diffInDays($due_date, false);

                // ✅ Color logic
                if ($daysLeft >= 15) {
                    $backgroundColor = 'green';      // 15 days or more remaining
                } elseif ($daysLeft >= 7) {
                    $backgroundColor = 'orange';     // 7 to 14 days remaining
                } else {
                    $backgroundColor = 'red';        // less than 7 days remaining / overdue
                }

                $recordNo = $query->record ?? $query->record_number ?? 0;

                $due_dates[] = [
                    'type' => $type,
                    'title' => Helpers::getDivisionCode($query->division_id)
                        . '/' . $titleFormat . '/' . date('Y') . '/'
                        . str_pad($recordNo, 4, '0', STR_PAD_LEFT),
                    'start' => $due_date->toDateString(),
                    'backgroundColor' => $backgroundColor,
                    'url' => url($urlPath, ['id' => $query->id])
                ];
            }
        };

        // 🔥 All Models Processing
        $processRecords(CC::class, 'CC', 'CC', 'rcms/CC');
        $processRecords(Deviation::class, 'Deviation', 'Deviation', 'rcms/devshow');
        $processRecords(LabIncident::class, 'Lab Incident', 'LI', 'rcms/labIncident-Show');
        $processRecords(OOS::class, 'OOS Chemical', 'OOS Chemical', 'rcms/oos/oos_view');
        $processRecords(OOS_micro::class, 'OOS Microbiology', 'OOS Microbiology', 'rcms/oos_micro/edit');
        $processRecords(Ootc::class, 'OOT', 'OOT', 'rcms/oot_view');
        $processRecords(Capa::class, 'CAPA', 'CAPA', 'capashow');
        $processRecords(ActionItem::class, 'Action Item', 'AI', 'rcms/actionItem');
        $processRecords(AuditProgram::class, 'Audit Program', 'Audit Program', 'rcms/AuditProgramShow');
        $processRecords(extension_new::class, 'Extension', 'Extension', 'extension_newshow');
        $processRecords(Resampling::class, 'Resampling', 'Resampling', 'resampling_view');
        $processRecords(Observation::class, 'Observation', 'Observation', 'rcms/observationshow');
        $processRecords(RootCauseAnalysis::class, 'Root Cause Analysis', 'Root Cause Analysis', 'rootshow');
        $processRecords(RiskManagement::class, 'Risk Assessment', 'Risk Assessment', 'RiskManagement');
        $processRecords(ManagementReview::class, 'Management Review', 'Management Review', 'manageshow');
        $processRecords(Auditee::class, 'External Audit', 'External Audit', 'show');
        $processRecords(InternalAudit::class, 'Internal Audit', 'Internal Audit', 'rcms/internalAuditShow');
        $processRecords(EffectivenessCheck::class, 'Effectiveness Check', 'Effectiveness Check', 'rcms/effectiveness');
        $processRecords(MarketComplaint::class, 'Market Complaint', 'Market Complaint', 'rcms/marketcomplaint/marketcomplaint_view');
        $processRecords(NonConformance::class, 'Non Conformance', 'Non Conformance', 'rcms/non-conformance-show');
        $processRecords(Incident::class, 'Incident', 'Incident', 'rcms/incident-show');
        $processRecords(FailureInvestigation::class, 'Failure Investigation', 'Failure Investigation', 'rcms/failure-investigation-show');
        $processRecords(Errata::class, 'Errata', 'Errata', 'errata/show');
        $processRecords(ChangeProposalJust::class, 'Change Proposal And Justification', 'Change Proposal And Justification', 'cpshow');

         $analytics  = [
            'CC' => CC::whereYear('created_at', $year)->count(),
            'Deviation' => Deviation::whereYear('created_at', $year)->count(),
            'Lab Incident' => LabIncident::whereYear('created_at', $year)->count(),
            'OOS Chemical' => OOS::where('Form_type', 'OOS_Chemical')->whereYear('created_at', $year)->count(),
            'OOT' => OOS::where('Form_type', 'OOT')->whereYear('created_at', $year)->count(),
            'OOS Micro' => OOS::where('Form_type', 'OOS_Micro')->whereYear('created_at', $year)->count(),
            'CAPA' => Capa::whereYear('created_at', $year)->count(),
            'Action Item' => ActionItem::whereYear('created_at', $year)->count(),
            'Audit Program' => AuditProgram::whereYear('created_at', $year)->count(),
            'Extension' => extension_new::whereYear('created_at', $year)->count(),
            'Resampling' => Resampling::whereYear('created_at', $year)->count(),
            'Observation' => Observation::whereYear('created_at', $year)->count(),
            'Risk Assessment' => RiskManagement::whereYear('created_at', $year)->count(),
            'Market Complaint' => MarketComplaint::whereYear('created_at', $year)->count(),
            'Incident' => Incident::whereYear('created_at', $year)->count(),
            'Change Proposal And Justification' => ChangeProposalJust::whereYear('created_at', $year)->count(),
        ];

        // ===============================
        // 📊 STATUS-WISE ANALYTICS
        // ===============================

        $statusAnalytics = [

        'CC' => CC::whereYear('created_at', $year)
            ->selectRaw('LOWER(status) as status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status'),

        'Deviation' => Deviation::whereYear('created_at', $year)
            ->selectRaw('LOWER(status) as status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status'),

        'Lab Incident' => LabIncident::whereYear('created_at', $year)
            ->selectRaw('LOWER(status) as status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status'),

        'OOS Chemical' => OOS::where('Form_type', 'OOS_Chemical')
            ->whereYear('created_at', $year)
            ->selectRaw('LOWER(status) as status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status'),

        'OOT' => OOS::where('Form_type', 'OOT')
            ->whereYear('created_at', $year)
            ->selectRaw('LOWER(status) as status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status'),

        'OOS Micro' => OOS::where('Form_type', 'OOS_Micro')
            ->whereYear('created_at', $year)
            ->selectRaw('LOWER(status) as status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status'),

        'CAPA' => Capa::whereYear('created_at', $year)
            ->selectRaw('LOWER(status) as status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status'),

        'Action Item' => ActionItem::whereYear('created_at', $year)
            ->selectRaw('LOWER(status) as status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status'),

        'Audit Program' => AuditProgram::whereYear('created_at', $year)
            ->selectRaw('LOWER(status) as status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status'),

        'Extension' => Extension::whereYear('created_at', $year)
            ->selectRaw('LOWER(status) as status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status'),

        'Resampling' => Resampling::whereYear('created_at', $year)
            ->selectRaw('LOWER(status) as status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status'),

        'Observation' => Observation::whereYear('created_at', $year)
            ->selectRaw('LOWER(status) as status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status'),

        'Risk Assessment' => RiskManagement::whereYear('created_at', $year)
            ->selectRaw('LOWER(status) as status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status'),

        'Market Complaint' => MarketComplaint::whereYear('created_at', $year)
            ->selectRaw('LOWER(status) as status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status'),

        'Incident' => Incident::whereYear('created_at', $year)
            ->selectRaw('LOWER(status) as status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status'),

        'Change Proposal And Justification' => ChangeProposalJust::whereYear('created_at', $year)
            ->selectRaw('LOWER(status) as status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status'),
        ];

        $divisions = QMSDivision::pluck('name', 'id');
        $allDivisionIds = QMSDivision::pluck('id');

        $divisionNames = [];
        $processData = [];

        // 🔥 DEFINE ALL PROCESSES HERE (ONLY THIS NEEDS UPDATE IN FUTURE)
        $processes = [
            'CC' => fn($divisionId) => CC::where('division_id', $divisionId)->whereYear('created_at', $year)->count(),

            'Deviation' => fn($divisionId) => Deviation::where('division_id', $divisionId)->whereYear('created_at', $year)->count(),

            'Lab Incident' => fn($divisionId) => LabIncident::where('division_id', $divisionId)->whereYear('created_at', $year)->count(),

            'OOS Chemical' => fn($divisionId) => OOS::where('Form_type', 'OOS_Chemical')
                ->where('division_id', $divisionId)->whereYear('created_at', $year)->count(),

            'OOT' => fn($divisionId) => OOS::where('Form_type', 'OOT')
                ->where('division_id', $divisionId)->whereYear('created_at', $year)->count(),

            'OOS Micro' => fn($divisionId) => OOS::where('Form_type', 'OOS_Micro')
                ->where('division_id', $divisionId)->whereYear('created_at', $year)->count(),

            'CAPA' => fn($divisionId) => Capa::where('division_id', $divisionId)->whereYear('created_at', $year)->count(),

            'Action Item' => fn($divisionId) => ActionItem::where('division_id', $divisionId)->whereYear('created_at', $year)->count(),

            'Audit Program' => fn($divisionId) => AuditProgram::where('division_id', $divisionId)->whereYear('created_at', $year)->count(),

            'Extension' => fn($divisionId) => Extension::where('division_id', $divisionId)->whereYear('created_at', $year)->count(),

            'Resampling' => fn($divisionId) => Resampling::where('division_id', $divisionId)->whereYear('created_at', $year)->count(),

            'Observation' => fn($divisionId) => Observation::where('division_code', $divisionId)->whereYear('created_at', $year)->count(),

            'Risk Assessment' => fn($divisionId) => RiskManagement::where('division_id', $divisionId)->whereYear('created_at', $year)->count(),

            'Market Complaint' => fn($divisionId) => MarketComplaint::where('division_id', $divisionId)->whereYear('created_at', $year)->count(),

            'Incident' => fn($divisionId) => Incident::where('division_id', $divisionId)->whereYear('created_at', $year)->count(),

            'Change Proposal And Justification' => fn($divisionId) => ChangeProposalJust::where('division_id', $divisionId)->whereYear('created_at', $year)->count(),
        ];


        // 🔥 LOOP ALL DIVISIONS
        foreach ($allDivisionIds as $divisionId) {

            $divisionName = $divisions[$divisionId] ?? 'Unknown';
            $divisionNames[] = $divisionName;

            foreach ($processes as $processName => $callback) {
                $processData[$processName][] = $callback($divisionId);
            }
        }

        // FINAL DATA
        $finalChartData = [
            'labels' => $divisionNames,
            'datasets' => $processData
        ];

        return view('frontend.dashboard', compact('due_dates','analytics', 'year', 'statusAnalytics', 'finalChartData'));
    }

    public function subscribe(Request $request)
    {
        $data = new Subscribe();
        $data->user_id = Auth::user()->id;
        $data->type = $request->type;
        $data->week = $request->week;
        if ($request->type == "Weekly") {
            $data->day = $request->day;
        }
        if ($request->type == "Monthly") {
            $data->day = $request->days;
        }
        $data->time = $request->time;

        if ($request->status) {
            $data->status = $request->status;
        }

        $data->save();
        $recipent = new Recipent();
        $recipent->subscribe_id = $data->id;
        $recipent->user_id = Auth::user()->id;
        $recipent->save();
        if (!empty($request->recipents)) {
            $imode = implode(',', $request->recipents);
            $datas = explode(',', $imode);
            foreach ($datas as $temp) {
                $recipent = new Recipent();
                $recipent->subscribe_id = $data->id;
                $recipent->user_id = $temp;
                $recipent->save();
            }
        }


        toastr()->success('Subscribed !!');
        return back();
    }
    public function analytics()
    {
        return view('frontend.analytics');
    }
    public function analyticsData(Request $request)
    {
        if ($request->value == "due") {
            $current_date = date('Y-m-d');
            $data = [
                'InternalAudit' => InternalAudit::whereDate('due_date', '<', $current_date)->count(),
                'Extension' => Extension::whereDate('due_date', '<', $current_date)->count(),
                'Capa' => Capa::whereDate('due_date', '<', $current_date)->count(),
                'AuditProgram' => AuditProgram::whereDate('due_date', '<', $current_date)->count(),
                'LabIncident' => LabIncident::whereDate('due_date', '<', $current_date)->count(),
                'RiskManagement' => RiskManagement::whereDate('due_date', '<', $current_date)->count(),
                'RootCauseAnalysis' => RootCauseAnalysis::whereDate('due_date', '<', $current_date)->count(),
                'ManagementReview' => ManagementReview::whereDate('due_date', '<', $current_date)->count(),
                'CC' => CC::whereDate('due_date', '<', $current_date)->count(),
                'ActionItem' => ActionItem::whereDate('due_date', '<', $current_date)->count(),
                'EffectivenessCheck' => EffectivenessCheck::whereDate('due_date', '<', $current_date)->count(),
                'Auditee' => Auditee::whereDate('due_date', '<', $current_date)->count(),
                'Observation' => Observation::whereDate('due_date', '<', $current_date)->count(),
            ];
        } else {
            $data = [
                'InternalAudit' => InternalAudit::count(),
                'Extension' => Extension::count(),
                'Capa' => Capa::count(),
                'AuditProgram' => AuditProgram::count(),
                'LabIncident' => LabIncident::count(),
                'RiskManagement' => RiskManagement::count(),
                'RootCauseAnalysis' => RootCauseAnalysis::count(),
                'ManagementReview' => ManagementReview::count(),
                'CC' => CC::count(),
                'ActionItem' => ActionItem::count(),
                'EffectivenessCheck' => EffectivenessCheck::count(),
                'Auditee' => Auditee::count(),
                'Observation' => Observation::count(),
            ];
        }
        $dataCounts = array_values($data);
        return response()->json(array_values($data));
    }
}
