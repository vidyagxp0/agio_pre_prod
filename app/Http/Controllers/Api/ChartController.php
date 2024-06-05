<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Deviation;
use App\Models\Document;
use App\Models\QMSDivision;
use Carbon\Carbon;
use Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function process_charts()
    {
        $res = Helpers::getDefaultResponse();

        try {

            $modelClasses = [
                \App\Models\Extension::class,
                \App\Models\ActionItem::class,
                \App\Models\Observation::class,
                \App\Models\RootCauseAnalysis::class,
                \App\Models\RiskAssessment::class,
                \App\Models\ManagementReview::class,
                \App\Models\InternalAudit::class,
                \App\Models\AuditProgram::class,
                // \App\Models\CAPA::class,
                \App\Models\CC::class,
                \App\Models\Document::class,
                \App\Models\LabIncident::class,
                \App\Models\EffectivenessCheck::class,
                \App\Models\OOS::class,
                \App\Models\OOT::class,
                \App\Models\Ootc::class,
                \App\Models\Deviation::class,
                \App\Models\MarketComplaint::class,
                \App\Models\NonConformance::class,
                \App\Models\FailureInvestigation::class,
                // \App\Models\ERRATA::class,
                // \App\Models\OOS_micro::class
            ];

            $counts = [];

            foreach ($modelClasses as $modelClass)
            {
                array_push($counts, [
                    'classname' => class_basename($modelClass),
                    'count' => self::getProcessCount($modelClass)
                ]);
            }

            $counts = collect($counts)->filter(function($count) {
                return $count['count'] > 0;
            });


            $res['body'] = $counts->all();
            

        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();
        }

        return response()->json($res);
    }

    public function document_status_charts()
    {
        $res = Helpers::getDefaultResponse();

        try {

            $counts = [
                'Draft' => 0,
                'In-HOD Review' => 0,
                'HOD Review Complete' => 0,
                'In-Review' => 0,
                'Reviewed' => 0,
                'For-Approval' => 0,
                'Approved' => 0,
                'Pending-Traning' => 0,
                'Traning-Complete' => 0,
                'Effective' => 0,
                'Obsolete' => 0,
            ];

            foreach ($counts as $status => $count)
            {
                $documents_count = Document::where('status', $status)->get()->count();

                $counts[$status] = $documents_count;
            }

            $res['body'] = $counts;
            

        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();
        }

        return response()->json($res);
    }
    
    public function deviation_classification_charts()
    {
        $res = Helpers::getDefaultResponse();

        try {

            $data = [];

            for ($i = 5; $i >= 0; $i--)
            {
                $monthly_data = [];
                $month = Carbon::now()->subMonths($i);

                $minor_deviations = Deviation::where('Deviation_category', 'minor')
                                    ->whereDate('created_at', '>=', $month->startOfMonth())
                                    ->whereDate('created_at', '<=', $month->endOfMonth())
                                    ->get()->count();
                $major_deviations = Deviation::where('Deviation_category', 'major')
                                    ->whereDate('created_at', '>=', $month->startOfMonth())
                                    ->whereDate('created_at', '<=', $month->endOfMonth())
                                    ->get()->count();
                $critical_deviations = Deviation::where('Deviation_category', 'critical')
                                    ->whereDate('created_at', '>=', $month->startOfMonth())
                                    ->whereDate('created_at', '<=', $month->endOfMonth())
                                    ->get()->count();


                $monthly_data['month'] = $month->format('M');
                $monthly_data['minor'] = $minor_deviations;
                $monthly_data['major'] = $major_deviations;
                $monthly_data['critical'] = $critical_deviations;

                array_push($data, $monthly_data);
                
            }

            $res['body'] = $data;

        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();
        }

        return response()->json($res);
    }
    
    public function deviation_departments_charts()
    {
        $res = Helpers::getDefaultResponse();

        try {

            $departments = ["CQA","QAB","CQC","MANU","PSG","CS","ITG","MM","CL","TT","QA","QM","IA","ACC","LOG","SM","BA"];

            $data = [];

            for ($i = 5; $i >= 0; $i--)
            {
                $monthly_data = [];
                $month = Carbon::now()->subMonths($i);

                foreach ($departments as $department)
                {
                    $deviations = Deviation::where('Initiator_Group', $department)
                                    ->whereDate('created_at', '>=', $month->startOfMonth())
                                    ->whereDate('created_at', '<=', $month->endOfMonth())
                                    ->get()->count();

                    $data[$department][$month->format('F')] = $deviations;
                }
                
            }

            // foreach ($departments as $department)
            // {
            //     $collection = collect($data[$department]);

            //     $data[$department] = $collection->flatten()->all();
            // }

            $res['body'] = $data;

        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();
        }

        return response()->json($res);
    }
    
    public function documents_originator_charts()
    {
        $res = Helpers::getDefaultResponse();

        try {

            $data = Document::join('users', 'documents.originator_id', '=', 'users.id')
                    ->select('documents.originator_id', 'users.name as originator_name', DB::raw('count(*) as document_count'))
                    ->groupBy('documents.originator_id', 'users.name')
                    ->get();

            $res['body'] = $data;

        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();
        }

        return response()->json($res);
    }
   
    public function documents_type_charts()
    {
        $res = Helpers::getDefaultResponse();

        try {

            $data = Document::join('document_types', 'documents.document_type_id', '=', 'document_types.id')
                ->select('document_types.name as document_type_name', DB::raw('count(documents.id) as document_count'))
                ->groupBy('document_types.id', 'document_types.name')
                ->get();

            $res['body'] = $data;

        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();
        }

        return response()->json($res);
    }
    
    public function documents_review_charts($months)
    {
        $res = Helpers::getDefaultResponse();

        try {

            $today = Carbon::today();
            $monthsLater = $today->copy()->addMonths($months);

            $data = Document::where('next_review_date', '>=', $today)
                ->where('next_review_date', '<=', $monthsLater)
                ->get();

            $res['body'] = $data;

        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();
        }

        return response()->json($res);
    }

    


    // Helpers

    static function getProcessCount($model_namespace, $field = null, $value = null) {
        try {
            if ($field && $value) {
                return $model_namespace::where($field, $value)->get()->count();
            } else {
                return $model_namespace::get()->count();
            }
        } catch (\Exception $e) {
            return 0;
        }
    }
}
