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
use App\Models\AdminUserAuditTrial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Jobs\SendAdminUserEmailJob; 
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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
        $group = Roles::whereIn('id', function ($query) {
                    $query->selectRaw('MIN(id)')
                        ->from('role_groups')
                        ->groupBy('name');
                })->get();
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
            'emp_code' => 'required|string|max:255|unique:users,emp_code',
            'email' => 'required|email',
            'password' => 'required',
            'departmentid' => 'required',
            'roles' => 'required|array',
        ]);

        // Store plain password BEFORE hashing
        $plainPassword = $request->password;

        $user = new User();
        $user->name = $request->name;
        $user->emp_code = $request->emp_code;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        // $user->force_password_change = 1;
        // $user->failed_attempts = 0;
        // $user->locked_at = null;
        $user->departmentid = $request->departmentid;
        $usertableRole = ''; // Initialize the variable to store concatenated role IDs

        if ($user->save()) {
            foreach ($request->roles as $roleId) {
                $checkRole = Roles::find($roleId);

                if (!$checkRole) continue; // safety check

                $roleArray = explode('-', $checkRole->name);

                $q_m_s_divisions_name = trim($roleArray[0] ?? '');
                $q_m_s_processes_name = trim($roleArray[1] ?? '');
                $q_m_s_roles_name = trim($roleArray[2] ?? '');

                // Assuming you have models for q_m_s_divisions and q_m_s_process
                $division = QMSDivision::where('name', $q_m_s_divisions_name)->first();
                $processes = QMSProcess::where('process_name', $q_m_s_processes_name)->get();
                $qmsroles = QMSRoles::where('name', $q_m_s_roles_name)->first();
                if (!$division || !$qmsroles) continue;

                foreach ($processes as $process) {

                    $userRole = new UserRole();

                    $usertableRole .= $qmsroles->id . ',';

                    $userRole->user_id = $user->id;
                    $userRole->role_id = $roleId;
                    $userRole->q_m_s_divisions_id = $division->id;
                    $userRole->q_m_s_processes_id = $process->id;
                    $userRole->q_m_s_roles_id = $qmsroles->id;

                    $userRole->save();
                }
            }

            // Clean roles string
            $uniqueUsertableRole = implode(',', array_unique(explode(',', rtrim($usertableRole, ','))));
            $user->role = $uniqueUsertableRole;
            $user->save();



            if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->role === 'superadmin') {

                    if (!empty($request->name)) {
                        $validation2 = new AdminUserAuditTrial();
                        $validation2->admin_id = $user->id;
                        $validation2->previous = "Null";
                        $validation2->current = $request->name;
                        $validation2->activity_type = 'Name';
                        $validation2->user_id = Auth::guard('admin')->user()->id;
                        $validation2->user_name = Auth::guard('admin')->user()->name;
                        $validation2->user_role = Auth::guard('admin')->user()->role;
                        $validation2->change_to = "";
                        $validation2->change_from = "";
                        $validation2->action_name = 'Create';
                        $validation2->save();
                    }

                     if (!empty($request->emp_code)) {
                        $validation2 = new AdminUserAuditTrial();
                        $validation2->admin_id = $user->id;
                        $validation2->previous = "Null";
                        $validation2->current = $request->name;
                        $validation2->activity_type = 'Code';
                        $validation2->user_id = Auth::guard('admin')->user()->id;
                        $validation2->user_name = Auth::guard('admin')->user()->name;
                        $validation2->user_role = Auth::guard('admin')->user()->role;
                        $validation2->change_to = "";
                        $validation2->change_from = "";
                        $validation2->action_name = 'Create';
                        $validation2->save();
                    }

                    // Check if email is provided
                    if (!empty($request->email)) {
                        $validation2 = new AdminUserAuditTrial();
                        $validation2->admin_id = $user->id;
                        $validation2->previous = "Null";
                        $validation2->current = $request->email;
                        $validation2->activity_type = 'Email';
                        $validation2->user_id = Auth::guard('admin')->user()->id;
                        $validation2->user_name = Auth::guard('admin')->user()->name;
                        $validation2->user_role = Auth::guard('admin')->user()->role;
                        $validation2->change_to = "";
                        $validation2->change_from = "";
                        $validation2->action_name = 'Create';
                        $validation2->save();
                    }

                    // Check if department is provided
                    if (!empty($request->departmentid)) {
                        $departmentName = Department::where('id', $request->departmentid)->value('name');

                        if (!$departmentName) {
                            \Log::error('Department not found for ID: ' . $request->departmentid);
                            $departmentName = 'Unknown';
                        }

                        $validation2 = new AdminUserAuditTrial();
                        $validation2->admin_id = $user->id;
                        $validation2->previous = "Null";
                        $validation2->current = $departmentName;
                        $validation2->activity_type = 'Department';
                        $validation2->user_id = Auth::guard('admin')->user()->id;
                        $validation2->user_name = Auth::guard('admin')->user()->name;
                        $validation2->user_role = Auth::guard('admin')->user()->role;
                        $validation2->change_to = "";
                        $validation2->change_from = "";
                        $validation2->action_name = 'Create';
                        $validation2->save();
                    }

                    // Check if role is provided
                    if (!empty($usertableRole)) {
                        $roleNames = DB::table('role_groups')
                            ->whereIn('id', explode(',', $usertableRole))
                            ->pluck('name')
                            ->toArray();

                        $roleNamesString = implode(', ', $roleNames);

                        $validation2 = new AdminUserAuditTrial();
                        $validation2->admin_id = $user->id;
                        $validation2->previous = "Null";
                        $validation2->current = $roleNamesString;
                        $validation2->activity_type = 'Roles';
                        $validation2->user_id = Auth::guard('admin')->user()->id;
                        $validation2->user_name = Auth::guard('admin')->user()->name;
                        $validation2->user_role = Auth::guard('admin')->user()->role;
                        $validation2->change_to = "";
                        $validation2->change_from = "";
                        $validation2->action_name = 'Create';
                        $validation2->save();
                    }
                }

            // ✅ Dispatch Job instead of Mail::send
            SendAdminUserEmailJob::dispatch($user, $plainPassword);

            toastr()->success('User added successfully & email queued');
            return redirect()->route('user_management.index');
        }

        toastr()->error('Something went wrong');
        return redirect()->back();
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
       $group = Roles::whereIn('id', function ($query) {
                    $query->selectRaw('MIN(id)')
                        ->from('role_groups')
                        ->groupBy('name');
                })->get();
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
        $lastUser = User::with('userRoles')->find($id);

        // ✅ Validation (IGNORE current user)
        $request->validate([
            'name' => 'required|string|max:255', 
            'emp_code' => ['required','string','max:255',Rule::unique('users', 'emp_code')->ignore($id)],
            'email' => 'required|email',
            'departmentid' => 'required',
            'roles' => 'required|array',
        ]);

        $user->name = $request->name;
        $user->emp_code = $request->emp_code;
        $user->email = $request->email;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
            // $user->force_password_change = 0;
            // $user->password_change_time = null;
            // $user->failed_attempts = 0;
            // $user->locked_at = null;
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
                $process = QMSProcess::where('process_name', $q_m_s_processes_name)->where('division_id', $division->id)->first();
                $qmsroles = QMSRoles::where('name', $q_m_s_roles_name)->first();
                $q_m_s_divisions_id = $division->id;
                $q_m_s_processes_id = $process?->id;
                $q_m_s_roles_id = $qmsroles->id;
                $userRole->user_id = $user->id;
                $userRole->role_id = $roleId;
                $userRole->q_m_s_divisions_id = $q_m_s_divisions_id;
                $userRole->q_m_s_processes_id = $q_m_s_processes_id;
                $userRole->q_m_s_roles_id = $q_m_s_roles_id;
                $userRole->save();
            }

            if ($lastUser->name != $request->name) {
                $validation2 = new AdminUserAuditTrial();
                $validation2->admin_id = $user->id;
                $validation2->previous = $lastUser->name;
                $validation2->current = $request->name;
                $validation2->activity_type = 'Name';
                $validation2->user_id = auth()->user()?->id;
                $validation2->user_name = auth()->user()?->name;
                $validation2->user_role = RoleGroup::where('id', auth()->user()?->role)->value('name');

                $validation2->change_to =   "Not Applicable";
                $validation2->change_from = $lastUser->status;
                if (is_null($lastUser->name) || $lastUser->name === '') {
                    $validation2->action_name = 'New';
                } else {
                    $validation2->action_name = 'Update';
                }
                $validation2->save();
            }

             if ($lastUser->emp_code != $request->emp_code) {
                $validation2 = new AdminUserAuditTrial();
                $validation2->admin_id = $user->id;
                $validation2->previous = $lastUser->emp_code;
                $validation2->current = $request->emp_code;
                $validation2->activity_type = 'Code';
                $validation2->user_id = auth()->user()?->id;
                $validation2->user_name = auth()->user()?->emp_code;
                $validation2->user_role = RoleGroup::where('id', auth()->user()?->role)->value('name');

                $validation2->change_to =   "Not Applicable";
                $validation2->change_from = $lastUser->status;
                if (is_null($lastUser->emp_code) || $lastUser->emp_code === '') {
                    $validation2->action_name = 'New';
                } else {
                    $validation2->action_name = 'Update';
                }
                $validation2->save();
            }

            if ($lastUser->email != $request->email) {
                $validation2 = new AdminUserAuditTrial();
                $validation2->admin_id = $user->id;
                $validation2->previous = $lastUser->email;
                $validation2->current = $request->email;
                $validation2->activity_type = 'Email';
                $validation2->user_id = auth()->user()?->id;
                $validation2->user_email = auth()->user()?->email;
                $validation2->user_role = RoleGroup::where('id', auth()->user()?->role)->value('name');

                $validation2->change_to =   "Not Applicable";
                $validation2->change_from = $lastUser->status;
                if (is_null($lastUser->email) || $lastUser->email === '') {
                    $validation2->action_name = 'New';
                } else {
                    $validation2->action_name = 'Update';
                }
                $validation2->save();
            }

            if ($lastUser->departmentid != $request->departmentid) {
                $currentDepartmentName = Department::where('id', $request->departmentid)->value('name');

                $previousDepartmentName = Department::where('id', $lastUser->departmentid)->value('name');

                if (!$currentDepartmentName) {
                    \Log::error('Department not found for ID: ' . $request->departmentid);
                    $currentDepartmentName = 'Unknown';
                }
                if (!$previousDepartmentName) {
                    \Log::error('Department not found for ID: ' . $lastUser->departmentid);
                    $previousDepartmentName = 'Unknown';
                }

                $validation2 = new AdminUserAuditTrial();
                $validation2->admin_id = $user->id;
                $validation2->previous = $previousDepartmentName;
                $validation2->current = $currentDepartmentName;
                $validation2->activity_type = 'Department';
                $validation2->user_id = auth()->user()?->id;
                $validation2->user_name = auth()->user()?->name;
                $validation2->user_role = RoleGroup::where('id', auth()->user()?->role)->value('name');
                $validation2->change_to = $currentDepartmentName;
                $validation2->change_from = $previousDepartmentName;
                if (is_null($previousDepartmentName->email) || $previousDepartmentName->email === '') {
                    $validation2->action_name = 'New';
                } else {
                    $validation2->action_name = 'Update';
                }
                $validation2->save();
            }

            if ($lastUser->role != $request->role) {
                $oldRoleNames = DB::table('role_groups')
                    ->whereIn('id', explode(',', $lastUser->role))
                    ->pluck('name')
                    ->toArray();
                $oldRoleNamesString = implode(', ', $oldRoleNames);

                $newRoleNames = DB::table('role_groups')
                    ->whereIn('id', explode(',', $request->role))
                    ->pluck('name')
                    ->toArray();
                $newRoleNamesString = implode(', ', $newRoleNames);

                if (empty($oldRoleNamesString)) {
                    $oldRoleNamesString = 'Null';
                }
                if (empty($newRoleNamesString)) {
                    $newRoleNamesString = 'Unknown';
                }

                $validation2 = new AdminUserAuditTrial();
                $validation2->admin_id = $user->id;
                $validation2->previous = $oldRoleNamesString;
                $validation2->current = $newRoleNamesString;
                $validation2->activity_type = 'Roles';
                $validation2->user_id = auth()->user()?->id;
                $validation2->user_name = auth()->user()?->name;
                $validation2->user_role = RoleGroup::where('id', auth()->user()?->role)->value('name');
                $validation2->change_to = "Not Applicable";
                $validation2->change_from = $lastUser->status;

                if (is_null($lastUser->role) || $lastUser->role === '') {
                    $validation2->action_name = 'New';
                } else {
                    $validation2->action_name = 'Update';
                }

                $validation2->save();
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

     public function AdminAuditTrail()
    {
        $users = User::all();
        $admin_audit = AdminUserAuditTrial::paginate(5);
        return view('admin.account.admin_user_auditTrial', compact('users','admin_audit'));
    }


}
