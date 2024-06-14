<?php

namespace App\Http\Controllers\Api;

use App\Models\Deviation;
use App\Models\CC;
use App\Models\errata;
use App\Models\FailureInvestigation;
use App\Models\MarketComplaint;
use App\Models\OutOfCalibration;
use App\Models\LabIncident;
use App\Models\InternalAudit;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Capa;
use App\Http\Controllers\Controller;


class LogFilterController extends Controller
{
    public function capa_filter(Request $request)
    {
        $res = [
            'status' => 'ok',
            'message' => 'success',
            'body' => []
        ];

        try {

            
            $query = Capa::query();
            
            if ($request->departmentCapa)
            {
                $query->where('Initiator_Group', $request->departmentCapa);
            }

            if ($request->division_idCapa) {
                $query->where('division_id', $request->division_idCapa);
            }

            if($request->capa_types)
            {
                $query->where('capa_type',$request->capa_types);
            }

            if ($request->date_fromCapa) {
               
                $dateFrom = Carbon::parse($request->date_fromCapa)->startOfDay();
               
                $query->whereDate('intiation_date', '>=', $dateFrom);
            }
    
            if ($request->date_toCapa) {
              
                $dateTo = Carbon::parse($request->date_toCapa)->endOfDay();
              
                $query->whereDate('intiation_date', '<=', $dateTo);
            }

           
            $capa = $query->get();

            $htmlData = view('frontend.forms.Logs.comps.capa_data', compact('capa'))->render();

            $res['body'] = $htmlData;


        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();
        }


        return response()->json($res);
    }

    
    public function failureInv_filter(Request $request)
        {
            $res = [
                'status' => 'ok',
                'message' => 'success',
                'body' => []
            ];
    
            try {
    
                
                $query = FailureInvestigation::query();
                
                if ($request->department)
                {
                    $query->where('Initiator_Group', $request->department);
                }
    
                if($request->division_id)
                {
                    $query->where('division_id',$request->division_id);
                }
    
                
    
                // if($request->nchange)
                // {
                //     $query->where('doc_change',$request->nchange);
                // }
    
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
                
                // if($request->error_er)
                // {
                //     $query->where('type_of_error',$request->error_er);
                // }
                
    
    
                $failure = $query->get();
    
                $htmlData = view('frontend.forms.Logs.filterData.failureinvestigation_data', compact('failure'))->render();
                
    
                $res['body'] = $htmlData;
    
    
            } catch (\Exception $e) {
                $res['status'] = 'error';
                $res['message'] = $e->getMessage();
            }
    
    
            return response()->json($res);
            
        }
    
    
    
        public function internal_audit_filter(Request $request)
        {
            $res = [
                'status' => 'ok',
                'message' => 'success',
                'body' => []
            ];
    
            try {
    
                
                $query = InternalAudit::query();
                
                if ($request->department)
                {
                    $query->where('Initiator_Group', $request->department);
                }
    
                if($request->division_id)
                {
                    $query->where('division_id',$request->division_id);
                }
    
                
    
                if($request->taudit)
                {
                    $query->where('audit_type',$request->taudit);
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
                   
                    $dateFrom = Carbon::parse($request->date_from)->startOfDay();
                   
                    $query->whereDate('intiation_date', '>=', $dateFrom);
                }
        
                if ($request->date_to) {
                  
                    $dateTo = Carbon::parse($request->date_to)->endOfDay();
                  
                    $query->whereDate('intiation_date', '<=', $dateTo);
                }
                
    
    
                $internal_audi = $query->get();
    
                $htmlData = view('frontend.forms.Logs.comps.internal_audit_data', compact('internal_audi'))->render();
                
    
                $res['body'] = $htmlData;
    
    
            } catch (\Exception $e) {
                $res['status'] = 'error';
                $res['message'] = $e->getMessage();
    
            }
    
    
            return response()->json($res);
            
        }






        public function labincident_filter(Request $request)
    {
        $res = [
            'status' => 'ok',
            'message' => 'success',
            'body' => []
        ];

        try {

            
            $query = LabIncident::query();
            
            if ($request->department_Lab)
            {
                $query->where('Initiator_Group', $request->department_Lab);
            }
            if($request->divivisionLab_id)
            {
                $query->where('division_id',$request->divivisionLab_id);
            }

            if ($request->period_lab) {
                $currentDate = Carbon::now();
                switch ($request->period_lab) {
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

            if ($request->dateFrom) {
               
                $datefrom = Carbon::parse($request->dateFrom)->startOfDay();
               
                $query->whereDate('intiation_date', '>=', $datefrom);
            }
    
            if ($request->dateTo) {
              
                $dateo = Carbon::parse($request->dateTo)->endOfDay();
              
                $query->whereDate('intiation_date', '<=', $dateo);
            }
            if($request->TypeOFIncidence)
            {
                $query->where('type_incidence_ia',$request->TypeOFIncidence);
            }


            $labincident = $query->get();

            $htmlData = view('frontend.forms.Logs.filterData.labincident_data', compact('labincident'))->render();
            

            $res['body'] = $htmlData;


        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();

        }


        return response()->json($res);
        
    }


    public function marketcomplaint_filter(Request $request)
    {
        $res = [
            'status' => 'ok',
            'message' => 'success',
            'body' => []
        ];

        try {

            
            $query = MarketComplaint::query();
            
            if ($request->market_department)
            {
                $query->where('Initiator_Group', $request->market_department);
            }

            if($request->div_idcomplaint)
            {
                $query->where('division_id',$request->div_idcomplaint);
            }
            if($request->categoryofcomplaints)
            {
                $query->where('categorization_of_complaint_gi',$request->categoryofcomplaints);
            }

            if ($request->period_lab) {
                $currentDate = Carbon::now();
                switch ($request->period_lab) {
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

            if ($request->dateMarketFrom) {
               
                $datefrom = Carbon::parse($request->dateMarketFrom)->startOfDay();
               
                $query->whereDate('intiation_date', '>=', $datefrom);
            }
    
            if ($request->dateMarketTo) {
              
                $dateo = Carbon::parse($request->dateMarketTo)->endOfDay();
              
                $query->whereDate('intiation_date', '<=', $dateo);
            }

            $marketcomplaint = $query->get();

            $htmlData = view('frontend.forms.Logs.filterData.marketcomplaint_data', compact('marketcomplaint'))->render();
            

            $res['body'] = $htmlData;


        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();

        }


        return response()->json($res);
        
    }



    public function ooc_filter(Request $request)
    {
        $res = [
            'status' => 'ok',
            'message' => 'success',
            'body' => []
        ];

        try {

            
            $query = OutOfCalibration::query();
            
            if ($request->department_ooc)
            {
                $query->where('Initiator_Group', $request->department_ooc);
            }

            if($request->div_id)
            {
                $query->where('division_id',$request->div_id);
            }
            // if($request->categoryofcomplaints)
            // {
            //     $query->where('categorization_of_complaint_gi',$request->categoryofcomplaints);
            // }

            if ($request->period_lab) {
                $currentDate = Carbon::now();
                switch ($request->period_lab) {
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

            if ($request->date_OOC_from) {
               
                $datefrom = Carbon::parse($request->date_OOC_from)->startOfDay();
               
                $query->whereDate('intiation_date', '>=', $datefrom);
            }
    
            if ($request->date_OOC_to) {
              
                $dateo = Carbon::parse($request->date_OOC_to)->endOfDay();
              
                $query->whereDate('intiation_date', '<=', $dateo);
            }
            
            if($request->instrmentGrid)
            {
             $querys = OutOfCalibration::with('InstrumentDetails')->get();

                $q

            $oocs = $query->get();

            $htmlData = view('frontend.forms.Logs.comps.outofcalibration_data', compact('oocs'))->render();
            

            $res['body'] = $htmlData;


        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();

        }


        return response()->json($res);
        
    }

    

    
}    

