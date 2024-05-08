<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\Models\Admin;
use App\Models\RoleGroup;
use App\Models\Department;
use App\Models\Grouppermission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GroupPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $array =[];
        $GroupPermission = Grouppermission::orderBy('id', "desc")->get();
        foreach($GroupPermission as $data){
            if($data->user_ids){
                $userid = explode(",", $data->user_ids);
                for($i=0 ; $i < count($userid); $i++){
                    $userdata = User::where('id', $userid[$i])->value('name');
                    array_push($array,$userdata);
                }
                $data->uname = implode(", ", $array);
            }
            else{
                $data->uname = "Select Group person";
            }
        }
        return view('admin.GroupPermission.index', compact('GroupPermission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $group = RoleGroup::all();
        $user = User::all();
        $department = Department::all();
        return view('admin.GroupPermission.create', compact('group', 'department', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $user = new Grouppermission();
        $user->role_id = $request->rolesid;
        $user->user_ids = implode(',', $request->user_ids);
        $user->name = $request->name;

        if ($user->save()) {
            toastr()->success('Group Permission successfully');
            return redirect()->route('GroupPermission.index');
        } else {
            toastr()->error('Something went wrong');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $role = RoleGroup::all();
        $department = Department::all();
        $user = User::all();
        $data = Grouppermission::find($id);
        return view('admin.GroupPermission.edit', compact('role', 'data', 'department', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $user = Grouppermission::find($id);
        $user->role_id = $request->rolesid;
        $user->user_ids = implode(',', $request->user_ids);
        $user->name = $request->name;

        if ($user->update()) {
            toastr()->success('Update successfully');
            return redirect()->route('GroupPermission.index');
        } else {
            toastr()->error('Something went wrong');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = Grouppermission::find($id);

        if ($user->delete()) {
            toastr()->success('Deleted successfully');
            return redirect()->back();
        } else {
            toastr()->error('Something went wrong');
            return redirect()->back();
        }
    }
}
