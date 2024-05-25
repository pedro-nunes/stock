<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Manufacturer;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $title = 'Fabricantes';
            $manufacturers = Manufacturer::orderBy('created_at',  'DESC')->get();
            if ($manufacturers->isEmpty()) {
                session()->flash('info', 'Ainda não existe <b class="text-danger">Fabricantes</b> cadastrados no sistema.');
            }
            return view('admin.manufacturer.index', compact('title', 'manufacturers'));
        } catch (QueryException $e) {
            // Log de erro
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
    public function store(Request $request)
    {
        try {
            $manufacturer = new Manufacturer;
            $manufacturer->fill($request->all());
            $manufacturer->slug = Str::of($request->name)->slug('-');

            // Upload da imagem

            $manufacturer->save();
            // Log (Info! Usuário (nome) criou um novo fabricante com nome ($request->name))
            return response()->json([
                'trigger' => alert(
                    'Fabricante <b>"' . $request->name . '"</b> cadastrado com sucesso!',
                    2000,
                    route('admin.manufacturer.index')
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
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $manufacturer = Manufacturer::find($id);
            $manufacturer->fill($request->all());
            $manufacturer->slug = Str::of($request->name)->slug('-');

            // Upload da imagem

            $manufacturer->save();
            // Log (Info! Usuário (nome) alterou o fabricante ($manufacturer->name))
            return response()->json([
                'trigger' => alert(
                    'Fabricante <b>"' . $request->name . '"</b> atualizado com sucesso!',
                    2000,
                    route('admin.manufacturer.index')
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
    public function destroy(string $id)
    {
        try {
            $manufacturer = Manufacturer::find($id);
            if (!$manufacturer->products->isEmpty()) {
                // Log (Atencão! Usuário (nome) tentou exluir um fabricante com produto(s) vinculado(s))
                return response()->json([
                    'trigger' => [
                        alert(
                            'Não é possivel excluir fabricantes vinculados à produtos cadastrados!',
                            false,
                            false,
                            'warning'
                        )
                    ],
                ]);
            }
            $manufacturer->delete();
            // Log (Info! Usuário (nome) excluiu o fabricante ($manufacturer->name))
            return response()->json([
                'result' =>  true,
            ]);
        } catch (QueryException $e) {
            // Log (Erro! $e->getMessage())
            return response()->json(['trigger' => db_error($e->getMessage())]);
        }
    }
}
