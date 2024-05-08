<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\QMSProcess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QMSProcessController extends Controller
{
    public function index()
    {
        //

        $process = QMSProcess::leftJoin("q_m_s_divisions", "q_m_s_divisions.id", "=", "q_m_s_processes.division_id")
            ->select(
                'q_m_s_divisions.name as dname',
                'q_m_s_processes.*'
            )->orderBy('id', "desc")->get();
        $division = DB::table('q_m_s_divisions')->where('status', 1)->get();

        return view('admin.QMSprocess.process', compact('process', 'division'));
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
        //
        $process = new QMSProcess();
        $process->process_name = $request->process_name;
        $process->division_id = $request->division_id;



        if ($process->save()) {
            toastr()->success('Added successfully');
            return redirect()->route('qms-process.index');
        } else {
            toastr()->error('Something went wrong');
            return redirect()->back();
        }
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
        $process = QMSProcess::find($id);
        $division = DB::table('q_m_s_divisions')->where('status', 1)->get();


        return view('admin.QMSprocess.edit', ['process' => $process], ['division' => $division]);

        //  return redirect()->route('image')->wtih('result',$result);

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
        $process = QMSProcess::find($id);
        $process->process_name = $request->process_name;
        $process->division_id = $request->division_id;

        if ($process->update()) {
            toastr()->success('Updated successfully');
            return redirect()->route('qms-process.index');
        } else {
            toastr()->error('Something went wrong');
            return redirect()->back();
        }

        // return redirect()->route('banner-list.index');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {

        $process = QMSProcess::find($id);

        if ($process->delete()) {
            toastr()->success('Deleted successfully');
            return redirect()->back();
        } else {
            toastr()->error('Something went wrong');
            return redirect()->back();
        }
    }
}
