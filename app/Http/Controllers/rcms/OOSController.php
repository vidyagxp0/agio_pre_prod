<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OOS;
use App\Models\Oosgrids;
use App\Services\Qms\OOSService;
use Carbon\Carbon;
use Error;
use Helpers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OOSController extends Controller
{
    public function index()
    {
        return view('frontend.OOS.oos_form');
    }

    public function store(Request $request)
    {

        $res = Helpers::getDefaultResponse();

        try {
            
            $oos_record = OOSService::create_oss($request);

            if ($oos_record['status'] == 'error')
            {
                throw new Error($oos_record['message']);
            } 

        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();
            info('Error in OOSController@store', [
                'message' => $e->getMessage()
            ]);
        }

        return redirect()->route('qms.dashboard');
    }


    public static function show($id)
    {
        $data = OOS::find($id);

        $info_product_materials = $data->grids()->where('identifier', 'info_product_material')->first();
        $details_stabilities = $data->grids()->where('identifier', 'details_stability')->first();
        $oos_details = $data->grids()->where('identifier', 'oos_detail')->first();
        $checklist_lab_invs = $data->grids()->where('identifier', 'checklist_lab_inv')->first();
        $oos_capas = $data->grids()->where('identifier', 'oos_capa')->first();
        $phase_two_invs = $data->grids()->where('identifier', 'phase_two_inv')->first();
        $oos_conclusions = $data->grids()->where('identifier', 'oos_conclusion')->first();
        $oos_conclusion_reviews = $data->grids()->where('identifier', 'oos_conclusion_review')->first();
        
        return view('frontend.OOS.oos_form_view', 
        compact('data', 'info_product_materials', 'details_stabilities', 'oos_details', 'checklist_lab_invs', 'oos_capas', 'phase_two_invs', 'oos_conclusions', 'oos_conclusion_reviews'));

    }


    public function update(Request $request, $id)
    {
        $data = OOS::find($id);

        toastr()->success("Record is created Successfully");
        return redirect(url('rcms/qms-dashboard'));
    }

    public function send_stage(Request $request, $id)
    {
        $oos_record = OOS::find($id);

        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            
            $oos = OOS::find($id);
            $oos->stage = $request->stage;
            $oos->status = $request->status;
            $oos->update();
            toastr()->success('Sent');
            return back();

        } else {
            toastr()->error('E-signature Not match');
            return back();
        }

    }

    public function cancel_record(Request $request, $id)
    {
        $oos_record = OOS::find($id);

    }
    
}
