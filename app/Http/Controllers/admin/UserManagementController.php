<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\Models\Admin;
use App\Models\GroupCategory;
use App\Models\QMSDivision;
use App\Models\QMSProcess;
use App\Models\QMSRoles;
use App\Models\RoleGroup;
use App\Models\Department;
use App\Models\Roles;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $users = user::leftJoin("departments", "departments.id", "=", "users.departmentid")
        ->get(['users.*', 'departments.name as dname']);
        return view('admin.account.account', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $group = Roles::all();
        $department = Department::all();
        return view('admin.account.create', compact('group','department'));
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'departmentid' => 'required',
            'roles' => 'required|array',
        ]);
        
        // $user = new User();
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = Hash::make($request->password);
        // $user->departmentid = $request->departmentid;
        // $usertableRole = '';
        // if ($user->save()) {
        //     foreach ($request->roles as $roleId) {
        //     $userRole = new UserRole();                
        //     $checkRole = Roles::find($roleId);

        //     // Split the string using the '-' delimiter
        //     $roleArray = explode('-', $checkRole->name);

        //     // Assign values to three variables
        //     $q_m_s_divisions_name = trim($roleArray[0]);
        //     $q_m_s_processes_name = trim($roleArray[1]);
        //     $q_m_s_roles_name = trim($roleArray[2]);

        //     // Assuming you have models for q_m_s_divisions and q_m_s_process
        //     $division = QMSDivision::where('name', $q_m_s_divisions_name)->first();
        //     $process = QMSProcess::where('process_name', $q_m_s_processes_name)->first();
        //     $qmsroles = QMSRoles::where('name', $q_m_s_roles_name)->first();
        //     $q_m_s_divisions_id = $division->id;
        //     $q_m_s_processes_id = $process->id;
        //     $q_m_s_roles_id = $qmsroles->id;

        //     $usertableRole = //concatinate the $q_m_s_roles_id by comma seprated 
        //     $userRole->user_id = $user->id;
        //     $userRole->role_id = $roleId;
        //     $userRole->q_m_s_divisions_id = $q_m_s_divisions_id;
        //     $userRole->q_m_s_processes_id = $q_m_s_processes_id;
        //     $userRole->q_m_s_roles_id = $q_m_s_roles_id;
        //     $userRole->save();
        // }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->departmentid = $request->departmentid;
        $usertableRole = ''; // Initialize the variable to store concatenated role IDs

        if ($user->save()) {
            foreach ($request->roles as $roleId) {
                $checkRole = Roles::find($roleId);


                // Split the string using the '-' delimiter
                $roleArray = explode('-', $checkRole->name);

                // Assign values to three variables
                $q_m_s_divisions_name = trim($roleArray[0]);
                $q_m_s_processes_name = trim($roleArray[1]);
                $q_m_s_roles_name = trim($roleArray[2]);

                // Assuming you have models for q_m_s_divisions and q_m_s_process
                $division = QMSDivision::where('name', $q_m_s_divisions_name)->first();
                $processes = QMSProcess::where('process_name', $q_m_s_processes_name)->get();
                $qmsroles = QMSRoles::where('name', $q_m_s_roles_name)->first();
                
                foreach ($processes as $process) {
                    $q_m_s_divisions_id = $division->id;
                    $q_m_s_processes_id = $process->id;
                    $q_m_s_roles_id = $qmsroles->id;
                    
                    $userRole = new UserRole();                
                    // Concatenate the q_m_s_roles_id with previous ones
                    $usertableRole .= $q_m_s_roles_id . ',';

                    $userRole->user_id = $user->id;
                    $userRole->role_id = $roleId;
                    $userRole->q_m_s_divisions_id = $q_m_s_divisions_id;
                    $userRole->q_m_s_processes_id = $q_m_s_processes_id;
                    $userRole->q_m_s_roles_id = $q_m_s_roles_id;
                    $userRole->save();
                }
            }

            // Remove the trailing comma from the concatenated string
            $usertableRole = rtrim($usertableRole, ',');

            // Explode the concatenated string into an array
            $rolesArray = explode(',', $usertableRole);

            // Remove duplicate entries
            $uniqueRolesArray = array_unique($rolesArray);

            // Implode the unique array back into a string
            $uniqueUsertableRole = implode(',', $uniqueRolesArray);

            // Update the user table with the unique concatenated role IDs
            $user->role = $uniqueUsertableRole;
            $user->save();


            toastr()->success('User added successfully');
            return redirect()->route('user_management.index');
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
        $group = Roles::all();
        $department = Department::all();

        $data = User::find($id);
        $userRoles = UserRole::where('user_id', $data->id)->pluck('role_id')->toArray();

        // dd($data->id, $userRoles);
        return view('admin.account.edit', compact('group', 'data','department', 'userRoles'));
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
        $user = User::with('userRoles')->find($id);    
    $user->name = $request->name;
    $user->email = $request->email;
    if (!empty($request->password)) {
        $user->password = Hash::make($request->password);
    }
    $user->departmentid = $request->departmentid;

    if ($user->save()) {
        // Delete existing user roles
        $user->userRoles()->delete();

        // Attach new roles
        foreach ($request->roles as $roleId) {
            $userRole = new UserRole();                
            $checkRole = Roles::find($roleId);

            // Split the string using the '-' delimiter
            $roleArray = explode('-', $checkRole->name);

            // Assign values to three variables
            $q_m_s_divisions_name = trim($roleArray[0]);
            $q_m_s_processes_name = trim($roleArray[1]);
            $q_m_s_roles_name = trim($roleArray[2]);
            // Assuming you have models for q_m_s_divisions and q_m_s_process
            $division = QMSDivision::where('name', $q_m_s_divisions_name)->first();
            $process = QMSProcess::where('process_name', $q_m_s_processes_name)->first();
            $qmsroles = QMSRoles::where('name', $q_m_s_roles_name)->first();
            $q_m_s_divisions_id = $division->id;
            $q_m_s_processes_id = $process->id;
            $q_m_s_roles_id = $qmsroles->id;
            $userRole->user_id = $user->id;
            $userRole->role_id = $roleId;
            $userRole->q_m_s_divisions_id = $q_m_s_divisions_id;
            $userRole->q_m_s_processes_id = $q_m_s_processes_id;
            $userRole->q_m_s_roles_id = $q_m_s_roles_id;
            $userRole->save();
        }
            toastr()->success('Update successfully');
            return redirect()->route('user_management.index');
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
        $user = User::find($id);

        if ($user->delete()) {
            toastr()->success('Deleted successfully');
            return redirect()->back();
        } else {
            toastr()->error('Something went wrong');
            return redirect()->back();
        }
    }
}
