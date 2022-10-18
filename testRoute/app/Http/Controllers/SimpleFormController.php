<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SimpleFormController extends Controller
{
    public function simpleform(Request $request)
    {
        return view('simpleForm');
    }

    public function store(Request $request){
        $text = "Correct";
        $input = $request->input('num');
        if ($input == '') {
            $text = 'Number is required';
            return view('simpleForm')->with('result',$text);
        } elseif (!is_numeric($input)) {
            $text = "This is not a number";
            return view('simpleForm')->with('result',$text);
        } elseif ((int) $input < 10) {
            $text = "Number must be greater than 10"; 
            return view('simpleForm')->with('result',$text);
        } else {
            return view('simpleForm')->with('result', $text);
        }
    }
}
