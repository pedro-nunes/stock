@extends('layouts.admin')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
    <div class="row">
        <!--div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Produtos cadastrados
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $products->count() . ($products->count() > 1 ? ' produtos' : ' produto') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Produtos sem saldo
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                0 produto
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Produtos com estoque baixo
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">1 produtos</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pedidos Pendentes
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                2 pedidos
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div-->
    <div class="row">
        <div class="col-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Últimos pedidos</h6>
                </div>
                <div class="card-body table-responsive">
                    <p>Aqui exibe os 10 últimos pedidos de venda</p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nome do cliente</th>
                                <th scope="col">Valor</th>
                                <th scope="col" class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 2; $i >= 1; $i--)
                            <tr>
                                <td>
                                    <a href="#">
                                        1001
                                    </a>
                                </td>
                                <td>Pedro Nunes</td>
                                <td>R$ 599,99</td>
                                <td class="text-center">
                                    <span class="badge badge-secondary">pendente</span>
                                </td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Produtos mais vendidos</h6>
                </div>
                <div class="card-body table-responsive">
                    <p>Aqui exibe os 10 produtos com maior número de vendas</p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col">Nome do produto</th>
                                <th scope="col" class="text-center">Vendas</th>
                                <th scope="col" class="text-center">Estoque</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 1; $i <= 2; $i++)
                            <tr>
                                <th scope="row" class="text-center">{{ $i }}</th>
                                <td>
                                    <a href="#">
                                        Nome do produto teste {{ $i }}
                                    </a>
                                </td>
                                <td class="text-center">{{ 2 }}</td>
                                <td class="text-center">2</td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-danger">Produtos com baixo índice de vendas</h6>
                </div>
                <div class="card-body table-responsive">
                    <p>Aqui exibe os produtos que não tem movimentação de vendas há mais de <b>30 dias</b></p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nome do produto</th>
                                <th scope="col">Preço de venda</th>
                                <th scope="col" class="text-center">Estoque</th>
                                <th scope="col" class="text-center">Ultima venda</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <!--
                                @for ($i = 2; $i >= 1; $i--)
                                <tr>
                                    <td>Nome do produto teste produto teste produto teste {{ $i }}</td>
                                    <td> R$ 599,99</td>
                                    <td class="text-center">5</td>
                                    <td class="text-center">20 de abril de 2024</td>
                                </tr>
                                @endfor
                                -->
                                <td colspan="4">
                                    <div class="alert alert-info text-center" role="alert">
                                        <b>Informação<i class="fas fa-exclamation fa-fw"></i></b> Ainda não existe dados suficientes para serem exibidos aqui!
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
