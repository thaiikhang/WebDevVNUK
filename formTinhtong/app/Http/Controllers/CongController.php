<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CongController extends Controller
{
    public function tinhtong(Request $request){
        $sum = $request->soA + $request->soB;
        return view('sum',compact('sum'));
    }
}
