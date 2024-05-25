<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorRequest;
use App\Models\Vendor;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $title  = 'Fornecedores';
            $vendors = Vendor::orderBy('id', 'DESC')->get();
            if($vendors->isEmpty()) {
                session()->flash('info', 'Ainda não existe <b class="text-danger">Fornecedores</b> cadastrados no sistema');
            }
            return view('admin.vendor.index', compact('title', 'vendors'));
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
        $title = 'Cadastrar fornecedores';
        return view('admin.vendor.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VendorRequest $request)
    {
        try {
            $vendor = new Vendor;
            $vendor->fill($request->all());
            $vendor->save();
            return response()->json([
                'trigger' => alert(
                    'Fornecedor <b class="text-danger">"' . $request->name . '"</b> cadastrado com sucesso!',
                    3000,
                    route('admin.vendor.index')
                ),
            ]);
        } catch(QueryException $e) {
            // Log de erro
            dd($e->getMessage());
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
        try {
            $title = 'Editar fornecedor';
            $vendor = Vendor::find($id);
            if(is_null($vendor)) {
                return redirect()->route('admin.vendor.index')->with('warning', 'Você tentou acessar um item inexistente!');
            }
            return view('admin.vendor.create', compact('title', 'vendor'));
        } catch(QueryException $e) {
            // Log de erro
            return abort(500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VendorRequest $request, string $id)
    {
        try {
            $vendor = Vendor::find($id);
            $vendor->fill($request->all());
            $vendor->save();
            return response()->json([
                'trigger' => alert(
                    'Fornecedor <b class="text-danger">"' . $request->name . '"</b> atualizado com sucesso!',
                    3000,
                    route('admin.vendor.index')
                ),
            ]);
        } catch(QueryException $e) {
            // Log de erro
            return abort(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id = null)
    {
        try {
            $vendor = Vendor::find($id);
            if (!$vendor->products->isEmpty()) {
                // Log (Atencão! Usuário (nome) tentou exluir um fornecedor com produto(s) vinculado(s))
                return response()->json([
                    'trigger' => [
                        alert(
                            'Não é possivel excluir fornecedores vinculados à produtos cadastrados!',
                            false,
                            false,
                            'warning'
                        )
                    ],
                ]);
            }
            $vendor->delete();
            // Log (Info! Usuário (nome) excluiu o fornecedor ($vendor->name))
            return response()->json([
                'result' =>  true,
            ]);
        } catch (QueryException $e) {
            // Log (Erro! $e->getMessage())
            return response()->json(['trigger' => db_error($e->getMessage())]);
        }
    }
}
