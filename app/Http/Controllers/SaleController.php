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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $alertItem = $items->whereBetween('quantity', [1, 6]);
        $dangerItem = $items->where('quantity', '==', 0);
        $sales = Sale::all();
        return view('sales',['name' => $name,'alertItems' => $alertItem,'dangerItems' => $dangerItem,'products' => $products,'sales' => $sales]);
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

            $product = Product::where('code',$request->produto)->firstOrFail();
            $item = Item::where('product_code',$request->produto)->firstOrFail();
            $manufacturer = Manufacturer::where('id',$item->manufacturer_id)->firstOrFail();

            $comprovantePath = $this->storeProof($request->file('comprovante'));
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
    protected function storeProof($file)
    {
        $extension = $file->getClientOriginalExtension();
        $fileName = time() . '_' . Str::random(10) . '.' . $extension;

        $path = $file->storeAs('comprovantes', $fileName, 'public');

        return $fileName;
    }
}
