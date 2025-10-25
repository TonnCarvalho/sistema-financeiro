@php
    use App\Helpers\FormataMoeda;
@endphp
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
                {{ FormataMoeda::formataMoeda($extratoDiario->ir_iof_diario) }}
            </div>
        </div>
    </div>
</div>
