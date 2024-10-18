<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ObjectDetectionController extends Controller
{
    public function index()
    {
        return view('object-detection');
    }
}
