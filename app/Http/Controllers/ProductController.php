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

class ProductController extends Controller
{
    public function products(Request $request){
        if(!Auth::check()){
            return redirect('/entrar');
        }
        if(session()->has('admin')){

        }
        $user = Auth::user();
        $name  = $user->name;
        $id = Auth::id();
        $produtos = Item::where('admin_id',$id)->where('ativo',1)->with('product')->with('manufacturer')->get();

        return view('products',['name' => $name,'produtos' => $produtos]);
    }

    public function showAddproduct(Request $request){
        if(!Auth::check()){
            return redirect('/entrar');
        }
        if(session()->has('admin')){

        }
        $user = Auth::user();
        $name  = $user->name;
        return view('addProducts',['name' => $name]);
    }

    public function addProducts(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/entrar');
        }

        $request->validate([
            'nome' => 'required|string|min:3|max:255',
            'codigo' => 'required|string|digits_between:8,14|unique:products,code',
            'data_de_compra' => 'required|date_format:d/m/Y',
            'data_de_vencimento' => 'nullable|date_format:d/m/Y|after:today',
            'valor_de_compra' => 'required|numeric|min:0',
            'valor_de_venda' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:1',
            'fabricante' => 'required|string|min:2|max:100',
            'email'=> 'required|email',
            'endereco'=> 'required|string|min:5|max:255',
            'numero'=> 'required',
            'cnpj'=> ['required', 'string', function ($attribute, $value, $fail) {
                $cnpj = preg_replace('/[^0-9]/', '', $value);
                if (strlen($cnpj) != 14 || preg_match('/(\d)\1{13}/', $cnpj)) {
                    return $fail('CNPJ inválido.');
                }
                for ($t = 12; $t < 14; $t++) {
                    $d = 0;
                    for ($m = $t - 7, $i = 0; $i < $t; $i++) {
                        $d += $cnpj[$i] * $m--;
                        if ($m < 2) $m = 9;
                    }
                    $d = ((10 * $d) % 11) % 10;
                    if ($cnpj[$i] != $d) {
                        return $fail('CNPJ inválido.');
                    }
                }
            }],
        ]);

        try {
            DB::beginTransaction();

            $manufacturer = Manufacturer::create([
                'name' => $request->input('fabricante'),
                'email' => $request->input('email'),
                'address' => $request->input('endereco'),
                'phone' => $request->input('numero'),
                'cnpj' => $request->input('cnpj'),
                'admin_id' => Auth::id(),
            ]);

            $product = Product::create([
                'code' => $request->input('codigo'),
                'name' => $request->input('nome'),
                'admin_id' => Auth::id(),
            ]);

            $purchaseDate = Carbon::createFromFormat('d/m/Y', $request->input('data_de_compra'))->format('Y-m-d');
            if($request->input('data_de_vencimento')){
                $dueDate = Carbon::createFromFormat('d/m/Y', $request->input('data_de_vencimento'))->format('Y-m-d');
            }


            $item = Item::create([
                'quantity' => $request->input('quantidade'),
                'purchase_value' => $request->input('valor_de_compra'),
                'sale_value' => $request->input('valor_de_venda'),
                'product_code' => $product->code,
                'purchase_date' => $purchaseDate,
                'product_id' => $product->id,
                'due_date' => $dueDate ?? null,
                'ativo' => 1,
                'manufacturer_id' => $manufacturer->id,
                'admin_id' => Auth::id(),
            ]);

            DB::commit();
            return redirect('/produtos')->with('success', 'Produto cadastrado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function showEditProductCode(Request $request){
        if(!Auth::check()){
            return redirect('/entrar');
        }
        $user = Auth::user();
        $name  = $user->name;
        return view('editProducts',['name' => $name,'titulo' => 'Editar','route' => 'productEditForm']);


    }

    public function showEditProducts(Request $request){
        if(!Auth::check()){
            return redirect('/entrar');
        }
        $user = Auth::user();
        $name  = $user->name;
        $request->validate([
            'codigo' => 'required|string|min:8|max:14',
        ]);

        try {
            $codigo = $request->input('codigo');
            $item = Item::where('product_code', $codigo)->firstOrFail();
            $product = Product::where('code', $codigo)->firstOrFail();
            $manufacturer = Manufacturer::findOrFail($item->manufacturer_id);

            $date = Carbon::createFromFormat('Y-m-d', $item->purchase_date)->format('d/m/Y');
            $dueDate = Carbon::createFromFormat('Y-m-d', $item->due_date)->format('d/m/Y');
            return view('editProductsForm', [
                'name' => $name,
                'item' => $item,
                'manufacturer' => $manufacturer,
                'product' => $product,
                'date' => $date,
                'dueDate' => $dueDate,
                'code' => $codigo,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return back()->withErrors(['error' => 'Produto ou fabricante não encontrado.']);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Erro ao carregar o produto para edição.']);
        }


    }

    public function editProducts(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/entrar');
        }

        $request->validate([
            'nome' => 'required|string|min:3|max:255',
            'codigo' => 'required|string|min:8|max:14',
            'data_de_compra' => 'required|date_format:d/m/Y',
            'data_de_vencimento' => 'nullable|date_format:d/m/Y|after:today',
            'valor_de_compra' => 'required|numeric|min:0',
            'valor_de_venda' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:1',
            'fabricante' => 'required|string|min:2|max:100',
            'email' => 'required|email',
            'endereco' => 'required|string|min:5|max:255',
            'numero' => 'required',
            'cnpj' => ['required', 'string', function ($attribute, $value, $fail) {
                $cnpj = preg_replace('/[^0-9]/', '', $value);
                if (strlen($cnpj) != 14 || preg_match('/(\d)\1{13}/', $cnpj)) {
                    return $fail('CNPJ inválido.');
                }
                for ($t = 12; $t < 14; $t++) {
                    $d = 0;
                    for ($m = $t - 7, $i = 0; $i < $t; $i++) {
                        $d += $cnpj[$i] * $m--;
                        if ($m < 2) $m = 9;
                    }
                    $d = ((10 * $d) % 11) % 10;
                    if ($cnpj[$i] != $d) {
                        return $fail('CNPJ inválido.');
                    }
                }
            }],
        ]);

        try {
            DB::beginTransaction();

            $originalCode = $request->input('original_code');
            $newCode = $request->input('codigo');

            $item = Item::where('product_code', $originalCode)->firstOrFail();
            $product = Product::where('code', $originalCode)->firstOrFail();
            $manufacturer = $item->manufacturer;

            // Atualizar fabricante
            $manufacturer->update([
                'name' => $request->input('fabricante'),
                'email' => $request->input('email'),
                'address' => $request->input('endereco'),
                'phone' => $request->input('numero'),
                'cnpj' => $request->input('cnpj'),
                'admin_id' => Auth::id(),
            ]);

            // Atualizar o código do item antes do produto (evita FK error)
            Item::where('product_code', $originalCode)->update(['product_code' => $newCode]);

            // Atualizar produto
            $product->update([
                'code' => $newCode,
                'name' => $request->input('nome'),
                'admin_id' => Auth::id(),
            ]);

            // Converter e validar data de compra
            try {
                $data = Carbon::createFromFormat('d/m/Y', $request->input('data_de_compra'));
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->withInput()->withErrors(['error' => 'Data de compra inválida.']);
            }

            if ($data->isAfter(Carbon::today())) {
                DB::rollBack();
                return back()->withInput()->withErrors(['error' => 'A data de compra deve ser anterior à data atual.']);
            }

            // Converter data de vencimento se houver
            $dueDateFormat = null;
            if ($request->filled('data_de_vencimento')) {
                try {
                    $dueDate = Carbon::createFromFormat('d/m/Y', $request->input('data_de_vencimento'));
                    if ($dueDate->isBefore(Carbon::today())) {
                        DB::rollBack();
                        return back()->withInput()->withErrors(['error' => 'A data de vencimento deve ser posterior à data atual.']);
                    }
                    $dueDateFormat = $dueDate->format('Y-m-d');
                } catch (\Exception $e) {
                    DB::rollBack();
                    return back()->withInput()->withErrors(['error' => 'Data de vencimento inválida.']);
                }
            }

            // Atualizar item
            $item->update([
                'quantity' => $request->input('quantidade'),
                'quantity_sold' => 0,
                'purchase_value' => $request->input('valor_de_compra'),
                'sale_value' => $request->input('valor_de_venda'),
                'purchase_date' => $data->format('Y-m-d'),
                'due_date' => $dueDateFormat,
                'ativo' => 1,
                'manufacturer_id' => $manufacturer->id,
                'admin_id' => Auth::id(),
            ]);

            DB::commit();
            return redirect('/produtos')->with('success', 'Produto editado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function deleteProduct(Request $request){
        if(!Auth::check()){
            return redirect('/entrar');
        }
        $user = Auth::user();
        $name  = $user->name;
        $request->validate([
            'codigo' => 'required|string|min:8|max:14',
        ]);
        try{
            $item = Item::where('product_code',$request->input('codigo'))->first();
            $product = Product::where('code',$request->input('codigo'))->first();
            $manufacturer = Manufacturer::where('id',$item->manufacturer_id)->first();
            $sales = Sale::where('product_code',$request->input('codigo'))->get();
            if (!$item || !$product || !$manufacturer) {
                return back()->withErrors(['error' => 'Produto não encontrado.']);

            }

            DB::beginTransaction();
            $item->delete();
            $product->delete();
            $manufacturer->delete();
            foreach ($sales as $sale) {
                $sale->delete();
            }
            DB::commit();
            return redirect('/produtos')->with('success', 'Produto excluido com sucesso!');

        }catch (\Exception $e){
            return back()->withErrors(['error' => 'Não encontramos um produto com esse codigo']);
        }
    }
}
