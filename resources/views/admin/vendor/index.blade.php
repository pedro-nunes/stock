@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dash')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Fronecedores</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mx-lg-2 mb-0 text-gray-800">Fornecedores</h1>
    </div>
    <div class="row mx-lg-2 mb-4">
        <div class="col-lg-12 bg-white">
            <div class="text-left my-3">
                <a class="btn btn-sm btn-primary btn-icon-split" href="{{ route('admin.vendor.create') }}">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Cadastrar fornecedor</span>
                </a>
            </div>
            <div class="mt-3">
                @include('layouts.flash-message')
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nome/Razão social</th>
                            <th>CPF/CNPJ</th>
                            <th>Responsável</th>
                            <th>Telefone</th>
                            <th class="text-center">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vendors as $v)
                        <tr>
                            <td>{{ $v->name }}</td>
                            <td>{{ $v->document }}</td>
                            <td>{{ $v->responsible }}</td>
                            <td>{{ $v->phone }}</td>
                            <td class="text-center">
                                <a class="btn btn-sm btn-primary" href="{{ route('admin.vendor.edit', $v->id) }}"
                                    title="Editar dados">
                                    <i class="fas fa-user-edit fa-fw"></i>
                                </a>
                                <a class="delete-vendor btn btn-sm btn-danger" href="#" title="Excluir fornecedor"
                                    data-toggle="modal" data-target="#modal-delete" data-subtitle="o fornecedor"
                                    data-url="{{ route('admin.vendor.destroy', $v->id) }}" data-modal-item-name="{{ $v->name }}">
                                    <i class="fas fa-trash-alt fa-fw"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
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
        $('a.delete-vendor').on('click', function(e) {
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
