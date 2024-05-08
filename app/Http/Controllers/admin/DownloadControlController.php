<?php

namespace App\Http\Controllers\admin;
use App\Models\DownloadControl;
use App\Models\RoleGroup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DownloadControlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $downloadcontrol = DownloadControl::join('role_groups', 'role_groups.id', '=', 'download_controls.role_id')->
        select('download_controls.*','role_groups.name')->get();
        return view('admin.controls.downloadcontrol.index',compact('downloadcontrol'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = RoleGroup::all();
        return view('admin.controls.downloadcontrol.create',compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $downloadcontrol = new DownloadControl();
        $downloadcontrol->role_id = $request->role_id;
        $downloadcontrol->daily = $request->daily;
        $downloadcontrol->weekly = $request->weekly;
        $downloadcontrol->monthly = $request->monthly;
        $downloadcontrol->quatarly = $request->quatarly;
        $downloadcontrol->yearly = $request->yearly;

        if ($downloadcontrol->save()) {
            toastr()->success('Added successfully');
            return redirect()->route('downloadcontrol.index');
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
        $downloadcontrol = DownloadControl::find($id);
        $role = RoleGroup::all();

        return view('admin.controls.downloadcontrol.edit', ['downloadcontrol' => $downloadcontrol, 'role'=>$role]);
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
        $downloadcontrol = DownloadControl::find($id);
        $downloadcontrol->role_id = $request->role_id;
        $downloadcontrol->daily = $request->daily;
        $downloadcontrol->weekly = $request->weekly;
        $downloadcontrol->monthly = $request->monthly;
        $downloadcontrol->quatarly = $request->quatarly;
        $downloadcontrol->yearly = $request->yearly;

        if ($downloadcontrol->save()) {
            toastr()->success('Updated successfully');
            return redirect()->route('downloadcontrol.index');
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
        $downloadcontrol = DownloadControl::find($id);

        if ($downloadcontrol->delete()) {
            toastr()->success('Deleted successfully');
            return redirect()->back();
        } else {
            toastr()->error('Something went wrong');
            return redirect()->back();
        }
    }
}
