@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dash') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Fabricantes</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">&nbsp; Fabricantes</h1>
    </div>
    <div class="row mx-lg-2 mb-4">
        <div class="col-lg-12 bg-white">
            <div class="input-group mb-3">
                <div class="input-group my-3">
                    <div class="input-group-append">
                        <a class="create-manufacturer btn btn-sm btn-primary btn-icon-split" data-toggle="modal"
                            data-target="#edit-manufacturer" data-url="{{ route('admin.manufacturer.store') }}">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Novo fabricante</span>
                        </a>
                    </div>
                </div>
            </div>
            <table class="table">
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
                    @forelse($manufacturers as $m)
                    <tr>
                        <th scope="row">{{ $m->id }}</th>
                        <td>{{ $m->name }}</td>
                        <td class="text-center">
                            <a class="link" href="#">
                                {{ $m->products->count()}}
                            </a>
                        </td>
                        <td>{{ $m->created_at }}</td>
                        <td class="text-center">
                            <a class="update-manufacturer btn btn-sm btn-primary" href="#" title="Editar dados"
                                data-toggle="modal" data-target="#edit-manufacturer" data-name="{{ $m->name }}"
                                data-url="{{ route('admin.manufacturer.update', $m->id) }}">
                                <i class="fas fa-edit fa-fw"></i>
                            </a>
                            <a class="delete-manufacturer btn btn-sm btn-danger" href="#" title="Excluir fabricante"
                                data-toggle="modal" data-target="#modal-delete" data-subtitle="o fabricante"
                                data-url="{{ route('admin.manufacturer.destroy', $m->id) }}" data-modal-item-name="{{ $m->name }}">
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
    <!--Modal create/edit-->
    @include('admin.manufacturer.edit')
    @include('layouts.modal-delete')

@endsection
@push('script')
<script type="text/javascript">
    $(document).ready(function() {
        /**
         * Deletar item
         */
        $('a.delete-manufacturer').on('click', function(e) {
            if ($('.alert').length > 0) {
                $('.alert').remove();
                $('.btn-load').removeAttr('disabled');
            }
            $('b.modal-item-name').text($(this).data('modal-item-name'));
            $('button').data('url', $(this).data('url'));
            $('span.subtitle').text($(this).data('subtitle'));
        });
        /**
         * Cadastrar fabricante
         */
        $('a.create-manufacturer').on('click', function(e) {
            if ($('.alert').length > 0) {
                $('.alert').remove();
                $('.btn-load').removeAttr('disabled');
            }
            $('#edit-manufacturer .modal-header').removeClass('bg-info').addClass('bg-primary');
            $('#edit-manufacturer .modal-title b').text('Cadastrar novo fabricante!');
            $('#edit-manufacturer form.form-modal').attr('action', $(this).data('url'));
            $('#edit-manufacturer form.form-modal input#_method').val('POST')
            $('#edit-manufacturer form.form-modal input#name').val('');
        });
        /**
         * Atualizar fabricante
         */
        $('a.update-manufacturer').on('click', function(e) {
            if ($('.alert').length > 0) {
                $('.alert').remove();
                $('.btn-load').removeAttr('disabled');
            }
            $('#edit-manufacturer .modal-header').removeClass('bd-primary').addClass('bg-info');
            $('#edit-manufacturer .modal-title b').text('Editando o fabricante!');
            $('#edit-manufacturer form.form-modal').attr('action', $(this).data('url'));
            $('#edit-manufacturer form.form-modal input#_method').val('PUT')
            $('#edit-manufacturer form.form-modal input#name').val($(this).data('name'));
        });
    });
</script>
@endpush
