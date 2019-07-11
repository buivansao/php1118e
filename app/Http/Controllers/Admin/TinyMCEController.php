<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TinyMCEController extends Controller
{
    public function store(Request $request)
    {

        $file = $request->file('file');
        $path = url('/uploads/') . '/' . $file->getClientOriginalName();
        $imgpath = $file->move(public_path('/uploads/'), $file->getClientOriginalName());
        $fileNameToStore = $path;


        return json_encode(['location' => $fileNameToStore]);

    }
}

