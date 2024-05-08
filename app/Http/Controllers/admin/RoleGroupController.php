<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\RoleGroup;
use Illuminate\Http\Request;


class RoleGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $group = RoleGroup::all();

        return view('admin.role_groups.group_category', compact('group'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('admin.role_groups.create');
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
        $group  = new RoleGroup();
        $group->name = $request->name;
        $group->description = $request->description;

        $read = $request->read == "on" ? 'true' : 'false';
        $create = $request->create == "on" ? 'true' : 'false';
        $edit = $request->edit == "on" ? 'true' : 'false';
        $delete = $request->delete == "on" ? 'true' : 'false';

        $group->permission = json_encode(['read' => $read, 'create' => $create, 'edit' => $edit, 'delete' => $delete]);


        if ($group->save()) {
            toastr()->success('Added successfully');
            return redirect()->route('role_groups.index');
        } else {
            toastr()->error('Something went wrong');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GroupCategory  $groupCategory
     * @return \Illuminate\Http\Response
     */
    public function show(RoleGroup $groupCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GroupCategory  $groupCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $data = RoleGroup::find($id);

        return view('admin.role_groups.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GroupCategory  $groupCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $group  = RoleGroup::find($id);
        $group->name = $request->name;
        $group->description = $request->description;


        $read = $request->read == "on" ? 'true' : 'false';
        $create = $request->create == "on" ? 'true' : 'false';
        $edit = $request->edit == "on" ? 'true' : 'false';
        $delete = $request->delete == "on" ? 'true' : 'false';

        $group->permission = json_encode(['read' => $read, 'create' => $create, 'edit' => $edit, 'delete' => $delete]);


        if ($group->update()) {
            toastr()->success('Update successfully');
            return redirect()->route('role_groups.index');
        } else {
            toastr()->error('Something went wrong');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GroupCategory  $groupCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $group = RoleGroup::find($id);

        if ($group->delete()) {
            toastr()->success('Deleted successfully');
            return redirect()->back();
        } else {
            toastr()->error('Something went wrong');
            return redirect()->back();
        }
    }
}
