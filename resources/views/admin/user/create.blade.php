
@extends('layouts.admin')
@section('content')
    <form class="send-ajax" id="send-ajax" method="post" enctype="multipart/form-data" autocomplete="off"
        action="">
        @method('PUT')
        <div class="row mx-lg-2 mb-4 py-4 bg-white">
            <div class="col-lg-12">
                <div class="ajax-alert"></div>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <label for="name">Nome: <i class="text-danger">*</i></label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="register">RG:</label>
                            <input type="text" class="form-control" name="register" id="register">
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="document">CPF: <i class="text-danger">*</i></label>
                            <input type="tel" class="form-control" name="document" id="document"
                                data-inputmask="'mask':'999.999.999-99'" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 col-md-3">
                        <div class="form-group">
                            <label for="phone">Telefone: <i class="text-danger">*</i></label>
                            <input type="tel" class="form-control" name="phone" id="phone"
                                data-inputmask="'mask':'99 9999-9999[9]'" required>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-6">
                        <div class="form-group">
                            <label for="email">E-mail: <i class="text-danger">*</i></label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12 col-sm-3">
                        <div class="form-group">
                            <label for="zip">CEP:</label>
                            <input type="tel" class="form-control" name="zip" id="zip"
                                data-inputmask="'mask':'99999-999'">
                        </div>
                    </div>
                    <div class="col-12 col-sm">
                        <div class="form-group">
                            <label for="address">Rua:</label>
                            <input type="text" class="form-control" name="address" id="address">
                        </div>
                    </div>
                    <div class="col-12 col-sm-1 col-md-2">
                        <div class="form-group">
                            <label for="number">Número:</label>
                            <input type="text" class="form-control" name="number" id="number">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-3">
                        <div class="form-group">
                            <label for="complement">Complemento:</label>
                            <input type="text" class="form-control" name="complement" id="complement">
                        </div>
                    </div>
                    <div class="col-12 col-sm">
                        <div class="form-group">
                            <label for="district">Bairro:</label>
                            <input type="text" class="form-control" name="district" id="district">
                        </div>
                    </div>
                    <div class="col-12 col-sm">
                        <div class="form-group">
                            <label for="city">Cidade:</label>
                            <input type="text" class="form-control" name="city" id="city">
                        </div>
                    </div>
                    <div class="col-12 col-sm-1 col-md-2">
                        <div class="form-group">
                            <label for="state">Estado <small>(Ex: SP)</small>:</label>
                            <input type="text" class="form-control" name="state" id="state" maxlength="2"
                                data-inputmask="'mask':'AA'">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="password">Senha: <i class="text-danger">*</i></label>
                            <input type="password" class="form-control" name="password" id="password"
                                autocomplete="new-password">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="password-confirm">Confirmar senha: <i class="text-danger">*</i></label>
                            <input type="password" class="form-control" name="password_confirmation" id="password-confirm"
                                autocomplete="new-password">
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center">
                    <div class="icon-load"></div>
                    <button type="submit" class="btn btn-success btn-icon-split btn-load">
                        <span class="icon text-white-50"><i class="fas fa-save fa-fw"></i></span>
                        <span class="text">Salvar</span>
                    </button>
                    <a class="btn btn-light btn-icon-split" href="{{ route('admin.user.index') }}">
                        <span class="icon text-white-50"><i class="fas fa-ban fa-fw"></i></span>
                        <span class="text">Cancelar</span>
                    </a>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('script')
    <script src="{{ asset('vendor/inputmask/dist/inputmask.min.js') }}"></script>
    <script src="{{ asset('vendor/inputmask/dist/bindings/inputmask.binding.js') }}"></script>
@endpush
