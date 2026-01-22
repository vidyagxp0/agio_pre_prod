<?php

namespace App\Http\Controllers\Api;

use App\Models\Deviation;
use App\Models\CC;
use App\Models\Supplier;
use App\Models\supplierAudit;
use App\Models\ActionItem;
use App\Models\GlobalChangeControl;
use App\Models\PreventiveMaintenance;
use App\Models\EquipmentLifecycleManagement;
use App\Models\GlobalCapa;
use App\Models\Sanction;
use App\Models\Document;
use App\Models\OOS;

use App\Models\Incident;
use App\Models\CallibrationDetails;
use App\Models\EHSEvent;
use App\Models\Ootc;
use App\Models\Auditee;

use App\Models\OOS_micro;
use App\Models\NonConformance;
use App\Models\RootCauseAnalysis;
use App\Models\AuditProgram;
use App\Models\errata;
use App\Models\FailureInvestigation;
use App\Models\EffectivenessCheck;
use App\Models\extension_new;
use App\Models\MarketComplaint;
use App\Models\RiskManagement;
use App\Models\OutOfCalibration;
use App\Models\LabIncident;
use App\Models\InternalAudit;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Capa;
use App\Models\ManagementReview;
use App\Models\Resampling;
use App\Models\CapaGrid;
use PDF;
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
                    $query->where('Initiator_group_code', $request->department);
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




        public function RootcauseanalysisFilter(Request $request)
    {
        $res = [
            'status' => 'ok',
            'message' => 'success',
            'body' => []
        ];

        try {

            
            $query = RootCauseAnalysis::query();
            
            
            if ($request->RootCauseAnalysisdept)
            {
                $query->where('initiator_group_code', $request->RootCauseAnalysisdept);
            }

            if($request->div_idRootCauseAnalysis)
            {
                $query->where('division_id',$request->div_idRootCauseAnalysis);
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

           if ($request->daterootcauseFrom) {
                $from = Carbon::createFromFormat('Y-m-d', $request->daterootcauseFrom)
                            ->format('d-m-Y');

                $query->where('intiation_date', '>=', $from);
            }

            if ($request->daterootcauseanalysisTo) {
                $to = Carbon::createFromFormat('Y-m-d', $request->daterootcauseanalysisTo)
                            ->format('d-m-Y');

                $query->where('intiation_date', '<=', $to);
            }

            $root_cause_analysises  = $query->get();
            // dd($root_cause_analysises);


            $htmlData = view('frontend.forms.Logs.filterData.Rootcauseanalysis_data', compact('root_cause_analysises'))->render();
            

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
                $query->where('Initiator_group_code', $request->department_Lab);
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
                $query->where('Initiator_group_code', $request->market_department);
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

       public function ActionItemFilter(Request $request)
    {
        $res = [
            'status' => 'ok',
            'message' => 'success',
            'body' => []
        ];

        try {

            
            $query = ActionItem::query();
            
            if ($request->ActionItem_department)
            {
                $query->where('departments', $request->ActionItem_department);
               
            }

            if($request->div_idActionitem)
            {
                $query->where('division_id',$request->div_idActionitem);
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

           
            
            if ($request->dateActionitemFrom) {
                $from = Carbon::createFromFormat('Y-m-d', $request->dateActionitemFrom)
                            ->format('d-m-Y');

                $query->where('intiation_date', '>=', $from);
            }

            if ($request->dateActionitemTo) {
                $to = Carbon::createFromFormat('Y-m-d', $request->dateActionitemTo)
                            ->format('d-m-Y');

                $query->where('intiation_date', '<=', $to);
            }

            $actions = $query->get();

            $htmlData = view('frontend.forms.Logs.filterData.action_data', compact('actions'))->render();
            

            $res['body'] = $htmlData;

           


        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();

        }


        return response()->json($res);
        
    }


     public function EffectivenessCheckFilter(Request $request)
    {
        $res = [
            'status' => 'ok',
            'message' => 'success',
            'body' => []
        ];

        try {

            
            $query = EffectivenessCheck::query();
            
            if ($request->effectivenes_department)
            {
                $query->where('Initiator_Group', $request->effectivenes_department);
            }

            if($request->div_ideffectiveness)
            {
                $query->where('division_id',$request->div_ideffectiveness);
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

            if ($request->dateeffectivenessFrom) {
               
                $datefrom = Carbon::parse($request->dateeffectivenessFrom)->startOfDay();
               
                $query->whereDate('intiation_date', '>=', $datefrom);
            }
    
            if ($request->dateEffectivenessTo) {
              
                $dateo = Carbon::parse($request->dateEffectivenessTo)->endOfDay();
              
                $query->whereDate('intiation_date', '<=', $dateo);
            }

            $effectiveneses = $query->get();

            $htmlData = view('frontend.forms.Logs.filterData.effectivenes_data', compact('effectiveneses'))->render();
            

            $res['body'] = $htmlData;


        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();

        }


        return response()->json($res);
        
    }


         public function ExtensionFilter(Request $request)
    {
        $res = [
            'status' => 'ok',
            'message' => 'success',
            'body' => []
        ];

        try {

            
            $query = extension_new::query();
            
            if ($request->extension_department)
            {
                $query->where('Initiator_Group', $request->extension_department);
            }

            if($request->div_idextension)
            {
                $query->where('division_id',$request->div_idextension);
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
                    $query->whereDate('initiation_date', '>=', $startDate);
                }
            }

            if ($request->dateextensionFrom) {
               
                $datefrom = Carbon::parse($request->dateextensionFrom)->startOfDay();
               
                $query->whereDate('initiation_date', '>=', $datefrom);
            }
    
            if ($request->dateextensionTo) {
              
                $dateo = Carbon::parse($request->dateextensionTo)->endOfDay();
              
                $query->whereDate('initiation_date', '<=', $dateo);
            }

            $extension_news = $query->get();

            $htmlData = view('frontend.forms.Logs.filterData.extension_data', compact('extension_news'))->render();
            

            $res['body'] = $htmlData;


        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();

        }


        return response()->json($res);
        
    }


       public function externalAuditFilter(Request $request)
    {
        $res = [
            'status' => 'ok',
            'message' => 'success',
            'body' => []
        ];

        try {

            
            $query = Auditee::query();
            
            if ($request->externalAudit_department)
            {
                $query->where('initiator_group_code', $request->externalAudit_department);
            }

            
            if($request->div_idexternalAudit)
            {
                
                $query->where('division_id',$request->div_idexternalAudit);
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

            if ($request->dateExternalauditFrom) {
               
                $datefrom = Carbon::parse($request->dateExternalauditFrom)->startOfDay();
               
                $query->whereDate('intiation_date', '>=', $datefrom);
            }
    
            if ($request->dateExternalauditTo) {
              
                $dateo = Carbon::parse($request->dateExternalauditTo)->endOfDay();
              
                $query->whereDate('intiation_date', '<=', $dateo);
            }

            $external_audits = $query->get();

            $htmlData = view('frontend.forms.Logs.filterData.external_audit_data', compact('external_audits'))->render();
            

            $res['body'] = $htmlData;


        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();

        }


        return response()->json($res);
        
    }




     public function AuditProgramFilter(Request $request)
    {
        $res = [
            'status' => 'ok',
            'message' => 'success',
            'body' => []
        ];

        try {

            
            $query = AuditProgram::query();
            
            if ($request->auditProgram_department)
            {
                $query->where('Initiator_group_code', $request->auditProgram_department);
            }

            if($request->div_idAuditprogram)
            {
                $query->where('division_id',$request->div_idAuditprogram);
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

            if ($request->dateAuditProgFrom) {
               
                $datefrom = Carbon::parse($request->dateAuditProgFrom)->startOfDay();
               
                $query->whereDate('intiation_date', '>=', $datefrom);
            }
    
            if ($request->dateAuditProgramTo) {
              
                $dateo = Carbon::parse($request->dateAuditProgramTo)->endOfDay();
              
                $query->whereDate('intiation_date', '<=', $dateo);
            }

            $AuditPrograms = $query->get();

            $htmlData = view('frontend.forms.Logs.filterData.auditPrograme_data', compact('AuditPrograms'))->render();
            

            $res['body'] = $htmlData;


        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();

        }


        return response()->json($res);
        
    }


     public function ResamplingFilter(Request $request)
    {
        $res = [
            'status' => 'ok',
            'message' => 'success',
            'body' => []
        ];

        try {

            
            $query = Resampling::query();
            
            if ($request->resampling_department)
            {
                $query->where('departments', $request->resampling_department);
            }

            if($request->div_idresampling)
            {
                $query->where('division_id',$request->div_idresampling);
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

           


            if ($request->dateresamplingFrom) {
                $from = Carbon::createFromFormat('Y-m-d', $request->dateresamplingFrom)
                            ->format('d-m-Y');

                $query->where('intiation_date', '>=', $from);
            }

            if ($request->dateresamplingTo) {
                $to = Carbon::createFromFormat('Y-m-d', $request->dateresamplingTo)
                            ->format('d-m-Y');

                $query->where('intiation_date', '<=', $to);
            }

            $Resamplings = $query->get();

            $htmlData = view('frontend.forms.Logs.filterData.Resampling_data', compact('Resamplings'))->render();
            
           
            $res['body'] = $htmlData;


        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();

        }

        

        return response()->json($res);
        
    }

       public function ManagementReviewFilter(Request $request)
    {
        $res = [
            'status' => 'ok',
            'message' => 'success',
            'body' => []
        ];

        try {

            $query = ManagementReview::query();

            if ($request->managementreview_department) {
                $query->where('initiator_group_code', $request->managementreview_department);
            }

            if ($request->div_idmanagementreview) {
                $query->where('division_id', $request->div_idmanagementreview);
            }

            // 🔹 Period filter
            if ($request->period_lab) {
                $currentDate = Carbon::now();

                switch ($request->period_lab) {
                    case 'Yearly':
                        $startDate = $currentDate->copy()->startOfYear();
                        break;

                    case 'Quarterly':
                        $startDate = $currentDate->copy()->firstOfQuarter();
                        break;

                    case 'Monthly':
                        $startDate = $currentDate->copy()->startOfMonth();
                        break;

                    default:
                        $startDate = null;
                }

                if ($startDate) {
                    $query->whereDate('intiation_date', '>=', $startDate);
                }
            }

            // 🔹 From date
            if ($request->datemanagementreviewFrom) {
                $query->whereDate(
                    'intiation_date',
                    '>=',
                    Carbon::parse($request->datemanagementreviewFrom)
                );
            }

            // 🔹 To date
            if ($request->datemanagementreviewTo) {
                $query->whereDate(
                    'intiation_date',
                    '<=',
                    Carbon::parse($request->datemanagementreviewTo)
                );
            }

            $ManagementReviews = $query->get();
            // dd($ManagementReviews);

            $htmlData = view(
                'frontend.forms.Logs.filterData.ManagementReview_data',
                compact('ManagementReviews')
            )->render();

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
                $query->where('Initiator_group_code', $request->department_outofcalibration);
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

           


              // FROM date only
                if ($request->date_from_oocdate) {
                    $query->whereDate(
                        'intiation_date',
                        '>=',
                        Carbon::parse($request->date_from_oocdate)
                    );
                }

                // TO date only
                if ($request->date_to_oocdata) {
                    $query->whereDate(
                        'intiation_date',
                        '<=',
                        Carbon::parse($request->date_to_oocdata)
                    );
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
                $query->where('Initiator_group_code', $request->department_risk);
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
            


            $riskmanagements  = $query->get();

            $htmlData = view('frontend.forms.Logs.filterData.riskmanagement_data', compact('riskmanagements'))->render();
            

            $res['body'] = $htmlData;


        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();
        }


        return response()->json($res);
    }

public function OOT_Filter(Request $request)
{
    $res = [
        'status' => 'ok',
        'message' => 'success',
        'body' => []
    ];

    try {
        $query = OOS::query();

        if ($request->department_oot) {
            $query->where('Initiator_group_code', $request->department_oot);
        }

        if ($request->division_id_oot) {
            $query->where('division_id', $request->division_id_oot);
        }

        if ($request->source_document_type_OOT) {
            $query->where('source_document_type_gi', $request->source_document_type_OOT);
        }

        if ($request->period_oot) {
            $currentDate = Carbon::now();
            switch ($request->period_oot) {
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

        // if ($request->date_oot_from) {
        //     $dateFrom = Carbon::parse($request->date_oot_from)->startOfDay();
        //     $query->whereDate('intiation_date', '>=', $dateFrom);
        // }

        // if ($request->date_OOT_to) {
        //     $dateTo = Carbon::parse($request->date_OOT_to)->endOfDay();
        //     $query->whereDate('intiation_date', '<=', $dateTo);
        // }
            if ($request->date_oot_from) {
                $from = Carbon::createFromFormat('Y-m-d', $request->date_oot_from)
                            ->format('d-m-Y');

                $query->where('intiation_date', '>=', $from);
            }

            if ($request->date_OOT_to) {
                $to = Carbon::createFromFormat('Y-m-d', $request->date_OOT_to)
                            ->format('d-m-Y');

                $query->where('intiation_date', '<=', $to);
            }


        $oots = $query->get();
        $oosmicro = OOS_micro::get();

        $htmlData = view('frontend.forms.Logs.filterData.OOS_OOT_log_data', compact('oots', 'oosmicro'))->render();

        $res['body'] = $htmlData;
    } catch (\Exception $e) {
        $res['status'] = 'error';
        $res['message'] = $e->getMessage();
    }

    return response()->json($res);
}


    



    public function nonconformance_filter(Request $request)
{
    $res = [
        'status' => 'ok',
        'message' => 'success',
        'body' => []
    ];

    try {


        $query = NonConformance::query();

        if ($request->department_non) 
        {
            $query->where('Initiator_Group', $request->department_non);
        }
        if ($request->division_non) {
            $query->where('division_id', $request->division_non);
        }

        if ($request->period_non) {
            $currentDate = Carbon::now();
            switch ($request->period_non) {
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

        if ($request->dateFrom_non) {

            $datefrom = Carbon::parse($request->dateFrom_non)->startOfDay();

            $query->whereDate('intiation_date', '>=', $datefrom);
        }

        if ($request->dateTo_non) {
            $dateto = Carbon::parse($request->dateTo_non)->endOfDay();
            $query->whereDate('intiation_date', '<=', $dateto);
        }
       
        if ($request->TypeOfDocument) {
            $query->where('type_incidence_ia', $request->TypeOfDocument);
        }


        $nonconformance = $query->get();

        $htmlData = view('frontend.forms.Logs.filterData.nonconformancedata', compact('nonconformance'))->render();


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

public function IncidentFilter(Request $request)
{
    $res = [
        'status' => 'ok',
        'message' => 'success',
        'body' => []
    ];

    try {
        $query = Incident::query();

        if ($request->departmentIncident) {
            $query->where('Initiator_group_code', $request->departmentIncident);
        }

        if ($request->division_idIncident) {
            $query->where('division_id', $request->division_idIncident);
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

        if ($request->date_fromIncident) {
            $dateFrom = Carbon::parse($request->date_fromIncident)->startOfDay();
            $query->whereDate('intiation_date', '>=', $dateFrom);
           }

        if ($request->date_toIncident) {
            $dateTo = Carbon::parse($request->date_toIncident)->endOfDay();
            $query->whereDate('intiation_date', '<=', $dateTo);
           }

        $Inc = $query->get();

        $htmlData = view('frontend.forms.logs.filterData.Inc_data', compact('Inc'))->render();

        $res['body'] = $htmlData;
    } catch (\Exception $e) {
        $res['status'] = 'error';
        $res['message'] = $e->getMessage();
    }

    return response()->json($res);
}


    
public function printPDF(Request $request)
{
    $filters = $request->all(); 
    
    $department = $filterCC['department'] ?? null; 
    $changerelateTo = $filterCC['changerelateTo'] ?? null; 
    $classification = $filterCC['dateFrom'] ?? null; 
    $Initiator = $filterCC['Initiator'] ?? null;
    
    $To = $filterCC['dateTo'] ?? null; 
   
    $query = Capa::query();

    $query->when($department, function ($q) use ($department) {
        return $q->where('initiator_Group', $department);
    });

  
    $query->when($Initiator, function ($q) use ($Initiator) {
        return $q->where('initiator_id', $Initiator);
    });

    $query->when($classification, function ($q) use ($classification) {
        return $q->where('intiation_date', $classification);
    });

    $query->when($To, function ($q) use ($To) {
        return $q->where('intiation_date', $To);
    });

   
    $filteredDataCC = $query->get();

    $rowsPerPage = 7;
    $totalRows = $filteredDataCC->count();
    $totalPages = ceil($totalRows / $rowsPerPage);
    $paginatedData = $filteredDataCC->chunk($rowsPerPage);

    

    $pdf = Pdf::loadView('frontend.forms.Logs.capapdf', compact('rowsPerPage','paginatedData','totalPages','filteredDataCC'))->setPaper('a4', 'landscape');

    return $pdf->stream('report.pdf');
}


    
public function printPDFCC(Request $request)
{
    $filterCC = $request->all();

    // dd($filterCC);
    $department = $filterCC['department'] ?? null; 
    $changerelateTo = $filterCC['changerelateTo'] ?? null; 
    $classification = $filterCC['dateFrom'] ?? null; 
    $Initiator = $filterCC['Initiator'] ?? null;
    
    $To = $filterCC['dateTo'] ?? null; 
    $changeCategory = $filterCC['RadioActivtiyCCC'] ?? null;
    $changeCategorytcc = $filterCC['RadioActivtiyTCC'] ?? null;

    $query = CC::query();

    $query->when($department, function ($q) use ($department) {
        return $q->where('initiator_Group', $department);
    });

    $query->when($changerelateTo, function ($q) use ($changerelateTo) {
        return $q->where('severity', $changerelateTo);
    });

    $query->when($Initiator, function ($q) use ($Initiator) {
        return $q->where('initiator_id', $Initiator);
    });

    $query->when($classification, function ($q) use ($classification) {
        return $q->where('intiation_date', $classification);
    });

    $query->when($To, function ($q) use ($To) {
        return $q->where('intiation_date', $To);
    });

    if ($changeCategory) {
        $categories = explode(',', $changeCategory); 
        $query->whereIn('doc_change', $categories);
    }

    if ($changeCategorytcc) {
        $categoriestcc = explode(',', $changeCategory); 
        $query->whereIn('doc_change', $categoriestcc);
    }

    $filteredDataCC = $query->get();

    $rowsPerPage = 5;
    $totalRows = $filteredDataCC->count();
    $totalPages = ceil($totalRows / $rowsPerPage);
    $paginatedData = $filteredDataCC->chunk($rowsPerPage);

    

    $pdf = Pdf::loadView('frontend.forms.Logs.cclogpdf', compact('rowsPerPage','paginatedData','totalPages','filteredDataCC','changeCategory','changeCategorytcc'))->setPaper('a4', 'landscape');

    return $pdf->stream('report.pdf');
}

}    

