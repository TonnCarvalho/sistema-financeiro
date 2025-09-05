<div class="card-title d-flex justify-content-between w-100">
    <div>
        <h2> {{ $title }} </h2>
    </div>
    {{-- botao usado para ir a rota --}}
    @if (!empty($manage))
        <div>
            <a href="{{ $route }}" class="btn btn-ghost-primary">
                {{ $manage }}
            </a>
        </div>
    @endif

    {{-- botao usado em modal --}}
    @if (!empty($buttonText))
        <div>
            <button type="button" class="btn btn-ghost-primary" x-on:click="$dispatch('open-form-modal')">
                {{ $buttonText }}
            </button>
        </div>
    @endif
</div>
