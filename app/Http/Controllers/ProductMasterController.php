<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductMaster;
use App\Imports\ProductMasterImport;
use App\Exports\ProductMasterExport;
use Maatwebsite\Excel\Facades\Excel;

class ProductMasterController extends Controller
{
    
    public function index()
    {
        //

        $prdocutmaster = ProductMaster::all();

        // dd($departments);
        return view('admin.EquipmentProduct.productmaster', compact('prdocutmaster'));
    }
     public function store(Request $request)
    {
        //
        $euipmentproduct = new ProductMaster();
        // dd($euipmentproduct,$request->all());
        $euipmentproduct->product_name = $request->product_name;
        $euipmentproduct->product_code = $request->product_code;
        $euipmentproduct->category = $request->category;

        if ($euipmentproduct->save()) {
            toastr()->success('Added successfully');
            return redirect()->route('eqproduct.index');
        } else {
            toastr()->error('Something went wrong');
            return redirect()->back();
        }
    }
     public function edit($id)

    {
        $equipmentproduct = ProductMaster::find($id);
        // $departments = Department::all();
        return view('admin.EquipmentProduct.productmasteredit', compact('equipmentproduct'));

        //  return redirect()->route('image')->wtih('result',$result);

    }
         public function update(Request $request, $id)

    {
        $euipmentproduct = ProductMaster::find($id);
        // $euipmentproduct->department_name = $request->department_name;
        $euipmentproduct->product_name = $request->product_name;
        $euipmentproduct->product_code = $request->product_code;
        $euipmentproduct->category = $request->category;

    

        if ($euipmentproduct->update()) {
            toastr()->success('Updated successfully');
            return redirect()->route('eqproduct.index');
        } else {
            toastr()->error('Something went wrong');
            return redirect()->back();
        }

        // return redirect()->route('banner-list.index');

    }
     public function destroy($id)
    {

        $euipmentproduct = ProductMaster::find($id);

        if ($euipmentproduct->delete()) {
            toastr()->success('Deleted successfully');
            return redirect()->back();
        } else {
            toastr()->error('Something went wrong');
            return redirect()->back();
        }
    }

     public function export()
    {
        return Excel::download(
            new ProductMasterExport,
            'equipmentProduct_master.xlsx'
        );
    }

    // Import
   public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,csv'
    ]);

    Excel::import(new ProductMasterImport, $request->file('file'));

    toastr()->success('Product Imported Successfully!');
    return redirect()->back();
}
}
