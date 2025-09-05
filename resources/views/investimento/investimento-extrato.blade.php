@extends('layout.layout')
@section('page-title', 'Investimento - Extrato')
@section('content')
    @php
        use App\Helpers\FormataMoeda;
        use App\Helpers\FormataData;
        use App\Helpers\FormataCalendario;
        $mesAnterior = null;
    @endphp
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="avatar avatar-xl"
                            style="
                            background-image: url({{ $investimentoDetalhe->contaBancaria->banco->image }});">
                        </span>
                    </div>
                    <div class="col">
                        <div class="card-title fs-1">
                            {{ $investimentoDetalhe->contaBancaria->nome }}
                        </div>
                        <div class="card-subtitle mt-1 fs-3">
                            {{ $investimentoDetalhe->nome }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body card-body-scrollable" style="height: 35rem">
                @foreach ($investimentoExtrato as $investimentoExtrato)
                    @php
                        $mesAtual = FormataCalendario::nomeDoMes($investimentoExtrato->created_at);
                    @endphp
                    <div class="m-3 text-center">
                        @if ($mesAtual !== $mesAnterior)
                            <div class="fs-2 m-3 text-center">
                                <strong>{{ $mesAtual }}</strong>
                            </div>
                            @php
                                $mesAnterior = $mesAtual;
                            @endphp
                        @endif
                    </div>
                    <div>
                        <div class="hr-text hr-text-center">
                            {{ FormataData::relativoDiaMesAno($investimentoExtrato->created_at) }}
                        </div>

                        <div class="row">
                            <div class="col-6 col-md-3 g-2">
                                <div>
                                    <strong>Valor bruto</strong>
                                </div>
                                <div>
                                    {{ FormataMoeda::formataMoeda($investimentoExtrato->valor_bruto) }}
                                </div>
                            </div>
                            <div class="col-6 col-md-3 g-2">
                                <div>
                                    <strong>Valor liquido</strong>
                                </div>
                                <div>
                                    {{ FormataMoeda::formataMoeda($investimentoExtrato->valor_liquido) }}
                                </div>
                            </div>
                            <div class="col-6 col-md-3 g-2">
                                <div>
                                    <strong>Ganhos/Perdas</strong>
                                </div>
                                <div>
                                    {{ FormataMoeda::formataMoeda($investimentoExtrato->ganhos_perdas) }}
                                </div>
                            </div>
                            <div class="col-6 col-md-3 g-2">
                                <div>
                                    <strong>IR/IOF</strong>
                                </div>
                                <div>
                                    - {{ FormataMoeda::formataMoeda($investimentoExtrato->ir_iof) }}
                                </div>
                            </div>
                        </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
