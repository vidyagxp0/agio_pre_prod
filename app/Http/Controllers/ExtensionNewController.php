<?php

namespace App\Http\Controllers;

use App\Models\extension_new;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExtensionNewController extends Controller
{

    public function index(Request $request){
        $data = "test";
        $reviewer = DB::table('user_roles')
                ->join('users', 'user_roles.user_id', '=', 'users.id')
                ->select('user_roles.q_m_s_processes_id', 'users.id','users.role','users.name') // Include all selected columns in the select statement
                ->where('user_roles.q_m_s_processes_id', 89)
                ->where('user_roles.q_m_s_roles_id', 2)
                ->groupBy('user_roles.q_m_s_processes_id', 'users.id','users.role','users.name') // Include all selected columns in the group by clause
                ->get();
        $approvers = DB::table('user_roles')
                ->join('users', 'user_roles.user_id', '=', 'users.id')
                ->select('user_roles.q_m_s_processes_id', 'users.id','users.role','users.name') // Include all selected columns in the select statement
                ->where('user_roles.q_m_s_processes_id', 89)
                ->where('user_roles.q_m_s_roles_id', 1)
                ->groupBy('user_roles.q_m_s_processes_id', 'users.id','users.role','users.name') // Include all selected columns in the group by clause
                ->get();


        return View('frontend.extension.extension_new', compact('data', 'reviewer', 'approvers'));
    }
    public function store(Request $request)
    {
        $request->validate([
        //     'site_location_code' => 'required|string',
        //     'initiator' => 'required|string',
        //     'initiation_date' => 'required|date',
            'short_description' => 'required|string',
        //     'reviewers' => 'required|json',
        //     'approvers' => 'required|json',
        //     'current_due_date' => 'required|date',
        //     'proposed_due_date' => 'required|date',
            'description' => 'required|string',
        //     'file_attachment_extension' => 'required|string',
        //     'reviewer_remarks' => 'nullable|string',
        //     'file_attachment_reviewer' => 'nullable|string',
        //     'approver_remarks' => 'nullable|string',
        //     'file_attachment_approver' => 'nullable|string',
        ]);
    
        $extensionNew = new extension_new();
        $extensionNew->site_location_code = $request->site_location_code;
        $extensionNew->initiator = $request->initiator;
        // dd($request->initiator);
        $extensionNew->initiation_date = $request->initiation_date;
        $extensionNew->short_description = $request->short_description;
        $extensionNew->reviewers = $request->reviewers;
        $extensionNew->approvers = $request->approvers;
        $extensionNew->current_due_date = $request->current_due_date;
        $extensionNew->proposed_due_date = $request->proposed_due_date;
        $extensionNew->description = $request->description;
        $extensionNew->file_attachment_extension = $request->file_attachment_extension;
        $extensionNew->reviewer_remarks = $request->reviewer_remarks;
        $extensionNew->file_attachment_reviewer = $request->file_attachment_reviewer;
        $extensionNew->approver_remarks = $request->approver_remarks;
        $extensionNew->file_attachment_approver = $request->file_attachment_approver;
    
        $extensionNew->save();
    
        return redirect()->back()->with('success', 'Induction training data saved successfully!');

    }

    public function show(Request $request,$id){

    }

    public function update(Request $request,$id){
    }
    
}
