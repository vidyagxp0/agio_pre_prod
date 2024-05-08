<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActionItem;
use App\Models\Capa;
use App\Models\CC;
use App\Models\EffectivenessCheck;
use App\Models\Extension;
use App\Models\InternalAudit;
use App\Models\ManagementReview;
use App\Models\RiskManagement;
use App\Models\LabIncident;
use App\Models\Auditee;
use App\Models\AuditProgram;
use App\Models\RootCauseAnalysis;
use App\Models\Observation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

class ApiController extends Controller
{
    /*******************************************************************************
     * @ Get Profile API
     * 
     *********************************************************************************/
    public function dashboardStatus(Request $request){
        $result = InternalAudit::orderByDesc('id')->get();
        try{
            $response = [];
            if($result->count() > 0){
                foreach($result as $res){
                    $data['id'] = $res->id;
                    $data['status'] = $res->status;
                    $response[] = $data;
                }
                return response()->json([
                    'status' => true,
					'authenticate' => true,
                    'data'  =>  $response,
                    'message' => 'Dashboard record'
                ], 200);
            }
            else{
                return response()->json([
                    'status' => false,
                    'authenticate' => false,
                    'message' => 'Record not found.'
                ], 200);
            }
        }
        catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'authenticate' => false,
                'message' => $th->getMessage()
            ], 200);
        }		
    }

    /*******************************************************************************
     * @ Get Profile API
     * 
     *********************************************************************************/
    public function getProfile(Request $request){
        try{
            $user = User::where('id', 1)->first();
            if(!is_null($user)){
                return response()->json([
                    'status' => true,
					'authenticate' => true,
                    'data'  =>  $user,
                    'message' => 'Profile details'
                ], 200);
            }
            else{
                return response()->json([
                    'status' => false,
                    'authenticate' => false,
                    'message' => 'Unauthorized.'
                ], 200);
            }
        }
        catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'authenticate' => false,
                'message' => $th->getMessage()
            ], 200);
        }		
    }
    /***************************
     * @ Get Capa Record
     * 
     ***************************/
    public function capaStatus(Request $request){
        $result = Capa::orderByDesc('id')->get();
        try{
            $response = [];
            if($result->count() > 0){
                foreach($result as $res){
                    $data['id'] = $res->id;
                    $data['status'] = $res->status;
                    $response[] = $data;
                }
                return response()->json([
                    'status' => true,
					'authenticate' => true,
                    'data'  =>  $response,
                    'message' => 'Dashboard record'
                ], 200);
            }
            else{
                return response()->json([
                    'status' => false,
                    'authenticate' => false,
                    'message' => 'Record not found.'
                ], 200);
            }
        }
        catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'authenticate' => false,
                'message' => $th->getMessage()
            ], 200);
        }		
    }
}