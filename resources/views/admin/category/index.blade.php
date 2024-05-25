@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dash') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Categorias</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">&nbsp; Categorias</h1>
    </div>
    <div class="row mx-lg-2 mb-4">
        <div class="col-lg-12 bg-white">
            <div class="input-group mb-3">
                <div class="input-group my-3">
                    <div class="input-group-append">
                        <a class="create-category btn btn-sm btn-primary btn-icon-split" data-toggle="modal"
                            data-target="#edit-category" data-url="{{ route('admin.category.store') }}">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Nova categoria</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="table-responsive-sm">
                <table class="table w-100">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col" class="text-center">Quantidade de produtos</th>
                        <th scope="col">Data do cadastro</th>
                        <th scope="col" class="text-center">Ação</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                        <tr>
                            <th scope="row">{{ $category->id }}</th>
                            <td>{{ $category->name }}</td>
                            <td class="text-center">
                                <a class="link" href="#">
                                    {{ $category->products->count()}}
                                </a>
                            </td>
                            <td>{{ $category->created_at }}</td>
                            <td class="text-center">
                                <a class="update-category btn btn-sm btn-primary" href="#" title="Editar dados"
                                    data-toggle="modal" data-target="#edit-category" data-name="{{ $category->name }}"
                                    data-url="{{ route('admin.category.update', $category->id) }}">
                                    <i class="fas fa-edit fa-fw"></i>
                                </a>
                                <a class="delete-category btn btn-sm btn-danger" href="#" title="Excluir categoria"
                                    data-toggle="modal" data-target="#modal-delete" data-subtitle="a categoria"
                                    data-url="{{ route('admin.category.destroy', $category->id) }}" data-modal-item-name="{{ $category->name }}">
                                    <i class="fas fa-trash-alt fa-fw"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-left">
                                @include('layouts.flash-message')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--Modal create/edit-->
    @include('admin.category.edit')
    @include('layouts.modal-delete')

@endsection
@push('script')
<script type="text/javascript">
    $(document).ready(function() {
        /**
         * Deletar item
         */
        $('a.delete-category').on('click', function(e) {
            if ($('.alert').length > 0) {
                $('.alert').remove();
                $('.btn-load').removeAttr('disabled');
            }
            $('b.modal-item-name').text($(this).data('modal-item-name'));
            $('button').data('url', $(this).data('url'));
            $('span.subtitle').text($(this).data('subtitle'));
        });
        /**
         * Cadastrar categoria
         */
        $('a.create-category').on('click', function(e) {
            if ($('.alert').length > 0) {
                $('.alert').remove();
                $('.btn-load').removeAttr('disabled');
            }
            $('#edit-category .modal-header').removeClass('bg-info').addClass('bg-primary');
            $('#edit-category .modal-title b').text('Cadastrar nova categoria!');
            $('#edit-category form.form-modal').attr('action', $(this).data('url'));
            $('#edit-category form.form-modal input#_method').val('POST')
            $('#edit-category form.form-modal input#name').val('');
        });
        /**
         * Atualizar categoria
         */
        $('a.update-category').on('click', function(e) {
            if ($('.alert').length > 0) {
                $('.alert').remove();
                $('.btn-load').removeAttr('disabled');
            }
            $('#edit-category .modal-header').removeClass('bd-primary').addClass('bg-info');
            $('#edit-category .modal-title b').text('Editando a categoria!');
            $('#edit-category form.form-modal').attr('action', $(this).data('url'));
            $('#edit-category form.form-modal input#_method').val('PUT')
            $('#edit-category form.form-modal input#name').val($(this).data('name'));
        });
    });
</script>
@endpush
