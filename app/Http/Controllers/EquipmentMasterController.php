<?php

namespace App\Http\Controllers;
use App\Models\Department;
use App\Exports\EquipmentMasterExport;
use App\Imports\EquipmentMasterImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\EquipmentMaster;
class EquipmentMasterController extends Controller
{
     public function index()
    {
        //

        $departments = Department::all();
        $equipmentmaster = EquipmentMaster::all();

        // dd($departments);
        return view('admin.EquipmentMaster.equipmentmaster', compact('departments' ,'equipmentmaster'));
    }
     public function store(Request $request)
    {
        //
        $euipmentmaster = new EquipmentMaster();
        // dd($euipmentmaster,$request->all());
        $euipmentmaster->department_id = $request->department_id;
        $euipmentmaster->equipment_name = $request->equipment_name;
        $euipmentmaster->equipment_id = $request->equipment_id;

        if ($euipmentmaster->save()) {
            toastr()->success('Added successfully');
            return redirect()->route('eqmaster.index');
        } else {
            toastr()->error('Something went wrong');
            return redirect()->back();
        }
    }

    public function edit($id)

    {
        $equipmentmaster = EquipmentMaster::find($id);
        $departments = Department::all();
        return view('admin.EquipmentMaster.edit', compact('equipmentmaster', 'departments'));

        //  return redirect()->route('image')->wtih('result',$result);

    }
     public function update(Request $request, $id)

    {
        $euipmentmaster = EquipmentMaster::find($id);
        // $euipmentmaster->department_name = $request->department_name;
        $euipmentmaster->department_id = $request->department_id;
        $euipmentmaster->equipment_name = $request->equipment_name;
        $euipmentmaster->equipment_id = $request->equipment_id;
    

        if ($euipmentmaster->update()) {
            toastr()->success('Updated successfully');
            return redirect()->route('eqmaster.index');
        } else {
            toastr()->error('Something went wrong');
            return redirect()->back();
        }

        // return redirect()->route('banner-list.index');

    }
     public function destroy($id)
    {

        $euipmentmaster = EquipmentMaster::find($id);

        if ($euipmentmaster->delete()) {
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
            new EquipmentMasterExport,
            'equipment_master.xlsx'
        );
    }

    // Import
    public function import(Request $request) 
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        Excel::import(new EquipmentMasterImport, $request->file('file'));

        toastr()->success('Data Imported Successfully!');
        return redirect()->back();
    }
}
