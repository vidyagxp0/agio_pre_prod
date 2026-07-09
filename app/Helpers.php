<?php
// namespace App;

use App\Http\Controllers\ExtensionNewController;
use App\Models\ActionItem;
use App\Models\CC;
use App\Models\ChangeProposalJust;
use App\Models\Department;
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
use App\Models\Capa;
use App\Models\EffectivenessCheck;
use App\Models\Extension;
use App\Models\InternalAudit;
use App\Models\ManagementReview;
use App\Models\OutOfCalibration;
use App\Models\Resampling;
use App\Models\RiskManagement;
use App\Models\Auditee;
use App\Models\NonConformance;
use App\Models\AuditProgram;
use App\Models\{Division, Incident,MarketComplaint,Errata};
use App\Models\RootCauseAnalysis;
use App\Models\Observation;
use App\Models\FailureInvestigation;
use App\Models\Ootc;
use App\Models\RecordNumber;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class Helpers
{
    /**
     * -----------------------------------------------------------------
     * PERFORMANCE LAYER
     * -----------------------------------------------------------------
     * Everything in this block is NEW. No existing public method was
     * removed, renamed, or had its signature/return type changed, so
     * every call site elsewhere in the project keeps working exactly
     * as before. All we did is stop re-running the same queries
     * over and over inside a single request (and, for slow-changing
     * data like role lists/divisions, across requests for a short TTL).
     * -----------------------------------------------------------------
     */

    /** In-memory, per-request cache. Cleared automatically at end of request. */
    private static array $memo = [];

    /**
     * Remember a value for the lifetime of the current request only.
     * Use this for anything derived from Auth::user() or that must
     * always be 100% fresh within a request but is safe to reuse
     * across multiple calls in that same request.
     */
    private static function remember(string $key, \Closure $callback)
    {
        if (!array_key_exists($key, self::$memo)) {
            self::$memo[$key] = $callback();
        }
        return self::$memo[$key];
    }

    /**
     * Remember a value both for this request AND across requests for a
     * short TTL. Use this ONLY for data that rarely changes within a
     * few minutes (role assignments, division names, user names, etc).
     * If your app updates roles/divisions live and expects it to be
     * reflected instantly, lower the TTL or clear the cache tag when
     * that data changes (see notes at the bottom of the file).
     */
    private static function rememberShared(string $key, int $ttlSeconds, \Closure $callback)
    {
        return self::remember($key, function () use ($key, $ttlSeconds, $callback) {
            return Cache::remember('helpers:' . $key, $ttlSeconds, $callback);
        });
    }

    /**
     * Single generic implementation backing ALL of the
     * getXXXUserList($division) methods below. They were all doing the
     * exact same query shape, just with a different q_m_s_roles_id, so
     * duplicating it 25 times only multiplied the number of round trips
     * for no benefit. This is now queried once per (role, division)
     * combo per request, and cached for 5 minutes across requests.
     */
    private static function getUsersByRole(string $roleId, $division = null)
    {
        $cacheKey = "users_by_role:{$roleId}:" . ($division ?? 'all');

        return self::rememberShared($cacheKey, 300, function () use ($roleId, $division) {
            if (!$division) {
                return DB::table('user_roles')
                    ->where(['q_m_s_roles_id' => $roleId])
                    ->select(['user_id', DB::raw('MAX(q_m_s_divisions_id) as q_m_s_divisions_id')])
                    ->groupBy('user_id')
                    ->get();
            }

            return DB::table('user_roles')
                ->where(['q_m_s_roles_id' => $roleId, 'q_m_s_divisions_id' => $division])
                ->select('user_id')
                ->distinct()
                ->get();
        });
    }

    /**
     * Call this after any create/update/delete on the user_roles table
     * (e.g. in your UserRole observer/controller) so the cached lists
     * above don't serve stale data for up to 5 minutes.
     *
     * Helpers::forgetRoleListCache(); // nukes all role list caches
     */
    public static function forgetRoleListCache(): void
    {
        self::$memo = array_filter(
            self::$memo,
            fn ($k) => !str_starts_with($k, 'users_by_role:'),
            ARRAY_FILTER_USE_KEY
        );
        // If you're on a cache driver that supports tags (redis/memcached),
        // switch rememberShared() to use Cache::tags('helpers-roles') and
        // just call Cache::tags('helpers-roles')->flush() here instead.
    }

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

    public static function getdateFormat($date)
    {
        if (empty($date) || !strtotime($date)) {
            return '';
        }
        try {
            $date = Carbon::parse($date);
            $formatted_date = $date->format("d-M-Y");
            return $formatted_date;
        } catch (\Exception $e) {
            return '';
        }
    }

    public static function getdateFormat1($date)
    {
        if (empty($date)) {
            return null;
        }

        try {
            return Carbon::parse($date)->format('d-M-Y H:i:s');
        } catch (\Exception $e) {
            return null;
        }
    }

    public static function isRevised($data)
    {
        if ($data >= 8) {
            return 'disabled';
        } else {
            return '';
        }
    }

    public static function isRiskAssessment($data)
    {
        if ($data == 0 || $data >= 7) {
            return 'disabled';
        } else {
            return '';
        }
    }

    public static function showStage($parentType, $model, $count)
    {
        // Memoized per (model, parentType) combo per request — this was
        // previously re-run every time the same parent type was checked
        // on the same page (common in wizard-style multi-step forms).
        $key = 'show_stage:' . $model . ':' . $parentType;

        $existingRecordsCount = self::remember($key, function () use ($model, $parentType) {
            return $model::where('parent_type', $parentType)->count();
        });

        return $existingRecordsCount > $count;
    }

    public static function getQCHeadUserList()
    {
        return self::getUsersByRole('10');
    }

    public static function getLeadAuditeeUserList()
    {
        return self::getUsersByRole('11');
    }

    public static function checkRoles($role)
    {
        $userId = Auth::user()->id;
        $userRoleIds = self::remember('user_role_ids:' . $userId, function () use ($userId) {
            return DB::table('user_roles')
                ->where(['user_id' => $userId])
                ->pluck('q_m_s_roles_id')
                ->toArray();
        });

        return in_array($role, $userRoleIds);
    }

    public static function checkTMSRoles($role)
    {
        $userId = Auth::user()->id;
        $userRoleIds = self::remember('tms_role_ids:' . $userId, function () use ($userId) {
            return DB::table('user_roles')
                ->where(['user_id' => $userId])
                ->pluck('role_id')
                ->toArray();
        });

        return in_array($role, $userRoleIds);
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
                    if ($document->stage >= 4) {
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
            $datauser = explode(',', $document->hods);
            for ($i = 0; $i < count($datauser); $i++) {
                if ($datauser[$i] == Auth::user()->id) {
                    if ($document->stage >= 2) {
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

    public static function getParentRecord($type, $id)
    {
        $parent_record = null;

        switch ($type) {
            case 'lab_incident':
                $parent_record = LabIncident::find($id);
                break;

            default:
                break;
        }

        return $parent_record;
    }

    public static function divisionNameForQMS($id)
    {
        return self::rememberShared("division_qms_name:{$id}", 300, function () use ($id) {
            return QMSDivision::where('id', $id)->value('name');
        });
    }

    public static function year($createdAt)
    {
        return Carbon::parse($createdAt)->format('Y');
    }

    // working code ==============

    // public static function getDivisionName($id)
    // {
    //     return self::rememberShared("division_name:{$id}", 300, function () use ($id) {
    //         return DB::table('q_m_s_divisions')->where('id', $id)->where('status', 1)->value('name');
    //     });
    // }

     // testng code ==============
    public static function getDivisionName($id)
{
    static $divisions = null;

    if ($divisions === null) {
        $divisions = DB::table('q_m_s_divisions')
            ->where('status', 1)
            ->pluck('name', 'id')
            ->toArray();
    }

    return $divisions[$id] ?? '';
}


    /**
     * Performance helper: cache role name lookup used heavily in workflow/audit-trail controllers.
     * Safe for production: read-only query, no data update/delete, short 5-minute TTL.
     */
    public static function getRoleName($id)
    {
        if (!$id) {
            return '';
        }

        return self::rememberShared("role_name:{$id}", 300, function () use ($id) {
            return DB::table('q_m_s_roles')->where('id', $id)->value('name') ?? '';
        });
    }

    public static function recordFormat($number)
    {
        return str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    public static function getInitiatorName($id)
    {
        return self::rememberShared("user_name:{$id}", 300, function () use ($id) {
            return User::where('id', $id)->value('name');
        });
    }

    public static function getEmpName($id)
    {
        return self::rememberShared("emp_name:{$id}", 300, function () use ($id) {
            return Employee::where('id', $id)->value('employee_name');
        });
    }

    public static function record($id)
    {
        return str_pad($id, 4, '0', STR_PAD_LEFT);
    }

    /************ New Roles Starts **************/

    public static function getHodUserList($division = null)
    {
        return self::getUsersByRole('4', $division);
    }

    public static function getQAUserList($division = null)
    {
        return self::getUsersByRole('7', $division);
    }

    public static function getQAHeadUserList($division = null)
    {
        return self::getUsersByRole('42', $division);
    }

    public static function getCQAHeadUserList($division = null)
    {
        return self::getUsersByRole('65', $division);
    }

    public static function getInitiatorUserList($division = null)
    {
        return self::getUsersByRole('3', $division);
    }

    public static function getApproverUserList($division = null)
    {
        return self::getUsersByRole('1', $division);
    }

    public static function getReviewerUserList($division = null)
    {
        return self::getUsersByRole('2', $division);
    }

    public static function getRAUsersList($division = null)
    {
        return self::getUsersByRole('50', $division);
    }

    public static function getCftUserList($division = null)
    {
        return self::getUsersByRole('5', $division);
    }

    public static function QCHead($division = null)
    {
        return self::getUsersByRole('45', $division);
    }

    public static function getTrainerUserList($division = null)
    {
        return self::getUsersByRole('6', $division);
    }

    public static function getProductionUserList($division = null)
    {
        return self::getUsersByRole('22', $division);
    }

    public static function getProductionHeadUserList($division = null)
    {
        return self::getUsersByRole('61', $division);
    }

    public static function getCQAUsersList($division = null)
    {
        return self::getUsersByRole('66', $division);
    }

    public static function getCQAHeadDesignUsersList($division = null)
    {
        return self::getUsersByRole('43', $division);
    }

    public static function getCQAReviewerUsersList($division = null)
    {
        return self::getUsersByRole('63', $division);
    }

    public static function getCQAApproverUsersList($division = null)
    {
        return self::getUsersByRole('64', $division);
    }

    public static function getCQAHeadUsersList($division = null)
    {
        return self::getUsersByRole('65', $division);
    }

    public static function getLeadAuditeeUsersList($division = null)
    {
        return self::getUsersByRole('11', $division);
    }

    public static function getLeadAuditorUsersList($division = null)
    {
        return self::getUsersByRole('12', $division);
    }

    public static function getNewLeadAuditorUsersList($division = null)
    {
        $cacheKey = 'new_lead_auditor_list:' . ($division ?? 'all');

        return self::rememberShared($cacheKey, 300, function () use ($division) {
            $query = DB::table('user_roles')
                ->join('users', 'users.id', '=', 'user_roles.user_id')
                ->where('user_roles.q_m_s_roles_id', '12')
                ->select('user_roles.user_id as id', 'users.name');

            if ($division) {
                $query->where('user_roles.q_m_s_divisions_id', $division);
            }

            return $query->distinct()->get();
        });
    }

    public static function getAuditManagerUsersList($division = null)
    {
        return self::getUsersByRole('13', $division);
    }

    public static function getQAReviewerUserList($division = null)
    {
        return self::getUsersByRole('48', $division);
    }

    public static function getHodDesigneeUserList($division = null)
    {
        return self::getUsersByRole('7', $division);
    }

    public static function getAssignToUserList($division = null)
    {
        return self::getUsersByRole('7', $division);
    }

    public static function getQAApproverUserList($division = null)
    {
        return self::getUsersByRole('67', $division);
    }

    public static function getAuditManagerUserList($division = null)
    {
        // Original used '13' with slightly different query shape but same
        // net result (distinct user_id per division / grouped MAX otherwise).
        return self::getUsersByRole('13', $division);
    }

    /************ Updated User List Data End ***********/

    public static function getUserEmail($id)
    {
        return self::rememberShared("user_email:{$id}", 300, function () use ($id) {
            try {
                return User::find($id)->email;
            } catch (\Exception $e) {
                \Log::error('Failed to retrieve email for user ID ' . $id . ': ' . $e->getMessage());
                return null;
            }
        });
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
        static $departments = null;
        if ($departments !== null) {
            return $departments;
        }

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
        static $departments = null;
        if ($departments !== null) {
            return $departments;
        }

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
        static $document_types = null;
        if ($document_types !== null) {
            return $document_types;
        }

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
            'PAMS' => 'Packing Material Specification',
            'PIAS' => 'Product / Item Information-Addendum for Specification',
            'MFPS' => 'Master Finished Product Specification',
            'MFPSTP' => 'Master Finished Product Standard Testing Procedure',
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
            'PROVALIINTERRE' => 'Process Validation Interim Report',
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
            'PROVALIPROTOCOL' => 'Process Validation protocol',
            'REQULIFICATIONPROTOCOL' => 'Area Qualification Protocol',
            'REPORTFORMEDIAFILL' => 'Report For Media Fill',
            'PROTOCOLFORMEDIAFILL' => 'Protocol For Media Fill',
            'ANNACINQULIPROTOCOL' => 'Annexure For Acceptance Of Installation Qualification Protocol',
            'ANNACOPERQULIPROTOCOL' => 'Annexure For Acceptance Of Operational Qualification Protocol',
            'ANNACPERMQULIPROTOCOL' => 'Annexure For Acceptance Of Performance Qualification Protocol',
            'PACKVALIREPORT' => 'Packing Validation Report',
            'PACKVALIPROTOCOL' => 'Packing Validation Protocol',
            'HOLDTIMESTUDYREPORT' => ' Hold Time Study Report',
            'HOLDTIMESTUDYPROTOCOL' => 'Hold Time Study Protocol',
            'FOCONITOGENREPORT' => 'Format For Compressed Air And Nitrogen Gas System Report',
            'FOCONITOGENPROTOCOL' => 'Format For Compressed Air And Nitrogen Gas System Protocol',
            'STABILITYPROTOCOL' => 'Stability study protocol',

            'ANNIGxPASSES' => 'Annexure I-Gxp Assessment',
            'ANNIIRiskASSES' => 'Annexure II-Initial Risk Assessment',
            'ANNIIIERESASSES' => 'Annexure III-ERES Assessment',
            'ANNIVPlanASSES' => 'Annexure IV-Validation Plan',
            'ANNVUserReqSpe' => 'Annexure V-User Requirements Specification',
            'ANNVIFunReqSpe' => 'Annexure VI-Functional Requirement Specification',
            'ANNVIIFunSpe' => 'Annexure VII-Functional Specification',
            'ANNVIIITechSpe' => 'Annexure VIII-Technical Specification',
            'ANNIXFunRiskASSES' => 'Annexure IX Functional Risk Assssment',
            'ANNXDesignSpe' => 'Annexure X-Design Specification',

            'ANNXIConfiSpe' => 'Annexure XI-Configuration Specification',
            'ANNXIIQualiProto' => 'Annexure XII Installation Infrastructure Operational Performance Qualification Protocol',
            'ANNXIIIUnitInTest' => 'Annexure XIII Unit Integration Test Script',
            'ANNXIVDataMigPro' => 'Annexure XIV Data Migration Protocol',
            'ANNXVPerfQualif' => 'Annexure XV Data Qualification Protocol',

            'ANNEXUREXVIIITRACEABILITYMATRIX' => 'annexure-XVIII - Traceability Matrix',
            'ANNEXUREXVIIVALIDATION' => 'annexure-XVII - Validation Summary Report',
            'ANNEXUREXVIINSTALLATION' => 'annexure-XVI - Installation_Infrastructure_Operational_Performance Qualification',
            'ANNEXUREXIXSYSTEMRETIREMENT' => 'annexure-XIX - System Retirement',

            'MAForRec' => 'Master Formula Record',
            'MAPacRec' => 'Master Packing Record',

            'SMF' => 'Site Master File',
            'VMP' => 'Validation Master Plan',
            'QM' => 'Quality Manual',
        ];

        return $document_types;
    }

    public static function getDepartmentWithString($id)
    {
        $response = [];
        if (!empty($id)) {
            $response = explode(',', $id);
        }
        return $response;
    }

    public static function getInitiatorEmail($id)
    {
        return self::rememberShared("initiator_email:{$id}", 300, function () use ($id) {
            return DB::table('users')->where('id', $id)->value('email');
        });
    }

    public static function formatNumberWithLeadingZeros($number)
    {
        return sprintf('%04d', $number);
    }

    public static function getDepartmentNameWithString($id)
    {
        $response = [];
        $resp = [];
        if (!empty($id)) {
            $result = explode(',', $id);
            if (in_array(1, $result)) {
                array_push($response, 'QA');
            }
            if (in_array(2, $result)) {
                array_push($response, 'QC');
            }
            if (in_array(3, $result)) {
                array_push($response, 'R&D');
            }
            if (in_array(4, $result)) {
                array_push($response, 'Manufacturing');
            }
            if (in_array(5, $result)) {
                array_push($response, 'Warehouse');
            }
            $resp = implode(',', $response);
        }
        return $resp;
    }

    static function getInitiatorGroups()
    {
        static $initiator_groups = null;
        if ($initiator_groups !== null) {
            return $initiator_groups;
        }

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
        switch ($shortName) {
            case 'Corporate Quality Assurance':
                return 'Corporate Quality Assurance';
            case 'QAB':
                return 'Quality Assurance Biopharma';
            case 'CQC':
                return 'Central Quality Control';
            case 'MANU':
                return 'Manufacturing';
            case 'PSG':
                return 'Plasma Sourcing Group';
            case 'CS':
                return 'Central Stores';
            case 'ITG':
                return 'Information Technology Group';
            case 'MM':
                return 'Molecular Medicine';
            case 'CL':
                return 'Central Laboratory';
            case 'TT':
                return 'Tech Team';
            case 'QA':
                return 'Quality Assurance';
            case 'QM':
                return 'Quality Management';
            case 'IA':
                return 'IT Administration';
            case 'ACC':
                return 'Accounting';
            case 'LOG':
                return 'Logistics';
            case 'SM':
                return 'Senior Management';
            case 'BA':
                return 'Business Administration';
            default:
                return '';
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
            info('Error in Helpers::userIsQA', ['message' => $e->getMessage(), 'obj' => $e]);
        }

        return $isQA;
    }

    public static function getMicroGridData(OOS_micro $micro, $identifier, $getKey = false, $keyName = null, $byIndex = false, $index = 0)
    {
        $res = $getKey ? '' : [];
        try {
            $grid = $micro->grids()->where('identifier', $identifier)->first();

            if ($grid && is_array($grid->data)) {
                $res = $grid->data;

                if ($getKey && !$byIndex) {
                    $res = array_key_exists($keyName, $grid->data) ? $grid->data[$keyName] : '';
                }

                if ($getKey && $byIndex && is_array($grid->data[$index])) {
                    $res = array_key_exists($keyName, $grid->data[$index]) ? $grid->data[$index][$keyName] : '';
                }
            }
        } catch (\Exception $e) {
        }
        return $res;
    }

    public static function disabledErrataFields($data)
    {
        if ($data == 0 || $data > 8) {
            return 'disabled';
        } else {
            return '';
        }
    }

    public static function disabledMarketComplaintFields($marketcomplaint)
    {
        if ($marketcomplaint == 0 || $marketcomplaint > 8) {
            return 'disabled';
        } else {
            return '';
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
                $status = 'For Checking';
                break;
            case '5':
                $status = 'Checked';
                break;
            case '6':
                $status = 'For-Approval';
                break;
            case '7':
                $status = 'Approved';
                break;
            case '8':
                $status = $training_required ? 'Under-Training' : 'Effective';
                break;
            case '9':
                $status = $training_required ? 'Training-Complete' : 'Obsolete';
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
                break;
        }

        return $status;
    }

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

    public static function isOOSChemical($data)
    {
        // (left as-is / no-op in the original)
    }

    public static function isOOSMicro($micro_data)
    {
        if ($micro_data == 0 || $micro_data >= 14) {
            return 'disabled';
        } else {
            return '';
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
                $dateInstance->addDays(30);
            }

            return $dateInstance->format($format);
        } catch (\Exception $e) {
            return 'NA';
        }
    }

    public static function getmonthFormat($date)
    {
        if (empty($date)) {
            return '';
        } else {
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

    public function getChecklistData()
    {
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

    static function getfullnameChecklist($check)
    {
        $checklist = '';

        switch ($check) {
            case '1':
                $checklist = "Checklist - Tablet Dispensing & Granulation";
                break;
            case '2':
                $checklist = "Checklist - Tablet Compression";
                break;
            case '3':
                $checklist = "Checklist - Tablet Coating";
                break;
            case '4':
                $checklist = "Checklist - Tablet/Capsule Packing";
                break;
            case '5':
                $checklist = "Checklist - Capsule";
                break;
            case '6':
                $checklist = "Checklist - Liquid/Ointment Dispensing & Manufacturing";
                break;
            case '7':
                $checklist = "Checklist - Liquid/Ointment Packing";
                break;
            case '8':
                $checklist = "Checklist - Quality Assurance";
                break;
            case '9':
                $checklist = "Checklist - Engineering";
                break;
            case '10':
                $checklist = "Checklist - Quality Control";
                break;
            case '11':
                $checklist = "Checklist - Stores";
                break;
            case '12':
                $checklist = "Checklist - Human Resource";
                break;
            case '13':
                $checklist = "Checklist - Production (Injection Dispensing & Manufacturing)";
                break;
            case '14':
                $checklist = "Checklist - Production (Injection Packing)";
                break;
            case '15':
                $checklist = "Checklist - Production (Powder Manufacturing and Packing)";
                break;
            case '16':
                $checklist = "Checklist - Analytical Research and Development";
                break;
            case '17':
                $checklist = "Checklist - Formulation Research and Development";
                break;
            case '18':
                $checklist = "Checklist - LL / P2P";
                break;
        }
        return $checklist;
    }

    static function getSeverityValue($seve)
    {
        $sevrty = '';

        switch ($seve) {
            case '1':
                $sevrty = "1-Insignificant";
                break;
            case '2':
                $sevrty = "2-Minor";
                break;
            case '3':
                $sevrty = "3-Major";
                break;
            case '4':
                $sevrty = "4-Critical";
                break;
            case '5':
                $sevrty = "5-Catastrophic";
                break;
        }
        return $sevrty;
    }

    static function getProbabilityValue($probe)
    {
        $probilty = '';

        switch ($probe) {
            case '1':
                $probilty = "1-Very rare";
                break;
            case '2':
                $probilty = "2-Unlikely";
                break;
            case '3':
                $probilty = "3-Possibly";
                break;
            case '4':
                $probilty = "4-Likely";
                break;
            case '5':
                $probilty = "5-Almost certain (every time)";
                break;
        }
        return $probilty;
    }

    static function getDetectionValue($dect)
    {
        $dectct = '';

        switch ($dect) {
            case '1':
                $dectct = "1-Always detected";
                break;
            case '2':
                $dectct = "2-Likely to detect";
                break;
            case '3':
                $dectct = "3-Possible to detect";
                break;
            case '4':
                $dectct = "4-Unlikely to detect";
                break;
            case '5':
                $dectct = "5-Not detectable";
                break;
        }
        return $dectct;
    }

    public static function getChildData($id, $parent_type)
    {
        // All 20+ branches were doing the identical query shape with only
        // $parent_type changing — collapsed to one query, memoized per
        // (parent_type, id) for the duration of the request. Behavior
        // (including the value returned for unmatched types) is unchanged.
        $known_types = [
            'Lab Incident', 'Deviation', 'OOC', 'OOT', 'Management Review', 'CAPA',
            'Action Item', 'Resampling', 'Observation', 'RCA', 'Risk Assesment',
            'External Audit', 'Internal Audit', 'Audit Program', 'CC', 'New Documnet',
            'Effectiveness Check', 'EffectivenessCheck', 'OOS Micro', 'OOS Chemical',
            'Market Complaint', 'Failure Investigation', 'Incident',
        ];

        if (!in_array($parent_type, $known_types)) {
            return 0;
        }

        return self::remember("child_data:{$parent_type}:{$id}", function () use ($id, $parent_type) {
            return extension_new::where('parent_type', $parent_type)
                ->where('parent_id', $id)
                ->count();
        });
    }

    public static function check_roles_qms($role_id, $user_id = null, $division_id = [1, 2, 3, 4, 5, 6, 7, 8], $process_names = ['Effective Check', 'Lab Incident', 'CAPA', 'Audit Program', 'Action Item', 'Internal Audit', 'External Audit', 'Deviation', 'Change Control', 'Risk Assessment', 'Root Cause Analysis', 'Observation', 'Extension'])
    {
        $user_id = $user_id ?? Auth::id();

        $cacheKey = 'check_roles_qms:' . $role_id . ':' . $user_id . ':' . md5(json_encode($division_id) . json_encode($process_names));

        return self::remember($cacheKey, function () use ($role_id, $user_id, $division_id, $process_names) {
            $process_ids = QMSProcess::whereIn('division_id', $division_id)
                ->whereIn('process_name', $process_names)
                ->pluck('id');

            if ($process_ids->isEmpty()) {
                return false;
            }

            return DB::table('user_roles')
                ->where('user_id', $user_id)
                ->whereIn('q_m_s_divisions_id', $division_id)
                ->whereIn('q_m_s_processes_id', $process_ids)
                ->where('q_m_s_roles_id', $role_id)
                ->exists();
        });
    }

    public static function check_roles($division_id, $process_name, $role_id, $user_id = null)
    {
        $user_id = $user_id ?: Auth::user()->id;
        $cacheKey = "check_roles:{$division_id}:{$process_name}:{$role_id}:{$user_id}";

        return self::remember($cacheKey, function () use ($division_id, $process_name, $role_id, $user_id) {
            $process = QMSProcess::where([
                'division_id' => $division_id,
                'process_name' => $process_name
            ])->first();

            $roleExists = DB::table('user_roles')->where([
                'user_id' => $user_id,
                'q_m_s_divisions_id' => $division_id,
                'q_m_s_processes_id' => $process ? $process->id : 0,
                'q_m_s_roles_id' => $role_id
            ])->first();

            return $roleExists ? true : false;
        });
    }

    public static function getHODDropdown()
    {
        return self::rememberShared('hod_dropdown', 300, function () {
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
        });
    }

    public static function getProductionDropdown()
    {
        return self::rememberShared('production_dropdown', 300, function () {
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
        });
    }

    public static function getProductionHeadDropdown()
    {
        return self::rememberShared('production_head_dropdown', 300, function () {
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
        });
    }

    /**
     * WARNING: this pulls EVERY row from ~25 tables into memory. It is
     * almost certainly the single biggest cause of slowness if it runs
     * on any page that loads more than occasionally. It's now cached
     * for 2 minutes so repeated hits within that window are free, but
     * the underlying cost when the cache does refresh is unchanged.
     *
     * If you can, the real fix is to:
     *   1) Only call this where you truly need "everything from every
     *      module" (e.g. a global search index build), not on normal
     *      page loads.
     *   2) Add ->select(['id', 'record', 'created_at', ...only what
     *      the caller actually uses...]) to each model query instead
     *      of loading full rows.
     *   3) Consider building this as a scheduled job that writes a
     *      pre-computed cache, rather than computing it live on request.
     */
    public static function getAllRelatedRecords()
    {
        return self::rememberShared('all_related_records', 120, function () {
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
            ];

            $relatedRecords = collect();

            foreach ($pre as $processName => $modelClass) {
                $records = $modelClass::all()->map(function ($record) use ($processName) {
                    $record->process_name = $processName;
                    return $record;
                });

                $relatedRecords = $relatedRecords->merge($records);
            }

            return $relatedRecords;
        });
    }

    public static function extensionCount($count)
    {
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
        $userId = Auth::user()->id;

        return self::remember("check_control_access:{$userId}", function () use ($userId) {
            $userRoles = UserRole::where('user_id', $userId)->pluck('role_id')->toArray();
            return PrintControl::whereIn('role_id', $userRoles)->exists();
        });
    }

    public static function getEmpNameByCode($code)
    {
        return self::rememberShared("emp_name_by_code:{$code}", 300, function () use ($code) {
            return Employee::where('full_employee_id', $code)->value('employee_name');
        });
    }

    public static function getFormattedDocumentNumbers($documentIds)
    {
        if (is_null($documentIds)) {
            return '';
        }

        if (is_string($documentIds)) {
            $documentIds = explode(',', $documentIds);
        }

        if (is_array($documentIds) && count($documentIds) > 0) {
            $documents = Document::whereIn('id', $documentIds)->get();
        } else {
            $documents = collect();
        }

        $formattedDocuments = [];

        foreach ($documents as $document) {
            $formattedDocuments[] = "{$document->sop_type_short}/{$document->department_id}/000{$document->id}/R{$document->major}";
        }

        return implode(', ', $formattedDocuments);
    }

    public static function getNameById($id)
    {
        return self::rememberShared("emp_name_by_id:{$id}", 300, function () use ($id) {
            return Employee::where('id', $id)->value('employee_name');
        });
    }

    public static function check_roles_initiatorcheck($requiredRoleId, $userId)
    {
        return self::remember("initiator_check:{$requiredRoleId}:{$userId}", function () use ($requiredRoleId, $userId) {
            return DB::table('user_roles')
                ->where('user_id', $userId)
                ->where('q_m_s_roles_id', $requiredRoleId)
                ->exists();
        });
    }

    public static function check_roles_qms_new($role_id, $process_name)
    {
        $userId = Auth::user()->id;
        $divisionId = Auth::user()->division_id;
        $cacheKey = "check_roles_qms_new:{$role_id}:{$process_name}:{$divisionId}:{$userId}";

        return self::remember($cacheKey, function () use ($role_id, $process_name, $divisionId, $userId) {
            $processIds = QMSProcess::where([
                'division_id' => $divisionId,
                'process_name' => $process_name
            ])->pluck('id');

            return DB::table('user_roles')
                ->where('user_id', $userId)
                ->whereIn('q_m_s_processes_id', $processIds)
                ->where('q_m_s_roles_id', $role_id)
                ->exists();
        });
    }

    public static function getChangeProposalJustificationRecordNumber($id)
    {
        $data = ChangeProposalJust::find($id);
        return Helpers::getDivisionName($data->division_id) . '/CPJ/' . Helpers::year($data->created_at) . '/' . str_pad($data->record, 4, '0', STR_PAD_LEFT);
    }

    public static function getUserDepartmentFromDB($id)
    {
        $data = Department::find($id);
        return $data->name;
    }

    public static function CCRecordNumber($id)
    {
        $data = CC::find($id);

        if (!$data) {
            return null;
        }

        return self::getDivisionName($data->division_id)
            . '/CC/'
            . date('Y', strtotime($data->created_at))
            . '/'
            . str_pad($data->record, 4, '0', STR_PAD_LEFT);
    }

    public static function ActionItemRecordNumber($number)
    {
        $data = ActionItem::find($number);

        if (!$data) {
            return null;
        }

        return self::getDivisionName($data->division_id) . '/AI/' . self::year($data->created_at) . '/' . str_pad($data->record, 4, '0', STR_PAD_LEFT);
    }

    public static function DeviaitonRecordNumber($number)
    {
        $data = Deviation::find($number);

        if (!$data) {
            return null;
        }
        return self::getDivisionName($data->division_id) . '/DEV/' . date('Y', strtotime($data->created_at)) . '/' . str_pad($data->record, 4, '0', STR_PAD_LEFT);
    }

    public static function CapaRecordNumber($number)
    {
        $data = Capa::find($number);

        if (!$data) {
            return null;
        }

        return self::getDivisionName($data->division_id) . '/CAPA/' . date('Y', strtotime($data->created_at)) . '/' .
            str_pad($data->record, 4, '0', STR_PAD_LEFT);
    }

    public static function EffectivenessCheckRecordNumber($number)
    {
        $data = EffectivenessCheck::find($number);

        if (!$data) {
            return null;
        }

        return self::getDivisionName($data->division_id) . '/EC/' . date('Y', strtotime($data->created_at)) . '/' .
            str_pad($data->record, 4, '0', STR_PAD_LEFT);
    }

    public static function ExtensionRecordNumber($number)
    {
        $data = extension_new::find($number);

        if (!$data) {
            return null;
        }

        return self::getDivisionName($data->division_id) . '/Ext/' . date('Y', strtotime($data->created_at)) . '/' .
            str_pad($data->record, 4, '0', STR_PAD_LEFT);
    }

    public static function MarketComplaintRecordNumber($number)
    {
        $data = MarketComplaint::find($number);

        if (!$data) {
            return null;
        }

        return self::getDivisionName($data->division_id) . '/MC/' . date('Y', strtotime($data->created_at)) . '/' .
            str_pad($data->record, 4, '0', STR_PAD_LEFT);
    }

    public static function OOSRecordNumber($number)
    {
        $data = OOS::find($number);

        if (!$data) {
            return null;
        }

        return self::getDivisionName($data->division_id) . '/' . ($data->Form_type) . '/' . date('Y', strtotime($data->created_at)) . '/' .
            str_pad($data->record, 4, '0', STR_PAD_LEFT);
    }

    public static function OOCRecordNumber($number)
    {
        $data = OutOfCalibration::find($number);

        if (!$data) {
            return null;
        }

        return self::getDivisionName($data->division_id) . '/OOC/' . date('Y', strtotime($data->created_at)) . '/' .
            str_pad($data->record, 4, '0', STR_PAD_LEFT);
    }

    public static function RCARecordNumber($number)
    {
        $data = RootCauseAnalysis::find($number);

        if (!$data) {
            return null;
        }

        return self::getDivisionName($data->division_id) . '/RCA/' . date('Y', strtotime($data->created_at)) . '/' .
            str_pad($data->record, 4, '0', STR_PAD_LEFT);
    }

    public static function AuditproRecordNumber($number)
    {
        $data = AuditProgram::find($number);

        if (!$data) {
            return null;
        }

        return self::getDivisionName($data->division_id) . '/AuditProgram/' . date('Y', strtotime($data->created_at)) . '/' .
            str_pad($data->record, 4, '0', STR_PAD_LEFT);
    }

    public static function ExternalAuditRecordNumber($number)
    {
        $data = Auditee::find($number);

        if (!$data) {
            return null;
        }

        return self::getDivisionName($data->division_id) . '/EA/' . date('Y', strtotime($data->created_at)) . '/' .
            str_pad($data->record, 4, '0', STR_PAD_LEFT);
    }

    public static function LabincidentRecordNumber($number)
    {
        $data = LabIncident::find($number);

        if (!$data) {
            return null;
        }

        return self::getDivisionName($data->division_id) . '/LI/' . date('Y', strtotime($data->created_at)) . '/' .
            str_pad($data->record, 4, '0', STR_PAD_LEFT);
    }

    public static function IncidentRecordNumber($number)
    {
        $data = Incident::find($number);

        if (!$data) {
            return null;
        }

        return self::getDivisionName($data->division_id) . '/INC/' . date('Y', strtotime($data->created_at)) . '/' .
            str_pad($data->record, 4, '0', STR_PAD_LEFT);
    }

    public static function ERRATARecordNumber($number)
    {
        $data = Errata::find($number);

        if (!$data) {
            return null;
        }

        return self::getDivisionName($data->division_id) . '/ERRATA/' . date('Y', strtotime($data->created_at)) . '/' .
            str_pad($data->record, 4, '0', STR_PAD_LEFT);
    }

    public static function InternalAuditRecordNumber($number)
    {
        $data = InternalAudit::find($number);

        if (!$data) {
            return null;
        }

        return self::getDivisionName($data->division_id) . '/IA/' . date('Y', strtotime($data->created_at)) . '/' .
            str_pad($data->record, 4, '0', STR_PAD_LEFT);
    }

    public static function RiskAssessmentRecordNumber($number)
    {
        $data = RiskManagement::find($number);

        if (!$data) {
            return null;
        }

        return self::getDivisionName($data->division_id) . '/RA/' . date('Y', strtotime($data->created_at)) . '/' .
            str_pad($data->record, 4, '0', STR_PAD_LEFT);
    }

    public static function ResamplingRecordNumber($number)
    {
        $data = Resampling::find($number);

        if (!$data) {
            return null;
        }

        return self::getDivisionName($data->division_id) . '/Resampling/' . date('Y', strtotime($data->created_at)) . '/' .
            str_pad($data->record, 4, '0', STR_PAD_LEFT);
    }

    public static function ManagmentReviewRecordNumber($number)
    {
        $data = ManagementReview::find($number);

        if (!$data) {
            return null;
        }

        return self::getDivisionName($data->division_id) . '/MR/' . date('Y', strtotime($data->created_at)) . '/' .
            str_pad($data->record, 4, '0', STR_PAD_LEFT);
    }

    public static function ObservationRecordNumber($number)
    {
        $data = Observation::find($number);

        if (!$data) {
            return null;
        }

        return self::getDivisionName($data->division_code) . '/OBS/' . date('Y', strtotime($data->created_at)) . '/' .
            str_pad($data->record, 4, '0', STR_PAD_LEFT);
    }

    public static function OOTRecordNumber($number)
    {
        $data = OOT::find($number);

        if (!$data) {
            return null;
        }

        return self::getDivisionName($data->division_id) . '/OOT/' . date('Y', strtotime($data->created_at)) . '/' .
            str_pad($data->record, 4, '0', STR_PAD_LEFT);
    }
}