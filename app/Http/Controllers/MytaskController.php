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
use App\Models\User;
use App\Models\Grouppermission;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\Paginator as PaginationPaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Helpers;

class MytaskController extends Controller
{
    public function index()
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

            }
            $arrayTask = array_unique(array_merge($array1, $array2));
            foreach ($arrayTask as $temp) {
                $temp->document_type_name = DocumentType::where('id', $temp->document_type_id)
                ->value('name');
            }
            $task = $this->paginate($arrayTask);
            return view('frontend.tasks', ['task' => $task]);
        

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
         $stageapprove = StageManage::withoutTrashed()->where('user_id',Auth::user()->id)->where('document_id',$id)->where('stage',"Approved")->latest()->first();
        $stageapprove_submit = StageManage::withoutTrashed()->where('user_id',Auth::user()->id)->where('document_id',$id)->where('stage',"Approval-Submit")->latest()->first();
       // $stageapprove = '';
        //$stageapprove_submit = '';
        $review_reject = StageManage::withoutTrashed()->where('user_id', Auth::user()->id)->where('document_id', $id)->where('stage', "Cancel-by-Reviewer")->latest()->first();
        $approval_reject = StageManage::withoutTrashed()->where('user_id', Auth::user()->id)->where('document_id', $id)->where('stage', "Cancel-by-Approver")->latest()->first();
        $document->department_name = Department::find($document->department_id);
        $document->doc_type = DocumentType::find($document->document_type_id);
        $document->oreginator = User::find($document->originator_id);
        $reviewer = User::where('role', 2)->get();
        $approvers = User::where('role', 1)->get();
        $reviewergroup = Grouppermission::where('role_id', 2)->get();
        $approversgroup = Grouppermission::where('role_id', 1)->get();
        return view('frontend.documents.review-details', compact('document', 'reviewer', 'approvers', 'reviewergroup', 'approversgroup', 'stagereview', 'stagereview_submit', 'stageapprove', 'stageapprove_submit', 'review_reject', 'approval_reject'));

    }

    public function paginate($items, $perPage = 10, $page = null, $options = ['path' => 'mytaskdata'])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
