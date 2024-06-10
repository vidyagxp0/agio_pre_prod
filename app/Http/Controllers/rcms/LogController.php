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
                
                $labincident = LabIncident::get();
                
        
                // $outOfCalibrations = OutOfCalibration::with('labincident')->get();
                $labincident =LabIncident::with('incidentInvestigationReports')->get();

                                            
                                        
                    return view('frontend.forms.logs.laboratoryincidentLog',compact('labincident'));
                    break;        
                

             case 'market-complaint':
            
                $marketcomplaint = MarketComplaint::with('product_details')->get();
                // $complaintData = [];
                // foreach ($marketcomplaint as $marketlog)
                // {
                //     $productDetails= $marketlog->product_details;
                //     foreach ($productDetails['data'] as $data) {
                //         $complaintData = [];
                //         return [
                //             'info_product_name' => $data['info_product_name'],
                //             'info_batch_no' => $data['info_batch_no'],
                //             'info_mfg_date' => $data['info_mfg_date'],
                //             'info_expiry_date' => $data['info_expiry_date'],
                //             'info_batch_size' => $data['info_batch_size'],
                //             'info_pack_size' => $data['info_pack_size'],
                //             'info_dispatch_quantity' => $data['info_dispatch_quantity'],
                //             'info_remarks' => $data['info_remarks'],
                //         ];
                //     }
                    
                //     // foreach($m as $mms)
                    
                // }

            
            

           
            




                    return view('frontend.forms.logs.Market-complaint-registerLog',compact('marketcomplaint'));
                        
                    break;        
                        
            case 'ooc':
            
            $oocs = OutOfCalibration::with('InstrumentDetails')->get();


            // $complaintData = [];
            // foreach ($oocs as $marketlog)
            // {
            //         $productDetails= $marketlog->InstrumentDetails;
            //         foreach ($productDetails['data'] as $data) {
            //                 $complaintData = [];
            //                 return [
            //                         'instrument_id' => $data['instrument_id'],
            //                         'instrument_name' => $data['instrument_name'],
                                   
            //             ];
            //         }
                    
            //         // foreach($m as $mms)
                
            //     }
                return view('frontend.forms.logs.OOC_log' , compact('oocs'));
                                              
            case 'oot':
            
            $oots =  Ootc::get();

            return view('frontend.forms.logs.OOS_OOT_log' , compact('oots'));


            case 'risk-management':
                $riskmlog = RiskManagement::get();
                $gridMarket = RiskAssesmentGrid::get();
                
                return view('frontend.forms.Logs.riskmanagementLog',compact('riskmlog','gridMarket'));


                
            case 'inernal-audit':
                $internal_audi = InternalAudit::get();
                
                return view('frontend.forms.logs.Internal_audit_Log',compact('internal_audi'));
              
            default:
            return $slug;

                break;
        }
    }
}
