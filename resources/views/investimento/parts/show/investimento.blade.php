@php
    use App\Helpers\FormataMoeda;
@endphp
<div class="col-12">
    {{-- informação sobre o investimento --}}
    <div class="card">
        <card class="card-header">
            <div class="row align-items-center">
                <div class="col-auto">
                    <span class="avatar avatar-xl"
                        style="
                            background-image: url({{ $investimento->contaBancaria->banco->image }});">
                    </span>
                </div>
                <div class="col">
                    <div class="card-title fs-1">
                        R$: {{ FormataMoeda::formataMoeda($investimento->valor) }}
                    </div>
                    <div class="card-subtitle mt-1 fs-3">
                        {{ $investimento->nome }}
                    </div>
                </div>

            </div>

        </card>
        <div class="card-body">
            <div class="datagrid">
                <div class="datagrid-item">
                    <div class="datagrid-title">
                        Banco
                    </div>
                    <div class="datagrid-content">
                        {{ $investimento->contaBancaria->banco->nome }}
                    </div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">
                        Tipo de investimento
                    </div>
                    <div class="datagrid-content text-uppercase">
                        {{ $investimento->tipo_investimento }}
                    </div>
                </div>

                <div class="datagrid-item">
                    <div class="datagrid-title">
                        Objetivo
                    </div>
                    <div class="datagrid-content">
                        {{ $investimento->nome }}
                    </div>
                </div>
                <div class="datagrid-item">
                    <div class="datagrid-title">
                        Data de inicio
                    </div>
                    <div class="datagrid-content">
                        {{ $investimento->created_at }}
                    </div>
                </div>
            </div>
            <div class="datagrid mt-3">
                <div class="datagrid-item">
                    <div class="datagrid-title">
                        Valor bruto
                    </div>
                    <div class="datagrid-content">
                        R$: {{ FormataMoeda::formataMoeda(1000) }}
                    </div>
                </div>
                <div class="datagrid-item">
                    <div class="datagrid-title">
                        Valor líquido
                    </div>
                    <div class="datagrid-content">
                        <strong class="text-success">
                            R$: {{ FormataMoeda::formataMoeda(900) }}
                        </strong>
                    </div>
                </div>
                <div class="datagrid-item">
                    <div class="datagrid-title">
                        Ganhos/Perdas
                    </div>
                    <div class="datagrid-content">
                        <strong class="text-success">
                            R$: {{ FormataMoeda::formataMoeda(0) }}
                        </strong>
                    </div>
                </div>
                <div class="datagrid-item">
                    <div class="datagrid-title">
                        IR/IOF
                    </div>
                    <div class="datagrid-content">
                        R$: -{{ FormataMoeda::formataMoeda(100) }}
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button class="btn btn-primary">Guarda</button>
            <button class="btn btn-outline-primary">Rendimento</button>
            <button class="btn btn-warning">Resgasta</button>
        </div>
    </div>
</div>
