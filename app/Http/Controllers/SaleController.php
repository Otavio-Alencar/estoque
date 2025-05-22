<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function sales(Request $request){
        if(!Auth::check()){
            return redirect('/entrar');
        }

        $user = Auth::user();
        $id = $user->id;
        $name  = $user->name;
        $items = Item::where('admin_id', $id)->get();
        $products = Product::where('admin_id', $id)->get();
        $alertItem = $items->whereBetween('quantity', [3, 6]);
        $dangerItem = $items->where('quantity', '<', 3);
        return view('sales',['name' => $name,'alertItems' => $alertItem,'dangerItems' => $dangerItem,'products' => $products]);
    }
    public function saleRegister(Request $request){
        if(!Auth::check()){
            return redirect('/entrar');
        }
        $request->validate([
            'produto' => 'required|exists:products,code',
            'email' => 'required|email',
            'quantidade' => 'required|integer|min:1',
            'data_de_venda' => 'required',
            'comprovante' => 'required|file|mimes:jpg,jpeg,png,pdf',
        ], [
            'produto.exists' => 'O produto selecionado não é válido.',
            'comprovante.mimes' => 'O comprovante deve ser uma imagem ou um PDF.',
        ]);
        try{
            DB::beginTransaction();
            $product = Product::where('code',$request->produto)->first();
            $item = Item::where('product_code',$request->produto)->first();
            $manufacturer = Manufacturer::where('id',$item->manufacturer_id)->first();
            if ($request->hasFile('comprovante')) {
                $comprovante = $request->file('comprovante');

                // Criar nome único para imagem
                $comprovanteName = time() . '_' . uniqid() . '.' . $comprovante->getClientOriginalExtension();

                // Mover para public/dist/img
                $comprovante->move(public_path('dist/comprovantes'), $comprovanteName);

                $comprovantePath = 'dist/img/' . $comprovanteName;
            } else {
                DB::rollBack();
                return back()->withInput()->withErrors(['error' => 'Erro ao registrar comprovante']);
            }

            if(!$item || !$manufacturer){
                DB::rollBack();
                return back()->withInput()->withErrors(['error' => 'Erro ao registrar venda']);
            }
            if($item->quantity <= 0){
                DB::rollBack();
                return back()->withInput()->withErrors(['error' => 'O produto está esgotado']);
            }
            if($item->quantity < $request->quantidade){
                DB::rollBack();
                return back()->withInput()->withErrors(['error' => 'Há menos produtos do que a quantidade de vendas que deseja registrar']);
            }
            $date = $request->input('data_de_venda');

            $data = Carbon::createFromFormat('d/m/Y', $date);

            if (!$data || $data->format('d/m/Y') !== $date) {
                DB::rollBack();
                return back()->withErrors(['error' => 'Data inválida.']);
            }

            if ($data->isAfter(Carbon::today())) {
                DB::rollBack();
                return back()->withInput()->withErrors(['error' => 'A data deve ser anterior à data atual.']);
            }
            $dataFormat = $data->format('Y-m-d');
            $item->update([
                'quantity' => ($item->quantity - $request->quantidade),
                'quantity_sold' => $request->quantidade
            ]);

            $sale = Sale::create([
                'quantity' => $request->quantidade,
                'sale_value' => $item->sale_value,
                'sale_date' => $dataFormat,
                'proof' => $comprovantePath,
                'product_code' => $product->code,
                'manufacturer_id' => $manufacturer->id,
                'item_id' => $item->id,
                'admin_id' => Auth::id()
            ]);
            DB::commit();
            return redirect('/estoque')->with('success', 'Venda cadastrada com sucesso!');
        }catch (\Exception $e){
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }

    }
}
