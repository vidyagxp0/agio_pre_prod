<?php
// namespace App;

use App\Http\Controllers\ExtensionNewController;
use App\Models\ActionItem;
use App\Models\Division;
use App\Models\Document;
use App\Models\extension_new;
use App\Models\QMSDivision;
use App\Models\QMSProcess;
use App\Models\User;
use App\Models\PrintControl;
use App\Models\UserRole;
use App\Models\Employee;
use App\Models\Deviation;
use App\Models\LabIncident;
use App\Models\OOS_micro;
use App\Models\OOS;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class Helpers
{
    public static function getArrayKey(array $array, $key)
    {
        return $array && is_array($array) && array_key_exists($key, $array) ? $array[$key] : '';
    }

    public static function getDefaultResponse()
    {
        $res = [
            'status' => 'ok',
            'message' => 'success',
            'body' => []
        ];

        return $res;
    }

    public static function getDueDate($days = 30, $formatDate = true)
    {
        try {

            $date = Carbon::now()->addDays($days);
            $formatted_date = $formatDate ? $date->format("d-F-Y") : $date->format('Y-m-d');
            return $formatted_date;

        } catch (\Exception $e) {
            return "01-Jan-1999";
        }
    }
    // public static function getdateFormat($date)
    // {
    //     $date = Carbon::parse($date);
    //     $formatted_date = $date->format("d-M-Y");
    //     return $formatted_date;
    // }
    // public static function getdateFormat($date)
    // {
    //     if(empty($date)) {
    //         return ''; // or any default value you prefer
    //     }
    //     // else{
    //     else{
    //         $date = Carbon::parse($date);
    //         $formatted_date = $date->format("d-M-Y");
    //         return $formatted_date;
    //     }

    // }

    public static function getdateFormat($date)
{
    if (empty($date) || !strtotime($date)) {
        return ''; // or any default value you prefer
    }
    try {
        $date = Carbon::parse($date);
        $formatted_date = $date->format("d-M-Y");
        return $formatted_date;
    } catch (\Exception $e) {
        // Log error or handle exception
        return ''; // or any default value you prefer
    }
}

    public static function getdateFormat1($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-M-Y H:i:s');
    }

    public static function isRevised($data)
    {
    {
        if($data  >= 8){
            return 'disabled';
        }else{
            return  '';
        }
    }}

    public static function isRiskAssessment($data)
    {
        if($data == 0 || $data  >= 7){
            return 'disabled';
        }else{
            return  '';
        }
    }


    public static function showStage($parentType, $model, $count)
    {
        $existingRecordsCount = $model::where('parent_type', $parentType)->count();
        return $existingRecordsCount > $count;
    }
    // public static function getHodUserList(){
    //     return $hodUserList = DB::table('user_roles')->where(['q_m_s_roles_id' =>'4'])->get();
    // }
    // public static function getQAUserList(){

    //     return $QAUserList = DB::table('user_roles')->where(['q_m_s_roles_id' =>'7'])->get();
    // }
    // public static function getInitiatorUserList(){\
    //     return $InitiatorUserList = DB::table('user_roles')->where(['q_m_s_roles_id' =>'3'])->get();
    // }
    // public static function getApproverUserList(){
    //     return $ApproverUserList = DB::table('user_roles')->where(['q_m_s_roles_id' =>'1'])->get();
    // }
    // public static function getReviewerUserList(){
    //     return $ReviewerUserList = DB::table('user_roles')->where(['q_m_s_roles_id' =>'2'])->get();
    // }
    // public static function getCFTUserList(){


    //     return $CFTUserList = DB::table('user_roles')->where(['q_m_s_roles_id' =>'5'])->get();
    // }
    // public static function getTrainerUserList(){


    //     return $TrainerUserList = DB::table('user_roles')->where(['q_m_s_roles_id' =>'6'])->get();
    // }
    // public static function getActionOwnerUserList(){


    //     return $ActionOwnerUserList = DB::table('user_roles')->where(['q_m_s_roles_id' =>'8'])->get();
    // }
    // public static function getQAHeadUserList(){


    //     return $QAHeadUserList = DB::table('user_roles')->where(['q_m_s_roles_id' =>'9'])->get();
    // }
    public static function getQCHeadUserList(){

        return $QCHeadUserList = DB::table('user_roles')->where(['q_m_s_roles_id' =>'10'])->get();
    }
    // public static function getLeadAuditeeUserList(){


    //     return $LeadAuditeeUserList = DB::table('user_roles')->where(['q_m_s_roles_id' =>'11'])->get();
    // }
    // public static function getLeadAuditorUserList(){


    //     return $LeadAuditorUserList = DB::table('user_roles')->where(['q_m_s_roles_id' =>'12'])->get();
    // }
    // public static function getAuditManagerUserList(){


    //     return $AuditManagerUserList = DB::table('user_roles')->where(['q_m_s_roles_id' =>'13'])->get();
    // }
    // public static function getSupervisorUserList(){


    //     return $SupervisorUserList = DB::table('user_roles')->where(['q_m_s_roles_id' =>'14'])->get();
    // }
    // public static function getResponsibleUserList(){


    //     return $ResponsibleUserList = DB::table('user_roles')->where(['q_m_s_roles_id' =>'15'])->get();
    // }
    // public static function getWorkGroupUserList(){


    //     return $WorkGroupUserList = DB::table('user_roles')->where(['q_m_s_roles_id' =>'16'])->get();
    // }
    // public static function getViewUserList(){


    //     return $ViewUserList = DB::table('user_roles')->where(['q_m_s_roles_id' =>'17'])->get();
    // }
    // public static function getFPUserList(){


    //     return $FPUserList = DB::table('user_roles')->where(['q_m_s_roles_id' =>'18'])->get();
    // }

    public static function checkRoles($role)
    {

        $userRoles = DB::table('user_roles')->where(['user_id' => Auth::user()->id])->get();
        $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
        if(in_array($role, $userRoleIds)){
            return true;
        }else{
            return false;
        }
        // if (strpos(Auth::user()->role, $role) !== false) {
        //    return true;
        // }else{
        //     return false;
        // }
        // }
    }

    public static function checkTMSRoles($role)
    {

        $userRoles = DB::table('user_roles')->where(['user_id' => Auth::user()->id])->get();
        $userRoleIds = $userRoles->pluck('role_id')->toArray();
        if(in_array($role, $userRoleIds)){
            return true;
        }else{
            return false;
        }
        // if (strpos(Auth::user()->role, $role) !== false) {
        //    return true;
        // }else{
        //     return false;
        // }
    }


    public static function getDivisionCode($id)
    {
        $code = '';

        switch ($id) {
            case 1:
                $code = 'CQA';
                break;
            case 2:
                $code = 'P1';
                break;
            case 3:
                $code = 'P2';
                break;
            case 4:
                $code = 'P3';
                break;
            case 5:
                $code = 'P4';
                break;
            case 6:
                $code = 'C1';
                break;
            default:
                break;
        }

        return $code;
    }


    public static function checkRoles_check_reviewers($document)
    {


        if ($document->reviewers) {
            $datauser = explode(',', $document->reviewers);
            for ($i = 0; $i < count($datauser); $i++) {
                if ($datauser[$i] == Auth::user()->id) {
                    return true;
                }
            }
        } else {
            return false;
        }
        }


    public static function checkRoles_check_approvers($document)
    {
        if ($document->approvers) {
            $datauser = explode(',', $document->approvers);
            for ($i = 0; $i < count($datauser); $i++) {
                if ($datauser[$i] == Auth::user()->id) {
                    if($document->stage >= 4){
                        return true;
                    } else {
                        return false;
                    }
                }
            }
        } else {
            return false;
        }
    }

    // public static function checkRoles_check_approvers($document)
    // {
    //     if ($document->approvers) {
    //         $datauser = explode(',', $document->approvers);
    //         for ($i = 0; $i < count($datauser); $i++) {
    //             if ($datauser[$i] == Auth::user()->id) {
    //                 if($document->stage >= 10){
    //                     return true;
    //                 } else {
    //                     return false;
    //                 }
    //             }
    //         }
    //     } else {
    //         return false;
    //     }
    // }


    public static function checkRoles_check_hods($document)
    {
        if ($document->hods) {
            $datauser = explode(',', $document->hods);
            for ($i = 0; $i < count($datauser); $i++) {
                if ($datauser[$i] == Auth::user()->id) {
                    if($document->stage >= 2){
                        return true;
                    } else {
                        return false;
                    }
                }
            }
        }
        return false;
    }

    public static function checkUserRolesApprovers($data)
    {
        $user = User::find($data->id);
        return $user->userRoles()->where('q_m_s_roles_id', 1)->exists();
    }

    public static function checkUserRolesreviewer($data)
    {
        $user = User::find($data->id);
        return $user->userRoles()->where('q_m_s_roles_id', 2)->exists();
    }

    public static function checkUserRolestrainer($data)
    {
        $user = User::find($data->id);
        return $user->userRoles()->where('q_m_s_roles_id', 6)->exists();
    }

    public static function checkUserRolesassign_to($data)
    {
        if ($data->role) {
            $datauser = explode(',', $data->role);
            for ($i = 0; $i < count($datauser); $i++) {
                if ($datauser[$i] == 4) {
                    return true;
                }
            }
        } else {
            return false;
        }
    }

    public static function checkUserRolesMicrobiology_Person($data)
    {
        if ($data->role) {
            $datauser = explode(',', $data->role);
            for ($i = 0; $i < count($datauser); $i++) {
                if ($datauser[$i] == 5) {
                    return true;
                }
            }
        } else {
            return false;
        }
    }

    // $parent ? $parent->record : '' blade file after getting parent from this function
    public static function getParentRecord($type, $id)
    {
        $parent_record = null;

        switch ($type) {
            case 'lab_incident':
                $parent_record = LabIncident::find($id);
                break;

            default:
                # code...
                break;
        }

        return $parent_record;
    }

    public static function divisionNameForQMS($id)
    {
        return QMSDivision::where('id', $id)->value('name');
    }

    public static function year($createdAt)
    {
        return Carbon::parse($createdAt)->format('Y');
    }

    public static function getDivisionName($id)
    {
        $name = DB::table('q_m_s_divisions')->where('id', $id)->where('status', 1)->value('name');
        return $name;
    }
    public static function recordFormat($number)
    {
        return   str_pad($number, 4, '0', STR_PAD_LEFT);
    }
    public static function getInitiatorName($id)
    {
        return   User::where('id',$id)->value('name');
    }

    public static function getEmpName($id)
    {
        return   Employee::where('id',$id)->value('employee_name');
    }


    public static function record($id)
    {
        return   str_pad($id, 4, '0', STR_PAD_LEFT);
    }



    /************ New Roles Starts **************/
    public static function getHodUserList($division = null){
        if (!$division) {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '4'])->select(['user_id', DB::raw('MAX(q_m_s_divisions_id) as q_m_s_divisions_id')])->groupBy('user_id')->get();
        } else {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '4', 'q_m_s_divisions_id' => $division])->select('user_id')->distinct()->get();
        }
    }

    public static function getQAUserList($division = null){
        if (!$division) {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '7'])->select(['user_id', DB::raw('MAX(q_m_s_divisions_id) as q_m_s_divisions_id')])->groupBy('user_id')->get();
        } else {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '7', 'q_m_s_divisions_id' => $division])->select('user_id')->distinct()->get();
        }
    }

    public static function getQAHeadUserList($division = null){
        if (!$division) {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '42'])->select(['user_id', DB::raw('MAX(q_m_s_divisions_id) as q_m_s_divisions_id')])->groupBy('user_id')->get();
        } else {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '42', 'q_m_s_divisions_id' => $division])->select('user_id')->distinct()->get();
        }
    }

    public static function getInitiatorUserList($division = null){
        if (!$division) {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '3'])->select(['user_id', DB::raw('MAX(q_m_s_divisions_id) as q_m_s_divisions_id')])->groupBy('user_id')->get();
        } else {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '3', 'q_m_s_divisions_id' => $division])->select('user_id')->distinct()->get();
        }
    }

    public static function getApproverUserList($division = null){
        if (!$division) {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '1'])->select(['user_id', DB::raw('MAX(q_m_s_divisions_id) as q_m_s_divisions_id')])->groupBy('user_id')->get();
        } else {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '1', 'q_m_s_divisions_id' => $division])->select('user_id')->distinct()->get();
        }
    }

    public static function getReviewerUserList($division = null){
        if (!$division) {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '2'])->select(['user_id', DB::raw('MAX(q_m_s_divisions_id) as q_m_s_divisions_id')])->groupBy('user_id')->get();
        } else {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '2', 'q_m_s_divisions_id' => $division])->select('user_id')->distinct()->get();
        }
    }

    public static function getRAUsersList($division = null){
        if (!$division) {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '50'])->select(['user_id', DB::raw('MAX(q_m_s_divisions_id) as q_m_s_divisions_id')])->groupBy('user_id')->get();
        } else {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '50', 'q_m_s_divisions_id' => $division])->select('user_id')->distinct()->get();
        }
    }

    public static function getCftUserList($division = null){
        if (!$division) {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '5'])->select(['user_id', DB::raw('MAX(q_m_s_divisions_id) as q_m_s_divisions_id')])->groupBy('user_id')->get();
        } else {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '5', 'q_m_s_divisions_id' => $division])->select('user_id')->distinct()->get();
        }
    }

    public static function getTrainerUserList($division = null){
        if (!$division) {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '6'])->select(['user_id', DB::raw('MAX(q_m_s_divisions_id) as q_m_s_divisions_id')])->groupBy('user_id')->get();
        } else {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '6', 'q_m_s_divisions_id' => $division])->select('user_id')->distinct()->get();
        }
    }

    public static function getProductionUserList($division = null){
        if (!$division) {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '22'])->select(['user_id', DB::raw('MAX(q_m_s_divisions_id) as q_m_s_divisions_id')])->groupBy('user_id')->get();
        } else {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '22', 'q_m_s_divisions_id' => $division])->select('user_id')->distinct()->get();
        }
    }

    public static function getProductionHeadUserList($division = null){
        if (!$division) {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '61'])->select(['user_id', DB::raw('MAX(q_m_s_divisions_id) as q_m_s_divisions_id')])->groupBy('user_id')->get();
        } else {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '61', 'q_m_s_divisions_id' => $division])->select('user_id')->distinct()->get();
        }
    }

    public static function getCQAUsersList($division = null){
        if (!$division) {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '66'])->select(['user_id', DB::raw('MAX(q_m_s_divisions_id) as q_m_s_divisions_id')])->groupBy('user_id')->get();
        } else {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '66', 'q_m_s_divisions_id' => $division])->select('user_id')->distinct()->get();
        }
    }

    public static function getCQAHeadDesignUsersList($division = null){
        if (!$division) {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '43'])->select(['user_id', DB::raw('MAX(q_m_s_divisions_id) as q_m_s_divisions_id')])->groupBy('user_id')->get();
        } else {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '43', 'q_m_s_divisions_id' => $division])->select('user_id')->distinct()->get();
        }
    }

    public static function getCQAReviewerUsersList($division = null){
        if (!$division) {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '63'])->select(['user_id', DB::raw('MAX(q_m_s_divisions_id) as q_m_s_divisions_id')])->groupBy('user_id')->get();
        } else {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '63', 'q_m_s_divisions_id' => $division])->select('user_id')->distinct()->get();
        }
    }

    public static function getCQAApproverUsersList($division = null){
        if (!$division) {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '64'])->select(['user_id', DB::raw('MAX(q_m_s_divisions_id) as q_m_s_divisions_id')])->groupBy('user_id')->get();
        } else {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '64', 'q_m_s_divisions_id' => $division])->select('user_id')->distinct()->get();
        }
    }

    public static function getCQAHeadUsersList($division = null){
        if (!$division) {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '65'])->select(['user_id', DB::raw('MAX(q_m_s_divisions_id) as q_m_s_divisions_id')])->groupBy('user_id')->get();
        } else {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '65', 'q_m_s_divisions_id' => $division])->select('user_id')->distinct()->get();
        }
    }


    public static function getLeadAuditeeUsersList($division = null){
        if (!$division) {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '11'])->select(['user_id', DB::raw('MAX(q_m_s_divisions_id) as q_m_s_divisions_id')])->groupBy('user_id')->get();
        } else {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '11', 'q_m_s_divisions_id' => $division])->select('user_id')->distinct()->get();
        }
    }

    public static function getLeadAuditorUsersList($division = null){
        if (!$division) {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '12'])->select(['user_id', DB::raw('MAX(q_m_s_divisions_id) as q_m_s_divisions_id')])->groupBy('user_id')->get();
        } else {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '12', 'q_m_s_divisions_id' => $division])->select('user_id')->distinct()->get();
        }
    }

    public static function getAuditManagerUsersList($division = null){
        if (!$division) {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '13'])->select(['user_id', DB::raw('MAX(q_m_s_divisions_id) as q_m_s_divisions_id')])->groupBy('user_id')->get();
        } else {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '13', 'q_m_s_divisions_id' => $division])->select('user_id')->distinct()->get();
        }
    }

    public static function getQAReviewerUserList($division = null){
        if (!$division) {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '48'])->select(['user_id', DB::raw('MAX(q_m_s_divisions_id) as q_m_s_divisions_id')])->groupBy('user_id')->get();
        } else {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '48', 'q_m_s_divisions_id' => $division])->select('user_id')->distinct()->get();
        }
    }


    public static function getHodDesigneeUserList($division = null){
        if (!$division) {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '7'])->select(['user_id', DB::raw('MAX(q_m_s_divisions_id) as q_m_s_divisions_id')])->groupBy('user_id')->get();
        } else {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '7', 'q_m_s_divisions_id' => $division])->select('user_id')->distinct()->get();
        }
    }


  public static function getAssignToUserList($division = null){
        if (!$division) {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '7'])->select(['user_id', DB::raw('MAX(q_m_s_divisions_id) as q_m_s_divisions_id')])->groupBy('user_id')->get();
        } else {
            return DB::table('user_roles')->where(['q_m_s_roles_id' => '7', 'q_m_s_divisions_id' => $division])->select('user_id')->distinct()->get();
        }
    }

    /************ Updated User List Data End ***********/

    public static function getUserEmail($id){
        $email = null;
        try {
            $email  = User::find($id)->email;
        } catch (\Exception $e) {
            \Log::error('Failed to retrieve email for user ID ' . $id . ': ' . $e->getMessage());
        }
        return $email;
    }

    static function getFullDepartmentName($code)
    {
        $full_department_name = '';

        switch ($code) {
            case 'CQA':
                $full_department_name = "Corporate Quality Assurance";
                break;
            case 'QA':
                $full_department_name = "Quality Assurance";
                break;
            case 'QC':
                $full_department_name = "Quality Control";
                break;
            case 'QM':
                $full_department_name = "Quality Control (Microbiology department)";
                break;
            case 'PG':
                $full_department_name = "Production General";
                break;
            case 'PL':
                $full_department_name = "Production Liquid Orals";
                break;
            case 'PT':
                $full_department_name = "Production Tablet and Powder";
                break;
            case 'PE':
                $full_department_name = "Production External (Ointment, Gels, Creams and Liquid)";
                break;
            case 'PC':
                $full_department_name = "Production Capsules";
                break;
            case 'PI':
                $full_department_name = "Production Injectable";
                break;
            case 'EN':
                $full_department_name = "Engineering";
                break;
            case 'HR':
                $full_department_name = "Human Resource";
                break;
            case 'ST':
                $full_department_name = "Store";
                break;
            case 'IT':
                $full_department_name = "Electronic Data Processing";
                break;
            case 'FD':
                $full_department_name = "Formulation  Development";
                break;
            case 'AL':
                $full_department_name = "Analytical research and Development Laboratory";
                break;
            case 'PD':
                $full_department_name = "Packaging Development";
                break;
            case 'PU':
                $full_department_name = "Purchase Department";
                break;
            case 'DC':
                $full_department_name = "Document Cell";
                break;
            case 'RA':
                $full_department_name = "Regulatory Affairs";
                break;
            case 'PV':
                $full_department_name = "Pharmacovigilance";
                break;

            default:
                break;
        }

        return $full_department_name;

    }

    static function getDepartments()
    {
        $departments = [
            'CQA' => 'Corporate Quality Assurance',
            'QA' => 'Quality Assurance',
            'QC' => 'Quality Control',
            'QM' => 'Quality Control (Microbiology department)',
            'PG' => 'Production General',
            'PL' => 'Production Liquid Orals',
            'PT' => 'Production Tablet and Powder',
            'PE' => 'Production External (Ointment, Gels, Creams and Liquid)',
            'PC' => 'Production Capsules',
            'PI' => 'Production Injectable',
            'EN' => 'Engineering',
            'HR' => 'Human Resource',
            'ST' => 'Store',
            'IT' => 'Electronic Data Processing',
            'FD' => 'Formulation Development',
            'AL' => 'Analytical research and Development Laboratory',
            'PD' => 'Packaging Development',
            'PU' => 'Purchase Department',
            'DC' => 'Document Cell',
            'RA' => 'Regulatory Affairs',
            'PV' => 'Pharmacovigilance',
            'Other' => 'Other Department',

        ];

        return $departments;
    }

    static function getDmsDepartments()
    {
        $departments = [
            'CQA' => 'Corporate Quality Assurance',
            'QA' => 'Quality Assurance',
            'QC' => 'Quality Control',
            'QM' => 'Quality Control (Microbiology department)',
            'PG' => 'Production General',
            'PL' => 'Production Liquid Orals',
            'PT' => 'Production Tablet and Powder',
            'PE' => 'Production External (Ointment, Gels, Creams and Liquid)',
            'PC' => 'Production Capsules',
            'PI' => 'Production Injectable',
            'EN' => 'Engineering',
            'HR' => 'Human Resource',
            'ST' => 'Store',
            'IT' => 'Electronic Data Processing',
            'FD' => 'Formulation Development',
            'AL' => 'Analytical research and Development Laboratory',
            'PD' => 'Packaging Development',
            'PU' => 'Purchase Department',
            'DC' => 'Document Cell',
            'RA' => 'Regulatory Affairs',
            'PV' => 'Pharmacovigilance',
            'SA' => 'Safety',
            'AC' => 'Accounts',
            'FN' => 'Finance',
            'AW' => 'Artwork',
            'CS' => 'Company Secretary',
            'EX' => 'Exports',
            'MK' => 'Marketing',
        ];

        return $departments;
    }


    static function SOPtype($type)
    {
        $soptype = '';

        switch ($type) {
            case 'SOP (Standard Operating procedure)':
                $soptype = "STANDARD OPERATING PROCEDURE";
                break;
            case 'EOP (Equipment Operating procedure)':
                $soptype = "EQUIPMENT OPERATING PROCEDURE";
                break;
            case 'IOP (Instrument Operating Procedure)':
                $soptype = "INSTRUMENT OPERATING PROCEDURE";
                break;

            default:
                break;
        }

        return $soptype;
    }


    static function getDocumentTypes()
    {
        $document_types = [
            'SOP' => 'SOP’s (All types)',
            'FPS' => 'Finished product specification',
            'INPS' => 'Inprocess specification',
            'CVS' => 'Cleaning validation specification',
            'FPSTP' => 'Finished product Standard Testing Procedure',
            'INPSTP' => 'Inprocess Standard Testing Procedure',
            'CVSTP' => 'Cleaning validation Standard Testing Procedure',
            'RAWMS' => 'Raw Material Specification',
            'RMSTP' => 'Raw Material Standard Testing Procedure',
            'PAMS' =>'Packing Material Specification',
            'PIAS' =>'Product / Item Information-Addendum for Specification',
            'MFPS' =>'Master Finished Product Specification',
            'MFPSTP' =>'Master Finished Product Standard Testing Procedure',
            'BOM' => 'Bill of Material',
            'BMR' => 'Batch Manufacturing Record',
            'BPR' => 'Batch Packing Record',
            'SPEC' => 'Specification (All types)',
            'STP' => 'Standard Testing Procedure (All types)',
            'TDS' => 'Test Data Sheet',
            'GTP' => 'General Testing Procedure',
            'PROTO' => 'Protocols (All types)',
            'REPORT' => 'Reports (All types)',
            'TEMPMAPPING' => 'Temperature Mapping Protocol Cum Report',
            'PROVALIDRE' => 'Process Validation Report',
            'PROVALIINTERRE'=>'Process Validation Interim Report',
            'EQUIPMENTHOLDREPORT' => 'Equipment Hold Time Study Report',
            'EQUIPMENTHOLDPROTOCOL' => 'Equipment Hold Time Study Protocol',
            'STUDYPROTOCOL' => 'Study Protocol',
            'ANNEQUALPROTO' => 'Annexure For Qualification Protocol',
            'ANNEQUALREPORT' => 'Annexure For Qualification REPORT',
            'STUDY' => 'Study Report',
            'AAEUSERREQUESPECI' => 'Annexure For User Requirement Specification',
            'PROCUMREPORT' => 'Protocol cum Report',
            'CLEAVALIPROTODOC' => 'Cleaning  Validation Protocol',
            'CLEAVALIREPORTDOC' => 'Cleaning  Validation Report',
            'QUALIPROCUMREP' => 'Qualification Protocol Cum Report',

            'REQULIFICATION' => 'Area Qualification Report',
            'PROVALIPROTOCOL'=>'Process Validation protocol',
            'REQULIFICATIONPROTOCOL'=>'Area Qualification Protocol',
            'REPORTFORMEDIAFILL'=>'Report For Media Fill',
            'PROTOCOLFORMEDIAFILL'=>'Protocol For Media Fill',
            'ANNACINQULIPROTOCOL'=>'Annexure For Acceptance Of Installation Qualification Protocol',
            'ANNACOPERQULIPROTOCOL'=>'Annexure For Acceptance Of Operational Qualification Protocol',
            'ANNACPERMQULIPROTOCOL'=>'Annexure For Acceptance Of Performance Qualification Protocol',
            'PACKVALIREPORT'=>'Packing Validation Report',
            'PACKVALIPROTOCOL'=>'Packing Validation Protocol',
            'HOLDTIMESTUDYREPORT'=>' Hold Time Study Report',
            'HOLDTIMESTUDYPROTOCOL'=>'Hold Time Study Protocol',
            'FOCONITOGENREPORT'=>'Format For Compressed Air And Nitrogen Gas System Report',
            'FOCONITOGENPROTOCOL'=>'Format For Compressed Air And Nitrogen Gas System Protocol',
            'STABILITYPROTOCOL'=>'Stability study protocol',

            'ANNIGxPASSES'=>'Annexure I-Gxp Assessment',
            'ANNIIRiskASSES'=>'Annexure II-Initial Risk Assessment',
            'ANNIIIERESASSES'=>'Annexure III-ERES Assessment',
            'ANNIVPlanASSES'=>'Annexure IV-Validation Plan',
            'ANNVUserReqSpe'=>'Annexure V-User Requirements Specification',
            'ANNVIFunReqSpe'=>'Annexure VI-Functional Requirement Specification',
            'ANNVIIFunSpe'=>'Annexure VII-Functional Specification',
            'ANNVIIITechSpe'=>'Annexure VIII-Technical Specification',
            'ANNIXFunRiskASSES'=>'Annexure IX Functional Risk Assssment',
            'ANNXDesignSpe'=>'Annexure X-Design Specification',

            'ANNXIConfiSpe'=>'Annexure XI-Configuration Specification',
            'ANNXIIQualiProto'=>'Annexure XII Installation Infrastructure Operational Performance Qualification Protocol',
            'ANNXIIIUnitInTest'=>'Annexure XIII Unit Integration Test Script',
            'ANNXIVDataMigPro'=>'Annexure XIV Data Migration Protocol',
            'ANNXVPerfQualif'=>'Annexure XV Data Qualification Protocol',

            // 'AREAQUALIFICATIONREPORT'=>'Area Qualification Report',
            'ANNEXUREXVIIITRACEABILITYMATRIX'=>'annexure-XVIII - Traceability Matrix',
            'ANNEXUREXVIIVALIDATION'=>'annexure-XVII - Validation Summary Report',
            'ANNEXUREXVIINSTALLATION'=>'annexure-XVI - Installation_Infrastructure_Operational_Performance Qualification',
            'ANNEXUREXIXSYSTEMRETIREMENT'=>'annexure-XIX - System Retirement',

            'MAForRec' =>'Master Formula Record',
            'MAPacRec' =>'Master Packing Record',
                        
            'SMF' => 'Site Master File',
            'VMP' => 'Validation Master Plan',
            'QM' => 'Quality Manual',
            
        ];

        return $document_types;
    }


    //  public static function getDueDate123($date, $addDays = false, $format = null)
    //     {
    //         try {
    //             if ($date) {
    //                 $format = $format ? $format : 'd M Y';
    //                 $dateInstance = Carbon::parse($date);
    //                 if ($addDays) {
    //                     $dateInstance->addDays(30);
    //                 }
    //                 return $dateInstance->format($format);
    //         }
    //         } catch (\Exception $e) {
    //             return 'NA';
    //         }
    //     }


    public static function getDepartmentWithString($id)
    {
        $response = [];
        if(!empty($id)){
            $response = explode(',',$id);
        }
        return $response;
    }
    public static function getInitiatorEmail($id)
    {


        return   DB::table('users')->where('id',$id)->value('email');
    }

    // Helpers::formatNumberWithLeadingZeros(0)
    public static function formatNumberWithLeadingZeros($number)
    {
        return sprintf('%04d', $number);
    }

    public static function getDepartmentNameWithString($id)
    {
        $response = [];
        $resp = [];
        if(!empty($id)){
            $result = explode(',',$id);
            if(in_array(1,$result)){
                array_push($response, 'QA');
            }
            if(in_array(2,$result)){
                array_push($response, 'QC');
            }
            if(in_array(3,$result)){
                array_push($response, 'R&D');
            }
            if(in_array(4,$result)){
                array_push($response, 'Manufacturing');
            }
            if(in_array(5,$result)){
                array_push($response, 'Warehouse');
            }
            $resp = implode(',',$response);
        }
        return $resp;
    }

    // static function getInitiatorGroups()

    static function getInitiatorGroups()
    {
        $initiator_groups = [
            'CQA' => 'Corporate Quality Assurance',
            'QA' => 'Quality Assurance',
            'QC' => 'Quality Control',
            'QM' => 'Quality Control (Microbiology department)',
            'PG' => 'Production General',
            'PL' => 'Production Liquid Orals',
            'PT' => 'Production Tablet and Powder',
            'PE' => 'Production External (Ointment, Gels, Creams and Liquid)',
            'PC' => 'Production Capsules',
            'PI' => 'Production Injectable',
            'EN' => 'Engineering',
            'HR' => 'Human Resource',
            'ST' => 'Store',
            'IT' => 'Electronic Data Processing',
            'FD' => 'Formulation  Development',
            'AL' => 'Analytical research and Development Laboratory',
            'PD' => 'Packaging Development',
            'PU' => 'Purchase Department',
            'DC' => 'Document Cell',
            'RA' => 'Regulatory Affairs',
            'PV' => 'Pharmacovigilance'
        ];

        return $initiator_groups;


    }



    public static function getInitiatorGroupFullName($shortName)
    {
    {

        switch ($shortName) {
            case 'Corporate Quality Assurance':
                return 'Corporate Quality Assurance';
                break;
            case 'QAB':
                return 'Quality Assurance Biopharma';
                break;
            case 'CQC':
                return 'Central Quality Control';
                break;
            case 'MANU':
                return 'Manufacturing';
                break;
            case 'PSG':
                return 'Plasma Sourcing Group';
                break;
            case 'CS':
                return 'Central Stores';
                break;
            case 'ITG':
                return 'Information Technology Group';
                break;
            case 'MM':
                return 'Molecular Medicine';
                break;
            case 'CL':
                return 'Central Laboratory';
                break;
            case 'TT':
                return 'Tech Team';
                break;
            case 'QA':
                return 'Quality Assurance';
                break;
            case 'QM':
                return 'Quality Management';
                break;
            case 'IA':
                return 'IT Administration';
                break;
            case 'ACC':
                return 'Accounting';
                break;
            case 'LOG':
                return 'Logistics';
                break;
            case 'SM':
                return 'Senior Management';
                break;
            case 'BA':
                return 'Business Administration';
                break;
            default:
                return '';
                break;
        }
    }
}

    static public function userIsQA()
    {
        $isQA = false;

        try {

            $auth_user = auth()->user();

            if ($auth_user && $auth_user->department && $auth_user->department->dc == 'QA') {
                return true;
            }

        } catch (\Exception $e) {
            info('Error in Helpers::userIsQA', [ 'message' => $e->getMessage(), 'obj' => $e ]);
        }

        return $isQA;
    }

    // Helpers::getMicroGridData($micro, 'analyst_training', true, 'response', true, 0)
    public static function getMicroGridData(OOS_micro $micro, $identifier, $getKey = false, $keyName = null, $byIndex = false, $index = 0)
    {
        $res = $getKey ? '' : [];
            try {
                $grid = $micro->grids()->where('identifier', $identifier)->first();

                if($grid && is_array($grid->data)){

                    $res = $grid->data;

                    if ($getKey && !$byIndex) {
                        $res = array_key_exists($keyName, $grid->data) ? $grid->data[$keyName] : '';
                    }

                    if ($getKey && $byIndex && is_array($grid->data[$index])) {
                        $res = array_key_exists($keyName, $grid->data[$index]) ? $grid->data[$index][$keyName] : '';
                    }
                }

            } catch(\Exception $e){

            }
        return $res;
    }

    public static function disabledErrataFields($data)
    {
        if($data == 0 || $data > 8){
            return 'disabled';
        }else{
            return  '';
        }

    }

    public static function disabledMarketComplaintFields($marketcomplaint)
    {
        if($marketcomplaint == 0 || $marketcomplaint > 8){
            return 'disabled';
        }else{
            return  '';
        }

    }

    public static function getDocStatusByStage($stage, $document_training = 'no')
    {
        $status = '';
        $training_required = $document_training == 'yes' ? true : false;
        switch ($stage) {
            case '1':
                $status = 'Draft';
                break;
            case '2':
                $status = 'In-HOD Review';
                break;
            case '3':
                $status = 'HOD Review Complete';
                break;
            case '4':
                $status = 'In-Review';
                break;
            case '5':
                $status = 'Reviewed';
                break;
            case '6':
                $status = 'For-Approval';
                break;
            case '7':
                $status = 'Approved';
                break;
            case '8':
                $status = $training_required ? 'Pending-Traning' : 'Effective';
                break;
            case '9':
                $status = $training_required ? 'Traning-Complete' : 'Obsolete';
                break;
            case '10':
                $status = $training_required ? 'In-Effective' : 'In-Effective';
                break;
            case '11':
                $status = 'Effective';
                break;
            case '12':
                $status = 'Obsolete';
                break;
            case '13':
                $status = 'Closed/Cancel';
                break;
            default:
                # code...
                break;
        }

        return $status;
    }

    // Kuldeep Patel
    public static function getDueDate123($date = null, $addDays = false, $format = 'd M Y')
    {
        try {
            $dateInstance = $date ? Carbon::parse($date) : Carbon::now();
            if ($addDays) {
                $dateInstance->addDays(30);
            }
            return $dateInstance->format($format);
        } catch (\Exception $e) {
            return 'NA';
        }
    }

    // SONALI SHARMA
    public static function isOOSChemical($data)
    {
        // if($data == 0 || $data  >= 15){
        //     return 'disabled';
        // }else{
        //     return  '';
        // }

    }

    public static function isOOSMicro($micro_data)
    {
        if($micro_data == 0 || $micro_data  >= 14){
            return 'disabled';
        }else{
            return  '';
        }
    }

    public static function getDueDatemonthly($date = null, $addDays = false, $format = null)
    {
        try {
            $format = $format ? $format : 'd-M-Y';
            $dateInstance = $date ? Carbon::parse($date) : Carbon::now();

            if ($addDays) {
                $dateInstance->addDays($addDays);
            } else {
                // Add 30 days instead of adding a month
                $dateInstance->addDays(30);
            }

            return $dateInstance->format($format);
        } catch (\Exception $e) {
            return 'NA';
        }
    }
    public static function getmonthFormat($date)
    {
        if(empty($date)) {
            return ''; // or any default value you prefer
        }
       else{
            $date = Carbon::parse($date);
            $formatted_date = $date->format("M-Y");
            return $formatted_date;
        }

    }

    public static function getChemicalGridData(OOS $data, $identifier, $getKey = false, $keyName = null, $byIndex = false, $index = 0)
    {
        $res = $getKey ? '' : [];

        try {
            $grid = $data->grids()->where('identifier', $identifier)->first();

            if ($grid && is_array($grid->data)) {
                $res = $grid->data;

                if ($getKey && !$byIndex) {
                    $res = array_key_exists($keyName, $grid->data) ? $grid->data[$keyName] : '';
                }

                if ($getKey && $byIndex && isset($grid->data[$index]) && is_array($grid->data[$index])) {
                    $res = array_key_exists($keyName, $grid->data[$index]) ? $grid->data[$index][$keyName] : '';
                }
            }
        } catch (\Exception $e) {

        }
        return is_array($res) ? '' : $res;
    }

    public function getChecklistData(){
        $checklists = [
            '1' => 'Checklist - Tablet Dispensing & Granulation',
            '2' => 'Checklist - Tablet Compression',
            '3' => 'Checklist - Tablet Coating',
            '4' => 'Checklist - Tablet/Capsule Packing',
            '5' => 'Checklist - Capsule',
            '6' => 'Checklist - Liquid/Ointment Dispensing & Manufacturing',
            '7' => 'Checklist - Liquid/Ointment Packing',
            '8' => 'Checklist - Quality Assurance',
            '9' => 'Checklist - Engineering',
            '10' => 'Checklist - Quality Control',
            '11' => 'Checklist - Stores',
            '12' => 'Checklist - Human Resource',
            '13' => 'Checklist - Production (Injection Dispensing & Manufacturing)',
            '14' => 'Checklist - Production (Injection Packing)',
            '15' => 'Checklist - Production (Powder Manufacturing and Packing)',
            '16' => 'Checklist - Analytical Research and Development',
            '17' => 'Checklist - Formulation Research and Development',
            '18' => 'Checklist - LL / P2P',
        ];

        return $checklists;

    }

    public static function getUsersDepartmentName($departmentid)
    {
        $full_department_name = '';

        
        switch ($departmentid) {
            case '1':
                $full_department_name = 'Corporate Quality Assurance';
                break;
            case '2':
                $full_department_name = 'Quality Control (Microbiology department)';
                break;
            case '3':
                $full_department_name = 'Engineering';
                break;
            case '4':
                $full_department_name = 'Store';
                break;
            case '5':
                $full_department_name = 'Production Injectable';
                break;
            case '6':
                $full_department_name = 'Production External';
                break;
            case '7':
                $full_department_name = 'Production Tablet,Powder and Capsule';
                break;
            case '8':
                $full_department_name = 'Quality Assurance';
                break;
            case '9':
                $full_department_name = 'Quality Control';
                break;
            case '10':
                $full_department_name = 'Ragulatory Affairs';
                break;
            case '11':
                $full_department_name = 'Packaging Development /Artwork';
                break;
            case '12':
                $full_department_name = 'Artwork';
                break;
            case '13':
                $full_department_name = 'Research & Development';
                break;
            case '14':
                $full_department_name = 'Human Resource';
                break;
            case '15':
                $full_department_name = 'Marketing';
                break;
            case '16':
                $full_department_name = 'Analytical research and Development Laboratory';
                break;
            case '17':
                $full_department_name = 'Information Technology';
                break;
            case '18':
                $full_department_name = 'Safety';
                break;
            case '19':
                $full_department_name = 'Purchase Department';
                break;
            default:
                $full_department_name = '';
                break;
        }

        return $full_department_name;


    }





    public static function getInitiatorGroupData($shortName)
    {
        $full_department_name = '';

        switch ($shortName) {
            case 'Corporate Quality Assurance':
                $full_department_name = 'Corporate Quality Assurance';
                break;
            case 'QAB':
                $full_department_name = 'Quality Assurance Biopharma';
                break;
            case 'CQC':
                $full_department_name = 'Central Quality Control';
                break;
            case 'MANU':
                $full_department_name = 'Manufacturing';
                break;
            case 'PSG':
                $full_department_name = 'Plasma Sourcing Group';
                break;
            case 'CS':
                $full_department_name = 'Central Stores';
                break;
            case 'ITG':
                $full_department_name = 'Information Technology Group';
                break;
            case 'MM':
                $full_department_name = 'Molecular Medicine';
                break;
            case 'CL':
                $full_department_name = 'Central Laboratory';
                break;
            case 'TT':
                $full_department_name = 'Tech Team';
                break;
            case 'QA':
                $full_department_name = 'Quality Assurance';
                break;
            case 'QM':
                $full_department_name = 'Quality Management';
                break;
            case 'IA':
                $full_department_name = 'IT Administration';
                break;
            case 'ACC':
                $full_department_name = 'Accounting';
                break;
            case 'LOG':
                $full_department_name = 'Logistics';
                break;
            case 'SM':
                $full_department_name = 'Senior Management';
                break;
            case 'BA':
                $full_department_name = 'Business Administration';
                break;
            default:
                $full_department_name = '';
                break;
        }

        return $full_department_name;

    }

    static function getfullnameChecklist($check){
        $checklist = '';

        switch($check){
            case'1':
            $checklist = "Checklist - Tablet Dispensing & Granulation";
            break;
            case'2':
            $checklist = "Checklist - Tablet Compression";
            break;
            case'3':
            $checklist = "Checklist - Tablet Coating";
            break;
            case'4':
            $checklist = "Checklist - Tablet/Capsule Packing";
            break;
            case'5':
            $checklist = "Checklist - Capsule";
            break;
            case'6':
            $checklist = "Checklist - Liquid/Ointment Dispensing & Manufacturing";
            break;
            case'7':
            $checklist = "Checklist - Liquid/Ointment Packing";
            break;
            case'8':
            $checklist = "Checklist - Quality Assurance";
            break;
            case'9':
            $checklist = "Checklist - Engineering";
            break;
            case'10':
            $checklist = "Checklist - Quality Control";
            break;
            case'11':
            $checklist = "Checklist - Stores";
            break;
            case'12':
            $checklist = "Checklist - Human Resource";
            break;
            case'13':
            $checklist = "Checklist - Production (Injection Dispensing & Manufacturing)";
            break;
            case'14':
            $checklist = "Checklist - Production (Injection Packing)";
            break;
            case'15':
            $checklist = "Checklist - Production (Powder Manufacturing and Packing)";
            break;
            case'16':
            $checklist = "Checklist - Analytical Research and Development";
            break;
            case'17':
            $checklist = "Checklist - Formulation Research and Development";
            break;
            case'18':
            $checklist = "Checklist - LL / P2P";
        break;
        }
        return $checklist;
    }

//----------------------------------------

    static function getSeverityValue($seve){
        $sevrty = '';

        switch($seve){
            case'1':
            $sevrty = "1-Insignificant";
            break;
            case'2':
            $sevrty = "2-Minor";
            break;
            case'3':
            $sevrty = "3-Major";
            break;
            case'4':
            $sevrty = "4-Critical";
            break;
            case'5':
            $sevrty = "5-Catastrophic";
        break;
        }
        return $sevrty;
    }


    static function getProbabilityValue($probe){
        $probilty = '';

        switch($probe){
            case'1':
            $probilty = "1-Very rare";
            break;
            case'2':
            $probilty = "2-Unlikely";
            break;
            case'3':
            $probilty = "3-Possibly";
            break;
            case'4':
            $probilty = "4-Likely";
            break;
            case'5':
            $probilty = "5-Almost certain (every time)";
        break;
        }
        return $probilty;
    }


    static function getDetectionValue($dect){
        $dectct = '';

        switch($dect){
            case'1':
            $dectct = "1-Always detected";
            break;
            case'2':
            $dectct = "2-Likely to detect";
            break;
            case'3':
            $dectct = "3-Possible to detect";
            break;
            case'4':
            $dectct = "4-Unlikely to detect";
            break;
            case'5':
            $dectct = "5-Not detectable";
        break;
        }
        return $dectct;
    }


//----------------------------------------




    public static function getChildData($id, $parent_type){
        $count = 0;
        if($parent_type == 'LabIncident')
       {
        $count = extension_new::where('parent_type', 'LabIncident')
        ->where('parent_id', $id)
        ->count();
       }
       elseif($parent_type == 'Deviation')
       {
        $count = extension_new::where('parent_type', 'Deviation')
        ->where('parent_id', $id)
        ->count();
       }
       elseif($parent_type == 'OOC')
       {
        $count = extension_new::where('parent_type', 'OOC')
        ->where('parent_id', $id)
        ->count();
       }
       elseif($parent_type == 'OOT')
       {
        $count = extension_new::where('parent_type', 'OOT')
        ->where('parent_id', $id)
        ->count();
       }
       elseif($parent_type == 'Management Review')
       {
        $count = extension_new::where('parent_type', 'Management Review')
        ->where('parent_id', $id)
        ->count();
       }
       elseif($parent_type == 'CAPA')
       {
        $count = extension_new::where('parent_type', 'CAPA')
        ->where('parent_id', $id)
        ->count();
       }
       elseif($parent_type == 'Action Item')
       {
        $count = extension_new::where('parent_type', 'Action Item')
        ->where('parent_id', $id)
        ->count();
       }
       elseif($parent_type == 'Resampling')
       {
        $count = extension_new::where('parent_type', 'Resampling')
        ->where('parent_id', $id)
        ->count();
       }
       elseif($parent_type == 'Observation')
       {
        $count = extension_new::where('parent_type', 'Observation')
        ->where('parent_id', $id)
        ->count();
       }
       elseif($parent_type == 'RCA')
       {
        $count = extension_new::where('parent_type', 'RCA')
        ->where('parent_id', $id)
        ->count();
       }
       elseif($parent_type == 'Risk Assesment')
       {
        $count = extension_new::where('parent_type', 'Risk Assesment')
        ->where('parent_id', $id)
        ->count();
       }
       elseif($parent_type == 'Management Review')
       {
        $count = extension_new::where('parent_type', 'Management Review')
        ->where('parent_id', $id)
        ->count();
       }
       elseif($parent_type == 'External Audit')
       {
        $count = extension_new::where('parent_type', 'External Audit')
        ->where('parent_id', $id)
        ->count();
       }
       elseif($parent_type == 'Internal Audit')
       {
        $count = extension_new::where('parent_type', 'Internal Audit')
        ->where('parent_id', $id)
        ->count();
       }
       elseif($parent_type == 'Audit Program')
       {
        $count = extension_new::where('parent_type', 'Audit Program')
        ->where('parent_id', $id)
        ->count();
       }
       elseif($parent_type == 'CC')
       {
        $count = extension_new::where('parent_type', 'CC')
        ->where('parent_id', $id)
        ->count();
       }
       elseif($parent_type == 'New Documnet')
       {
        $count = extension_new::where('parent_type', 'New Documnet')
        ->where('parent_id', $id)
        ->count();
       }
       elseif($parent_type == 'Effectiveness Check')
       {
        $count = extension_new::where('parent_type', 'Effectiveness Check')
        ->where('parent_id', $id)
        ->count();
       }
       elseif($parent_type == 'OOS Micro')
       {
        $count = extension_new::where('parent_type', 'OOS Micro')
        ->where('parent_id', $id)
        ->count();
       }
       elseif($parent_type == 'OOS Chemical')
       {
        $count = extension_new::where('parent_type', 'OOS Chemical')
        ->where('parent_id', $id)
        ->count();
       }
       elseif($parent_type == 'Market Complaint')
       {
        $count = extension_new::where('parent_type', 'Market Complaint')
        ->where('parent_id', $id)
        ->count();
       }
       elseif($parent_type == 'Failure Investigation')
       {
        $count = extension_new::where('parent_type', 'Failure Investigation')
        ->where('parent_id', $id)
        ->count();
       }
       elseif($parent_type == 'Incident')
       {
        $count = extension_new::where('parent_type', 'Incident')
        ->where('parent_id', $id)
        ->count();
       }


        return $count;
    }

    public static function check_roles_qms($role_id, $user_id = null, $division_id = [1,2,3,4,5,6,7,8], $process_names = ['Effective Check', 'Lab Incident', 'CAPA', 'Audit Program', 'Action Item', 'Internal Audit', 'External Audit', 'Deviation', 'Change Control', 'Risk Assessment', 'Root Cause Analysis', 'Observation', 'Extension'])
    {
        // Get user ID if not passed
        $user_id = $user_id ?? Auth::id();

        // Get all matching process IDs
        $process_ids = QMSProcess::whereIn('division_id', $division_id)
            ->whereIn('process_name', $process_names)
            ->pluck('id');

        if ($process_ids->isEmpty()) {
            return false;
        }

        // Check if user has the role for any of the matching processes
        $roleExists = DB::table('user_roles')
            ->where('user_id', $user_id)
            ->whereIn('q_m_s_divisions_id', $division_id)
            ->whereIn('q_m_s_processes_id', $process_ids)
            ->where('q_m_s_roles_id', $role_id)
            ->exists();

        return $roleExists;
    }

    public static function check_roles($division_id, $process_name, $role_id, $user_id = null)
    {

        $process = QMSProcess::where([
            'division_id' => $division_id,
            'process_name' => $process_name
        ])->first();

        $roleExists = DB::table('user_roles')->where([
            'user_id' => $user_id ? $user_id : Auth::user()->id,
            'q_m_s_divisions_id' => $division_id,
            'q_m_s_processes_id' => $process ? $process->id : 0,
            'q_m_s_roles_id' => $role_id
        ])->first();

        return $roleExists ? true : false;
    }


    public static function getHODDropdown() {
        $hodUserList = DB::table('user_roles')
            ->join('users', 'user_roles.user_id', '=', 'users.id')
            ->where('user_roles.q_m_s_roles_id', '4')
            ->select('users.id', 'users.name')
            ->distinct()
            ->get();

        $dropdown = [];
        foreach ($hodUserList as $hodUser) {
            $dropdown[] = ['id' => $hodUser->id, 'name' => $hodUser->name];
        }

        return $dropdown;
    }

    public static function getProductionDropdown() {
        $ProductionUserList = DB::table('user_roles')
            ->join('users', 'user_roles.user_id', '=', 'users.id')
            ->where('user_roles.q_m_s_roles_id', '22')
            ->select('users.id', 'users.name')
            ->distinct()
            ->get();

        $dropdown = [];
        foreach ($ProductionUserList as $productionUser) {
            $dropdown[] = ['id' => $productionUser->id, 'name' => $productionUser->name];
        }

        return $dropdown;
    }

    public static function getProductionHeadDropdown() {
        $ProductionHeadUserList = DB::table('user_roles')
            ->join('users', 'user_roles.user_id', '=', 'users.id')
            ->where('user_roles.q_m_s_roles_id', '61')
            ->select('users.id', 'users.name')
            ->distinct()
            ->get();

        $dropdown = [];
        foreach ($ProductionHeadUserList as $productionHeadUser) {
            $dropdown[] = ['id' => $productionHeadUser->id, 'name' => $productionHeadUser->name];
        }

        return $dropdown;
    }


    public static function getAllRelatedRecords()
    {
        $pre = [
            'DEV' => \App\Models\Deviation::class,
            'AP' => \App\Models\AuditProgram::class,
            'AI' => \App\Models\ActionItem::class,
            'Exte' => \App\Models\extension_new::class,
            'Resam' => \App\Models\Resampling::class,
            'Obse' => \App\Models\Observation::class,
            'RCA' => \App\Models\RootCauseAnalysis::class,
            'RA' => \App\Models\RiskAssessment::class,
            'MR' => \App\Models\ManagementReview::class,
            'EA' => \App\Models\Auditee::class,
            'IA' => \App\Models\InternalAudit::class,
            'CAPA' => \App\Models\Capa::class,
            'CC' => \App\Models\CC::class,
            'ND' => \App\Models\Document::class,
            'Lab' => \App\Models\LabIncident::class,
            'EC' => \App\Models\EffectivenessCheck::class,
            'OOSChe' => \App\Models\OOS::class,
            'OOT' => \App\Models\OOT::class,
            'OOC' => \App\Models\OutOfCalibration::class,
            'MC' => \App\Models\MarketComplaint::class,
            'NC' => \App\Models\NonConformance::class,
            'Incident' => \App\Models\Incident::class,
            'FI' => \App\Models\FailureInvestigation::class,
            'ERRATA' => \App\Models\errata::class,
            'OOSMicr' => \App\Models\OOS_micro::class,
            // Add other models as necessary...
        ];

        // Create an empty collection to store the related records
        $relatedRecords = collect();

        // Loop through each model and get the records, adding the process name to each record
        foreach ($pre as $processName => $modelClass) {
            $records = $modelClass::all()->map(function ($record) use ($processName) {
                $record->process_name = $processName; // Attach the process name to each record
                return $record;
            });

            // Merge the records into the collection
            $relatedRecords = $relatedRecords->merge($records);
        }

        return $relatedRecords;
    }

    public static function extensionCount($count) {
        switch ($count) {
            case 'number1':
                $count = 1;
                break;
            case 'number2':
                $count = 2;
                break;
            case 'number':
                $count = 3;
                break;
        }
        return $count;
    }
    public static function checkControlAccess()
    {
    // Retrieve the user's roles
    $userRoles = UserRole::where('user_id', Auth::user()->id)->pluck('role_id')->toArray();

    // Check if any of the user roles exist in the PrintControl table
    $controls = PrintControl::whereIn('role_id', $userRoles)->exists();

    // Return true if controls exist, false otherwise
    return $controls;
    }

    public static function getEmpNameByCode($code){
        return   Employee::where('full_employee_id',$code)->value('employee_name');
    }

    public static function getFormattedDocumentNumbers($documentIds) {

        // Ensure document IDs are not null and is a string or array
        if (is_null($documentIds)) {
            return ''; // or handle error as needed
        }

        if (is_string($documentIds)) {
            $documentIds = explode(',', $documentIds);
        }

        // Fetch documents only if $documentIds is an array and has items
        if (is_array($documentIds) && count($documentIds) > 0) {
            $documents = Document::whereIn('id', $documentIds)->get();
        } else {
            $documents = collect(); // Empty collection if no valid IDs
        }
        
        $formattedDocuments = [];

        foreach ($documents as $document) {
            $formattedDocuments[] = "{$document->sop_type_short}/{$document->department_id}/000{$document->id}/R{$document->major}";
        }

        return implode(', ', $formattedDocuments);
    }

    public static function getNameById($id){
        return   Employee::where('id',$id)->value('employee_name');
    }


}

