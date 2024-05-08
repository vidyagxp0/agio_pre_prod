<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\RiskLevel;
use App\Models\RiskLevelKeywords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiskLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = RiskLevelKeywords::all();
        return view('admin.risk-level.risk-level', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $existRiskLevel = RiskLevelKeywords::where("keyword", $request->keyword)->first();
        if ($existRiskLevel) {
            toastr()->error("This keyword already exists.");
        } else {
            $riskLevel = new RiskLevelKeywords();
            $riskLevel->keyword = $request->keyword_name;
            $riskLevel->risk_level = $request->risk_level;
            $riskLevel->save();
            toastr()->success("Keyword added successfully.");
        }

        return redirect('/admin/risk-level');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $keyword = RiskLevelKeywords::findOrFail($id);
        return view('admin.risk-level.edit', compact('keyword'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $keyword = RiskLevelKeywords::findOrFail($id);

        $existRiskLevel = RiskLevelKeywords::where("id", $id)->first();
        if (!$existRiskLevel) {
            toastr()->error("This Keyword does not exist.");
        } else {
            $existRiskLevel->keyword = $request->keyword_name;
            $existRiskLevel->risk_level = $request->risk_level;
            $existRiskLevel->update();
            toastr()->success("Keyword Updated successfully.");
        }


        return redirect('/admin/risk-level');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $keyword = RiskLevelKeywords::findOrFail($id);
        $keyword->delete();

        return redirect('/admin/risk-level')->with('success', 'Keyword Deleted successfully!');
    }
}
