<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Distributionlist;
use Illuminate\Http\Request;

class DistributionListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $distributionlist = Distributionlist::all();
        return view('admin.distributionlist.distributionlist', compact('distributionlist'));
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
        $distributionlist = new Distributionlist();
        $distributionlist->dlname = $request->dlname;
        $distributionlist->dlcode = $request->dlcode;

        if ($distributionlist->save()) {
            toastr()->success('Added successfully');
            return redirect()->route('distributionlist.index');
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
        $distributionlist = Distributionlist::find($id);

        return view('admin.distributionlist.edit', ['distributionlist' => $distributionlist]);

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
        $distributionlist = Distributionlist::find($id);
        $distributionlist->dlname = $request->dlname;
        $distributionlist->dlcode = $request->dlcode;

        if ($distributionlist->update()) {
            toastr()->success('Updated successfully');
            return redirect()->route('distributionlist.index');
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

        $distributionlist = Distributionlist::find($id);

        if ($distributionlist->delete()) {
            toastr()->success('Deleted successfully');
            return redirect()->back();
        } else {
            toastr()->error('Something went wrong');
            return redirect()->back();
        }
    }
}
