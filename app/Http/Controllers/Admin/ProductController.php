<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $title = 'Produtos';
            $products = Product::all();
            if($products->isEmpty()) {
                session()->flash('info', 'Ainda não existe <b class="text-danger">Produtos</b> cadastrados no sistema');
            }
            return view('admin.product.index', compact('title', 'products'));
        } catch (QueryException $e) {
            // Log the error
            return abort(500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $title = 'Cadastrar produto';
            $categories = Category::all();
            $manufacturers = Manufacturer::all();
            $vendors = Vendor::all();
            return view('admin.product.create', compact('title', 'categories' ,'manufacturers' ,'vendors'));
        } catch (QueryException $e) {
            // Log de erro
            return abort(500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        try {
            $product = new Product;

            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $thumbnail = $request->code . date('dmy-H-i-s') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('img/products'), $thumbnail);
            }
            $product->fill($request->all());
            $product->slug = Str::of($request->name)->slug;
            $product->status = 1;
            if(isset($thumbnail)){
                $product->thumbnail = "products/" . $thumbnail;
            }
            $product->save();
            return response()->json([
                'trigger' => alert(
                    'Produto <b>"' . $request->name . '"</b> cadastrado com sucesso!',
                    2000,
                    route('admin.product.index')
                ),
            ]);
        } catch (QueryException $e) {
            // Log de erro
            return abort(500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.product.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $title = 'Editar produto';
            $product = Product::find($id);
            $manufacturers = Manufacturer::all();
            $vendors = Vendor::all();
            if(is_null($product)) {
                return redirect()->route('admin.vendor.index')->with('warning', 'Você tentou acessar um item inexistente!');
            }
            return view('admin.product.edit', compact('product', 'title', 'manufacturers', 'vendors'));
        } catch (QueryException $e) {
            // Log de erro
            return abort(500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        try {
            $product = Product::find($id);
            if ($request->hasFile('thumbnail')) {
                if (file_exists(public_path('img/' . $product->thumbnail))
                    && is_file(public_path('img/' . $product->thumbnail))) {
                    unlink(public_path('img/' . $product->thumbnail));
                }
                $file = $request->file('thumbnail');
                $thumbnail = $request->code . date('dmy-H-i-s') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('img/products'), $thumbnail);
            }
            $product->fill($request->all());
            $product->slug = Str::of($request->name)->slug;
            $product->status = ($request->status ?? 0);
            if(isset($thumbnail)){
                $product->thumbnail = "products/" . $thumbnail;
            }
            $product->save();
            return response()->json([
                'trigger' => alert(
                    'Produto <b>"' . $request->name . '"</b> Atualizado com sucesso!',
                    2000,
                    route('admin.product.index')
                ),
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
            //return abort(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::find($id);
            /**if (!$product->products->isEmpty()) {
                // Log (Atencão! Usuário (nome) tentou exluir um produto com pedido(s) vinculado(s))
                return response()->json([
                    'trigger' => [
                        alert(
                            'Não é possivel excluir produtos vinculados à pedidos cadastrados!',
                            false,
                            false,
                            'warning'
                        )
                    ],
                ]);
            }*/
            $product->delete();
            // Log (Info! Usuário (nome) excluiu o produto ($product->name))
            return response()->json([
                'result' =>  true,
            ]);
        } catch (QueryException $e) {
            // Log (Erro! $e->getMessage())
            return response()->json(['trigger' => db_error($e->getMessage())]);
        }
    }
}
