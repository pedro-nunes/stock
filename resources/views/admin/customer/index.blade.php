@extends('layouts.admin')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Clientes</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href={{ route('admin.dash') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Clientes</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row mx-lg-2 mb-4">
        <div class="col-lg-12 bg-white">
            <div class="text-left my-3">
                <a class="btn btn-sm btn-primary btn-icon-split" href=" {{ route('admin.customer.create') }}">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Cadastrar cliente</span>
                </a>
            </div>
            <input type="text" class="form-control form-control-sm" id="filter" placeholder="Procurar cliente">
            <div class="mt-3">
                @include('layouts.flash-message')
            </div>
            <table class="footable table toggle-arrow-tiny" data-page-size="30" data-filter="#filter">
                <thead>
                    <tr>
                        <th data-toggle="true">Nome</th>
                        <th data-hide="phone">WhatsApp</th>
                        <th data-hide="phone">Cadastrado</th>
                        <th data-hide="phone">Telefones</th>
                        <th data-hide="all">E-mail</th>
                        <th data-hide="all">Endereço</th>
                        <th data-hide="all">RG</th>
                        <th data-hide="all">CPF</th>
                        <th data-hide="phone">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $c)
                    <tr class="footable-even">
                        <td>{{ $c->first_name . ' ' . $c->last_name }} </td>
                        <td><i class="fab fa-whatsapp fa-fw text-success"></i>{{ $c->whatsapp }}</td>
                        <td>{{ $c->created_at }}</td>
                        <td>{{ $c->phone }}</td>
                        <td>{{ $c->email }}</td>
                        <td>{{ $c->address . ', ' . $c->number . ' - ' . $c->city . '-' . $c->state }}</td>
                        <td>{{ $c->register }}</td>
                        <td>{{ $c->document }}</td>
                        <td class="text-center footable-visible footable-last-column">
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.customer.edit', $c->id) }}"
                                title="Editar dados">
                                <i class="fas fa-user-edit fa-fw"></i>
                            </a>
                            <a class="delete-customer btn btn-sm btn-danger" href="#" title="Excluir cliente"
                                data-toggle="modal" data-target="#modal-delete" data-subtitle="o cliente"
                                data-url="{{ route('admin.customer.destroy', $c->id) }}" data-modal-item-name="{{ $c->first_name }}">
                                <i class="fas fa-trash-alt fa-fw"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>

                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">
                            <ul class="pagination float-right"></ul>
                        </td>
                    </tr>
                </tfoot>
            </table>
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
        $('a.delete-customer').on('click', function(e) {
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
