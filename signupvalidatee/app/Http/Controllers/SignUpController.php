<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\signupRequest;

class SignUpController extends Controller
{
    public function viewsignup(){
        return view('signup');
    }

    public function displayInfo(signupRequest $request){
        $user = [
            'name'=>$name = $request-> input("name"),
            'age'=>$age = $request-> input("age"),
            'date'=>$date = $request-> input("date"),
            'phone'=>$phone = $request-> input("phone"),
            'web'=>$web = $request-> input("web"),
            'address'=>$address = $request-> input("address")
        ];
        return view('signup')->with('user',$user);
    }
}
