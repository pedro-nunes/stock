@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dash') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Usuários</li>
            </ol>
        </nav>
    </div>
</div>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mx-lg-2 mb-0 text-gray-800">Usuários</h1>
</div>
<div class="row mx-lg-2 mb-4">
    <div class="col-12 bg-white">
        <div class="text-left my-3">
            <a class="btn btn-sm btn-primary btn-icon-split" href="{{ route('admin.user.create') }}">
                <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
                <span class="text">Cadastrar usuário</span>
            </a>
        </div>
    </div>
    <div class="mt-3">
        @include('layouts.flash-message')
    </div>
    <div class="col-12 bg-white">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 gutters-sm">
            <div class="col mb-3">
                <div class="card" style="min-width: 250px">
                    <img src="https://via.placeholder.com/340x120/FFB6C1/000000" alt="Pedro" class="card-img-top">
                    <div class="card-body text-center">
                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" style="width:100px;margin-top:-65px"
                            alt="Pedro" class="img-fluid img-thumbnail rounded-circle border-0 mb-3">
                        <h5 class="card-title">Pedro</h5>
                        <p class="text-secondary mb-1">pedro@multiverso.com</p>
                    </div>
                    <div class="card-footer text-center">
                        <a class="btn btn-primary btn-sm btn-icon-split"
                            href="{{ route('admin.user.edit', 1) }}">
                            <span class="icon text-white-50"><i class="fas fa-edit"></i></span>
                            <span class="text">Editar</span>
                        </a>
                        <a class="delete-user btn btn-sm btn-danger btn-icon-split" href="#" title="Excluir usuário"
                            data-toggle="modal" data-target="#modal-delete" data-subtitle="o usuário"
                            data-url="#" data-modal-item-name="Pedro">
                            <span class="icon text-white-50"><i class="fas fa-trash"></i></span>
                            <span class="text">Excluir</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.modal-delete')

@endsection
@push('script')
<script type="text/javascript">
    $(document).ready(function() {
        /**
         * Deletar item
         */
        $('a.delete-user').on('click', function(e) {
            if ($('.alert').length > 0) {
                $('.alert').remove();
                $('.btn-load').removeAttr('disabled');
            }
            $('b.modal-item-name').text($(this).data('modal-item-name'));
            $('button').data('url', $(this).data('url'));
            $('span.subtitle').text($(this).data('subtitle'));
        });
    });
</script>
@endpush
