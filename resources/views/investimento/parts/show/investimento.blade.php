@php
    use App\Helpers\FormataMoeda;
    use App\Helpers\FormataData;
@endphp

<div class="col-12" x-data="investimento">
    {{-- informação sobre o investimento --}}
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-auto">
                    <span class="avatar avatar-xl"
                        style="
                            background-image: url({{ $investimento->contaBancaria->banco->image }});">
                    </span>
                </div>
                <div class="col">
                    <div class="card-title fs-1">
                        R$: {{ FormataMoeda::formataMoeda($investimento->valor_bruto) }}
                    </div>
                    <div class="card-subtitle mt-1 fs-3">
                        {{ $investimento->nome }}
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-6 col-sm-3">
                    <div class="datagrid-title">
                        Banco
                    </div>
                    <div class="datagrid-content">
                        {{ $investimento->contaBancaria->banco->nome }}
                    </div>
                </div>

                <div class="col-6 col-sm-3">
                    <div class="datagrid-title">
                        Tipo de investimento
                    </div>
                    <div class="datagrid-content text-uppercase">
                        {{ $investimento->tipo_investimento }}
                    </div>
                </div>

                <div class="col-6 col-sm-3">
                    <div class="datagrid-title">
                        Objetivo
                    </div>
                    <div class="datagrid-content">
                        {{ $investimento->nome }}
                    </div>
                </div>
                <div class="col-6 col-sm-3">
                    <div class="datagrid-title">
                        Data de inicio
                    </div>
                    <div class="datagrid-content">
                        {{ FormataData::diaMesAno($investimento->created_at) }}
                    </div>
                </div>
            </div>
            <div class="row g-3 mt-3">
                <div class="col-6 col-sm-3">
                    <div class="datagrid-title">
                        Valor bruto
                    </div>
                    <div class="datagrid-content">
                        <strong>
                            R$: {{ FormataMoeda::formataMoeda($investimento->valor_bruto) }}
                        </strong>
                    </div>
                </div>
                <div class="col-6 col-sm-3">
                    <div class="datagrid-title">
                        Valor líquido
                    </div>
                    <div class="datagrid-content">
                        <strong class="text-success">
                            R$: {{ FormataMoeda::formataMoeda($investimento->valor_liquido) }}
                        </strong>
                    </div>
                </div>
                <div class="col-6 col-sm-3">
                    <div class="datagrid-title">
                        Ganhos/Perdas
                    </div>
                    <div class="datagrid-content">
                        <strong class="text-success">
                            R$: {{ FormataMoeda::formataMoeda($investimento->ganho_perda) }}
                        </strong>
                    </div>
                </div>
                <div class="col-6 col-sm-3">
                    <div class="datagrid-title">
                        IR/IOF
                    </div>
                    <div class="datagrid-content text-danger">
                        <strong>
                            R$: -{{ FormataMoeda::formataMoeda($investimento->ir_iof) }}
                        </strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button class="btn btn-primary" x-on:click='openModal()'>
                Guardar
            </button>
            <a href="{{ route('investimentoCdb.indexAddRendimentoCdb', $investimento->id) }}" class="btn btn-outline-primary">
                Add rendimento</a>
            <button class="btn btn-warning">Resgastar</button>
        </div>
    </div>

    <x-modal.form title="Acrescenta investimento" button='Guardar'
        action="{{ route('investimentoCbd.guarda', $investimento->id) }}" submit="guarda({{ $investimento->id }})">
        <x-slot:form>
            <div>
                <label for="guarda_valor" class="form-label required">Quanto quer guarda?</label>
                <input type="text" class="form-control" name="guarda_valor" id="guarda_valor" x-model='guarda.valor'>

                <template x-if='errors.guarda_valor'>
                    <span class="text-danger">
                        Campo obrigatório
                    </span>
                </template>
            </div>
        </x-slot:form>
    </x-modal.form>
</div>
