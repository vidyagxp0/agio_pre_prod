<?php

namespace App\Http\Controllers\Api;

use App\Models\Deviation;
use App\Models\CC;
use App\Models\errata;
use App\Models\FailureInvestigation;
use App\Models\MarketComplaint;
use App\Models\RiskManagement;
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

            $htmlData = view('frontend.forms.Logs.filterData.capa_data', compact('capa'))->render();

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
        
        if ($request->department_changecontrol) {
            $query->where('Initiator_Group', $request->department_changecontrol);
        }

        if ($request->division_id_changecontrol) {
            $query->where('division_id', $request->division_id_changecontrol);
        }

        if ($request->nchange) {
            $query->where('doc_change', $request->nchange);
        }

        if ($request->date_from_changecontrol) {
            $dateFrom = Carbon::parse($request->date_from_changecontrol)->startOfDay();
            $query->whereDate('intiation_date', '>=', $dateFrom);
        }

        if ($request->date_to_changecontrol) {
            $dateTo = Carbon::parse($request->date_to_changecontrol)->endOfDay();
            $query->whereDate('intiation_date', '<=', $dateTo);
        }

        $ccontrol = $query->get();

        $htmlData = view('frontend.forms.Logs.filterData.changecontrol_data', compact('ccontrol'))->render();

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
                
                if ($request->department_failureLog)
                {
                    $query->where('Initiator_Group', $request->department_failureLog);
                }
    
                if($request->div_id_failure)
                {
                    $query->where('division_id',$request->div_id_failure);
                }
    
                
    
                // if($request->nchange)
                // {
                //     $query->where('doc_change',$request->nchange);
                // }
    
                if ($request->period_failure) {
                    $currentDate = Carbon::now();
                    switch ($request->period_failure) {
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
    
                
                if ($request->dateFailureFrom) {
               
                    $datefrom = Carbon::parse($request->dateFailureFrom)->startOfDay();
                   
                    $query->whereDate('intiation_date', '>=', $datefrom);
                }
                
                if ($request->dateFailureTo) {
                    $dateTo = Carbon::parse($request->dateFailureTo)->startOfDay();
                    $query->whereDate('intiation_date', '>=', $dateTo);

                }
                
                
    
    
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
    
                $htmlData = view('frontend.forms.Logs.filterData.internal_audit_data', compact('internal_audi'))->render();
                
    
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
            
            if ($request->department_outofcalibration)
            {
                $query->where('Initiator_Group', $request->department_outofcalibration);
            }

            if($request->div_id_outofcalibration)
            {
                $query->where('division_id',$request->div_id_outofcalibration);
            }

            if ($request->instrument_equipment && $request->instrument_value) {
                if ($request->instrument_equipment === 'instrument_name') {
                    $query->where('instrument_name', $request->instrument_value);
                } elseif ($request->instrument_equipment === 'instrument_id') {
                    $query->where('instrument_id', $request->instrument_value);
                }
            }
    
            // if($request->categoryofcomplaints)
            // {
            //     $query->where('categorization_of_complaint_gi',$request->categoryofcomplaints);
            // }

            if ($request->period_outofcalibration) {
                $currentDate = Carbon::now();
                switch ($request->period_outofcalibration) {
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

            $oocs = $query->get();

            $htmlData = view('frontend.forms.Logs.filterData.outofcalibration_data', compact('oocs'))->render();
            

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

            $htmlData = view('frontend.forms.Logs.filterData.errata_data', compact('erratalog'))->render();
            

            $res['body'] = $htmlData;


        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();
        }


        return response()->json($res);
    }

    public function risk_management_filter(Request $request)
    {
        $res = [
            'status' => 'ok',
            'message' => 'success',
            'body' => []
        ];

        try {

            
            $query = RiskManagement::query();
            
            if ($request->department_risk)
            {
                $query->where('Initiator_Group', $request->department_risk);
            }

            if($request->division_id_risk)
            {
                $query->where('division_id',$request->division_id_risk);
            }

            if($request->sor)
            {
                $query->where('source_of_risk',$request->sor);
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

            if ($request->date_from_risk) {
                $query->whereDate('intiation_date', '>=', Carbon::parse($request->date_from_risk));
            }
            
            if ($request->date_to_risk) {
                $query->whereDate('intiation_date', '<=', Carbon::parse($request->date_to_risk));
            }

            if($request->error_er)
            {
                $query->where('type_of_error',$request->error_er);
            }
            


            $riskmlog = $query->get();

            $htmlData = view('frontend.forms.Logs.filterData.riskmanagement_data', compact('riskmlog'))->render();
            

            $res['body'] = $htmlData;


        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();
        }


        return response()->json($res);
    }

    public function deviation_filter(Request $request)
{
    $res = [
        'status' => 'ok',
        'message' => 'success',
        'body' => []
    ];

    try {
        $query = Deviation::query();

        if ($request->departmentDeviation) {
            $query->where('Initiator_Group', $request->departmentDeviation);
        }

        if ($request->division_idDeviation) {
            $query->where('division_id', $request->division_idDeviation);
        }

        if ($request->audit_type) {
            $query->where('audit_type', $request->audit_type);
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
                \Log::info("Filtering from period: {$request->period}, Start Date: {$startDate}");
            }
        }

        if ($request->date_fromDeviation) {
            $dateFrom = Carbon::parse($request->date_fromDeviation)->startOfDay();
            $query->whereDate('intiation_date', '>=', $dateFrom);
            \Log::info("Filtering from Date From: {$dateFrom}");
        }

        if ($request->date_toDeviation) {
            $dateTo = Carbon::parse($request->date_toDeviation)->endOfDay();
            $query->whereDate('intiation_date', '<=', $dateTo);
            \Log::info("Filtering to Date To: {$dateTo}");
        }

        $deviation = $query->get();

        $htmlData = view('frontend.forms.Logs.filterData.deviation_data', compact('deviation'))->render();

        $res['body'] = $htmlData;
    } catch (\Exception $e) {
        $res['status'] = 'error';
        $res['message'] = $e->getMessage();
        \Log::error("Deviation Filter Error: {$e->getMessage()}");
    }

    return response()->json($res);
}

    



    

    
}    

