<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Slide;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function getIndex(){
        $slide = Slide::all();
        // return view('page.trangchu');
        // return view('page.trangchu',compact('slide'));
        $new_product = Product::where('new',1)->get();
        //dd($new_product);
        return view('page.trangchu',compact('slide','new_product'));
    }

    public function getLoaiSp(){
        return view('page.loai_sanpham');
    }

    public function getChitiet(){
        return view('page.chitiet_sanpham');
    }

    public function getLienhe(){
        return view('page.lienhe');
    }

    public function getAbout(){
        return view('page.about');
    }
}
