<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\DocumentHistory;
use App\Models\Department;
use App\Models\StageManage;
use App\Models\RoleGroup;
use App\Models\QMSProcess;
use App\Models\User;

use App\Models\ActionItem;
use App\Models\AuditProgram;
use App\Models\Auditee;
use App\Models\Capa;
use App\Models\CC;
use App\Models\Deviation;
use App\Models\EffectivenessCheck;
use App\Models\errata;
use App\Models\Extension;
use App\Models\FailureInvestigation;
use App\Models\Incident;
use App\Models\InternalAudit;
use App\Models\LabIncident;
use App\Models\ManagementReview;
use App\Models\MarketComplaint;
use App\Models\NonConformance;
use App\Models\Observation;
use App\Models\OOS;
use App\Models\OutOfCalibration;
use App\Models\Resampling;
use App\Models\RiskManagement;
use App\Models\RootCauseAnalysis;

use App\Models\UserRole;
use App\Models\Grouppermission;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\Paginator as PaginationPaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Helpers;

class MytaskController extends Controller
{
    public function index(Request $request)
    {


            $array1 = [];
            $array2 = [];
            $document = Document::where('stage', '>=', 2)->orWhere('stage','>=','4')->orderByDesc('id')->get();

            foreach ($document as $data) {
                $data->originator_name = User::where('id', $data->originator_id)->value('name');
                if ($data->approver_group) {
                    $datauser = explode(',', $data->approver_group);
                    for ($i = 0; $i < count($datauser); $i++) {
                        $group = Grouppermission::where('id', $datauser[$i])->value('user_ids');
                        $ids = explode(',', $group);
                        for ($j = 0; $j < count($ids); $j++) {
                            if ($ids[$j] == Auth::user()->id) {
                                array_push($array1, $data);
                            }
                        }
                    }
                }
                if ($data->approvers) {
                    $datauser = explode(',', $data->approvers);
                    for ($i = 0; $i < count($datauser); $i++) {
                        if ($datauser[$i] == Auth::user()->id) {
                            array_push($array2, $data);
                        }
                    }
                }
                if ($data->reviewers_group) {
                    $datauser = explode(',', $data->reviewers_group);
                    for ($i = 0; $i < count($datauser); $i++) {
                        $group = Grouppermission::where('id', $datauser[$i])->value('user_ids');
                        $ids = explode(',', $group);
                        for ($j = 0; $j < count($ids); $j++) {
                            if ($ids[$j] == Auth::user()->id) {
                                array_push($array1, $data);
                            }
                        }
                    }
                }
                if ($data->reviewers) {
                    $datauser = explode(',', $data->reviewers);
                    for ($i = 0; $i < count($datauser); $i++) {
                        if ($datauser[$i] == Auth::user()->id) {
                            array_push($array2, $data);
                            // echo "<pre>";
                            // print_r($array2);
                            // die;

                        }
                    }
                }

                if ($data->hods) {
                    $datauser = explode(',', $data->hods);
                    for ($i = 0; $i < count($datauser); $i++) {
                        if ($datauser[$i] == Auth::user()->id) {
                            array_push($array2, $data);
                            // echo "<pre>";
                            // print_r($array2);
                            // die;

                        }
                    }
                }

            }


            $arrayTask = array_unique(array_merge($array1, $array2));
            foreach ($arrayTask as $temp) {
                $temp->document_type_name = DocumentType::where('id', $temp->document_type_id)
                ->value('name');
            }
            $task = $this->paginate($arrayTask);


            /******* My Task For ALL Process ******/
            $selectedProcess = $request->input('process');
            $selectedStatus = $request->input('status');
            $loggedInUserId = Auth::id();
            $taskCounts = [];
            $records = [];

            // Define process models and their respective stages
            $processes = [
                'ActionItem' => ['model' => ActionItem::class, 'name' => 'Action Item'],
                'AuditProgram' => ['model' => AuditProgram::class, 'name' => 'Audit Program'],
                'Capa' => ['model' => Capa::class, 'name' => 'CAPA'],
                'CC' => ['model' => CC::class, 'name' => 'Change Control'],
                'Deviation' => ['model' => Deviation::class, 'name' => 'Deviation'],
                'EffectivenessCheck' => ['model' => EffectivenessCheck::class, 'name' => 'Effectiveness Check'],
                'Errata' => ['model' => errata::class, 'name' => 'Errata'],
                'Extension' => ['model' => Extension::class, 'name' => 'Extension'],
                'ExternalAudit' => ['model' => Auditee::class, 'name' => 'External Audit'],
                'FailureInvestigation' => ['model' => FailureInvestigation::class, 'name' => 'Failure Investigation'],
                'Incident' => ['model' => Incident::class, 'name' => 'Incident'],
                'InternalAudit' => ['model' => InternalAudit::class, 'name' => 'Internal Audit'],
                'LabIncident' => ['model' => LabIncident::class, 'name' => 'Lab Incident'],
                'ManagementReview' => ['model' => ManagementReview::class, 'name' => 'Management Review'],
                'MarketComplaint' => ['model' => MarketComplaint::class, 'name' => 'Market Complaint'],
                'NonConformance' => ['model' => NonConformance::class, 'name' => 'Non-Conformance'],
                'Observation' => ['model' => Observation::class, 'name' => 'Observation'],
                'OOC' => ['model' => OutOfCalibration::class, 'name' => 'OOC'],
                'OOSOOT' => ['model' => OOS::class, 'name' => 'OOS/OOT'],
                'Resampling' => ['model' => Resampling::class, 'name' => 'Resampling'],
                'RiskAssessment' => ['model' => RiskManagement::class, 'name' => 'Risk Assessment'],
                'RootCauseAnalysis' => ['model' => RootCauseAnalysis::class, 'name' => 'Root Cause Analysis'],
            ];

            if ($selectedProcess && isset($processes[$selectedProcess])) {
                // Get the process model
                $processModel = $processes[$selectedProcess]['model'];
                $processName = $processes[$selectedProcess]['name'];

                // Find related processes and user roles
                $findProcess = QMSProcess::where('process_name', $processName)->pluck('id');
                $userRoles = UserRole::whereIn('q_m_s_processes_id', $findProcess)
                    ->where('user_id', $loggedInUserId)
                    ->pluck('q_m_s_roles_id')
                    ->unique();

                // Fetch all records for the process
                $processAllRecords = $processModel::pluck('stage');

                // Define stages for each process
                $stages = [
                    'ActionItem' => [
                        ['id' => 1, 'status' => 'Opened', 'role' => 3],
                        ['id' => 2, 'status' => 'Acknowledge', 'role' => 18],
                        ['id' => 3, 'status' => 'Work Completion', 'role' => 18],
                        ['id' => 4, 'status' => 'QA/CQA Verification', 'role' => [7,66]],
                    ],
                    'AuditProgram' => [
                        ['id' => 1, 'status' => 'Opened', 'role' => [7,66]],
                        ['id' => 2, 'status' => 'Pending Approval', 'role' => 4],
                        ['id' => 3, 'status' => 'Pending Audit', 'role' => [9, 65]],
                    ],
                    'Capa' => [
                        ['id' => 1, 'status' => 'Opened', 'role' => 3],
                        ['id' => 2, 'status' => 'HOD Review', 'role' => 4],
                        ['id' => 3, 'status' => 'QA/CQA Review', 'role' => [7, 63]],
                        ['id' => 4, 'status' => 'QA/CQA Approval', 'role' => [7]],
                        ['id' => 5, 'status' => 'CAPA In progress', 'role' => 3],
                        ['id' => 6, 'status' => 'HOD Final Review', 'role' => 4],
                        ['id' => 7, 'status' => 'QA/CQA Closure Review', 'role' => [7, 66]],
                        ['id' => 8, 'status' => 'QAH/CQA Head Approval', 'role' => [7, 65]],
                    ],
                    'CC' => [
                        ['id' => 1, 'status' => 'Opened', 'role' => 3],
                        ['id' => 2, 'status' => 'HOD Assessment', 'role' => 4],
                        ['id' => 3, 'status' => 'QA/CQA Initial Assessment', 'role' => [7, 66]],
                        ['id' => 4, 'status' => 'CFT Assessment', 'role' => 5],
                        ['id' => 5, 'status' => 'QA/CQA Final Review', 'role' => [7, 66]],
                        ['id' => 6, 'status' => 'Pending RA Approval', 'role' => 50],
                        ['id' => 7, 'status' => 'QA/CQA Head/Manager Designee Approval', 'role' => [39, 66]],
                        ['id' => 8, 'status' => 'Pending Initiator Update', 'role' => 3],
                        ['id' => 9, 'status' => 'HOD Final Review', 'role' => 4],
                        ['id' => 10, 'status' => 'Implementation verification by QA/CQA', 'role' => [7, 66]],
                        ['id' => 11, 'status' => 'QA/CQA Closure Approval', 'role' => [39, 66]],
                    ],
                    'Deviation' => [
                        ['id' => 1, 'status' => 'Opened', 'role' => 3],
                        ['id' => 2, 'status' => 'HOD Review', 'role' => 4],
                        ['id' => 3, 'status' => 'QA/CQA Initial Assessment', 'role' => 7],
                        ['id' => 4, 'status' => 'CFT Review', 'role' => 5],
                        ['id' => 5, 'status' => 'QA/CQA Final Assessment', 'role' => [7, 66]],
                        ['id' => 6, 'status' => 'QA/CQA Head/Manager Designee Approval', 'role' => [43, 65]],
                        ['id' => 7, 'status' => 'Pending Initiator Update', 'role' => 3],
                        ['id' => 8, 'status' => 'HOD Final Review', 'role' => 4],
                        ['id' => 9, 'status' => 'Implementation verification by QA/CQA', 'role' => [7, 66]],
                        ['id' => 10, 'status' => 'Head QA/CQA Designee Closure Approval', 'role' => [43, 65]],
                        ['id' => 11, 'status' => 'Pending Cancellation', 'role' => 7],
                    ],
                    'EffectivenessCheck' => [
                        ['id' => 1, 'status' => 'Opened', 'role' => 3],
                        ['id' => 2, 'status' => 'Acknowledge', 'role' => 18],
                        ['id' => 3, 'status' => 'Work Completion', 'role' => 18],
                        ['id' => 4, 'status' => 'HOD Review', 'role' => 4],
                        ['id' => 5, 'status' => 'QA/CQA Review', 'role' => [7, 66]],
                        ['id' => 6, 'status' => 'QA/CQA Approval-Effective', 'role' => [43, 65]],
                        ['id' => 7, 'status' => 'QA/CQA Approval-Not Effective', 'role' => [43, 65]],
                    ],
                    'Errata' => [
                        ['id' => 1, 'status' => 'Opened', 'role' => 3],
                        ['id' => 2, 'status' => 'HOD Review', 'role' => 4],
                        ['id' => 3, 'status' => 'QA/CQA Initial Review', 'role' => [7, 66]],
                        ['id' => 4, 'status' => 'QA/CQA Approval', 'role' => [7, 43, 65]],
                        ['id' => 5, 'status' => 'Pending Correction', 'role' => 3],
                        ['id' => 6, 'status' => 'Pending HOD Review', 'role' => 4],
                        ['id' => 7, 'status' => 'Pending QA/CQA Head Approval', 'role' => [7, 43, 66]],
                    ],

                ];

                // Loop through the stages and count tasks
                foreach ($stages[$selectedProcess] as $stage) {
                    if (is_array($stage['role'])) {
                        $roleMatch = $userRoles->intersect($stage['role'])->isNotEmpty();
                    } else {
                        $roleMatch = $userRoles->contains($stage['role']);
                    }

                    if ($roleMatch) {
                        $taskCounts[$stage['status']] = $processAllRecords->filter(function ($taskStage) use ($stage) {
                            return $taskStage == $stage['id'];
                        })->count();
                    }
                }

                // Fetch records if status is selected
                if ($selectedStatus) {
                    $records = $processModel::where('stage', array_search($selectedStatus, array_column($stages[$selectedProcess], 'status')))->get();
                }
            }

            return view('frontend.tasks', compact('task','taskCounts', 'records', 'selectedProcess', 'selectedStatus', 'processes'));


            /******* My Task For ALL Process Ends ******/


            if (Helpers::checkRoles(4)) {
                $array1 = [];
                $array2 = [];
                $document = Document::where('stage', '>=', 2)->orderByDesc('id')->get();

                foreach ($document as $data) {
                    $data->originator_name = User::where('id', $data->originator_id)->value('name');

                    if ($data->hods) {
                        $datauser = explode(',', $data->hods);
                        for ($i = 0; $i < count($datauser); $i++) {
                            if ($datauser[$i] == Auth::user()->id) {
                                array_push($array2, $data);
                            }
                        }
                    }

                }
                $arrayTask = array_unique(array_merge($array1, $array2));
                foreach ($arrayTask as $temp) {
                    $temp->document_type_name = DocumentType::where('id', $temp->document_type_id)
                    ->value('name');
                }
                $task = $this->paginate($arrayTask);

                return view('frontend.tasks', ['task' => $task]);
            }

        if (Helpers::checkRoles(2)) {
            $array1 = [];
            $array2 = [];
            $document = Document::where('stage', '>=', 2)->orderByDesc('id')->get();

            foreach ($document as $data) {
                $data->originator_name = User::where('id', $data->originator_id)->value('name');

                if ($data->reviewers_group) {
                    $datauser = explode(',', $data->reviewers_group);
                    for ($i = 0; $i < count($datauser); $i++) {
                        $group = Grouppermission::where('id', $datauser[$i])->value('user_ids');
                        $ids = explode(',', $group);
                        for ($j = 0; $j < count($ids); $j++) {
                            if ($ids[$j] == Auth::user()->id) {
                                array_push($array1, $data);
                            }
                        }
                    }
                }
                if ($data->reviewers) {
                    $datauser = explode(',', $data->reviewers);
                    for ($i = 0; $i < count($datauser); $i++) {
                        if ($datauser[$i] == Auth::user()->id) {
                            array_push($array2, $data);
                            // echo "<pre>";
                            // print_r($array2);
                            // die;

                        }
                    }
                }

            }
            $arrayTask = array_unique(array_merge($array1, $array2));
            foreach ($arrayTask as $temp) {
                $temp->document_type_name = DocumentType::where('id', $temp->document_type_id)
                ->value('name');
            }
            $task = $this->paginate($arrayTask);

            return view('frontend.tasks', ['task' => $task]);
        }

        if (Helpers::checkRoles(1)) {
            $array1 = [];
            $array2 = [];
            $document = Document::where('stage', '>=', 4)->orderByDesc('id')->get();
            foreach ($document as $data) {
                $data->originator_name = User::where('id', $data->originator_id)
                ->value('name');
                if ($data->approver_group) {
                    $datauser = explode(',', $data->approver_group);
                    for ($i = 0; $i < count($datauser); $i++) {
                        $group = Grouppermission::where('id', $datauser[$i])->value('user_ids');
                        $ids = explode(',', $group);
                        for ($j = 0; $j < count($ids); $j++) {
                            if ($ids[$j] == Auth::user()->id) {
                                array_push($array1, $data);
                            }
                        }
                    }
                }
                if ($data->approvers) {
                    $datauser = explode(',', $data->approvers);
                    for ($i = 0; $i < count($datauser); $i++) {
                        if ($datauser[$i] == Auth::user()->id) {
                            array_push($array2, $data);
                        }
                    }
                }

            }
            $arrayTask = array_unique(array_merge($array1, $array2));
            foreach ($arrayTask as $temp) {
                $temp->document_type_name = DocumentType::where('id', $temp->document_type_id)->value('name');
            }
            $task = $this->paginate($arrayTask);
            return view('frontend.tasks', ['task' => $task]);
        }
    }
    public function reviewdetails($id)
    {

        $document = Document::find($id);
        $document->last_modify = DocumentHistory::where('document_id', $document->id)->latest()->first();
        $stagereview = StageManage::withoutTrashed()->where('user_id', Auth::user()->id)->where('document_id', $id)->where('stage', "Reviewed")->latest()->first();
        $stagereview_submit = StageManage::withoutTrashed()->where('user_id', Auth::user()->id)->where('document_id', $id)->where('stage', "Review-Submit")->latest()->first();

        $stagehod_submit = StageManage::withoutTrashed()->where('user_id',Auth::user()->id)->where('document_id',$id)->where('stage',"HOD Review-Submit")->latest()->first();
        $stagehod = StageManage::withoutTrashed()->where('user_id',Auth::user()->id)->where('document_id',$id)->where('stage',"HOD Review Complete")->latest()->first();

        $stageapprove = StageManage::withoutTrashed()->where('user_id',Auth::user()->id)->where('document_id',$id)->where('stage',"Approved")->latest()->first();
        $stageapprove_submit = StageManage::withoutTrashed()->where('user_id',Auth::user()->id)->where('document_id',$id)->where('stage',"Approval-Submit")->latest()->first();
       // $stageapprove = '';
        //$stageapprove_submit = '';
        $hod_reject = StageManage::withoutTrashed()->where('user_id', Auth::user()->id)->where('document_id', $id)->where('stage', "Cancel-by-HOD")->latest()->first();
        $review_reject = StageManage::withoutTrashed()->where('user_id', Auth::user()->id)->where('document_id', $id)->where('stage', "Cancel-by-Reviewer")->latest()->first();
        $approval_reject = StageManage::withoutTrashed()->where('user_id', Auth::user()->id)->where('document_id', $id)->where('stage', "Cancel-by-Approver")->latest()->first();
        $document->department_name = Department::find($document->department_id);
        $document->doc_type = DocumentType::find($document->document_type_id);
        $document->oreginator = User::find($document->originator_id);
        $reviewer = User::where('role', 2)->get();
        $approvers = User::where('role', 1)->get();
        $reviewergroup = Grouppermission::where('role_id', 2)->get();
        $approversgroup = Grouppermission::where('role_id', 1)->get();
        return view('frontend.documents.review-details', compact('document', 'reviewer', 'approvers', 'reviewergroup', 'approversgroup', 'stagereview', 'stagereview_submit', 'stageapprove', 'stageapprove_submit', 'review_reject', 'approval_reject', 'stagehod_submit', 'stagehod', 'hod_reject'));

    }

    public function paginate($items, $perPage = 10, $page = null, $options = ['path' => 'mytaskdata'])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    /**
 * Fetch task counts based on selected process and its specific stages.
 */

}
