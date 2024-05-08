<?php

namespace App\Http\Controllers\admin;
use App\Models\PrintControl;
use App\Models\RoleGroup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrintControlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $printcontrol = PrintControl::join('role_groups', 'role_groups.id', '=', 'print_controls.role_id')->
        select('print_controls.*','role_groups.name')->get();
        return view('admin.controls.printcontrol.index',compact('printcontrol'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = RoleGroup::all();
        return view('admin.controls.printcontrol.create',compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $printcontrol = new PrintControl();
        $printcontrol->role_id = $request->role_id;
        $printcontrol->daily = $request->daily;
        $printcontrol->weekly = $request->weekly;
        $printcontrol->monthly = $request->monthly;
        $printcontrol->quatarly = $request->quatarly;
        $printcontrol->yearly = $request->yearly;

        if ($printcontrol->save()) {
            toastr()->success('Added successfully');
            return redirect()->route('printcontrol.index');
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
        $printcontrol = PrintControl::find($id);
        $role = RoleGroup::all();

        return view('admin.controls.printControl.edit', ['printcontrol' => $printcontrol, 'role'=>$role]);
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
        $printcontrol = PrintControl::find($id);
        $printcontrol->role_id = $request->role_id;
        $printcontrol->daily = $request->daily;
        $printcontrol->weekly = $request->weekly;
        $printcontrol->monthly = $request->monthly;
        $printcontrol->quatarly = $request->quatarly;
        $printcontrol->yearly = $request->yearly;

        if ($printcontrol->save()) {
            toastr()->success('Updated successfully');
            return redirect()->route('printcontrol.index');
        } else {
            toastr()->error('Something went wrong');
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $printcontrol = PrintControl::find($id);

        if ($printcontrol->delete()) {
            toastr()->success('Deleted successfully');
            return redirect()->back();
        } else {
            toastr()->error('Something went wrong');
            return redirect()->back();
        }
    }
}
