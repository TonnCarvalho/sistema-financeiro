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
            <a href="{{ route('investimentoCdb.AddRendimentoCdb', $investimento->id) }}"
                class="btn btn-outline-primary">
                Add rendimento
            </a>
            <a href="{{ route('investimentoCdb.resgata', $investimento->id) }}" class="btn btn-warning">
                Resgastar
            </a>
        </div>
    </div>

    @include('investimento_cdb.parts.show.form_guarda')

</div>
