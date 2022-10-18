<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArrayController extends Controller
{
    public function getIndex()
    {
        $name = 'Khang';
        $age = 20;
        $class = '20CSE';
        $arr = [
            [   'name' => $name,
                'age' => $age,
                'class' => $class
            ],
            [
                'name' => 'Tuan',
                'age' => $age,
                'class' => $class
            ]];
        return view('testarray')->with('student', $arr);
    }
}
