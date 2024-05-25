<div class="modal fade" id="create-category" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="create-categoryLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="create-category"><b class="text-light">Cadastrar categoria!</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times; </span>
                </button>
            </div>
            <form class="form-modal send-ajax" action="{{ route('admin.category.store') }}" autocomplete="off" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="ajax-alert"></div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name"> Nome da categoria: <i class="text-danger">*</i></label>
                                <input type="text" class="form-control" name="name" id="name" autofocus
                                    required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-around ">
                    <div class="row">
                        <div class="col-12">
                            <div class="icon-load"></div>
                            <button type="submit" class="btn btn-sm btn-success btn-icon-split btn-load">
                                <span class="icon text-white-50"><i class="fas fa-save fa-fw"></i></span>
                                <span class="text">Salvar</span>
                            </button>
                            <button class="btn btn-sm btn-light btn-icon-split" data-dismiss="modal">
                                <span class="icon text-white-50"><i class="fas fa-ban fa-fw"></i></span>
                                <span class="text">Cancelar</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
