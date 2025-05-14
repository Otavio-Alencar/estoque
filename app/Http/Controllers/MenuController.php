<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Manufacturer;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{

    public function index(Request $request){
        Carbon::setLocale('pt_BR');
        if(!Auth::check()){
            return redirect('/entrar');
        }
        if(session()->has('admin')){

        }
        $user = Auth::user();
        $name  = $user->name;
        $email = $user->email;
        $image = $user->image;

        $userId = Auth::id();
        $itensQuantity = Item::where('admin_id',$userId)->count();
        $investidos = DB::table('items')
            ->where('admin_id', $userId)
            ->select(DB::raw('SUM(purchase_value * quantity) as total'))
            ->value('total');
        $lucro = DB::table('items')
            ->where('admin_id', $userId)
            ->select(DB::raw('SUM(sale_value * quantity_sold) as lucro'))
            ->value('lucro');
        $quantitySold = DB::table('items')
            ->where('admin_id', $userId)
            ->select(DB::raw('SUM(quantity_sold) as quantity'))
            ->value('quantity');
        $manufacturerQuantity = Manufacturer::where('admin_id',$userId)->count();
        $labels = [];
        $vendasPorMes = [];
        $investimentosPorMes = [];

        for ($mes = 1; $mes <= 12; $mes++) {
            $inicio = Carbon::create(2025, $mes, 1)->startOfMonth();
            $fim = Carbon::create(2025, $mes, 1)->endOfMonth();
            $labels[] = $inicio->translatedFormat('F');
            $vendas = DB::table('items')
                ->where('admin_id', $userId)
                ->whereBetween('sale_date', [$inicio, $fim])
                ->select(DB::raw('SUM(sale_value * quantity_sold) as total'))
                ->value('total');


            $investimentos = DB::table('items')
                ->where('admin_id', $userId)
                ->whereBetween('purchase_date', [$inicio, $fim])
                ->select(DB::raw('SUM(purchase_value * quantity) as total'))
                ->value('total');

            $vendasPorMes[] = round($vendas, 2);
            $investimentosPorMes[] = round($investimentos, 2);



        }
        $chartData = [
            'labels' => $labels,
            'vendas' => $vendasPorMes,
            'investimentos' => $investimentosPorMes
        ];

        return view('welcome', [
            'name' => $name,
            'email' => $email,
            'itensQuantity' => $itensQuantity,
            'investimentos' => $investidos ?? 0,
            'lucro' => $lucro ?? 0,
            'manufacturerQuantity' => $manufacturerQuantity ?? 0,
            'chartData' => $chartData,
            'quantitySold' => $quantitySold ?? 0,
        ]);
    }


}
