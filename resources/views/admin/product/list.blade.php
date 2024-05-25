@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dash') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Estoque</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mx-lg-2 mb-0 text-gray-800">Produtos</h1>
    </div>
    <div class="row mx-lg-2 mb-4">
        <div class="col-lg-12 bg-white">
            <div class="text-left my-3">
                <a class="btn btn-sm btn-primary btn-icon-split" href="{{ route('admin.product.create') }}">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Cadastrar produto</span>
                </a>
            </div>
            <div class="mt-3">
                @include('layouts.flash-message')
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th class="text-left">Código</th>
                            <th>Descrição</th>
                            <th>Preço</th>
                            <th class="text-center">Estoque</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $p)
                        <tr>
                            <td scope="row">
                                @if($p->thumbnail)
                                <img src="{{ asset('img/'. $p->thumbnail) }}" width="40px" height="40px">
                                @endif
                            </td>
                            <td scope="row" class="text-left">&nbsp; {{ $p->code }}</thd>
                            <td>{{ $p->name }}</td>
                            <td>R$ {{ $p->sale_price }}</td>
                            <td class="text-center">{{ $p->stock }}</td>
                            <td class="text-center">
                                @if($p->status == 0)
                                <span class="badge badge-secondary">Inativo</span>
                                @else
                                <span class="badge badge-success">Publicado</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a class="btn btn-sm btn-primary" href="{{ route('admin.product.edit', $p->id) }}" title="Editar dados">
                                    <i class="fas fa-edit fa-fw"></i>
                                </a>
                                <a class="delete-product btn btn-sm btn-danger" href="#" title="Excluir produto"
                                    data-toggle="modal" data-target="#modal-delete" data-subtitle="a categoria"
                                    data-url="{{ route('admin.product.destroy', $p->id) }}" data-modal-item-name="{{ $p->name }}">
                                    <i class="fas fa-trash-alt fa-fw"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-left">
                            </td>
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
        $('a.delete-product').on('click', function(e) {
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
