<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SetDivision;
use Illuminate\Support\Facades\Auth;
class FormDivisionController extends Controller
{
    public function formDivision(Request $request)
    {
        $request->session()->forget('division');
        $request->session()->put('division', $request->division_id);
        if ($request->process_name == "Internal Audit") {
            return redirect('audit');
        } elseif ($request->process_name == "External Audit") {
            return redirect('auditee');
        } elseif ($request->process_name == "CAPA") {
            return redirect('capa');
        } elseif ($request->process_name == "Audit Program") {
            return redirect('audit-program');
        } elseif ($request->process_name == "Lab Incident") {
            return redirect('lab-incident');
        } elseif ($request->process_name == "Risk Assessment") {
            return redirect('risk-management');
        } elseif ($request->process_name == "Extension") {
            return redirect('extension-new');
        } elseif ($request->process_name == "Effectiveness Check") {
            return redirect('effectiveness-check');            
        } elseif ($request->process_name == "Root Cause Analysis") {
            return redirect('root-cause-analysis');
        } elseif ($request->process_name == "Failure Investigation") {
            return redirect('rcms/failure-investigation');
        } elseif ($request->process_name == "Change Control") {
            return redirect()->route('CC.create');
        } elseif ($request->process_name == "Management Review") {
            return redirect('meeting');
        }
        elseif ($request->process_name == 'OOS Chemical') {
            return redirect()->route('oos.index');
        }
        elseif ($request->process_name == 'OOT') {
            return redirect()->route('oot.index');
        }
        elseif ($request->process_name == 'OOC') {
            return redirect()->route('ooc.index');
        }
        elseif ($request->process_name == 'OOS-Microbiology') {
            return redirect()->route('oos_micro.index');
        }
        elseif ($request->process_name == 'ERRATA') {
            return redirect()->route('errata_new');
        }
        elseif ($request->process_name == 'Market Complaint') {
            return redirect()->route('marketcomplaint.market_complaint_new');
        }
        elseif ($request->process_name == 'Deviation') {
            return redirect()->route('deviation');
        }
        elseif ($request->process_name == "New Document") {

            $new = new SetDivision;
            $new->division_id = $request->division_id;
            $new->process_id = $request->process_id;
            $new->user_id = Auth::user()->id;
            $new->save();

            return redirect('documents/create');
        }
    }
}
