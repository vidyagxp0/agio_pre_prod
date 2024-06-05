<?php

namespace App\Http\Controllers;

use App\Models\DownloadHistory;
use App\Models\PrintHistory;
use App\Models\Department;
use App\Models\QMSDivision;
use App\Models\DocumentTraining;
use App\Models\Document;
use App\Models\Division;
use App\Models\Process;
use App\Models\UserRole;
use App\Models\DocumentContent;
use App\Models\StageManage;
use App\Models\RoleGroup;
use App\Models\User;
use App\Models\Stage;
use App\Models\DocumentHistory;
use App\Models\Grouppermission;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Helpers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentDetailsController extends Controller
{

  function viewdetails($id)
  {
    try {
      $document = Document::findOrFail($id);
      $document->department_name = Department::find($document->department_id);
      $document->doc_type = DocumentType::find($document->document_type_id);
      $document->oreginator = User::find($document->originator_id);
      $document->last_modify_date = DocumentHistory::where('document_id', $document->id)->latest()->first();
      $document->last_modify = DocumentHistory::where('document_id', $document->id)->latest()->first();
      $reviewer = User::where('role', 2)->get();
      $approvers = User::where('role', 1)->get();
      $reviewergroup = Grouppermission::where('role_id', 2)->get();
      $approversgroup = Grouppermission::where('role_id', 1)->get();
      return view('frontend.documents.document-details', compact('document', 'reviewer', 'approvers', 'reviewergroup', 'approversgroup'));
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
      return "Document Not Found";
    }
  }

  function sendforstagechanage(Request $request)
  {
    // return $request;
    if ($request->username == Auth::user()->email) {
      if (Hash::check($request->password, Auth::user()->password)) {
        $document = Document::withTrashed()->find($request->document_id);
        $originator = User::find($document->originator_id);
        $reviewer = User::find($document->reviewers);
        $approvers = User::find($document->approvers);
        $lastDocument = Document::withTrashed()->find($request->document_id);
        // $fullPermission = UserRole::where(['user_id' => Auth::user()->id, 'q_m_s_divisions_id' => $document->division_id])->get();
        // $fullPermissionIds = $fullPermission->pluck('q_m_s_roles_id')->toArray();
        
        if (Helpers::checkRoles(3) && $document->originator_id == Auth::user()->id && $request->stage_id == 2 || $request->stage_id == 6 || $request->stage_id == 8 || $request->stage_id == 11) {
          
          $stage = new StageManage;
          $stage->document_id = $request->document_id;
          $stage->user_id = Auth::user()->id;
          $stage->role = RoleGroup::where('id', Auth::user()->role)->value('name');
          $stage->stage = Stage::where('id', $request->stage_id)->value('name');
          $stage->comment = $request->comment;

          
        if ($stage->stage == "In-Review") {
            $deletePreviousApproval = StageManage::where('document_id', $request->document_id)->get();
            if ($deletePreviousApproval) {
              foreach ($deletePreviousApproval as $updateRecords) {
                $updateRecords->delete();
              }
            }
            $history = new DocumentHistory();
            $history->document_id = $request->document_id;
            $history->activity_type = 'Send for Reviewer';
            $history->previous = '';
            $history->current = '';
            $history->comment = $request->comment;
            $history->action_name = 'Submit';
            $history->change_from = 'Draft';
            $history->change_to = 'In-Review';
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = 'Draft';
            $history->save();
          }
          $stage->save();
        } else {
          $stage = new StageManage;
          $stage->document_id = $request->document_id;
          $stage->user_id = Auth::user()->id;
          $stage->role = RoleGroup::where('id', Auth::user()->role)->value('name');
          $stage->stage = $request->stage_id;
          $stage->comment = $request->comment;
          $stage->save();

          if ($request->stage_id == 'HOD Review Complete') {
            $stage = new StageManage;
            $stage->document_id = $request->document_id;
            $stage->user_id = Auth::user()->id;
            $stage->role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $stage->stage = 'HOD Review-Submit';
            $stage->comment = $request->comment;
            $stage->save();

            $history = new DocumentHistory();
            $history->document_id = $request->document_id;
            $history->activity_type = 'HOD Review Submit';
            $history->previous = '';
            $history->current = '';
            $history->comment = $request->comment;
            $history->action_name = 'Submit';
            $history->change_from = 'In-HOD Review';
            $history->change_to = 'HOD Reviewed';
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = 'In-HOD Review';
            $history->save();
          }

          if ($request->stage_id == 'Reviewed') {
            $stage = new StageManage;
            $stage->document_id = $request->document_id;
            $stage->user_id = Auth::user()->id;
            $stage->role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $stage->stage = 'Review-Submit';
            $stage->comment = $request->comment;
            $stage->save();

            $history = new DocumentHistory();
            $history->document_id = $request->document_id;
            $history->activity_type = 'Review Submit';
            $history->previous = '';
            $history->current = '';
            $history->comment = $request->comment;
            $history->action_name = 'Submit';
            $history->change_from = 'In-Review';
            $history->change_to = 'Reviewed';
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = 'In-Review';
            $history->save();
          }
          if ($request->stage_id == 'Approved') {
            $stage = new StageManage;
            $stage->document_id = $request->document_id;
            $stage->user_id = Auth::user()->id;
            $stage->role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $stage->stage = 'Approval-Submit';
            $stage->comment = $request->comment;
            $stage->save();

            $history = new DocumentHistory();
            $history->document_id = $request->document_id;
            $history->activity_type = 'Approval Submit';
            $history->previous = '';
            $history->current = '';
            $history->comment = $request->comment;
            $history->action_name = 'Submit';
            $history->change_from = 'For-Approval';
            $history->change_to = 'Approved';
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = 'For-Approval';
            $history->save();
          }
          
          if ($request->stage_id == 'Cancel-by-HOD') {
            StageManage::where('document_id', $request->document_id)
              // ->where('user_id', Auth::user()->id)
              ->where('stage', 'In-HOD Review')
              ->delete();
          }

          if ($request->stage_id == 'Cancel-by-Approver') {
            StageManage::where('document_id', $request->document_id)
              // ->where('user_id', Auth::user()->id)
              ->where('stage', 'In-Review')
              ->delete();
          }   

        }

        
        if (Helpers::checkRoles(2) && in_array(Auth::user()->id, explode(",", $document->reviewers)) && ($document->stage == 4 || $document->stage == 5)) {
          if ($request->stage_id == "Cancel-by-Reviewer") {
              $document->stage = 1;
              $document->status = "Draft";
              $history = new DocumentHistory();
              $history->document_id = $request->document_id;
              $history->activity_type = 'Cancel-by-Reviewer';
              $history->previous = '';
              $history->current = '';
              $history->comment = $request->comment;
              $history->action_name = 'Submit';
              $history->change_from = 'In-Review';
              $history->change_to = 'Draft';
              $history->user_id = Auth::user()->id;
              $history->user_name = Auth::user()->name;
              $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
              $history->origin_state = 'In-Review';
              $history->save();
            try {
              Mail::send('mail.review-reject', ['document' => $document],
              function ($message) use ($originator) {
                      $message->to($originator->email)
                              ->subject('Rejected By'.Auth::user()->name.'(Reviewer)');
              });
            } catch (\Exception $e) {
              // 
            }
          } else {
            try {
                Mail::send('mail.reviewed', ['document' => $document],
                function ($message) use ($originator) {
                        $message->to($originator->email)
                                ->subject('Reviewed By'.Auth::user()->name.'(Reviewer)');
                });
            } catch (\Exception $e) {
              // 
            }
            $reviewersData = 0;
            $reviewersDataforgroup = 0;
            if ($document->reviewers) {
              $data = explode(',', $document->reviewers);
              $review = 0;
              for ($i = 0; $i < count($data); $i++) {
                $stateCheak = StageManage::where('document_id', $request->document_id)->where('user_id', $data[$i])->where('stage', "Review-Submit")->count();
                if ($stateCheak > 0) {
                  $review = $review + 1;
                }
              }
              if ($review == count($data)) {
                $reviewersData = 1;

              }

            }
            if ($document->reviewers_group) {
              $groupData = Grouppermission::where('id', $document->reviewers_group)->value('user_ids');
              $dataforgroup = explode(',', $groupData);
              $reviewforgroup = 0;
              for ($i = 0; $i < count($dataforgroup); $i++) {
                $stateCheak = StageManage::where('document_id', $request->document_id)->where('user_id', $dataforgroup[$i])->where('stage', "Review-Submit")->count();
                if ($stateCheak > 0) {
                  $reviewforgroup = $reviewforgroup + 1;
                }
              }
              if ($review == count($dataforgroup)) {
                $reviewersDataforgroup = 1;
                if ($document->reviewers) {
                  if ($reviewersData == 1) {

                    $document->stage = 5;
                    $document->status = Stage::where('id', 5)->value('name');
                    try {
                      Mail::send(
                        'mail.reviewed',
                        ['document' => $document],
                        function ($message) use ($originator) {
                          $message->to($originator->email)
                            ->subject('Document is now Reviewed');
                        }
                      );
                    } catch (\Exception $e) {
                      // 
                    }
                  }
                } else {
                  $document->stage = 5;
                  $document->status = Stage::where('id', 5)->value('name');
                  try {
                    Mail::send(
                      'mail.reviewed',
                      ['document' => $document],
                      function ($message) use ($originator) {
                        $message->to($originator->email)
                          ->subject('Document is now Reviewed');
                      }
                    );
                  } catch (\Exception $e) {
                    // 
                  }
                }
              }
            }
            if ($document->reviewers) {
              if ($document->reviewers_group) {
                if ($reviewersDataforgroup == 1 && $reviewersData = 1) {
                  $document->stage = 5;
                  $document->status = Stage::where('id', 5)->value('name');
                  try {
                    Mail::send(
                      'mail.reviewed',
                      ['document' => $document],
                      function ($message) use ($originator) {
                        $message->to($originator->email)
                          ->subject('Document is now Reviewed');
                      }
                    );
                  } catch (\Exception $e) {
                    // 
                  }
                } 
              } else {
                if ($reviewersData == 1) {
                  $document->stage = 5;
                  $document->status = Stage::where('id', 5)->value('name');
                  try {
                    Mail::send(
                      'mail.reviewed',
                      ['document' => $document],
                      function ($message) use ($originator) {
                        $message->to($originator->email)
                          ->subject('Document is Reviewed');
                      }
                    );
                  } catch (\Exception $e) {
                    // 
                  }
                }
              }
            }
          }

        }
        
        if (Helpers::checkRoles(1) && in_array(Auth::user()->id, explode(",", $document->approvers)) && ($document->stage == 6 || $document->stage == 7)) {
          if ($request->stage_id == "Cancel-by-Approver") {
            $document->status = "Draft";
            $document->stage = 1;
              $history = new DocumentHistory();
              $history->document_id = $request->document_id;
              $history->activity_type = 'Cancel-by-Approver';
              $history->previous = '';
              $history->current = '';
              $history->comment = $request->comment;
              $history->action_name = 'Submit';
              $history->change_from = 'In-Approver';
              $history->change_to = 'Draft';
              $history->user_id = Auth::user()->id;
              $history->user_name = Auth::user()->name;
              $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
              $history->origin_state = 'In-Approver';
              $history->save();
            try {
              Mail::send(
                'mail.approve-reject',
                ['document' => $document],
                function ($message) use ($originator) {
                  $message->to($originator->email)
                    ->subject('Rejected by' . Auth::user()->name . '(Approver)');
                }
              );
            } catch (\Exception $e) {
              // 
            }
          } else {
            try {
              Mail::send(
                'mail.approved',
                ['document' => $document],
                function ($message) use ($originator) {
                  $message->to($originator->email)
                    ->subject('Approved by' . Auth::user()->name . '(Approver)');
  
                }
              );
            } catch (\Exception $e) {
              // 
            }
            $reviewersData = 0;
            $reviewersDataforgroup = 0;
            if ($document->approvers) {
              $data = explode(',', $document->approvers);
              $review = 0;
              for ($i = 0; $i < count($data); $i++) {
                $stateCheak = StageManage::where('document_id', $request->document_id)->where('user_id', $data[$i])->where('stage', "Approval-Submit")->count();
                if ($stateCheak > 0) {
                  $review = $review + 1;
                }
              }
              if ($review == count($data)) {
                $reviewersData = 1;

              }

            }
            if ($document->approver_group) {
              $groupData = Grouppermission::where('id', $document->approver_group)->value('user_ids');
              $dataforgroup = explode(',', $groupData);
              $reviewforgroup = 0;
              for ($i = 0; $i < count($dataforgroup); $i++) {
                $stateCheak = StageManage::where('document_id', $request->document_id)->where('user_id', $dataforgroup[$i])->where('stage', "Approval-Submit")->count();
                if ($stateCheak > 0) {
                  $reviewforgroup = $reviewforgroup + 1;
                }
              }
              if ($review == count($dataforgroup)) {
                $reviewersDataforgroup = 1;
                if ($document->reviewers) {
                  if ($reviewersData == 1) {
                    $document->stage = 7;
                    $document->status = Stage::where('id', 7)->value('name');
                    try {
                      Mail::send(
                        'mail.approved',
                        ['document' => $document],
                        function ($message) use ($originator) {
                          $message->to($originator->email)
                            ->subject("Document is now Approved");
  
                        }
                      );
                    } catch (\Exception $e) {
                      // 
                    }
                  }
                } else {
                  $document->stage = 7;
                  $document->status = Stage::where('id', 7)->value('name');
                  try {
                    Mail::send(
                      'mail.approved',
                      ['document' => $document],
                      function ($message) use ($originator) {
                        $message->to($originator->email)
                          ->subject("Document is now Approved");
  
                      }
                    );
                  } catch (\Exception $e) {
                    // 
                  }
                }
              }
            }
            if ($document->approvers) {
              if ($document->approver_group) {
                if ($reviewersDataforgroup == 1 && $reviewersData == 1) {
                  $document->stage = 5;
                  $document->status = Stage::where('id', 5)->value('name');
                  try {
                    Mail::send(
                      'mail.approved',
                      ['document' => $document],
                      function ($message) use ($originator) {
                        $message->to($originator->email)
                          ->subject("Document is now Approved.");
  
                      }
                    );
                  } catch (\Exception $e) {
                    // 
                  }
                }
              } else {
                if ($reviewersData == 1) {
                  $document->stage = 7;
                  $document->status = Stage::where('id', 7)->value('name');
                  try {
                    Mail::send(
                      'mail.approved',
                      ['document' => $document],
                      function ($message) use ($originator) {
                        $message->to($originator->email)
                          ->subject("Document is now Approved");
  
                      }
                    );
                  } catch (\Exception $e) {
                    // 
                  }
                }
              }
            }
          }
        }

        if (Helpers::checkRoles(4) && in_array(Auth::user()->id, explode(",", $document->hods)) && ($document->stage == 2 || $document->stage == 3)) {
          if ($request->stage_id == "Cancel-by-HOD") {
            $document->status = "Draft";
            $document->stage = 1;
              $history = new DocumentHistory();
              $history->document_id = $request->document_id;
              $history->activity_type = 'Cancel-by-HOD';
              $history->previous = '';
              $history->current = '';
              $history->comment = $request->comment;
              $history->action_name = 'Submit';
              $history->change_from = 'In-HOD Review';
              $history->change_to = 'Draft';
              $history->user_id = Auth::user()->id;
              $history->user_name = Auth::user()->name;
              $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
              $history->origin_state = 'In-HOD Review';
              $history->save();
            try {
              Mail::send(
                'mail.approve-reject',
                ['document' => $document],
                function ($message) use ($originator) {
                  $message->to($originator->email)
                    ->subject('Rejected by' . Auth::user()->name . '(HOD)');
                }
              );
            } catch (\Exception $e) {
              // 
            }
          } else {
            try {
              Mail::send(
                'mail.approved',
                ['document' => $document],
                function ($message) use ($originator) {
                  $message->to($originator->email)
                    ->subject('HOD Review completed by' . Auth::user()->name . '(HOD)');
  
                }
              );
            } catch (\Exception $e) {
              // 
            }
            // $hodsData = 0;
            // $hodsDataforgroup = 0;
            // if ($document->hods) {
            //   $data = explode(',', $document->hods);
            //   $hods = 0;

            //   for ($i = 0; $i < count($data); $i++) {
            //     $stateCheak = StageManage::where('document_id', $request->document_id)->where('user_id', $data[$i])->where('stage', "In-HOD Review")->count();
            //     if ($stateCheak > 0) {
            //       $review = $review + 1;
            //     }
            //   }
            //   if ($review == count($data)) {
            //     $hodsData = 1;

            //   }

            // }

            if ($document->hods) {
                $document->stage = 3;
                $document->status = Stage::where('id', 3)->value('name');
                try {
                  Mail::send(
                    'mail.approved',
                    ['document' => $document],
                    function ($message) use ($originator) {
                      $message->to($originator->email)
                        ->subject("Document is now Approved");

                    }
                  );
                } catch (\Exception $e) {
                  // 
                }
            }
          }

        }

        if (Helpers::checkRoles(3) && $document->originator_id == Auth::user()->id && $request->stage_id == 2 || $request->stage_id == 4 || $request->stage_id == 6 ||  $request->stage_id == 8 || $request->stage_id == 10 || $request->stage_id == 11) {
          
          if ($request->stage_id) {
            $document->stage = $request->stage_id;
            $document->status = Stage::where('id', $request->stage_id)->value('name');
            if ($request->stage_id == 2) {
              if ($document->reviewers) {
                $temperory = explode(',', $document->reviewers);
                for ($i = 0; $i < count($temperory); $i++) {
                  $temp_user = User::find($temperory[$i]);

                  $temp_user->fromMain = User::find($document->originator_id);

                            try {
                              Mail::send('mail.for_review',['document' => $document],
                              function ($message) use ($temp_user) {
                                      $message->to($temp_user->email)
                                              ->subject('Document is for Review');
                              });
                            } catch (\Exception $e) {
                              // 
                            }

                }
              }
            }
            if ($request->stage_id == 4) {
              if ($document->hods) {
                $document['stage'] = $request->stage_id;
                $document['status'] = Stage::where('id', $request->stage_id)->value('name');

                $document->update();
                $history = new DocumentHistory();
                $history->document_id = $request->document_id;
                $history->activity_type = 'Send for Approver';
                $history->previous = '';
                $history->current = '';
                $history->comment = $request->comment;
                $history->action_name = 'Submit'; 
                $history->change_from = 'Reviewed';
                $history->change_to = 'For-Approval';
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = 'Reviewed';
                $history->save();
                $temperory = explode(',', $document->approvers);
                for ($i = 0; $i < count($temperory); $i++) {
                  $temp_user = User::find($temperory[$i]);
                  $temp_user->fromMain = User::find($document->originator_id);
                  try {
                    Mail::send(
                      'mail.for_approval',
                      ['document' => $document],
                      function ($message) use ($temp_user) {
                        $message->to($temp_user->email)
                          ->subject('Document is for Approval');
                      }
                    );
                  } catch (\Exception $e) {
                    // 
                  }
                }
              }
            }
            if ($request->stage_id == 6) {
              $traning = DocumentTraining::where('document_id', $document->id)->first();
              if ($traning){
                $traning->trainer = User::find($traning->trainer);
                try {
                  Mail::send(
                    'mail.for_training',
                    ['document' => $document],
                    function ($message) use ($traning) {
                      $message->to($traning->trainer->email)
                        ->subject('Document is for training');
                    }
                  );
                } catch (\Exception $e) {

                }
              } 

            }

            if ($request->stage_id == 10) {
              $document->effective_date = Carbon::now()->format('Y-m-d');
              // $document->review_period = 3; //3 year
            
              if ($document->revised == 'Yes')
              {
                $old_document = Document::where([
                  'document_number' => $document->document_number,
                  'status' => 'Effective'
                ])->first();

                if ($old_document) {
                  $old_document->stage = 11;
                  $old_document->status = 'Obsolete';
                  $old_document->save();
                }
              }

              try {
                  $next_review_date = Carbon::parse($document->effective_date)->addYears($document->review_period)->format('Y-m-d');
                  $document->next_review_date = $next_review_date;
              } catch (\Exception $e) {
                  // 
              }
            }
            if ($request->stage_id == 11) { 
                $document['stage'] = $request->stage_id;
                $document['status'] = Stage::where('id', $request->stage_id)->value('name');
            }
          }
        }

        $document->update();
        toastr()->success('Document has been sent.');
        return redirect()->back();
      } else {
        toastr()->error('E-signature is not matched.');
        return redirect()->back();
      }
    } else {
      toastr()->error('Username is not matched.');
      return redirect()->back();
    }

  }

  function auditTrial($id)
  {
    $audit = DocumentHistory::where('document_id', $id)->orderByDESC('id')->get()->unique('activity_type');
    $today = Carbon::now()->format('d-m-y');
    $document = Document::where('id', $id)->first();
    $document->doctype = DocumentType::where('id', $document->document_type_id)->value('typecode');
    $document->division = Division::where('id', $document->division_id)->value('name');
    $document->process = Process::where('id', $document->process_id)->value('process_name');
    $document->originator = User::where('id', $document->originator_id)->value('name');
    $document['year'] = Carbon::parse($document->created_at)->format('Y');
    $document['document_type_name'] = DocumentType::where('id', $document->document_type_id)->value('name');
    return view('frontend.documents.audit-trial', compact('audit', 'document', 'today'));
  }

  function auditTrialIndividual($id, $user)
  {
    $audit = DocumentHistory::where('document_id', $id)->where('user_id', $user)->orderByDESC('id')->get()->unique('activity_type');
    $today = Carbon::now()->format('d-m-y');
    $document = Document::where('id', $id)->first();
    $document->division = Division::where('id', $document->division_id)->value('name');
    $document->process = Process::where('id', $document->process_id)->value('process_name');
    $document->originator = User::where('id', $document->originator_id)->value('name');
    return view('frontend.documents.audit-trial', compact('audit', 'document', 'today'));
  }

  function getAuditDetail($id)
  {
    $detail = DocumentHistory::find($id);
    $doc = Document::where('id', $detail->document_id)->first();
    $html = "";
    if (!empty($detail)) {
      $html = '<div class="info-list">
        <div class="main-head">Activity</div>
        <div class="list-item">
            <div class="head">Activity Type</div>
            <div>:</div>
            <div>' . $detail->activity_type . '</div>
        </div>
        <div class="list-item">
            <div class="head">Performed on</div>
            <div>:</div>
            <div>' . $detail->created_at . '</div>
        </div>
        <div class="list-item">
            <div class="head">Performed by</div>
            <div>:</div>
            <div>' . $detail->user_name . '</div>
        </div>
        <div class="list-item">
            <div class="head">Performer Role</div>
            <div>:</div>
            <div>' . $detail->user_role . '</div>
        </div>
        <div class="list-item">
            <div class="head">Origin State</div>
            <div>:</div>
            <div>' . $detail->origin_state . '</div>
        </div>
        <div class="list-item">
            <div class="head">Resulting State</div>
            <div>:</div>
            <div>Rejected</div>
        </div>
                </div>
                <div class="activity-detail">
                    <div class="info">
                        <div class="name">Short Description was modified by : .' . $detail->user_name . '</div>
                        <div class="date">' . $detail->created_at . '</div>
                        <div>Document Number : SOP-' . $detail->document_id . '</div>
                    </div>
                    <div class="info">
                        <div class="bold">Changed from</div>
                        <div>' . $detail->previous . '</div>
                    </div>
                    <div class="info">
                        <div class="bold">Changed to</div>
                        <div>' . $detail->current . '</div>
                    </div>

                </div>';
    }
    $response['html'] = $html;

    return response()->json($response);
  }
  function auditDetails($id)
  {
    $detail = DocumentHistory::find($id);
    $detail_data = DocumentHistory::where('activity_type', $detail->activity_type)->where('document_id', $detail->document_id)->latest()->get();
    $doc = Document::where('id', $detail->document_id)->first();
    $doc->division = Division::where('id', $doc->division_id)->value('name');
    $doc->process = Process::where('id', $doc->process_id)->value('process_name');
    $doc->origiator_name = User::find($doc->originator_id);
    return view('frontend.documents.audit-trial-inner', compact('detail', 'doc', 'detail_data'));
  }
  function history($id)
  {

    $history = DocumentHistory::find($id);
    $data = Document::find($history->document_id);
    $data->department = Department::find($data->department_id);
    $data['originator'] = User::where('id', $data->originator_id)->value('name');
    $data['originator_email'] = User::where('id', $data->originator_id)->value('email');
    $data['document_content'] = DocumentContent::where('document_id', $history->document_id)->first();
    $pdf = App::make('dompdf.wrapper');
    $pdf = PDF::loadView('frontend.documents.audit-pdf', compact('history', 'data'))->setOptions(['dpi' => 150, 'defaultFont' => 'arial']);
    $pdf->set_option("isPhpEnabled", true);
    $pdf->setPaper('A4');
    $pdf->render();
    $canvas = $pdf->getDomPDF()->getCanvas();
    $height = $canvas->get_height();
    $width = $canvas->get_width();
    $canvas->set_opacity(.1, "Multiply");
    $canvas->page_script('$pdf->set_opacity(.2, "Multiply");');

    $canvas->page_text(
      $width / 5,
      $height / 2,
      $data->status,
      null,
      55,
      array(0, 0, 0),
      2,
      3,
      -30
    );
    return $pdf->stream('SOP' . $id . '.pdf');
  }


  function updatereviewers(Request $request, $id)
  {
    $document = Document::find($id);
    if ($request->reviewers) {
      $document->reviewers = implode(',', $request->reviewers);
    }
    if ($request->reviewers_group) {
      $document->reviewers_group = implode(',', $request->reviewers_group);
    }
    if ($request->approvers) {
      $document->approvers = implode(',', $request->approvers);
    }
    if ($request->approver_group) {
      $document->approver_group = implode(',', $request->approver_group);
    }
    if ($document->update()) {
      toastr()->success('Updated successfully');
    } else {
      toastr()->error('Somthing went wrong');
    }
    return back();

  }

  function notification($id)
  {
    $document = Document::find($id);
    $document->division = Division::find($document->division_id);
    $document->process = Process::find($document->process_id);
    $document->oreginator = User::find($document->originator_id);
    return view('frontend.notification', compact('document'));

  }

  public function getData(Request $request)
  {


    $selectedOption = $request->input('option');

    // Fetch the data for the selected option from the database or any other source
    // For example:
    $data = User::where('id', $selectedOption)->first();
    $data->role = RoleGroup::where('id', $data->role)->value('name');

    // Return the data as a response to the AJAX request
    return response()->json(['role' => $data->role, 'name' => $data->name]);
  }
  public function sendNotification(Request $request)
  {
    $user = User::find($request->option);
    Mail::send(
      'frontend.message',
      ['request' => $request],
      function ($message) use ($user) {
        $message->to($user->email)
          ->subject('You have receiverd a new notification');
      }
    );
    toastr()->success('Mail sent');
    return back();

  }

  public function search(Request $request)
  {
    $count = Document::join('document_contents', 'document_contents.document_id', 'documents.id')
      ->join('document_types', 'document_types.id', 'documents.document_type_id')
      ->join('divisions', 'divisions.id', 'documents.division_id')
      ->join('users', 'users.id', 'documents.originator_id')
      ->select('documents.*', 'document_contents.*', 'users.name as originator_name', 'document_types.name as document_type_name', 'divisions.name as division_name')
      ->where(function ($query) use ($request) {
        if (!empty($request->originator)) {
          $query->where('documents.originator_id', $request->originator);
        }
      })
      ->where(function ($query) use ($request) {
        if (!empty($request->record)) {

          $query->Where('documents.record', $request->record);
        }
      })
      ->where(function ($query) use ($request) {
        if (!empty($request->doc_num)) {

          $query->Where('documents.id', $request->doc_num);
        }
      })
      ->where(function ($query) use ($request) {
        if (!empty($request->document_name)) {

          $query->Where('documents.document_name', $request->document_name);
        }
      })
      ->where(function ($query) use ($request) {
        if (!empty($request->status)) {

          $query->Where('documents.status', $request->status);
        }
      })
      ->where(function ($query) use ($request) {
        if (!empty($request->created_date)) {

          $query->whereDate('documents.created_at', '=', $request->created_date);
        }
      })
      ->where(function ($query) use ($request) {
        if (!empty($request->due_date)) {

          $query->Where('documents.due_date', $request->due_date);
        }
      })
      ->where(function ($query) use ($request) {
        if (!empty($request->effective_date)) {

          $query->Where('documents.effective_date', $request->effective_date);
        }
      })
      ->where(function ($query) use ($request) {
        if (!empty($request->purpose)) {

          $query->Where('document_contents.purpose', 'LIKE', '%' . $request->purpose . "%");
        }
      })
      ->orderByDesc('documents.id')->count();
    $documents = Document::join('document_contents', 'document_contents.document_id', 'documents.id')
      ->join('document_types', 'document_types.id', 'documents.document_type_id')
      ->join('divisions', 'divisions.id', 'documents.division_id')
      ->join('users', 'users.id', 'documents.originator_id')
      ->select('documents.*', 'document_contents.*', 'users.name as originator_name', 'document_types.name as document_type_name', 'divisions.name as division_name')
      ->where(function ($query) use ($request) {
        if (!empty($request->originator)) {
          $query->where('documents.originator_id', $request->originator);
        }
      })
      ->where(function ($query) use ($request) {
        if (!empty($request->record)) {

          $query->Where('documents.record', $request->record);
        }
      })
      ->where(function ($query) use ($request) {
        if (!empty($request->doc_num)) {

          $query->Where('documents.id', $request->doc_num);
        }
      })
      ->where(function ($query) use ($request) {
        if (!empty($request->document_name)) {

          $query->Where('documents.document_name', $request->document_name);
        }
      })
      ->where(function ($query) use ($request) {
        if (!empty($request->status)) {

          $query->Where('documents.status', $request->status);
        }
      })
      ->where(function ($query) use ($request) {
        if (!empty($request->created_date)) {

          $query->whereDate('documents.created_at', '=', $request->created_date);
        }
      })
      ->where(function ($query) use ($request) {
        if (!empty($request->due_date)) {

          $query->Where('documents.due_date', $request->due_date);
        }
      })
      ->where(function ($query) use ($request) {
        if (!empty($request->effective_date)) {

          $query->Where('documents.effective_date', $request->effective_date);
        }
      })
      ->where(function ($query) use ($request) {
        if (!empty($request->purpose)) {

          $query->Where('document_contents.purpose', 'LIKE', '%' . $request->purpose . "%");
        }
      })
      ->orderByDesc('documents.id')->paginate(10);

    return view('frontend.documents.index', compact('documents', 'count'));

  }

  public function searchAdvance(Request $request)
  {
    $count = Document::join('document_contents', 'document_contents.document_id', 'documents.id')
      ->join('document_types', 'document_types.id', 'documents.document_type_id')
      ->join('divisions', 'divisions.id', 'documents.division_id')
      ->join('users', 'users.id', 'documents.originator_id')
      ->select('documents.*', 'document_contents.*', 'users.name as originator_name', 'document_types.name as document_type_name', 'divisions.name as division_name')
      ->orwhere(function ($query) use ($request) {
        if (!empty($request->field)) {
          $query->whereIN('documents.document_name', $request->value);
        }
      })
      ->orwhere(function ($query) use ($request) {
        if (!empty($request->field)) {
          $query->whereIN('documents.short_description', $request->value);
        }
      })

      ->orderByDesc('documents.id')->count();
    $documents = Document::join('document_contents', 'document_contents.document_id', 'documents.id')
      ->join('document_types', 'document_types.id', 'documents.document_type_id')
      ->join('divisions', 'divisions.id', 'documents.division_id')
      ->join('users', 'users.id', 'documents.originator_id')
      ->select('documents.*', 'document_contents.*', 'users.name as originator_name', 'document_types.name as document_type_name', 'divisions.name as division_name')
      ->orwhere(function ($query) use ($request) {
        if (!empty($request->field)) {
          $query->where('documents.document_name', $request->value);
        }
      })
      ->orwhere(function ($query) use ($request) {
        if (!empty($request->field)) {
          foreach ($request->value as $value)
          {
            $query->where('documents.short_description', 'LIKE', '%'. $value .'%');
          }
        }
      })
      ->orderByDesc('documents.id')->paginate(10);

      $divisions = QMSDivision::where('status', '1')->select('id', 'name')->get();
        // $divisions = QMSDivision::where('status', '1')->select('id', 'name')->get();
        $documentValues = Document::withoutTrashed()->select('id', 'document_type_id')->get();
        $documentTypeIds = $documentValues->pluck('document_type_id')->unique()->toArray();
        $documentTypes = DocumentType::whereIn('id', $documentTypeIds)->select('id', 'name')->get();

        $documentStatus = Document::withoutTrashed()->select('id', 'status')->get();
        $documentStatusIds = $documentValues->pluck('document_type_id')->unique()->toArray();
        // dd($documentStatus);

        $OriValues = Document::withoutTrashed()->select('id', 'originator_id')->get();
        $OriTypeIds = $OriValues->pluck('originator_id')->unique()->toArray();
        $originator = User::whereIn('id', $OriTypeIds)->select('id', 'name')->get();

    return view('frontend.documents.index', compact('documents', 'count', 'divisions', 'originator', 'documentTypes', 'documentStatus'));

    // return view('frontend.documents.index', compact('documents', 'count'));

  }

  public function printAudit($id)
  {
    $audit = DocumentHistory::where('document_id', $id)->orderByDESC('id')->get()->unique('activity_type');
    $today = Carbon::now()->format('d-m-y');
    $document = Document::where('id', $id)->first();
    $document->division = Division::where('id', $document->division_id)->value('name');
    $document->process = Process::where('id', $document->process_id)->value('process_name');
    $document->originator = User::where('id', $document->originator_id)->value('name');


    $pdf = PDF::loadview('frontend.documents.audit-trialPrint', compact('audit', 'document', 'today'))
      ->setOptions([
        'defaultFont' => 'sans-serif',
        'isHtml5ParserEnabled' => true,
        'isRemoteEnabled' => true,
        'isPhpEnabled' => true
      ]);


    return $pdf->stream('Audit' . $id . '.pdf');
  }
}
