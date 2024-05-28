<?php

use App\Models\ActionItem;
use App\Models\Division;
use App\Models\QMSDivision;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class Helpers
{
    public static function getArrayKey(array $array, $key)
    {
        return $array && is_array($array) && array_key_exists($key, $array) ? $array[$key] : '';
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
    public static function getdateFormat($date)
    {
        if(empty($date)) {
            return ''; // or any default value you prefer
        }
        // else{
        else{
            $date = Carbon::parse($date);
            $formatted_date = $date->format("d-M-Y");
            return $formatted_date;
        }

    }

    public static function getdateFormat1($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-M-Y');
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
    // public static function getHodUserList(){

    //     return $hodUserList = DB::table('user_roles')->where(['q_m_s_roles_id' =>'4'])->get();
    // }
    // public static function getQAUserList(){

    //     return $QAUserList = DB::table('user_roles')->where(['q_m_s_roles_id' =>'7'])->get();
    // }
    // public static function getInitiatorUserList(){


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


    public static function checkRoles_check_hods($document)
    {
        if ($document->hods) {
            $datauser = explode(',', $document->approvers);
            for ($i = 0; $i < count($datauser); $i++) {
                if ($datauser[$i] == Auth::user()->id) {
                    if($document->stage >= 2){
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
    public static function record($id)
    {
        return   str_pad($id, 5, '0', STR_PAD_LEFT);
    }

    public static function getHodUserList(){

        return $hodUserList = DB::table('user_roles')->where(['q_m_s_roles_id' =>'4'])->get();
    }
    public static function getQAUserList(){

        return $QAUserList = DB::table('user_roles')->where(['q_m_s_roles_id' =>'7'])->get();
    }
    public static function getInitiatorUserList(){

        return $InitiatorUserList = DB::table('user_roles')->where(['q_m_s_roles_id' =>'3'])->get();
    }
    public static function getApproverUserList(){

        return $ApproverUserList = DB::table('user_roles')->where(['q_m_s_roles_id' =>'1'])->get();
    }
    public static function getReviewerUserList(){

        return $ReviewerUserList = DB::table('user_roles')->where(['q_m_s_roles_id' =>'2'])->get();
    }
    public static function getCFTUserList(){

        return $CFTUserList = DB::table('user_roles')->where(['q_m_s_roles_id' =>'5'])->get();
    }
    public static function getTrainerUserList(){

        return $TrainerUserList = DB::table('user_roles')->where(['q_m_s_roles_id' =>'6'])->get();
    }

    static function getFullDepartmentName($code)
    {
        $full_department_name = '';

        switch ($code) {
            case 'CQA':
                $full_department_name = "Corporate Quality Assurance";
                break;
            case 'QAB':
                $full_department_name = "Quality Assurance Biopharma";
                break;
            case 'CQC':
                $full_department_name = "Central Quality Control";
                break;
            case 'MANU':
                $full_department_name = "Manufacturing";
                break;
            case 'PSG':
                $full_department_name = "Plasma Sourcing Group";
                break;
            case 'CS':
                $full_department_name = "Central Stores";
                break;
            case 'ITG':
                $full_department_name = "Information Technology Group";
                break;
            case 'MM':
                $full_department_name = "Molecular Medicine";
                break;
            case 'CL':
                $full_department_name = "Central Laboratory";
                break;
            case 'TT':
                $full_department_name = "Tech team";
                break;
            case 'ACC':
                $full_department_name = "Accounting";
                break;
            case 'LOG':
                $full_department_name = "Logistics";
                break;
            case 'SM':
                $full_department_name = "Senior Management";
                break;
            case 'BA':
                $full_department_name = "Business Administration";
                break;

            default:
                break;
        }

        return $full_department_name;

    }


     public static function getDueDate123($date, $addDays = false, $format = null)
        {
            try {
                if ($date) {
                    $format = $format ? $format : 'd M Y';
                    $dateInstance = Carbon::parse($date);
                    if ($addDays) {
                        $dateInstance->addDays(30);
                    }
                    return $dateInstance->format($format);
            }
            } catch (\Exception $e) {
                return 'NA';
            }
        }


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
            'QAB' => 'Quality Assurance Biopharma',
            'CQC' => 'Central Quality Control',
            'MANU' => 'Manufacturing',
            'PSG' => 'Plasma Sourcing Group',
            'CS' => 'Central Stores',
            'ITG' => 'Information Technology Group',
            'MM' => 'Molecular Medicine',
            'CL' => 'Central Laboratory',
            'TT' => 'Tech team',
            'QA' => 'Quality Assurance',
            'QM' => 'Quality Management',
            'IA' => 'IT Administration',
            'ACC' => 'Accounting',
            'LOG' => 'Logistics',
            'SM' => 'Senior Management',
            'BA' => 'Business Administration'
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


    // public static function hodMail($data)
    // {
    //     Mail::send('hod-mail',['data' => $data],
    // function ($message){
    //         $message->to("shaleen.mishra@mydemosoftware.com")
    //                 ->subject('Record is for Review');
    //     });
    // }

    public static function disabledErrataFields($data)
    {
        if($data == 0 || $data > 5){
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

}
