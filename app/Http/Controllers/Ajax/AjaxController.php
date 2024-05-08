<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Training;
use App\Models\User;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    /**
     * $id = App\Models\Document id
     */
    public function getSopTrainingUsers($id)
    {
        $res = [ 
            'status' => 'ok',
            'message' => 'success',
            'body' => []
        ];
        
        try {

            $completed_trainings = Training::where('sops', 'LIKE', '%'. $id .'%')->where('status', 'Complete')->get();

            $exclude_user_ids = [];

            foreach ($completed_trainings as $training)
            {
                $training->trainees ? array_push($exclude_user_ids, explode(',', $training->trainees)) : '';
            }

            $users = User::where('role', '!=', 6)->whereNotIn('id', $exclude_user_ids)->get();
            
            foreach($users as $data){
                $data->department = Department::where('id',$data->departmentid)->value('name');
            }

            $html = view('frontend.TMS.comps.training-users', compact('users'))->render();

            $res['body'] = $html;

        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();
        }

        return response()->json($res);
    }
}
