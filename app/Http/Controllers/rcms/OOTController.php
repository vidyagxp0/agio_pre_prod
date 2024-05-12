<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use App\Models\OOT;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class OOTController extends Controller
{
    public function index()
    {
        return view('frontend.OOT.OOT_form');
    }


    public function store(Request $request)
    { 
        //dd($request->all());
        // $Oot = new OOT();
      $input = $request->all(); 

            //$input['due_date'] = $input['due_date'] ? Carbon::parse($input['due_date'])->format('d F Y') : '';

           if (!empty ($request->gi_attachment)) {
            $files = [];
            if ($request->hasfile('gi_attachment')) {
                foreach ($request->file('gi_attachment') as $file) {
                    $name =  'gi_attachment' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['gi_attachment'] = json_encode($files);
        }


        if (!empty ($request->gi_attachment)) {
            $files = [];
            if ($request->hasfile('closure_attachment')) {
                foreach ($request->file('closure_attachment') as $file) {
                    $name =  'closure_attachment' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['closure_attachment'] = json_encode($files);
        }
        if (!empty ($request->upli_attachment)) {
            $files = [];
            if ($request->hasfile('upli_attachment')) {
                foreach ($request->file('upli_attachment') as $file) {
                    $name =  'upli_attachment' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['upli_attachment'] = json_encode($files);
        }

        if (!empty ($request->conclusionattachment)) {
            $files = [];
            if ($request->hasfile('conclusionattachment')) {
                foreach ($request->file('conclusionattachment') as $file) {
                    $name =  'conclusionattachment' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['conclusionattachment'] = json_encode($files);
        }

        if (!empty ($request->plir_attachment)) {
            $files = [];
            if ($request->hasfile('plir_attachment')) {
                foreach ($request->file('plir_attachment') as $file) {
                    $name =  'plir_attachment' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['plir_attachment'] = json_encode($files);
        }


        if (!empty ($request->phase_inv_attachment)) {
            $files = [];
            if ($request->hasfile('phase_inv_attachment')) {
                foreach ($request->file('phase_inv_attachment') as $file) {
                    $name =  'phase_inv_attachment' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['phase_inv_attachment'] = json_encode($files);
        }

        if (!empty ($request->qcr_attachment)) {
            $files = [];
            if ($request->hasfile('qcr_attachment')) {
                foreach ($request->file('qcr_attachment') as $file) {
                    $name =  'qcr_attachment' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['qcr_attachment'] = json_encode($files);
        }
        if (!empty ($request->atp_attachment)) {
            $files = [];
            if ($request->hasfile('atp_attachment')) {
                foreach ($request->file('atp_attachment') as $file) {
                    $name =  'atp_attachment' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['atp_attachment'] = json_encode($files);
        }

        if (!empty ($request->attachment_if_any_oot_c)) {
            $files = [];
            if ($request->hasfile('attachment_if_any_oot_c')) {
                foreach ($request->file('attachment_if_any_oot_c') as $file) {
                    $name =  'attachment_if_any_oot_c' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['attachment_if_any_oot_c'] = json_encode($files);
        }

        if (!empty ($request->ile_attachment_oot_cr)) {
            $files = [];
            if ($request->hasfile('ile_attachment_oot_cr')) {
                foreach ($request->file('ile_attachment_oot_cr') as $file) {
                    $name =  'ile_attachment_oot_cr' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['ile_attachment_oot_cr'] = json_encode($files);
        }

        
        if (!empty ($request->qa_attachment_oot_cq_r)) {
            $files = [];
            if ($request->hasfile('qa_attachment_oot_cq_r')) {
                foreach ($request->file('qa_attachment_oot_cq_r') as $file) {
                    $name =  'qa_attachment_oot_cq_r' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['qa_attachment_oot_cq_r'] = json_encode($files);
        }
         
          
        if (!empty ($request->file_attachment_bd)) {
            $files = [];
            if ($request->hasfile('file_attachment_bd')) {
                foreach ($request->file('file_attachment_bd') as $file) {
                    $name =  'file_attachment_bd' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['file_attachment_bd'] = json_encode($files);
        }

        if (!empty ($request->reopen_attachment_re)) {
            $files = [];
            if ($request->hasfile('reopen_attachment_re')) {
                foreach ($request->file('reopen_attachment_re') as $file) {
                    $name =  'reopen_attachment_re' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['reopen_attachment_re'] = json_encode($files);
        }

        if (!empty ($request->approval_attachment_uaa)) {
            $files = [];
            if ($request->hasfile('approval_attachment_uaa')) {
                foreach ($request->file('approval_attachment_uaa') as $file) {
                    $name =  'approval_attachment_uaa' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['approval_attachment_uaa'] = json_encode($files);
        }

        if (!empty ($request->any_attachment_uae)) {
            $files = [];
            if ($request->hasfile('any_attachment_uae')) {
                foreach ($request->file('any_attachment_uae') as $file) {
                    $name =  'any_attachment_uae' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['any_attachment_uae'] = json_encode($files);
        }

        if (!empty ($request->required_attachment_uar)) {
            $files = [];
            if ($request->hasfile('required_attachment_uar')) {
                foreach ($request->file('required_attachment_uar') as $file) {
                    $name =  'required_attachment_uar' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['required_attachment_uar'] = json_encode($files);
        }

        if (!empty ($request->verification_attachment_uav)) {
            $files = [];
            if ($request->hasfile('verification_attachment_uav')) {
                foreach ($request->file('verification_attachment_uav') as $file) {
                    $name =  'verification_attachment_uav' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['verification_attachment_uav'] = json_encode($files);
        }
      dd($input);

            OOT::create($input);


                     
    }
}
