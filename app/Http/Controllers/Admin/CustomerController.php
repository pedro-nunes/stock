<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Database\QueryException;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   try {
            $title = 'Clientes';
            $customers = Customer::orderBy('id', 'DESC')->get();
            if($customers->isEmpty()) {
                session()->flash('info', 'Ainda não existe <b class="text-danger">Clientes</b> cadastrados no sistema');
            }
            return view('admin.customer.index', compact('title', 'customers'));
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
        $title = 'Cadastrar clientes';
        return view('admin.customer.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {
        try {
            $customer = new Customer;
            $customer->fill($request->all());
            $customer->save();
            return response()->json([
                'trigger' => alert(
                    'Cliente <b class="text-danger">"' . $request->first_name . ' ' . $request->last_name .'"</b> cadastrado com sucesso!',
                    2000,
                    route('admin.customer.index')
                ),
            ]);
        } catch (QueryException $e) {
            dd($e->getMessage());
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
        try {
            $title = 'Editar cliente';
            $customer = Customer::find($id);
            if(is_null($customer)) {
                return redirect()->route('admin.customer.index')->with('warning', 'Você tentou acessar um item inexistente!');
            }
            return view('admin.customer.create', compact('title', 'customer'));
        } catch (QueryException $e) {
            // Log de erro
            return abort(500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, string $id)
    {
        try {
            $customer = Customer::find($id);
            $customer->fill($request->all());
            $customer->save();
            return response()->json([
                'trigger' => alert(
                    'Cliente <b class="text-danger">"' . $request->first_name . ' ' . $request->last_name .'"</b> atualizado com sucesso!',
                    2000,
                    route('admin.customer.index')
                ),
            ]);
        } catch (QueryException $e) {
            return abort(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $customer = Customer::find($id);
            /**if (!$customer->products->isEmpty()) {
                // Log (Atencão! Usuário (nome) tentou exluir um cliente com pedido(s) vinculado(s))
                return response()->json([
                    'trigger' => [
                        alert(
                            'Não é possivel excluir clientes vinculados à pedidos cadastrados!',
                            false,
                            false,
                            'warning'
                        )
                    ],
                ]);
            }*/
            $customer->delete();
            // Log (Info! Usuário (nome) excluiu o cliente ($customer->first_name))
            return response()->json([
                'result' =>  true,
            ]);
        } catch (QueryException $e) {
            // Log (Erro! $e->getMessage())
            return response()->json(['trigger' => db_error($e->getMessage())]);
        }
    }
}
