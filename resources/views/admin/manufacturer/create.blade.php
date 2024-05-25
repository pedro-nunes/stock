@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dash') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.manufacturer.index') }}">Fabricantes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        @if($manufacturer && !is_null($manufacturer->name))
                            Editar: {{ $manufacturer->name }}
                        @else
                            Cadastrar fabricante
                        @endisset
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">&nbsp;
            @if($manufacturer && !is_null($manufacturer->name))
                Editar: {{ $manufacturer->name }}
            @else
                Cadastrar fabricante
            @endisset
        </h1>
    </div>
    <div class="row mx-lg-2 mb-4">
        <div class="col-lg-12 bg-white">
            <form class="send-ajax form-horizontal my-4" id="send-ajax" enctype="multipart/form-data"
                action="{{ route('admin.manufacturer.store') }}" method="post" autocomplete="off">
                <!--Se erro por ajax, recebe o erro-->
                <div class="ajax-alert"></div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="name">Fabricante: <i class="text-danger">*</i></label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $manufacturer->name) }}" required>
                        </div>
                    </div>
                    <hr>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="icon">Icone:</label>
                            <input type="file" class="form-control-file" name="icon" id="icon" value="{{ old('icon', $manufacturer->icon) }}">
                        </div>
                    </div>
                    <hr>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="slug">URL Amigável: (ex: nome-do-fabricante)</label>
                            <input type="tel" class="form-control" name="slug" id="slug" value="{{ old('name', $manufacturer->slug) }}">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-12 text-center">
                    <div class="icon-load"></div>
                    <button type="submit" class="btn btn-success btn-icon-split btn-load">
                        <span class="icon text-white-50"><i class="fas fa-save fa-fw"></i></span>
                        <span class="text">Salvar</span>
                    </button>
                    <a class="btn btn-light btn-icon-split" href="{{ route('admin.manufacturer.index') }}">
                        <span class="icon text-white-50"><i class="fas fa-ban fa-fw"></i></span>
                        <span class="text">Cancelar</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
