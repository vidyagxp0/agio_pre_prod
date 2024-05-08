<?php

namespace App\Http\Controllers;

use App\Models\OpenStage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\ChangeControlStage;
use App\Models\RoleGroup;
use Illuminate\Http\Request;
use Helpers;
use Illuminate\Support\Facades\Mail;

class ChangeControlController extends Controller
{
    public function statechange(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = OpenStage::find($id);
            $originator = User::find($changeControl->initiator_id);
            if ($changeControl->stage == 1) {
                $changeControl->stage = "2";
                $changeControl->status = "Under HOD Review";
                $changeControl->update();
                Mail::send('emp', ['document' => $changeControl],
                    function ($message) use ($originator) {
                        $message->to($originator->email)
                            ->subject("Document is now on Under HOD Review stage");

                    });
                toastr()->success('Document Sent Successflly !');
                return back();
            }
            if ($changeControl->stage == 2) {
                if ($request->stage == 1) {
                    $changeControl->stage = "1";
                    $changeControl->status = "Open-state";
                    $changeControl->update();
                    Mail::send('emp', ['document' => $changeControl],
                        function ($message) use ($originator) {
                            $message->to($originator->email)
                                ->subject("Document is now Rejected by HOD");

                        });
                    toastr()->success('Document Sent Successflly !');
                    return back();
                }
                $changeControl->stage = "3";
                $changeControl->status = "Reviewed";
                $changeControl->update();
                Mail::send('emp', ['document' => $changeControl],
                    function ($message) use ($originator) {
                        $message->to($originator->email)
                            ->subject("Document is now Reviewed by HOD");

                    });
                toastr()->success('Document Sent Successflly !');
                return back();
            }
            if ($changeControl->stage == 3) {
                $changeControl->stage = "4";
                $changeControl->status = "Under CFT Review";
                $changeControl->update();
                Mail::send('emp', ['document' => $changeControl],
                    function ($message) use ($originator) {
                        $message->to($originator->email)
                            ->subject("Document is now Under CFT Review stage");

                    });
                toastr()->success('Document Sent Successflly !');
                return back();
            }
            if ($changeControl->stage == 4) {
                if (Helpers::checkRoles(5)) {
                    $change = new ChangeControlStage();
                    $change->change_control_id = $id;
                    $change->user_id = Auth::user()->id;
                    $change->role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $change->stage = $request->stage;
                    if ($request->stage == 5) {
                        $change->stageName = "Approved";
                    }
                    if ($request->stage == 1) {
                        $change->stageName = "Reject";
                    }

                    $change->comment = $request->comment;
                    $change->save();
                    $state = ChangeControlStage::where('change_control_id', $id)->where('stage', 5)->count();
                    if ($changeControl->cft) {
                        $cft = explode(',', $changeControl->cft);
                        if ($state == count($cft)) {
                            $changeControl->stage = "5";
                            $changeControl->status = "Approved";
                            $changeControl->update();
                            Mail::send('emp', ['document' => $changeControl],
                                function ($message) use ($originator) {
                                    $message->to($originator->email)
                                        ->subject("Document is now Approved");

                                });
                            toastr()->success('Document Sent Successflly !');
                            return back();
                        } else {
                            if ($request->stage == 1) {
                                $changeControl->stage = 1;
                                $changeControl->status = "Open-state";
                                $changeControl->update();
                                Mail::send('emp', ['document' => $changeControl],
                                    function ($message) use ($originator) {
                                        $message->to($originator->email)
                                            ->subject("Document is now Approved by" . Auth::user()->name);

                                    });
                                toastr()->success('Document Sent Successflly !');
                                return back();
                            }


                        }
                    }
                }
                // $changeControl->stage = "5";
                // $changeControl->status = "Approved";
                // $changeControl->update();
                // Mail::send('emp', ['document' => $changeControl],
                // function ($message) use ($originator) {
                //         $message->to($originator->email)
                //         ->subject("Document is now on Approved stage");

                // });
                // toastr()->success('Document Sent Successflly !');
                // return back();
            }
            if ($changeControl->stage == 5) {
                $changeControl->stage = "6";
                $changeControl->status = "Effective";
                $changeControl->update();
                Mail::send('emp', ['document' => $changeControl],
                    function ($message) use ($originator) {
                        $message->to($originator->email)
                            ->subject("Change control Document is now Effective");

                    });
                toastr()->success('Document Sent Successflly !');
                return back();
            }


        } else {
            toastr()->error('E-Signature not matched');
            return back();
        }


    }
}
