<?php

namespace App\Http\Controllers;

use App\Models\Cupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CuponController extends Controller
{
    //add_cupon
    function add_cupon(){
        $all_cupon = Cupon::all();
        return view('admin.cupon.index',[
            'all_cupon'=>$all_cupon,
        ]);
    }

    // cupon_insert
    function cupon_insert(Request $request){
        Cupon::insert([
            'cupon_name'=>$request->code,
            'cupon_discount'=>$request->discount,
            'cupon_validity'=>$request->validity,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('cupon_insert', 'Cupon Insert Successfully !');
    }
}
