@php
    use App\Helpers\FormataMoeda;
@endphp
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <x-card.title title="Extrato" />
        </div>
        <div class="card-body">
            <div class="fs-2 mb-3 text-center">
                <strong>Outubro</strong>
            </div>
            <div>
                @foreach ($investimentoExtrato as $investimentoExtrato)
                    <div class="hr-text text-start">
                        27/05/2025
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
</div>
