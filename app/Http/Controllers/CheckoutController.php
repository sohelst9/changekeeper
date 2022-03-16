<?php

namespace App\Http\Controllers;

use App\Models\BillingDetails;
use App\Models\cart;
use App\Models\CartProductDetails;
use App\Models\City;
use App\Models\Country;
use App\Models\Order;
use App\Models\product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Prophecy\Call\Call;

class CheckoutController extends Controller
{
    // checkout--
    function checkout(){
        $sub_total = 0;
        $cart = cart::where('user_id', Auth::guard('CustomerLogin')->id())->get();
        $countries =Country::all();
        foreach($cart as $carts){
            $sub_total += $carts->cart_to_product->after_discount * $carts->quantity;
        }
        return view('frontend.checkout',[
            'cart'=>$cart,
            'sub_total'=>$sub_total,
            'countries'=>$countries,
        ]);
    }

    // ajax to controller method and relation country to city--
    function getCity(Request $request){
       $citis= City::where('country_id', $request->country_id)->get();
       $data_send = '<option value="">Select a City&hellip;</option>';
       foreach($citis as $city){
           $data_send .='<option value="'.$city->id.'">'.$city->name.'</option>';
       }
       echo $data_send;
    }

    // order

    function order_insert(Request $request){
        // checkout page validation
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'country_id'=>'required',
            'city_id'=>'required',
            'address'=>'required',
            'delivery_location'=>'required',
            'payment_method'=>'required',
        ],[
        'name.required'=>'* Please Enter Your Name !',
        'email.required'=>'* Please Enter Your Email !',
        'phone.required'=>'* Please Enter Your Phone Number !',
        'country_id.required'=>'* Please Select Your Country !',
        'city_id.required'=>'* Please Select Your City !',
        'address.required'=>'* Please Enter Your Address !',
        'delivery_location.required'=>'* Please Select Your Delivery Location !',
        'payment_method.required'=>'* Please Select Your payment Method !',
        ]);
        // checkout page validation end---
        if($request->payment_method == 1){

            //insert order date and Order table----
            $order_id = Order::insertGetId([
                    'user_id'=>Auth::guard('CustomerLogin')->id(),
                    'total'=>$request->total,
                    'discount'=>$request->discount,
                    'delivery_charge'=>$request->delivery_location,
                    'payment_method'=>$request->payment_method,
                    'created_at'=>Carbon::now(),
            ]);

            // insert billing details----
            BillingDetails::insert([
                    'order_id'=>$order_id,
                    'user_id'=>Auth::guard('CustomerLogin')->id(),
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'company'=>$request->company,
                    'phone'=>$request->phone,
                    'country_id'=>$request->country_id,
                    'city_id'=>$request->city_id,
                    'address'=>$request->address,
                    'notes'=>$request->notes,
                    'created_at'=>Carbon::now(),
            ]);

            // insert cart product details---
            $carts = cart::where('user_id', Auth::guard('CustomerLogin')->id())->get();
            foreach($carts as $cart){
                    CartProductDetails::insert([
                        'order_id'=>$order_id,
                        'product_id'=>$cart->product_id,
                        'quantity'=>$cart->quantity,
                        'product_price'=>$cart->cart_to_product->product_price,
                        'created_at'=>Carbon::now(),
                ]);
            }
            return redirect()->route('order_confirm')->with('order_success', 'Your Order has Been Placed !!');
        }
        elseif($request->payment_method == 2){
            $sub_total= $request->total;
            $discount = $request->discount;
            $delivery_charge= $request->delivery_location;
            return view('exampleHosted',[
                'sub_total'=>$sub_total,
                'discount'=>$discount,
                'delivery_charge'=>$delivery_charge,
            ]);
        }
        else{
            return redirect('/');
        }


    }
    //order_confirm

    function order_confirm(){
        $carts = $carts = cart::where('user_id', Auth::guard('CustomerLogin')->id())->get();
        foreach($carts as $cart){
            cart::find($cart->id)->delete();
            product::find($cart->product_id)->decrement('quantity', $cart->quantity);
        }
        return view('frontend.order_confirm');
    }
}
