<div class="card-title d-flex justify-content-between w-100">
    <div>
        <h2> {{ $title }} </h2>
    </div>

    @if (!empty($buttonText))
        <div>
            {{-- <button type="button" class="btn btn-ghost-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
               {{ $buttonText }}
            </button> --}}
            <button type="button" class="btn btn-ghost-primary" x-on:click="$dispatch('open-form-modal')">
                {{ $buttonText }}
            </button>
        </div>
    @endif

</div>
