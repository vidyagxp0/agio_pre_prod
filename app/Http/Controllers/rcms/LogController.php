<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use App\Models\Deviation;
use App\Models\Capa;
use App\Models\CC;
use App\Models\errata;
use App\Models\FailureInvestigation;
use App\Models\lab_incidents_grid;
use App\Models\MarketComplaintGrids;
use App\Models\NonConformance;
use App\Models\OOS_micro;
use App\Models\LabIncident;
use App\Models\Ootc;
use App\Models\OOS;
use App\Models\MarketComplaint;
use App\Models\OutOfCalibration;
use App\Models\Incident;
use App\Models\RiskManagement;
use App\Models\InternalAudit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\ActionItem;
use App\Models\EffectivenessCheck;
use App\Models\AuditProgram;
use App\Models\extension_new;
use App\Models\Auditee;
use App\Models\ManagementReview;
use App\Models\Resampling;
use App\Models\RootCauseAnalysis;


class LogController extends Controller
{
    public function index($slug)
    {
        switch ($slug) {
            case 'capa':
                $capa = Capa::get();
                
                return view('frontend.forms.Logs.capa_log',compact('capa'));
                break;
            case 'deviation':
                $deviation = Deviation::get();
                // dd($deviation);
                return view('frontend.forms.Logs.deviation_log', compact('deviation'));
                break;

            case 'change-control':
                $ccontrol = CC::get();
                    
                   
                    return view('frontend.forms.Logs.ChangeControlLog',compact('ccontrol'));
                    break;

                
            case 'errata':
                        $erratalog = errata::get();
                            
                           
                            return view('frontend.forms.Logs.errata_log',compact('erratalog'));
                            break;
        
            case 'failure-investigation':
                        $failure = FailureInvestigation::get();
                                    
                                   
              return view('frontend.forms.Logs.failure_investigation_log',compact('failure'));
              break;        
            

                case 'lab-incident':
                
                    $labincident =LabIncident::with([
                        'incidentInvestigationReports',
                        'division'  
                    ])->get();
               
        
                
                                        
                    return view('frontend.forms.Logs.laboratoryIncidentLog',compact('labincident'));
                    break;        
                

            //  case 'market-complaint':
                
            //     $marketcomplaint = MarketComplaint::with('product_details')->get();
                
            //         return view('frontend.forms.Logs.Market-complaint-registerLog',compact('marketcomplaint'));
                        
            //         break;        
               
            
             case 'actionitem':
                    $actions = ActionItem::get();
                    //  dd($actions);
                    return view('frontend.forms.Logs.actionItemlogs', compact('actions'));
                break;

            case 'effectiveness-check':
                    $effectiveneses = EffectivenessCheck::get();
                    //  dd($effectiveneses);
                    return view('frontend.forms.Logs.effectivenesslogs', compact('effectiveneses'));
                break;   


            case 'extension':
                    $extension_news = extension_new::get();
                    //  dd($effectiveneses);
                     return view('frontend.forms.Logs.Extensionlogs', compact('extension_news'));
                break;  
                
            case 'external-audit':
                    $external_audits = Auditee::get();
                    //  dd($effectiveneses);
                     return view('frontend.forms.Logs.external_auditlogs', compact('external_audits'));
                break;   
    

            case 'managementreview':
                    $ManagementReviews = ManagementReview::get();
                    //  dd($ManagementReviews);
                      return view('frontend.forms.Logs.ManagementReviewlogs', compact('ManagementReviews'));
                break;   

            case 'auditprogram':
                    $AuditPrograms = AuditProgram::get();
                    
                    return view('frontend.forms.Logs.auditProgramlogs', compact('AuditPrograms'));
                break;

             case 'auditprogram':
                    $AuditPrograms = AuditProgram::get();
                    
                    return view('frontend.forms.Logs.auditProgramlogs', compact('AuditPrograms'));
                break;
    

            case 'market-complaint':
                    $marketcomplaint = MarketComplaint::with([
                        'product_details',
                        'division'   
                    ])->get();

                    return view('frontend.forms.Logs.Market-complaint-registerLog', compact('marketcomplaint'));
                break;

            case 'ooc':
            
                $oocs = OutOfCalibration::with('InstrumentDetails', 'assignedUser')->get();
                
                $users = User::all();
                
        
                    return view('frontend.forms.Logs.OOC_log' , compact('oocs','users'));
              
                                              
            case 'oot':
            
                // $oots =  OOS::get();

                $oots = OOS::get();
                // $oosmicro = OOS_micro::get();
            
                 // foreach($oots as $oo)
            // {
                // return $oo;

            //     $gridata=$oo->ProductGridOot;
            //     foreach ($gridata['data'] as $data) {
            //         $ootss=[];
            //         return[
            //             'item_product_code'=>$data['item_product_code']
            //         ];
            //     }
            // }
            
            // foreach($oots['data'] as $aaaa) {
            //     return $aaaa;
            // }
            
            
                
            // $oosmicro = OOS_micro::get();

            return view('frontend.forms.Logs.OOS_OOT_log' , compact('oots'));



            case 'resampling':

                
                $Resamplings = Resampling::get();
              
                

                 return view('frontend.forms.Logs.Resamplinglogs',compact('Resamplings'));

            case 'root-cause-analysis':

                
                $root_cause_analysises = RootCauseAnalysis::get();
              
            //   dd($root_cause_analysises);
                return view('frontend.forms.Logs.rootcauseanalysislogs',compact('root_cause_analysises'));



            case 'risk-management':

                
                $riskmanagements = RiskManagement::get();
            //  dd($riskmanagements);
                return view('frontend.forms.Logs.riskmanagementLog',compact('riskmanagements'));

   

                
            case 'inernal-audit':
                $internal_audi = InternalAudit::get();
                
                return view('frontend.forms.Logs.Internal_audit_Log',compact('internal_audi'));
         
            case 'non-conformance':
                $nonconformance = NonConformance::get();

                return view('frontend.forms.Logs.non_conformance_log',compact('nonconformance'));
               
             case 'incident':
                // $Inc = Incident::with(['Grid' => function ($query) {
                //     $query->where('type','Product')->take(3);
                // }] )->take(3)->get();

               $Inc= Incident::get();
                
                // foreach($Inc as $ias)
                // foreach ($ias->Grid as $a)
                // return $a->product_name;
                   return view('frontend.forms.Logs.incidentLog',compact('Inc'));
            return $slug;
                   
            default:

                break;
        }
    }
}
