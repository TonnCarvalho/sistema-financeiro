@php
    use App\Helpers\FormataMoeda;
@endphp
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
