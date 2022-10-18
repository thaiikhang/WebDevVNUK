<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function firstUser() {
        return view('user1');
    }

    public function secondUser() {
        echo 'hello user2';
    }

    public function thirdUser() {
        echo 'hello user3';
    }
}
