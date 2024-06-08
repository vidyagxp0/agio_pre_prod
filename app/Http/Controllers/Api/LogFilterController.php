<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Deviation;
use App\Models\CC;
use App\Models\errata;
use App\Models\FailureInvestigation;
use App\Models\MarketComplaint;
use App\Models\OutOfCalibration;
use App\Models\LabIncident;
use App\Models\Capa;
use App\Models\InternalAudit;
use Illuminate\Http\Request;
use Carbon\Carbon;


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
    public function deviation_filter(Request $request)
    {
        $res = [
            'status' => 'ok',
            'message' => 'success',
            'body' => []
        ];

        try {

            
            $query = Deviation::query();
            
            if ($request->departmentDeviation)
            {
                $query->where('Initiator_Group', $request->departmentDeviation);
            }

            if ($request->division_idDeviation) {
                $query->where('division_id', $request->division_idDeviation);
            }

            if($request->audit_type)
            {
                $query->where('audit_type',$request->audit_type);
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

            

            if ($request->date_fromDeviation) {
               
                $dateFrom = Carbon::parse($request->date_fromDeviation)->startOfDay();
               
                $query->whereDate('intiation_date', '>=', $dateFrom);
            }
    
            if ($request->date_toDeviation) {
              
                $dateTo = Carbon::parse($request->date_toDeviation)->endOfDay();
              
                $query->whereDate('intiation_date', '<=', $dateTo);
            }

            // if ($request->) {
            //     $dateFromDeviation = Carbon::createFromFormat('d-M-Y', $request->date_fromDeviation);
            //     $query->whereDate('initiation_date', '>=', $dateFromDeviation);
            // }
            
            // if ($request->) {
            //     $dateto = Carbon::createFromFormat('d-M-Y', $request->date_toDeviation);
            //     $query->whereDate('initiation_date', '<=', $dateto);
            // }

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


    public function failureInv_filter(Request $request)
    {
        $res = [
            'status' => 'ok',
            'message' => 'success',
            'body' => []
        ];

        try {

            
            $query = FailureInvestigation::query();
            
            if ($request->department_failure)
            {
                $query->where('Initiator_Group', $request->department_failure);
            }

            if($request->div_idfailure)
            {
                $query->where('division_id',$request->div_idfailure);
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

            if ($request->date_From_failure) {
                $query->whereDate('intiation_date', '>=', Carbon::parse($request->date_From_failure));
            }
            
            if ($request->date_To_failure) {
                $query->whereDate('intiation_date', '<=', Carbon::parse($request->date_To_failure));
            }
            
            // if($request->error_er)
            // {
            //     $query->where('type_of_error',$request->error_er);
            // }
            


            $failure = $query->get();

            $htmlData = view('frontend.forms.Logs.comps.failure_investigation_data', compact('failure'))->render();
            

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
            if($request->TypeOFIncidence)
            {
                $query->where('type_incidence_ia',$request->TypeOFIncidence);
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

            $labincident = $query->get();

            $htmlData = view('frontend.forms.Logs.comps.labincident_data', compact('labincident'))->render();
            

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
            
            if ($request->departmentcomplaint)
            {
                $query->where('Initiator_Group', $request->departmentcomplaint);
            }

            if($request->div_id)
            {
                $query->where('division_id',$request->div_id);
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

            $htmlData = view('frontend.forms.Logs.comps.marketcomplaint_data', compact('marketcomplaint'))->render();
            

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
