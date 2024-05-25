@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dash') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.customer.index') }}">Clientes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        @isset($customer)
                        Editar cliente
                        @else
                        Cadastrar cliente
                        @endisset
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mx-lg-2 mb-0 text-gray-800">
            @isset($customer)
            Editar cliente: {{ $customer->first_name . ' ' . $customer->last_name }}
            @else
            Cadastrar cliente
            @endisset
        </h1>
    </div>
    <div class="row mx-lg-2 mb-4">
        <div class="col-lg-12 bg-white">
            <form class="send-ajax form-horizontal my-4" id="send-ajax" enctype="multipart/form-data"
                action="{{ isset($customer) ? route('admin.customer.update', $customer->id) : route('admin.customer.store') }}"
                method="post" autocomplete="off">
                @isset($customer) @method('PUT') @endisset
                <div class="ajax-alert"></div>
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label for="first_name">Nome: <i class="text-danger">*</i></label>
                            <input type="text" class="form-control" name="first_name" id="first_name"
                                value="{{ $customer->first_name ?? '' }}" required>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label for="last_name">Sobrenome: <i class="text-danger">*</i></label>
                            <input type="text" class="form-control" name="last_name" id="last_name"
                            value="{{ $customer->last_name ?? '' }}" required>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="register">RG:</label>
                            <input type="text" class="form-control" name="register" id="register"
                            value="{{ $customer->register ?? '' }}" >
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="document">CPF: <i class="text-danger">*</i></label>
                            <input type="tel" class="form-control" name="document" id="document"
                                data-inputmask="'mask':'999.999.999-99'" value="{{ $customer->document ?? '' }}"
                                required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 col-md-3">
                        <div class="form-group">
                            <label for="whatsapp">Whatsapp: <i class="text-danger">*</i></label>
                            <input type="tel" class="form-control" name="whatsapp" id="whatsapp"
                                data-inputmask="'mask':'99 9999-9999[9]'" value="{{ $customer->whatsapp ?? '' }}">
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-3">
                        <div class="form-group">
                            <label for="phone">Telefone: <i class="text-danger">*</i></label>
                            <input type="tel" class="form-control" name="phone" id="phone"
                                data-inputmask="'mask':'99 9999-9999[9]'" value="{{ $customer->phone ?? '' }}">
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-3">
                        <div class="form-group">
                            <label for="email">E-mail: <i class="text-danger">*</i></label>
                            <input type="email" class="form-control" name="email" id="email"
                                value="{{ $customer->email ?? '' }}" required>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-3">
                        <div class="form-group">
                            <label for="where_find">Como nos conheceu:</label>
                            <input list="where_finds" class="form-control" name="where_find" id="where_find"
                                value="{{ $customer->where_find ?? '' }}">
                            <datalist id="where_finds">
                                <option value="Google">
                                <option value="Facebook">
                                <option value="Instagram">
                                <option value="Indicação">
                            </datalist>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12 col-sm-3">
                        <div class="form-group">
                            <label for="zip">CEP: <i class="text-danger">*</i></label>
                            <input type="tel" class="form-control" name="zip" id="zip"
                                data-inputmask="'mask':'99999-999'" value="{{ $customer->zip ?? '' }}">
                        </div>
                    </div>
                    <div class="col-12 col-sm">
                        <div class="form-group">
                            <label for="address">Rua: <i class="text-danger">*</i></label>
                            <input type="text" class="form-control" name="address" id="address"
                                value="{{ $customer->address ?? '' }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-sm-1 col-md-2">
                        <div class="form-group">
                            <label for="number">Número: <i class="text-danger">*</i></label>
                            <input type="text" class="form-control" name="number" id="number"
                                value="{{ $customer->number ?? '' }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-3">
                        <div class="form-group">
                            <label for="complement">Complemento:</label>
                            <input type="text" class="form-control" name="complement" id="complement"
                                value="{{ $customer->complement ?? '' }}">
                        </div>
                    </div>
                    <div class="col-12 col-sm">
                        <div class="form-group">
                            <label for="district">Bairro: <i class="text-danger">*</i></label>
                            <input type="text" class="form-control" name="district" id="district"
                                value="{{ $customer->district ?? '' }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-sm">
                        <div class="form-group">
                            <label for="city">Cidade: <i class="text-danger">*</i></label>
                            <input type="text" class="form-control" name="city" id="city"
                                value="{{ $customer->city ?? '' }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-sm-1 col-md-2">
                        <div class="form-group">
                            <label for="state">Estado <small>(Ex: SP)</small>: <i class="text-danger">*</i></label>
                            <input type="text" class="form-control" name="state" id="state" maxlength="2"
                                data-inputmask="'mask':'AA'" value="{{ $customer->state ?? '' }}" required>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center">
                    <div class="icon-load"></div>
                    <button type="submit" class="btn btn-success btn-icon-split btn-load">
                        <span class="icon text-white-50"><i class="fas fa-save fa-fw"></i></span>
                        <span class="text">Salvar</span>
                    </button>
                    <a class="btn btn-light btn-icon-split" href="{{ route('admin.customer.index') }}">
                        <span class="icon text-white-50"><i class="fas fa-ban fa-fw"></i></span>
                        <span class="text">Cancelar</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('vendor/inputmask/dist/inputmask.min.js') }}"></script>
    <script src="{{ asset('vendor/inputmask/dist/bindings/inputmask.binding.js') }}"></script>
@endpush

