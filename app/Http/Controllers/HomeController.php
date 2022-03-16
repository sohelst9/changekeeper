<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    //user---
    function users(){
        $logged_user_id = Auth::id();
        $all_user = User::where('id', '!=' ,$logged_user_id)->get();
        $login_user = Auth::user()->name;
        $total_user = User::count();
        return view('admin.user.all_user', compact('all_user', 'login_user', 'total_user'));
    }
    //user delete
    function user_delete($user_id){
        User::find($user_id)->delete();
        return back()->with('delete_success', 'User Delete Successfully..');
    }
}
