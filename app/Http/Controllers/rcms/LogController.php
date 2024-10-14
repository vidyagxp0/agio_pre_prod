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
use App\Models\MarketComplaint;
use App\Models\OutOfCalibration;
use App\Models\Incident;
use App\Models\RiskManagement;
use App\Models\InternalAudit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;



class LogController extends Controller
{
    public function index($slug)
    {
        switch ($slug) {
            case 'capa':
                $capa = Capa::get();
                
               
                return view('frontend.forms.logs.capa_log',compact('capa'));
                break;
            case 'deviation':
                $deviation = Deviation::get();
                return view('frontend.forms.logs.deviation_log', compact('deviation'));
                break;

            case 'change-control':
                $ccontrol = CC::get();
                    
                   
                    return view('frontend.forms.logs.ChangeControlLog',compact('ccontrol'));
                    break;

                
            case 'errata':
                        $erratalog = errata::get();
                            
                           
                            return view('frontend.forms.logs.errata_log',compact('erratalog'));
                            break;
        
            case 'failure-investigation':
                        $failure = FailureInvestigation::get();
                                    
                                   
              return view('frontend.forms.logs.failure_investigation_log',compact('failure'));
              break;        
            

                case 'lab-incident':
                
                    $labincident =LabIncident::with('incidentInvestigationReports')->get();
                
        
                
                                            
                                        
                    return view('frontend.forms.logs.laboratoryincidentLog',compact('labincident'));
                    break;        
                

             case 'market-complaint':
                
                $marketcomplaint = MarketComplaint::with('product_details')->get();
                
                    return view('frontend.forms.logs.Market-complaint-registerLog',compact('marketcomplaint'));
                        
                    break;        
                        
            case 'ooc':
            
                $oocs = OutOfCalibration::with('InstrumentDetails', 'assignedUser')->get();
                // foreach($oocs as $ss)
                // $sd = $ss->InstrumentDetails;
                //  $sq = $sd->data;
                //  foreach ($sq as $ds)
                //  return $ds['instrument_name'];
                $users = User::all();
                
        
                    return view('frontend.forms.logs.OOC_log' , compact('oocs','users'));
              
                                              
            case 'oot':
            
                $oots =  Ootc::with('ProductGridOot')->get();


                $oots = Ootc::with('ProductGridOot')->get();
                $oosmicro = OOS_micro::get();
            
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
            
            
                
            $oosmicro = OOS_micro::get();

            return view('frontend.forms.logs.OOS_OOT_log' , compact('oots','oosmicro'));



            case 'risk-management':

                $riskmlog = RiskManagement::with(['Action' => function ($query) {
                    $query->where('type', 'Action_Plan')->take(5); // Limit to 5 records
                }])->get();
                
                // foreach ($riskmlogs as $risk) {
                //     foreach ($risk->Action as $action) {
                //         return $action->action; // Return each action record
                //     }
                // }
                

                
                return view('frontend.forms.Logs.riskmanagementLog',compact('riskmlog'));


                
            case 'inernal-audit':
                $internal_audi = InternalAudit::get();
                
                return view('frontend.forms.logs.Internal_audit_Log',compact('internal_audi'));
         
            case 'non-conformance':
                $nonconformance = NonConformance::get();

                return view('frontend.forms.Logs.non_conformance_log',compact('nonconformance'));
               
             case 'incident':
                $Inc = Incident::with(['Grid' => function ($query) {
                    $query->where('type','Product')->take(3);
                }] )->take(3)->get();
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
