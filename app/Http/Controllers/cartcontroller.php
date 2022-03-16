<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\Cupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class cartcontroller extends Controller
{

    //view cart

    function cart(Request $request){
        $cupon_code = $request->cupon_code;
        $message = null;
        $cart_info = cart::where('user_id', Auth::guard('CustomerLogin')->id())->get();

        if($cupon_code == ''){
            $discount = 0;

        }
        else{
            if(Cupon::where('cupon_name', $cupon_code)->exists()){
                if(Carbon::now()->format('Y-m-d') > Cupon::where('cupon_name', $cupon_code)->first()->cupon_validity){
                    $message= 'Cupon Code Expired !';
                    $discount = 0;
                }
                else{
                    $discount = Cupon::where('cupon_name', $cupon_code)->first()->cupon_discount;
                }
            }
            else{
                $message= 'Invalid Cupon Code !';
                $discount = 0;
            }
        }
        return view('frontend.cart',[
            'cart_info'=>$cart_info,
            'discount'=> $discount,
            'cupon_code'=>$cupon_code,
            'message'=>$message,
        ]);
    }
    // cart_insert

    function cart_insert(Request $request){
        // same user same  product add cart kore then quantity increment hobe
        if(cart::where('user_id', Auth::guard('CustomerLogin')->id())->where('product_id', $request->product_id)->exists()){
            cart::where('product_id', $request->product_id)->increment('quantity', $request->quantity);
            return back()->with('add_cart', 'Product Added to Cart');
        }
        // same user na hole cart insert hobe
        else{
            cart::insert([
            'product_id'=>$request->product_id,
            'user_id'=>Auth::guard('CustomerLogin')->id(),
            'quantity'=>$request->quantity,
            'created_at'=> Carbon::now(),
        ]);
        return back()->with('add_cart', 'Product Added to Cart');
      }
    }

    //cart_delete---
    function cart_delete($cart_id){
        Cart::find($cart_id)->delete();
        return back();
    }

    // cart_update
    function cart_update(Request $request){
      foreach($request->quantity as $cart_id=>$quantity){
          cart::find($cart_id)->update([
                'quantity'=>$quantity
          ]);
      }

      return back()->with('cart_update', 'Cart Update Successfully !');
    }

}
