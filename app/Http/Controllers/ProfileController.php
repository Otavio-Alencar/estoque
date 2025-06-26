<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function getProfile(Request $request){
        if(!Auth::check()){
            return redirect('/entrar');
        }


        $user = Auth::user();
        $userId = $user->id;
        $name  = $user->name;
        $image = $user->image;
        $quantitySold = DB::table('items')
            ->where('admin_id', $userId)
            ->select(DB::raw('SUM(quantity_sold) as quantity'))
            ->value('quantity');
        $itensQuantity = Item::where('admin_id',$userId)->count();
        return view('profile', ['name' => $name,'image' => $image,'quantitySold' => $quantitySold,'itensQuantity' => $itensQuantity]);
    }

    public function updateProfile(Request $request){
        $request->validate([
            'name' => 'min:3',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        try {
            DB::beginTransaction();

            $admin = Admin::findOrFail(Auth::id());

            if ($request->name) {
                $admin->name = $request->name;
            }

            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('profiles', 'public');
                $admin->image = '/storage/' . $photoPath;
            }
            $admin->save();
            DB::commit();
            return back();

        }catch (\Exception $e){
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
