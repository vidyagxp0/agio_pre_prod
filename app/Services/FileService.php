<?php

namespace App\Services;

use Illuminate\Http\Request;

class FileService
{
    public static function uploadMultipleFiles(Request $request, $inputName = null, $directory = 'upload/') : array
    {
        $files = [];

        if ($inputName && !empty ($request->$inputName)) {
            if ($request->hasfile($inputName)) {
                foreach ($request->file($inputName) as $file) {
                    
                    $name =  'multifileupload_' . rand(1, 10000*10000) . '.' . $file->getClientOriginalExtension();
                    $file->move($directory, $name);
                    array_push($files, $name);
                }
            }
        }

        return $files;
    }
}