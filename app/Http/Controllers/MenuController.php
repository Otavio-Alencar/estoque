<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function index(Request $request){
        if(!Auth::check()){
            return redirect('/entrar');
        }
        if(session()->has('admin')){

        }
        $user = Auth::user();
        $name  = $user->name;
        $email = $user->email;
        return view('welcome', ['name' =>$name, 'email' => $email ]);
    }
}
