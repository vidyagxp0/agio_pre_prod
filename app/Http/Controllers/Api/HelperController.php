<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HelperController extends Controller
{

    /**
     * response { "link": "path/to/image.jpg" }
     */
    public function upload_file(Request $request)
    {
        $res = [
            'link' => ''
        ];

        info('image req', $request->all());

        if ($request->hasFile('image_param')) {
            $file = $request->file('image_param');
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/'), $imageName);
            $res['link'] = asset('uploads/' . $imageName);
        }

        return response()->json($res);

    }

}
