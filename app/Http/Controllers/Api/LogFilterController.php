<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Deviation;
use App\Models\CC;
use App\Models\errata;
use Illuminate\Http\Request;
use Carbon\Carbon;


class LogFilterController extends Controller
{
    public function deviation_filter(Request $request)
    {
        $res = [
            'status' => 'ok',
            'message' => 'success',
            'body' => []
        ];

        try {

            
            $query = Deviation::query();
            
            if ($request->department)
            {
                $query->where('Initiator_Group', $request->department);
            }

            if ($request->division_id) {
                $query->where('division_id', $request->division_id);
            }

            if($request->audit_type)
            {
                $query->where('audit_type',$request->audit_type);
            }

            if ($request->date_from) {
                $dateFrom = Carbon::createFromFormat('d-M-Y', $request->date_from);
                $query->whereDate('initiation_date', '>=', $dateFrom);
            }
            
            if ($request->date_to) {
                $dateto = Carbon::createFromFormat('d-M-Y', $request->date_to);
                $query->whereDate('initiation_date', '<=', $dateto);
            }

            $deviation = $query->get();

            $htmlData = view('frontend.forms.Logs.comps.deviation_data', compact('deviation'))->render();

            $res['body'] = $htmlData;


        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();
        }


        return response()->json($res);
    }



    public function changecontrol_filter(Request $request)
    {
        $res = [
            'status' => 'ok',
            'message' => 'success',
            'body' => []
        ];

        try {

            
            $query = CC::query();
            
            if ($request->department_cc)
            {
                $query->where('Initiator_Group', $request->department_cc);
            }

            if($request->division_id)
            {
                $query->where('division_id',$request->division_id);
            }

            if($request->nchange)
            {
                $query->where('doc_change',$request->nchange);
            }

            if ($request->period) {
                $currentDate = Carbon::now();
                switch ($request->period) {
                    case 'Yearly':
                        $startDate = $currentDate->startOfYear();
                        break;
                    case 'Quarterly':
                        $startDate = $currentDate->firstOfQuarter();
                        break;
                    case 'Monthly':
                        $startDate = $currentDate->startOfMonth();
                        break;
                    default:
                        $startDate = null;
                        break;
                }
                if ($startDate) {
                    $query->whereDate('intiation_date', '>=', $startDate);
                }
            }

            if ($request->date_from) {
                $query->whereDate('intiation_date', '>=', Carbon::parse($request->date_from));
            }
            
            if ($request->date_to) {
                $query->whereDate('intiation_date', '<=', Carbon::parse($request->date_to));
            }
            


            $ccontrol = $query->get();

            $htmlData = view('frontend.forms.Logs.comps.changecontrol_data', compact('ccontrol'))->render();
            

            $res['body'] = $htmlData;


        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();
        }


        return response()->json($res);
    }


    public function errata_filter(Request $request)
    {
        $res = [
            'status' => 'ok',
            'message' => 'success',
            'body' => []
        ];

        try {

            
            $query = errata::query();
            
            if ($request->department_e)
            {
                $query->where('department_code', $request->department_e);
            }

            if($request->division_id)
            {
                $query->where('division_id',$request->division_id);
            }

            if($request->nchange)
            {
                $query->where('doc_change',$request->nchange);
            }

            if ($request->period) {
                $currentDate = Carbon::now();
                switch ($request->period) {
                    case 'Yearly':
                        $startDate = $currentDate->startOfYear();
                        break;
                    case 'Quarterly':
                        $startDate = $currentDate->firstOfQuarter();
                        break;
                    case 'Monthly':
                        $startDate = $currentDate->startOfMonth();
                        break;
                    default:
                        $startDate = null;
                        break;
                }
                if ($startDate) {
                    $query->whereDate('intiation_date', '>=', $startDate);
                }
            }

            if ($request->date_from) {
                $query->whereDate('intiation_date', '>=', Carbon::parse($request->date_from));
            }
            
            if ($request->date_to) {
                $query->whereDate('intiation_date', '<=', Carbon::parse($request->date_to));
            }

            if($request->error_er)
            {
                $query->where('type_of_error',$request->error_er);
            }
            


            $erratalog = $query->get();

            $htmlData = view('frontend.forms.Logs.comps.errata_data', compact('erratalog'))->render();
            

            $res['body'] = $htmlData;


        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();
        }


        return response()->json($res);
    }

    
}
