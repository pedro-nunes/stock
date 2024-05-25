@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dash') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Produtos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Cadastrar produto
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mx-lg-2 mb-0 text-gray-800">Cadastrar produto</h1>
    </div>
    <div class="row mx-lg-1 mb-4">
        <div class="col-lg-12 bg-white">
            <form class="send-ajax form-horizontal my-4" id="send-ajax" enctype="multipart/form-data"
                action="{{ route('admin.product.store') }}" method="POST" autocomplete="off">
                <div class="ajax-alert"></div>
                <div class="row">
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-6 col-sm-3 col-md-3">
                                <div class="form-group">
                                    <label for="code">Código: <i class="text-danger">*</i></label>
                                    <input type="text" class="form-control" name="code" id="code" required>
                                </div>
                            </div>
                            <div class="col-12 col-sm-9 col-md-9">
                                <div class="form-group">
                                    <label for="name">Nome: <i class="text-danger">*</i></label>
                                    <input type="text" class="form-control" name="name" id="name" required autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="category_id">Categoria: <i class="text-danger">*</i></label>
                                    <select class="form-control" name="category_id" id="category_id" required>
                                        <option value="">Selecione uma categoria</option>
                                        @forelse ($categories as $c)
                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @empty
                                        @endforelse
                                      </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="manufacturer_id">Fabricante:</label>
                                    <select class="form-control" name="manufacturer_id" id="manufacturer_id">
                                        <option value="">Selecione um fabricante</option>
                                        @forelse ($manufacturers as $m)
                                        <option value="{{ $m->id }}">{{ $m->name }}</option>
                                        @empty
                                        @endforelse
                                      </select>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4">
                                <div class="form-group">
                                    <label for="vendor_id">Fornecedor:</label>
                                    <select class="form-control" name="vendor_id" id="vendor_id">
                                        <option value="">Selecione um fornecedor</option>
                                        @forelse ($vendors as $vendor)
                                        <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                        @empty
                                        @endforelse
                                      </select>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="sale_price">Preço de venda: <i class="text-danger">*</i></label>
                                    <input type="text" class="form-control" name="sale_price" id="sale_price" required>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="cost_price">Preço de custo: <i class="text-danger">*</i></label>
                                    <input type="text" class="form-control" name="cost_price" id="cost_price" required>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="min_stock">Estoque mínimo: <i class="text-danger">*</i></label>
                                    <input type="text" class="form-control" name="min_stock" id="min_stock" required>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="variation">Variação do produto: (Ex: Cor: Verde; Tam: 50cm)</label>
                                    <input type="text" class="form-control" name="variation" id="variation">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col border-left">
                        <div class="form-group">
                            <label for="thumbnail">Foto do produto:</label>
                            <input type="file" class="form-control-file load-image" name="thumbnail" id="thumbnail"
                                    accept="image/*">
                        </div>
                        <div class="text-center thumbnail">
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center">
                    <div class="icon-load"></div>
                    <button type="submit" class="btn btn-success btn-icon-split btn-load">
                        <span class="icon text-white-50"><i class="fas fa-save fa-fw"></i></span>
                        <span class="text">Salvar</span>
                    </button>
                    <a class="btn btn-light btn-icon-split" href="{{ route('admin.product.index') }}">
                        <span class="icon text-white-50"><i class="fas fa-ban fa-fw"></i></span>
                        <span class="text">Cancelar</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
