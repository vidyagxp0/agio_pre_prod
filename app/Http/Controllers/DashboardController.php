<?php

namespace App\Http\Controllers;

use App\Models\Deviation;
use App\Models\Document;
use App\Models\Errata;
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

    public function index()
    {
        $due_dates = [];
        $today = \Carbon\Carbon::today();

        // 🔥 Common function for all modules
        $processRecords = function ($records, $type, $titleFormat, $urlPath) use (&$due_dates, $today) {

            foreach ($records as $query) {

                // ❌ Skip if due_date is empty
                if (empty($query->due_date)) {
                    continue;
                }

                $due_date = \Carbon\Carbon::parse($query->due_date);
                $daysLeft = $today->diffInDays($due_date, false);

                // 🎨 Color logic
                if ($daysLeft > 7) {
                    $backgroundColor = 'green';
                } elseif ($daysLeft > 1) {
                    $backgroundColor = 'orange';
                } else {
                    $backgroundColor = 'red';
                }

                // 📌 Title dynamic handling (record / record_number)
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
        $processRecords(CC::all(), 'CC', 'CC', 'rcms/CC');
        $processRecords(Deviation::all(), 'Deviation', 'Deviation', 'rcms/devshow');
        $processRecords(LabIncident::all(), 'Lab Incident', 'LI', 'rcms/labIncident-Show');
        $processRecords(OOS::all(), 'OOS Chemical', 'OOS Chemical', 'rcms/oos/oos_view');
        $processRecords(OOS_micro::all(), 'OOS Microbiology', 'OOS Microbiology', 'rcms/oos_micro/edit');
        $processRecords(Ootc::all(), 'OOT', 'OOT', 'rcms/oot_view');
        $processRecords(Capa::all(), 'CAPA', 'CAPA', 'capashow');
        $processRecords(ActionItem::all(), 'Action Item', 'AI', 'rcms/actionItem');
        $processRecords(AuditProgram::all(), 'Audit Program', 'Audit Program', 'rcms/AuditProgramShow');
        $processRecords(Extension::all(), 'Extension', 'Extension', 'extension_newshow');
        $processRecords(Resampling::all(), 'Resampling', 'Resampling', 'resampling_view');
        $processRecords(Observation::all(), 'Observation', 'Observation', 'rcms/observationshow');
        $processRecords(RootCauseAnalysis::all(), 'Root Cause Analysis', 'Root Cause Analysis', 'rootshow');
        $processRecords(RiskAssessment::all(), 'Risk Assessment', 'Risk Assessment', 'RiskManagement');
        $processRecords(ManagementReview::all(), 'Management Review', 'Management Review', 'manageshow');
        $processRecords(Auditee::all(), 'External Audit', 'External Audit', 'show');
        $processRecords(InternalAudit::all(), 'Internal Audit', 'Internal Audit', 'rcms/internalAuditShow');
        $processRecords(EffectivenessCheck::all(), 'Effectiveness Check', 'Effectiveness Check', 'rcms/effectiveness');
        $processRecords(MarketComplaint::all(), 'Market Complaint', 'Market Complaint', 'rcms/marketcomplaint/marketcomplaint_view');
        $processRecords(NonConformance::all(), 'Non Conformance', 'Non Conformance', 'rcms/non-conformance-show');
        $processRecords(Incident::all(), 'Incident', 'Incident', 'rcms/incident-show');
        $processRecords(FailureInvestigation::all(), 'Failure Investigation', 'Failure Investigation', 'rcms/failure-investigation-show');
        $processRecords(Errata::all(), 'Errata', 'Errata', 'errata/show');

        // ================= ROLE BASED =================

        if (Helpers::checkRoles(3)) {

            $count = [];
            $userId = Auth::user()->id;

            $draft = Document::where('originator_id', $userId)->where('stage', 1)->count();
            $in_review = Document::where('originator_id', $userId)->where('stage', 2)->count();
            $reviewed = Document::where('originator_id', $userId)->where('stage', 3)->count();
            $for_approve = Document::where('originator_id', $userId)->where('stage', 4)->count();
            $approved = Document::where('originator_id', $userId)->where('stage', 5)->count();
            $training = Document::where('originator_id', $userId)->where('stage', 6)->count();
            $effective = Document::where('originator_id', $userId)->where('stage', 8)->count();

            $count = implode(',', [$draft, $in_review, $reviewed, $for_approve, $approved, $training, $effective]);

            $data = Document::where('originator_id', $userId)->get();

            foreach ($data as $temp) {
                $temp->created_at = \Carbon\Carbon::parse($temp->created_at)->format('Y-m-d');
            }

            return view('frontend.dashboard', compact('data', 'count', 'due_dates'));
        }

        if (Helpers::checkRoles(2)) {

            $array1 = [];
            $array2 = [];
            $document = Document::where('stage', '>=', 2)->get();

            foreach ($document as $data) {

                $data->originator_name = User::where('id', $data->originator_id)->value('name');

                if ($data->reviewers_group) {
                    foreach (explode(',', $data->reviewers_group) as $groupId) {
                        $groupUsers = Grouppermission::where('id', $groupId)->value('user_ids');
                        foreach (explode(',', $groupUsers) as $userId) {
                            if ($userId == Auth::id()) {
                                $array1[] = $data;
                            }
                        }
                    }
                }

                if ($data->reviewers) {
                    foreach (explode(',', $data->reviewers) as $userId) {
                        if ($userId == Auth::id()) {
                            $array2[] = $data;
                        }
                    }
                }
            }

            $arrayTask = array_unique(array_merge($array1, $array2), SORT_REGULAR);

            foreach ($arrayTask as $temp) {
                $temp->created_at = \Carbon\Carbon::parse($temp->created_at)->format('Y-m-d');
            }

            return view('frontend.dashboard', [
                'data' => $arrayTask,
                'due_dates' => $due_dates
            ]);
        }

        if (Helpers::checkRoles(1)) {

            $array1 = [];
            $array2 = [];
            $document = Document::where('stage', '>=', 4)->get();

            foreach ($document as $data) {

                $data->originator_name = User::where('id', $data->originator_id)->value('name');

                if ($data->approver_group) {
                    foreach (explode(',', $data->approver_group) as $groupId) {
                        $groupUsers = Grouppermission::where('id', $groupId)->value('user_ids');
                        foreach (explode(',', $groupUsers) as $userId) {
                            if ($userId == Auth::id()) {
                                $array1[] = $data;
                            }
                        }
                    }
                }

                if ($data->approvers) {
                    foreach (explode(',', $data->approvers) as $userId) {
                        if ($userId == Auth::id()) {
                            $array2[] = $data;
                        }
                    }
                }
            }

            $arrayTask = array_unique(array_merge($array1, $array2), SORT_REGULAR);

            foreach ($arrayTask as $temp) {
                $temp->created_at = \Carbon\Carbon::parse($temp->created_at)->format('Y-m-d');
            }

            return view('frontend.dashboard', ['data' => $arrayTask]);
        }

        return view('frontend.dashboard', compact('due_dates'));
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
