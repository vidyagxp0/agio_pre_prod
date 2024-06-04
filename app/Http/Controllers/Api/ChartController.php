<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QMSDivision;
use Helpers;
use Illuminate\Http\Request;

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
