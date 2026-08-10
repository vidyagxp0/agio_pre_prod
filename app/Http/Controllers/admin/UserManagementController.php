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
        $request->validate([
            'name' => 'required|string|max:255',
            'emp_code' => 'required|string|max:255|unique:users,emp_code',
            'email' => 'required|email',
            'departmentid' => 'required',
            'roles' => 'required|array',

            'password' => [
                'required',
                'min:7',
                'max:20',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
            ],
        ], [
            'password.min' => 'Password must be at least 7 characters.',
            'password.max' => 'Password must not exceed 20 characters.',
            'password.regex' => 'Password must include uppercase, lowercase, number and special character.',
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
                        $validation2->current = $request->emp_code;
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

                    if (!empty($request->password)) {
                        $validation2 = new AdminUserAuditTrial();
                        $validation2->admin_id = $user->id;
                        $validation2->previous = "Null";
                        $validation2->current = Hash::make($request->password);
                        $validation2->activity_type = 'Password';
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
    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'emp_code' => [
    //             'required',
    //             'string',
    //             'max:255',
    //             Rule::unique('users', 'emp_code')->ignore($id)
    //         ],
    //         'email' => 'required|email',
    //         'departmentid' => 'required',
    //         'roles' => 'required|array',

    //         'password' => [
    //             'nullable',
    //             'min:7',
    //             'max:20',
    //             'regex:/[a-z]/',
    //             'regex:/[A-Z]/',
    //             'regex:/[0-9]/',
    //             'regex:/[@$!%*#?&]/',
    //         ],
    //     ], [
    //         'password.min' => 'Password must be at least 7 characters.',
    //         'password.max' => 'Password must not exceed 20 characters.',
    //         'password.regex' => 'Password must include uppercase, lowercase, number and special character.',
    //     ]);

    //     $user = User::with('userRoles')->find($id); 
    //     $lastUser = User::with('userRoles')->find($id);

    //     $oldRoles = $lastUser->userRoles
    //     ->pluck('role_id')
    //     ->sort()
    //     ->values()
    //     ->toArray();

    //     $newRoles = collect($request->roles)
    //     ->sort()
    //     ->values() 
    //     ->toArray();
    //     //  Validation (IGNORE current user)


    //     $user->name = $request->name;
    //     $user->emp_code = $request->emp_code;
    //     $user->email = $request->email;
    //     if (!empty($request->password)) {
    //         $user->password = Hash::make($request->password);
    //         // $user->force_password_change = 0;
    //         // $user->password_change_time = null;
    //         // $user->failed_attempts = 0;
    //         // $user->locked_at = null;
    //     }
    //     $user->departmentid = $request->departmentid;

    //     if ($user->save()) {

    //         // cft person code here
    //         $oldName = $lastUser->name;
    //         $newName = $request->name;

    //         if ($oldName != $newName) {

    //             $personColumns = [
    //                 'Production_person',
    //                 'Quality_Control_Person',
    //                 'QualityAssurance_person',
    //                 'Engineering_person',
    //                 'Analytical_Development_person',
    //                 'Kilo_Lab_person',
    //                 'Technology_transfer_person',
    //                 'Environment_Health_Safety_person',
    //                 'Human_Resource_person',
    //                 'Information_Technology_person',
    //                 'Project_management_person',
    //                 'Other1_person',
    //                 'Other2_person',
    //                 'Other3_person',
    //                 'Other4_person',
    //                 'Other5_person',
    //                 'RA_person',
    //                 'Production_Table_Person',
    //                 'Production_Injection_Person',
    //                 'ProductionInjection_person',
    //                 'ProductionLiquid_person',
    //                 'Store_person',
    //                 'ResearchDevelopment_person',
    //                 'Microbiology_person',
    //                 'RegulatoryAffair_person',
    //                 'CorporateQualityAssurance_person',
    //                 'ContractGiver_person',
    //                 'RA_data_person',
    //                 'QA_CQA_person',
    //             ];

    //             $tables = [
    //                 'cc_cfts',
    //                 'deviationcfts',
    //                 'risk_managment_cfts',
    //                 'external_audit_c_f_t_s',
    //                 'market_complaint_cfts',
    //             ];

    //             foreach ($tables as $table) {

    //                 $records = DB::table($table)->get();

    //                 foreach ($records as $record) {

    //                     $updateData = [];

    //                     foreach ($personColumns as $column) {

    //                         if (
    //                             property_exists($record, $column) &&
    //                             !empty($record->$column) &&
    //                             strpos($record->$column, $oldName) !== false
    //                         ) {

    //                             $updateData[$column] = str_replace(
    //                                 $oldName,
    //                                 $newName,
    //                                 $record->$column
    //                             );
    //                         }
    //                     }

    //                     if (!empty($updateData)) {
    //                         DB::table($table)
    //                             ->where('id', $record->id)
    //                             ->update($updateData);
    //                     }
    //                 }
    //             }
    //         }

    //         // Delete existing user roles
    //         $user->userRoles()->delete();

    //         // Attach new roles
    //         foreach ($request->roles as $roleId) {
    //             $userRole = new UserRole();                
    //             $checkRole = Roles::find($roleId);

    //             // Split the string using the '-' delimiter
    //             $roleArray = explode('-', $checkRole->name);

    //             // Assign values to three variables
    //             $q_m_s_divisions_name = trim($roleArray[0]);
    //             $q_m_s_processes_name = trim($roleArray[1]);
    //             $q_m_s_roles_name = trim($roleArray[2]);
    //             // Assuming you have models for q_m_s_divisions and q_m_s_process
    //             $division = QMSDivision::where('name', $q_m_s_divisions_name)->first();
    //             $process = QMSProcess::where('process_name', $q_m_s_processes_name)->where('division_id', $division->id)->first();
    //             $qmsroles = QMSRoles::where('name', $q_m_s_roles_name)->first();
    //             $q_m_s_divisions_id = $division->id;
    //             $q_m_s_processes_id = $process?->id;
    //             $q_m_s_roles_id = $qmsroles->id;
    //             $userRole->user_id = $user->id;
    //             $userRole->role_id = $roleId;
    //             $userRole->q_m_s_divisions_id = $q_m_s_divisions_id;
    //             $userRole->q_m_s_processes_id = $q_m_s_processes_id;
    //             $userRole->q_m_s_roles_id = $q_m_s_roles_id;
    //             $userRole->save();
    //         }

    //         if ($lastUser->name != $request->name) {
    //             $validation2 = new AdminUserAuditTrial();
    //             $validation2->admin_id = $user->id;
    //             $validation2->previous = $lastUser->name;
    //             $validation2->current = $request->name;
    //             $validation2->activity_type = 'Name';
    //             $validation2->user_id = auth()->user()?->id;
    //             $validation2->user_name = auth()->user()?->name;
    //             $validation2->user_role = RoleGroup::where('id', auth()->user()?->role)->value('name');

    //             $validation2->change_to =   "Not Applicable";
    //             $validation2->change_from = $lastUser->status;
    //             if (is_null($lastUser->name) || $lastUser->name === '') {
    //                 $validation2->action_name = 'New';
    //             } else {
    //                 $validation2->action_name = 'Update';
    //             }
    //             $validation2->save();
    //         }

    //         if ($lastUser->emp_code != $request->emp_code) {
    //             $validation2 = new AdminUserAuditTrial();
    //             $validation2->admin_id = $user->id;
    //             $validation2->previous = $lastUser->emp_code;
    //             $validation2->current = $request->emp_code;
    //             $validation2->activity_type = 'Code';
    //             $validation2->user_id = auth()->user()?->id;
    //             $validation2->user_name = auth()->user()?->emp_code;
    //             $validation2->user_role = RoleGroup::where('id', auth()->user()?->role)->value('name');

    //             $validation2->change_to =   "Not Applicable";
    //             $validation2->change_from = $lastUser->status;
    //             if (is_null($lastUser->emp_code) || $lastUser->emp_code === '') {
    //                 $validation2->action_name = 'New';
    //             } else {
    //                 $validation2->action_name = 'Update';
    //             }
    //             $validation2->save();
    //         }

    //         if ($lastUser->email != $request->email) {
    //             $validation2 = new AdminUserAuditTrial();
    //             $validation2->admin_id = $user->id;
    //             $validation2->previous = $lastUser->email;
    //             $validation2->current = $request->email;
    //             $validation2->activity_type = 'Email';
    //             $validation2->user_id = auth()->user()?->id;
    //             $validation2->user_name = auth()->user()?->name;
    //             $validation2->user_role = RoleGroup::where('id', auth()->user()?->role)->value('name');

    //             $validation2->change_to =   "Not Applicable";
    //             $validation2->change_from = $lastUser->status;
    //             if (is_null($lastUser->email) || $lastUser->email === '') {
    //                 $validation2->action_name = 'New';
    //             } else {
    //                 $validation2->action_name = 'Update';
    //             }
    //             $validation2->save();
    //         }
            
    //         if ($lastUser->password != $request->password) {
    //             $validation2 = new AdminUserAuditTrial();
    //             $validation2->admin_id = $user->id;
    //             // old hashed password
    //             $validation2->previous = $lastUser->password;

    //             // new hashed password
    //             $validation2->current = Hash::make($request->password);
    //             $validation2->activity_type = 'Password';
    //             $validation2->user_id = auth()->user()?->id;
    //             $validation2->user_name = auth()->user()?->name;
    //             $validation2->user_role = RoleGroup::where('id', auth()->user()?->role)->value('name');

    //             $validation2->change_to =   "Not Applicable";
    //             $validation2->change_from = $lastUser->status;
    //             if (is_null($lastUser->password) || $lastUser->password === '') {
    //                 $validation2->action_name = 'New';
    //             } else {
    //                 $validation2->action_name = 'Update';
    //             }
    //             $validation2->save();
    //         }

    //     if ($lastUser->departmentid != $request->departmentid) {
    //         $currentDepartmentName = Department::where('id', $request->departmentid)->value('name');

    //         $previousDepartmentName = Department::where('id', $lastUser->departmentid)->value('name');

    //         if (!$currentDepartmentName) {
    //             \Log::error('Department not found for ID: ' . $request->departmentid);
    //             $currentDepartmentName = 'Unknown';
    //         }
    //         if (!$previousDepartmentName) {
    //             \Log::error('Department not found for ID: ' . $lastUser->departmentid);
    //             $previousDepartmentName = 'Unknown';
    //         }

    //         $validation2 = new AdminUserAuditTrial();
    //         $validation2->admin_id = $user->id;
    //         $validation2->previous = $previousDepartmentName;
    //         $validation2->current = $currentDepartmentName;
    //         $validation2->activity_type = 'Department';
    //         $validation2->user_id = auth()->user()?->id;
    //         $validation2->user_name = auth()->user()?->name;
    //         $validation2->user_role = RoleGroup::where('id', auth()->user()?->role)->value('name');
    //         $validation2->change_to = $currentDepartmentName;
    //         $validation2->change_from = $previousDepartmentName;
    //         if (is_null($previousDepartmentName) || $previousDepartmentName === '') {
    //             $validation2->action_name = 'New';
    //         } else {
    //             $validation2->action_name = 'Update';
    //         }
    //         $validation2->save();
    //     }
    //         // old code
    //         // if ($oldRoles != $newRoles) {

    //         //     $oldRoleNames = Roles::whereIn('id', $oldRoles)
    //         //         ->pluck('name')
    //         //         ->implode(', ');

    //         //     $newRoleNames = Roles::whereIn('id', $newRoles)
    //         //         ->pluck('name')
    //         //         ->implode(', ');

    //         //     $validation2 = new AdminUserAuditTrial();
    //         //     $validation2->admin_id = $user->id;
    //         //     $validation2->previous = $oldRoleNames ?: 'Null';
    //         //     $validation2->current = $newRoleNames ?: 'Null';
    //         //     $validation2->activity_type = 'Roles';
    //         //     $validation2->user_id = auth()->id();
    //         //     $validation2->user_name = auth()->user()?->name;
    //         //     $validation2->user_role = RoleGroup::where(
    //         //         'id',
    //         //         auth()->user()?->role
    //         //     )->value('name');

    //         //     $validation2->change_to = $newRoleNames;
    //         //     $validation2->change_from = $oldRoleNames;
    //         //     $validation2->action_name = 'Update';

    //         //     $validation2->save();
    //         // }

    //         // new code
    //         if ($oldRoles != $newRoles) {

    //             // Old role names
    //             $oldRoleNamesArray = Roles::whereIn('id', $oldRoles)
    //                 ->pluck('name')
    //                 ->toArray();

    //             // New role names
    //             $newRoleNamesArray = Roles::whereIn('id', $newRoles)
    //                 ->pluck('name')
    //                 ->toArray();

    //             // Convert to strings
    //             $oldRoleNames = implode(', ', $oldRoleNamesArray);
    //             $newRoleNames = implode(', ', $newRoleNamesArray);

    //             /*
    //             |--------------------------------------------------------------------------
    //             | Find Added Roles
    //             |--------------------------------------------------------------------------
    //             */

    //             $addedRoles = array_diff(
    //                 $newRoleNamesArray,
    //                 $oldRoleNamesArray
    //             );

    //             /*
    //             |--------------------------------------------------------------------------
    //             | Find Removed Roles
    //             |--------------------------------------------------------------------------
    //             */

    //             $removedRoles = array_diff(
    //                 $oldRoleNamesArray,
    //                 $newRoleNamesArray
    //             );

    //             $addedRolesString = !empty($addedRoles)
    //                 ? implode(', ', $addedRoles)
    //                 : 'None';

    //             $removedRolesString = !empty($removedRoles)
    //                 ? implode(', ', $removedRoles)
    //                 : 'None';


    //             /*
    //             |--------------------------------------------------------------------------
    //             | Audit Trail
    //             |--------------------------------------------------------------------------
    //             */

    //             $validation2 = new AdminUserAuditTrial();

    //             // Target user whose roles were changed
    //             $validation2->admin_id = $user->id;

    //             // Previous and current complete roles
    //             $validation2->previous = $oldRoleNames ?: 'Null';
    //             $validation2->current = $newRoleNames ?: 'Null';

    //             $validation2->activity_type = 'Roles';

    //             // Admin who performed the change
    //             $validation2->user_id = auth()->id();
    //             $validation2->user_name = auth()->user()?->name;

    //             $validation2->user_role = RoleGroup::where(
    //                 'id',
    //                 auth()->user()?->role
    //             )->value('name');

    //             // Detailed change information
    //             $validation2->change_from = $removedRolesString;
    //             $validation2->change_to = $addedRolesString;

    //             $validation2->action_name = 'Update';

    //             $validation2->save();
    //         }
    //         toastr()->success('Update successfully');
    //         return redirect()->route('user_management.index');
    //     } else {
    //         toastr()->error('Something went wrong');
    //         return redirect()->back();
    //     }
    // }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',

            'emp_code' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'emp_code')->ignore($id),
            ],

            'email' => 'required|email',
            'departmentid' => 'required',
            'roles' => 'required|array',

            'password' => [
                'nullable',
                'min:7',
                'max:20',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
            ],
        ], [
            'password.min' => 'Password must be at least 7 characters.',
            'password.max' => 'Password must not exceed 20 characters.',
            'password.regex' => 'Password must include uppercase, lowercase, number and special character.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Get User
        |--------------------------------------------------------------------------
        */

        $user = User::with('userRoles')->findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Store OLD values BEFORE updating anything
        |--------------------------------------------------------------------------
        */

        $oldName = $user->name;
        $oldEmpCode = $user->emp_code;
        $oldEmail = $user->email;
        $oldDepartmentId = $user->departmentid;
        $oldPassword = $user->password;

        /*
        |--------------------------------------------------------------------------
        | OLD ROLES
        | IMPORTANT: Get roles before deleting/recreating them
        |--------------------------------------------------------------------------
        */

        $oldRoles = $user->userRoles
            ->pluck('role_id')
            ->map(fn ($roleId) => (int) $roleId)
            ->sort()
            ->values()
            ->toArray();


        /*
        |--------------------------------------------------------------------------
        | NEW ROLES
        |--------------------------------------------------------------------------
        */

        $newRoles = collect($request->roles ?? [])
            ->map(fn ($roleId) => (int) $roleId)
            ->sort()
            ->values()
            ->toArray();


        /*
        |--------------------------------------------------------------------------
        | Store NEW request values
        |--------------------------------------------------------------------------
        */

        $newName = $request->name;
        $newEmpCode = $request->emp_code;
        $newEmail = $request->email;
        $newDepartmentId = $request->departmentid;


        /*
        |--------------------------------------------------------------------------
        | Update User Basic Information
        |--------------------------------------------------------------------------
        */

        $user->name = $newName;
        $user->emp_code = $newEmpCode;
        $user->email = $newEmail;
        $user->departmentid = $newDepartmentId;


        /*
        |--------------------------------------------------------------------------
        | PASSWORD UPDATE
        |
        | Only update password when user actually entered a new password.
        |--------------------------------------------------------------------------
        */

        $passwordChanged = false;

        if (!empty($request->password)) {

            $user->password = Hash::make($request->password);

            $passwordChanged = true;
        }


        /*
        |--------------------------------------------------------------------------
        | Save User
        |--------------------------------------------------------------------------
        */

        if ($user->save()) {


            /*
            |--------------------------------------------------------------------------
            | CFT PERSON NAME UPDATE
            |--------------------------------------------------------------------------
            */

            if ($oldName != $newName) {

                $personColumns = [
                    'Production_person',
                    'Quality_Control_Person',
                    'QualityAssurance_person',
                    'Engineering_person',
                    'Analytical_Development_person',
                    'Kilo_Lab_person',
                    'Technology_transfer_person',
                    'Environment_Health_Safety_person',
                    'Human_Resource_person',
                    'Information_Technology_person',
                    'Project_management_person',
                    'Other1_person',
                    'Other2_person',
                    'Other3_person',
                    'Other4_person',
                    'Other5_person',
                    'RA_person',
                    'Production_Table_Person',
                    'Production_Injection_Person',
                    'ProductionInjection_person',
                    'ProductionLiquid_person',
                    'Store_person',
                    'ResearchDevelopment_person',
                    'Microbiology_person',
                    'RegulatoryAffair_person',
                    'CorporateQualityAssurance_person',
                    'ContractGiver_person',
                    'RA_data_person',
                    'QA_CQA_person',
                ];

                $tables = [
                    'cc_cfts',
                    'deviationcfts',
                    'risk_managment_cfts',
                    'external_audit_c_f_t_s',
                    'market_complaint_cfts',
                ];

                foreach ($tables as $table) {

                    $records = DB::table($table)->get();

                    foreach ($records as $record) {

                        $updateData = [];

                        foreach ($personColumns as $column) {

                            if (
                                property_exists($record, $column) &&
                                !empty($record->$column) &&
                                strpos($record->$column, $oldName) !== false
                            ) {

                                $updateData[$column] = str_replace(
                                    $oldName,
                                    $newName,
                                    $record->$column
                                );
                            }
                        }

                        if (!empty($updateData)) {

                            DB::table($table)
                                ->where('id', $record->id)
                                ->update($updateData);
                        }
                    }
                }
            }


            /*
            |--------------------------------------------------------------------------
            | DELETE OLD USER ROLES
            |--------------------------------------------------------------------------
            |
            | This can happen every time, but AUDIT is based on
            | $oldRoles and $newRoles captured BEFORE this operation.
            |
            |--------------------------------------------------------------------------
            */

            $user->userRoles()->delete();


            /*
            |--------------------------------------------------------------------------
            | CREATE NEW USER ROLES
            |--------------------------------------------------------------------------
            */

            foreach ($newRoles as $roleId) {

                $checkRole = Roles::find($roleId);

                if (!$checkRole) {
                    continue;
                }


                /*
                |--------------------------------------------------------------------------
                | Split Role Name
                |--------------------------------------------------------------------------
                */

                $roleArray = explode('-', $checkRole->name);

                $q_m_s_divisions_name = trim($roleArray[0] ?? '');
                $q_m_s_processes_name = trim($roleArray[1] ?? '');
                $q_m_s_roles_name = trim($roleArray[2] ?? '');


                /*
                |--------------------------------------------------------------------------
                | Get QMS Data
                |--------------------------------------------------------------------------
                */

                $division = QMSDivision::where(
                    'name',
                    $q_m_s_divisions_name
                )->first();

                if (!$division) {
                    \Log::error('QMS Division not found', [
                        'division_name' => $q_m_s_divisions_name,
                        'role_id' => $roleId,
                        'role_name' => $checkRole->name,
                    ]);

                    continue;
                }


                $process = QMSProcess::where(
                    'process_name',
                    $q_m_s_processes_name
                )
                    ->where('division_id', $division->id)
                    ->first();

                if (!$process) {
                    \Log::error('QMS Process not found', [
                        'process_name' => $q_m_s_processes_name,
                        'division_id' => $division->id,
                        'division_name' => $q_m_s_divisions_name,
                        'role_id' => $roleId,
                        'role_name' => $checkRole->name,
                    ]);

                    continue;
                }


                $qmsroles = QMSRoles::where(
                    'name',
                    $q_m_s_roles_name
                )->first();

                if (!$qmsroles) {
                    \Log::error('QMS Role not found', [
                        'qms_role_name' => $q_m_s_roles_name,
                        'role_id' => $roleId,
                        'role_name' => $checkRole->name,
                    ]);

                    continue;
                }
                /*
                |--------------------------------------------------------------------------
                | Save User Role
                |--------------------------------------------------------------------------
                */

                $userRole = new UserRole();

                $userRole->user_id = $user->id;
                $userRole->role_id = $roleId;
                $userRole->q_m_s_divisions_id = $division->id;
                $userRole->q_m_s_processes_id = $process?->id;
                $userRole->q_m_s_roles_id = $qmsroles->id;

                $userRole->save();
            }


            /*
            |--------------------------------------------------------------------------
            | AUDIT: NAME
            |--------------------------------------------------------------------------
            */

            if ($oldName !== $newName) {

                $validation2 = new AdminUserAuditTrial();

                $validation2->admin_id = $user->id;
                $validation2->previous = $oldName ?: 'Null';
                $validation2->current = $newName ?: 'Null';
                $validation2->activity_type = 'Name';

                $validation2->user_id = auth()->user()?->id;
                $validation2->user_name = auth()->user()?->name;

                $validation2->user_role = RoleGroup::where(
                    'id',
                    auth()->user()?->role
                )->value('name');

                $validation2->change_from = $oldName ?: 'Null';
                $validation2->change_to = $newName ?: 'Null';
                $validation2->action_name = 'Update';

                $validation2->save();
            }


            /*
            |--------------------------------------------------------------------------
            | AUDIT: EMPLOYEE CODE
            |--------------------------------------------------------------------------
            */

            if ($oldEmpCode !== $newEmpCode) {

                $validation2 = new AdminUserAuditTrial();

                $validation2->admin_id = $user->id;
                $validation2->previous = $oldEmpCode ?: 'Null';
                $validation2->current = $newEmpCode ?: 'Null';
                $validation2->activity_type = 'Code';

                $validation2->user_id = auth()->user()?->id;
                $validation2->user_name = auth()->user()?->name;

                $validation2->user_role = RoleGroup::where(
                    'id',
                    auth()->user()?->role
                )->value('name');

                $validation2->change_from = $oldEmpCode ?: 'Null';
                $validation2->change_to = $newEmpCode ?: 'Null';
                $validation2->action_name = 'Update';

                $validation2->save();
            }


            /*
            |--------------------------------------------------------------------------
            | AUDIT: EMAIL
            |--------------------------------------------------------------------------
            */

            if ($oldEmail !== $newEmail) {

                $validation2 = new AdminUserAuditTrial();

                $validation2->admin_id = $user->id;
                $validation2->previous = $oldEmail ?: 'Null';
                $validation2->current = $newEmail ?: 'Null';
                $validation2->activity_type = 'Email';

                $validation2->user_id = auth()->user()?->id;
                $validation2->user_name = auth()->user()?->name;

                $validation2->user_role = RoleGroup::where(
                    'id',
                    auth()->user()?->role
                )->value('name');

                $validation2->change_from = $oldEmail ?: 'Null';
                $validation2->change_to = $newEmail ?: 'Null';
                $validation2->action_name = 'Update';

                $validation2->save();
            }


            /*
            |--------------------------------------------------------------------------
            | AUDIT: PASSWORD
            |--------------------------------------------------------------------------
            |
            | IMPORTANT:
            | Password audit is created ONLY when password field
            | was actually provided.
            |
            | Never store old/new password hash in audit trail.
            |
            |--------------------------------------------------------------------------
            */

            if ($passwordChanged) {

                $validation2 = new AdminUserAuditTrial();

                $validation2->admin_id = $user->id;

                $validation2->previous = '********';
                $validation2->current = 'Password Updated';

                $validation2->activity_type = 'Password';

                $validation2->user_id = auth()->user()?->id;
                $validation2->user_name = auth()->user()?->name;

                $validation2->user_role = RoleGroup::where(
                    'id',
                    auth()->user()?->role
                )->value('name');

                $validation2->change_from = 'Password Changed';
                $validation2->change_to = 'Password Updated';
                $validation2->action_name = 'Update';

                $validation2->save();
            }


            /*
            |--------------------------------------------------------------------------
            | AUDIT: DEPARTMENT
            |--------------------------------------------------------------------------
            */

            if ((int) $oldDepartmentId !== (int) $newDepartmentId) {

                $currentDepartmentName = Department::where(
                    'id',
                    $newDepartmentId
                )->value('name');

                $previousDepartmentName = Department::where(
                    'id',
                    $oldDepartmentId
                )->value('name');


                $currentDepartmentName = $currentDepartmentName ?: 'Unknown';
                $previousDepartmentName = $previousDepartmentName ?: 'Unknown';


                $validation2 = new AdminUserAuditTrial();

                $validation2->admin_id = $user->id;

                $validation2->previous = $previousDepartmentName;
                $validation2->current = $currentDepartmentName;

                $validation2->activity_type = 'Department';

                $validation2->user_id = auth()->user()?->id;
                $validation2->user_name = auth()->user()?->name;

                $validation2->user_role = RoleGroup::where(
                    'id',
                    auth()->user()?->role
                )->value('name');

                $validation2->change_from = $previousDepartmentName;
                $validation2->change_to = $currentDepartmentName;
                $validation2->action_name = 'Update';

                $validation2->save();
            }


            /*
            |--------------------------------------------------------------------------
            | AUDIT: ROLES
            |--------------------------------------------------------------------------
            |
            | IMPORTANT:
            | Compare OLD roles with NEW roles.
            |
            | If same roles -> NO AUDIT.
            |
            |--------------------------------------------------------------------------
            */

            if ($oldRoles !== $newRoles) {


                /*
                |--------------------------------------------------------------------------
                | Old Role Names
                |--------------------------------------------------------------------------
                */

                $oldRoleNamesArray = [];

                if (!empty($oldRoles)) {

                    $oldRoleNamesArray = Roles::whereIn(
                        'id',
                        $oldRoles
                    )
                        ->pluck('name')
                        ->toArray();
                }


                /*
                |--------------------------------------------------------------------------
                | New Role Names
                |--------------------------------------------------------------------------
                */

                $newRoleNamesArray = [];

                if (!empty($newRoles)) {

                    $newRoleNamesArray = Roles::whereIn(
                        'id',
                        $newRoles
                    )
                        ->pluck('name')
                        ->toArray();
                }


                /*
                |--------------------------------------------------------------------------
                | Complete Old/New Roles
                |--------------------------------------------------------------------------
                */

                $oldRoleNames = !empty($oldRoleNamesArray)
                    ? implode(', ', $oldRoleNamesArray)
                    : 'Null';

                $newRoleNames = !empty($newRoleNamesArray)
                    ? implode(', ', $newRoleNamesArray)
                    : 'Null';


                /*
                |--------------------------------------------------------------------------
                | Added Roles
                |--------------------------------------------------------------------------
                */

                $addedRoles = array_diff(
                    $newRoleNamesArray,
                    $oldRoleNamesArray
                );

                $addedRolesString = !empty($addedRoles)
                    ? implode(', ', $addedRoles)
                    : 'None';


                /*
                |--------------------------------------------------------------------------
                | Removed Roles
                |--------------------------------------------------------------------------
                */

                $removedRoles = array_diff(
                    $oldRoleNamesArray,
                    $newRoleNamesArray
                );

                $removedRolesString = !empty($removedRoles)
                    ? implode(', ', $removedRoles)
                    : 'None';


                /*
                |--------------------------------------------------------------------------
                | Create Roles Audit
                |--------------------------------------------------------------------------
                */

                $validation2 = new AdminUserAuditTrial();

                $validation2->admin_id = $user->id;

                $validation2->previous = $oldRoleNames;
                $validation2->current = $newRoleNames;

                $validation2->activity_type = 'Roles';

                $validation2->user_id = auth()->user()?->id;
                $validation2->user_name = auth()->user()?->name;

                $validation2->user_role = RoleGroup::where(
                    'id',
                    auth()->user()?->role
                )->value('name');


                /*
                |--------------------------------------------------------------------------
                | Added / Removed Role Details
                |--------------------------------------------------------------------------
                */

                $validation2->change_from = $removedRolesString;
                $validation2->change_to = $addedRolesString;

                $validation2->action_name = 'Update';

                $validation2->save();
            }


            /*
            |--------------------------------------------------------------------------
            | Success
            |--------------------------------------------------------------------------
            */

            toastr()->success('Update successfully');

            return redirect()->route('user_management.index');
        }


        /*
        |--------------------------------------------------------------------------
        | Save Failed
        |--------------------------------------------------------------------------
        */

        toastr()->error('Something went wrong');

        return redirect()->back();
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
        $admin_audit = AdminUserAuditTrial::orderBy('id', 'desc')->paginate(5);
        return view('admin.account.admin_user_auditTrial', compact('users','admin_audit'));
    }


}
