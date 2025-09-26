<div class="col-12">
    <div class="card">
        <div class="card-header">
            <x-card.title title='Resumo' />
        </div>
        <div class="card-body">
            <div class="row row-card">
                <div class="col-6">
                    <x-card.card-bg-color title='Atual' bgColor='bg-primary-lt'>

                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="datagrid-title mt-2">
                                Valor Bruto
                            </div>
                            <div class="datagrid-content">
                                {{ FormataMoeda::formataMoeda($investimento->valor_bruto) }}
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="datagrid-title mt-2">
                                Valor Liquido
                            </div>
                            <div class="datagrid-content">
                                {{ FormataMoeda::formataMoeda($investimento->valor_liquido) }}
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="datagrid-title mt-2">
                                Ganhos/Perdas
                            </div>
                            <div class="datagrid-content">
                                {{ FormataMoeda::formataMoeda($investimento->ganho_perda) }}
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="datagrid-title mt-2">
                                IR/IOF
                            </div>
                            <div class="datagrid-content">
                                {{ FormataMoeda::formataMoeda($investimento->ir_iof) }}
                            </div>
                        </div>

                    </x-card.card-bg-color>
                </div>

                <div class="col-6">
                    <x-card.card-bg-color title='Novo'>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="datagrid-title mt-2">
                                Valor Bruto
                            </div>
                            <div class="datagrid-content" id='novo_valor_bruto'>
                                {{ FormataMoeda::formataMoeda($investimento->valor_bruto) }}
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="datagrid-title mt-2">
                                Valor Liquido
                            </div>
                            <div class="datagrid-content">
                                {{ FormataMoeda::formataMoeda($investimento->valor_liquido) }}
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="datagrid-title mt-2">
                                Ganhos/Perdas
                            </div>
                            <div class="datagrid-content">
                                {{ FormataMoeda::formataMoeda($investimento->ganho_perda) }}
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="datagrid-title mt-2">
                                IR/IOF
                            </div>
                            <div class="datagrid-content">
                                {{ FormataMoeda::formataMoeda($investimento->ir_iof) }}
                            </div>
                        </div>
                    </x-card.card-bg-color>
                </div>
            </div>
        </div>
    </div>
</div>
