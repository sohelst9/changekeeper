<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerLoginController extends Controller
{
    function customer_login(Request $request){
        if(Auth::guard('CustomerLogin')->attempt(['email' =>$request->email, 'password' =>$request->password])){
            return redirect('/');
        }
        else{
            return redirect('/register');
        }
    }

    public function customer_logout(Request $request) {
        Auth::guard('CustomerLogin')->logout();
        return redirect('/');
      }


}
