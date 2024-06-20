<?php

namespace App\Services;

use App\Models\OOS_micro;
use App\Models\OOS_Micro_grid;
use Illuminate\Http\Request;

class OOSMicroService
{
    public static function store_grid(OOS_micro $micro, Request $request, $identifier)
    {
        $res = [
            'status' => 'ok',
            'message' => 'success',
            'body' => []
        ];

        try {

            $micro_grid = OOS_Micro_grid::where(['oos_micro_id' => $micro->id, 'identifier' => $identifier])->firstOrNew();
            $micro_grid->oos_micro_id = $micro->id;
            $micro_grid->identifier = $identifier;
            $micro_grid->data = $request->$identifier;
            $micro_grid->save();


        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();
            info('Error in oos service', [
                'res' => $res
            ]);
        }

        return $res;
    }

    public static function update_grid(OOS_micro $micro, Request $request, $identifier)
    {
       //$id=OOS_mocro::find($id);
       $res = [
           'status' => 'ok',
           'message' => 'success',
           'body' => []
       ];

       try {

           $micro_grid = OOS_Micro_grid::where(['oos_micro_id' => $micro->id, 'identifier' => $identifier])->firstOrNew();
           $micro_grid->oos_micro_id = $micro->id;
           $micro_grid->identifier = $identifier;
           $micro_grid->data = $request->$identifier;
           $micro_grid->update();


       } catch (\Exception $e) {
           $res['status'] = 'error';
           $res['message'] = $e->getMessage();
       }

       return $res;
    }
}
