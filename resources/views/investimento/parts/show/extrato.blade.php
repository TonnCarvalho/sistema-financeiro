@php
    use App\Helpers\FormataMoeda;
    use App\Helpers\FormataData;
    use App\Helpers\FormataCalendario;
    $mesAnterior = null;
@endphp

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <x-card.title title="Extrato" />
            <div>
                <a href="{{ route('investimento.extrato', $investimento->id) }}" class="btn btn-ghost-primary">
                    Ver todo extrado
                </a>
            </div>
        </div>
        <div class="card-body">
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
                    @if ($investimentoExtrato->movimento == 'entrada')
                        <div class="row alert alert-success">
                            <div class="col-6 col-md-3 g-2">
                                <div>
                                    <strong>Valor aplicado</strong>
                                </div>

                                <div>
                                    {{ FormataMoeda::formataMoeda($investimentoExtrato->valor_aplicado) }}
                                    <br>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($investimentoExtrato->movimento == 'rendimento')
                        @foreach ($investimentoExtrato->investimentoExtratosDiarios as $extratoDiario)
                            <div class="row">
                                <div class="col-6 col-md-3 g-2">
                                    <div>
                                        <strong>Valor bruto</strong>
                                    </div>

                                    <div>
                                        {{ FormataMoeda::formataMoeda($investimentoExtrato->valor_bruto) }}
                                        <br>
                                        <div class="text-success">
                                            +{{ FormataMoeda::formataMoeda($extratoDiario->valor_bruto_diario) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 g-2">
                                    <div>
                                        <strong>Valor liquido</strong>
                                    </div>
                                    <div>
                                        {{ FormataMoeda::formataMoeda($investimentoExtrato->valor_liquido) }}
                                        <div class="text-success">
                                            +{{ FormataMoeda::formataMoeda($extratoDiario->valor_liquido_diario) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 g-2">
                                    <div>
                                        <strong>Ganhos/Perdas</strong>
                                    </div>
                                    <div>
                                        {{ FormataMoeda::formataMoeda($investimentoExtrato->ganho_perda) }}
                                        <div class="text-success">
                                            +{{ FormataMoeda::formataMoeda($extratoDiario->ganho_perda_diario) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 g-2">
                                    <div>
                                        <strong>IR/IOF</strong>
                                    </div>
                                    <div>
                                        - {{ FormataMoeda::formataMoeda($investimentoExtrato->ir_iof) }}
                                        <div class="text-danger">
                                            -{{ FormataMoeda::formataMoeda($extratoDiario->ir_iof_diario) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
            @endforeach
            <div class="text-center mt-3">
                <a href="{{ route('investimento.extrato', $investimento->id) }}" class="btn btn-pill btn-primary">
                    Ver todo o extrado
                </a>
            </div>
        </div>
    </div>
</div>
