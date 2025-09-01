<div class="modal " id="confirmaExclusao" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Confirma exclução</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ $action }}" method="POST">
                @csrf
                @method('delete')
                <div class="modal-body">
                    {{ $message }}
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger px-5" data-bs-dismiss="modal">Excluir</button>
                    <button type="button" class="btn btn-light ms-auto" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
