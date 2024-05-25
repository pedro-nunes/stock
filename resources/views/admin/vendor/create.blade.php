@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dash') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.vendor.index') }}">Fornecedores</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        @isset($vendor)
                        Editar fornecedor
                        @else
                        Cadastrar fornecedor
                        @endisset
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mx-lg-2 mb-0 text-gray-800">
            @isset($vendor)
            Editar fornecedor: {{ $vendor->name }}
            @else
            Cadastrar fornecedor
            @endisset
        </h1>
    </div>
    <div class="row mx-lg-2 mb-4">
        <div class="col-lg-12 bg-white">
            <form class="send-ajax form-horizontal my-4" id="send-ajax" enctype="multipart/form-data"
                action="{{ isset($vendor) ? route('admin.vendor.update', $vendor->id) : route('admin.vendor.store') }}"
                method="post" autocomplete="off">
                @isset($vendor) @method('PUT') @endisset
                <div class="ajax-alert"></div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="form-group">
                            <label for="name">Nome fantasia: <i class="text-danger">*</i></label>
                            <input type="text" class="form-control" name="name" id="name"
                                value="{{ $vendor->name ?? ''  }}" required>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="form-group">
                            <label for="company_name">Razão social: <i class="text-danger">*</i></label>
                            <input type="text" class="form-control" name="company_name" id="company_name"
                                value="{{ $vendor->company_name ?? '' }}" required>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="document">CPF ou CNPJ: <i class="text-danger">*</i></label>
                            <input type="tel" class="form-control" name="document" id="document"
                                data-inputmask="'mask':['999.999.999-99', '99.999.999/9999-99']"
                                value="{{ $vendor->document ?? '' }}" required>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="reg_state">Inscrição estadual:</label>
                            <input type="tel" class="form-control" name="reg_state" id="reg_state"
                                value="{{ $vendor->reg_state ?? '' }}">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="reg_municipal">Inscrição municial:</label>
                            <input type="tel" class="form-control" name="reg_municipal" id="reg_municipal"
                                value="{{ $vendor->reg_municipal ?? '' }}">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="responsible">Responsável: <i class="text-danger">*</i></label>
                            <input type="text" class="form-control" name="responsible" id="responsible"
                                value="{{ $vendor->responsible ?? '' }}">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="phone">Telefone: <i class="text-danger">*</i></label>
                            <input type="tel" class="form-control" name="phone" id="phone"
                                data-inputmask="'mask':'99 9999-9999[9]'" value="{{ $vendor->phone ?? '' }}"
                                required>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-12 col-lg-4">
                        <div class="form-group">
                            <label for="email">E-mail: <i class="text-danger">*</i></label>
                            <input type="email" class="form-control" name="email" id="email"
                                value="{{ $vendor->email ?? '' }}" required>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <div class="form-group">
                            <label for="zip">CEP: <i class="text-danger">*</i></label>
                            <input type="tel" class="form-control" name="zip" id="zip" data-inputmask="'mask':'99999-999'"
                                value="{{ $vendor->zip ?? '' }}" required>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-8 col-lg-6">
                        <div class="form-group">
                            <label for="address">Rua: <i class="text-danger">*</i></label>
                            <input type="text" class="form-control" name="address" id="address"
                                value="{{ $vendor->address ?? '' }}" required>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-2">
                        <div class="form-group">
                            <label for="number">Número: <i class="text-danger">*</i></label>
                            <input type="text" class="form-control" name="number" id="number"
                                value="{{ $vendor->number ?? '' }}" required>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-2 col-xl-3">
                        <div class="form-group">
                            <label for="complement">Complemento: </label>
                            <input type="text" class="form-control" name="complement" id="complement"
                                value="{{ $vendor->complement ?? '' }}">
                        </div>
                    </div>
                    <div class="col-12 col-sm- col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label for="district">Bairro: <i class="text-danger">*</i></label>
                            <input type="text" class="form-control" name="district" id="district"
                                value="{{ $vendor->district ?? '' }}" required>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
                        <div class="form-group">
                            <label for="city">Cidade: <i class="text-danger">*</i></label>
                            <input type="text" class="form-control" name="city" id="city"
                                value="{{ $vendor->city ?? '' }}" required>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-2">
                        <div class="form-group">
                            <label for="state">Estado <small>(Ex: SP)</small>: <i class="text-danger">*</i></label>
                            <input type="text" class="form-control" name="state" id="state" maxlength="2"
                                data-inputmask="'mask':'AA'" value="{{ $vendor->state ?? '' }}" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="observation">Observações:</label>
                            <textarea class="form-control" rows="3" name="observation" id="observation">
                                {{ $vendor->observation ?? ''}}
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center">
                    <div class="icon-load"></div>
                    <button type="submit" class="btn btn-success btn-icon-split btn-load">
                        <span class="icon text-white-50"><i class="fas fa-save fa-fw"></i></span>
                        <span class="text">Salvar</span>
                    </button>
                    <a class="btn btn-light btn-icon-split" href="{{ route('admin.vendor.index') }}">
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
