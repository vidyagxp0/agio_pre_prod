<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\QMSDivision;
use Illuminate\Http\Request;

class QMSDivisionController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $division = QMSDivision::all();
        return view('admin.QMSdivision.division', compact('division'));
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
        $division = new QMSDivision();
        $division->name = $request->name;

        if ($division->save()) {
            toastr()->success('Added successfully');
            return redirect()->route('qms-division.index');
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
        $division = QMSDivision::find($id);

        return view('admin.QMSdivision.edit', ['division' => $division]);

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
        $division = QMSDivision::find($id);
        $division->name = $request->name;


        if ($division->update()) {
            toastr()->success('Updated successfully');
            return redirect()->route('qms-division.index');
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

        $division = QMSDivision::find($id);

        if ($division->delete()) {
            toastr()->success('Deleted successfully');
            return redirect()->back();
        } else {
            toastr()->error('Something went wrong');
            return redirect()->back();
        }
    }
}
