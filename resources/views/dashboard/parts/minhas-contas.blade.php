@php
    use App\Helpers\FormataMoeda;
@endphp
<div class="col-sm-12 col-md-6">
    <div class="card">

        <div class="card-header position-relative">
            <div class="bg-success position-absolute rounded-pill" style="height: 60px; width: 5px"></div>
            <div class="ms-3">
                <p class="h3 m-0 text-secondary">
                    Receita de Julho
                </p>
                <p class="h2 text-secondary m-0">
                    R$: {{ $totalSaldo }}
                    <strong class="text-black">
                    </strong>
                </p>
            </div>
        </div>

        <div class="card-body">
            <x-card.title title="Minhas contas: {{ count($totalBanco) }}" manage="Ver todos" route="{{ route('conta-bancaria.index') }}" />
            @foreach ($bancoUsuario as $banco)
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="avatar rounded-circle" style="background-image: url({{ $banco->banco->image }})">
                        </span>
                    </div>
                    <div class="col">
                        <strong>
                            {{ $banco->nome }}
                        </strong>
                    </div>
                    <div class="col text-end">
                        <span class="text-primary">
                            <strong>
                                R$ {{ FormataMoeda::formataMoeda($banco->saldo) }}
                            </strong>
                        </span>
                    </div>
                </div>

                @if (!$loop->last)
                    <hr class="my-3">
                @endif
            @endforeach

        </div>
    </div>
</div>
