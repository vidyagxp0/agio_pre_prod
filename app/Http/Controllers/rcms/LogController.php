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
use App\Models\LabIncident;
use App\Models\Ootc;
use App\Models\MarketComplaint;
use App\Models\OutOfCalibration;
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
                
                $users = User::all();
                
        
                    return view('frontend.forms.logs.OOC_log' , compact('oocs','users'));
              
                                              
            case 'oot':
            
            $oots =  Ootc::get();

            return view('frontend.forms.logs.OOS_OOT_log' , compact('oots'));


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
                
            default:
            return $slug;

                break;
        }
    }
}
