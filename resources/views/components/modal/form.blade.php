<div x-data="{}" x-on:open-form-modal.window="openModal()">
    <div class="modal fade" id="modal-form">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ $action }}" method="POST" x-on:submit.prevent="send">
                    @csrf
                    <div class="modal-body">
                        {{ $form }}
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success px-5">
                            Adicionar
                        </button>
                        <button type="button" class="btn btn-light ms-auto" data-bs-dismiss="modal"
                            data-bs-target="#modal-form" aria-label="Close">
                            Cancelar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
