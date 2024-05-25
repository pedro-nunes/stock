<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $title = 'Categorias';
            $categories = Category::orderBy('created_at',  'DESC')->get();
            if ($categories->isEmpty()) {
                session()->flash('info', 'Ainda não existe <b class="text-danger">Categorias</b> cadastradas no sistema.');
            }
            return view('admin.category.index', compact('title', 'categories'));
        } catch (QueryException $e) {
            // Log (Erro! $e->getMessage())
            return abort(500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        try {
            $category = new Category;
            $category->fill($request->all());
            $category->slug = Str::of($request->name)->slug('-');
            $category->save();
            // Log (Info! Usuário (nome) criou uma nova categoria com nome ($request->name))
            return response()->json([
                'trigger' => alert(
                    'Categoria <b>"' . $request->name . '"</b> cadastrada com sucesso!',
                    1000,
                    route('admin.category.index')
                ),
            ]);
        } catch (QueryException $e) {
            // Log (Erro! $e->getMessage())
            return abort(500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param string $id
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        try {
            $category = Category::find($id);
            $category->fill($request->all());
            $category->slug = Str::of($request->name)->slug('-');
            $category->save();
            // Log (Info! Usuário (nome) alterou a categoria ($category->name))
            return response()->json([
                'trigger' => alert(
                    'Categoria <b>"' . $request->name . '"</b> atualizada com sucesso!',
                    1000,
                    route('admin.category.index')
                ),
            ]);
        } catch (QueryException $e) {
            // Log (Erro! $exception->getMessage())
            return abort(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id = null)
    {
        try {
            $category = Category::find($id);
            if (!$category->products->isEmpty()) {
                // Log (Atencão! Usuário (nome) tentou exluir uma categoria com produto(s) vinculado(s))
                return response()->json([
                    'trigger' => [
                        alert(
                            'Não é possivel excluir categorias vinculadas à produtos cadastrados!',
                            false,
                            false,
                            'warning'
                        )
                    ],
                ]);
            }
            $category->delete();
            // Log (Info! Usuário (nome) excluiu a categoria ($category->name))
            return response()->json([
                'result' =>  true,
            ]);
        } catch (QueryException $e) {
            // Log (Erro! $e->getMessage())
            return response()->json(['trigger' => db_error($e->getMessage())]);
        }
    }
}
