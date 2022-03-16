<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\CustomerLogin;
use App\Models\Order;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class frontendcontroller extends Controller
{
    // index---frontend
    function index(){
        $all_category = category::all();
        $all_product = product::latest()->get();
        return view('frontend.index',[
            'all_category'=>$all_category,
            'all_product'=>$all_product,
        ]);
    }

    // product_details

    function product_details($product_id){
        $product_info = product::find($product_id);
        $related_product = product::where('category_id',$product_info->category_id)->where('id', '!=', $product_id)->get();
        return view('frontend.product_details',[
            'product_info'=>$product_info,
            'related_product'=>$related_product,

        ]);

    }

    // customer account
    function account(){
        $orders = Order::where('user_id', Auth::guard('CustomerLogin')->id())->get();
        return view('frontend.account',[
            'orders'=>$orders,
        ]);
    }

    //account_update
    function account_update(Request $request){
       CustomerLogin::find(Auth::guard('CustomerLogin')->id())->update([
            'name'=>$request->name,
            'password'=>bcrypt($request->password),
       ]);
       return back()->with('customer_update', 'Customer Update Successfully !');
    }
    // all_product
    function all_product(){
        $all_category = category::all();
        $all_product = product::all();
        return view('frontend.all_product',[
            'all_category'=>$all_category,
            'all_product'=>$all_product,
        ]);
    }
}
