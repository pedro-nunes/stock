<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de gerenciamento e controle de estoque">
    <meta name="author" content="Pedro Nunes">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title>{{ $title ?? '' }} - Multiverso</title>
    <link href="{{ asset('vendor/bootstrap-4.6.2-dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('vendor/footable/footable.core.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
</head>
<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dash') }}">
                <div class="sidebar-brand-text mx-3">
                    <img src="{{ asset('img/logo-multiverso.png') }}" title="Multiverso" alt="Multiverso" class="w-100">
                </div>
            </a>
            <li class="nav-item {!! nav_active('admin.dash') !!}">
                <a class="nav-link" href="{{ route('admin.dash') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Estoque
            </div>
            <li class="nav-item {!! nav_active('admin.product.*') !!}">
                <a class="nav-link" href="{{ route('admin.product.index') }}">
                    <i class="fas fa-fw fa-barcode"></i>
                    <span>Produtos</span></a>
            </li>
            <li class="nav-item {!! nav_active('admin.category.*') !!}">
                <a class="nav-link" href="{{ route('admin.category.index') }}">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Categorias</span></a>
            </li>
            <li class="nav-item {!! nav_active('admin.manufacturer.*') !!}">
                <a class="nav-link" href="{{ route('admin.manufacturer.index') }}">
                    <i class="fas fa-fw fa-tags"></i>
                    <span>Fabricantes</span></a>
            </li>
            <li class="nav-item {!! nav_active('admin.vendor.*') !!}">
                <a class="nav-link" href="{{ route('admin.vendor.index') }}">
                    <i class="fas fa-fw fa-dolly"></i>
                    <span>Fornecedores</span></a>
            </li>
            <li class="nav-item {!! nav_active('admin.stock.*') !!}">
                <a class="nav-link" href="{{ route('admin.stock.index') }}">
                    <i class="fas fa-fw fa-layer-group"></i>
                    <span>Estoque</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-list-ol"></i>
                    <span>Lista de compras</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Vendas
            </div>
            <li class="nav-item {!! nav_active('admin.customer.*') !!}">
                <a class="nav-link" href="{{ route('admin.customer.index') }}">
                    <i class="fas fa-fw fa-user-tag"></i>
                    <span>Clientes</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.order.index') }}">
                    <i class="fas fa-fw fa-receipt"></i>
                    <span>Pedidos</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Sistema
            </div>
            <li class="nav-item {!! nav_active('admin.user.*') !!}">
                <a class="nav-link" href="{{ route('admin.user.index') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Usuários</span></a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!--Only MD-->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" name="search-general" id="search-general"
                                placeholder="Procurar por..." aria-label="Pesquisar" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            name="search-general" id="search-general" placeholder="Procurar por..."
                                            aria-label="Pesquisar" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alertas
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Exibir todos</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Pedro Nunes</span>
                                <img class="img-profile rounded-circle"  src="{{ asset('img/undraw_profile.svg') }}">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Configurações
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Log de atividades
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Sair
                                </a>
                            </div>
                        </li>
                    </ul>

                </nav>
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Projeto Integrador - Eixo de Computação | UNIVESP - {{ date('Y') }}</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!--Modal logout-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Deseja sair do sistema?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Você clicou no botão de Logout e está prestes a sair do sistema, deseja continuar?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.login') }}">Sair</a>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-4.6.2-dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.js') }}"></script>
    <script src="{{ asset('vendor/footable/footable.all.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.footable').footable({
                calculateWidthOverride: function() {
                    return {
                        width: $(window).width()
                    };
                }
            });
            $('.footable .pagination li').addClass('page-item');
            $('.footable .pagination li a').addClass('page-link');
        });
    </script>
    @stack('script')
</body>
</html>
