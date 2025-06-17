<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Manufacturer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ManufacturerController extends Controller
{
    public function manufacturers(request $request){
        if(!Auth::check()){
            return redirect('/entrar');
        }
        $user = Auth::user();
        $name  = $user->name;
        $manufacturers = Manufacturer::where('admin_id', $user->id)->get();
        return view('manufacturers',['name' => $name,'manufacturers' => $manufacturers]);
    }


}

