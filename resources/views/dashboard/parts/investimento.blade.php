<div class="col-sm-12 col-md-6">
    <div class="card">
        <div class="card-body">
            <x-card.title title="Meus investimentos" />

            {{-- INVESTIMENTOS --}}
            <div class="row align-items-center">
                <div class="accordion-item">

                    <div class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse-1-investimentos" aria-expanded="false">
                            <div class="col-auto">
                                <span class="avatar rounded-circle"
                                    style="background-image: url(https://altarendablog.com.br/wp-content/uploads/2023/12/3afb1b054f7646acabdcd1e953f77c7d_thumb1.jpg)">
                                </span>
                            </div>
                            <div class="col">
                                <strong>
                                    Banco Inter
                                </strong>
                            </div>
                            <div class="accordion-button-toggle">
                                <!-- Download SVG icon from http://tabler.io/icons/icon/chevron-down -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                    <path d="M6 9l6 6l6 -6"></path>
                                </svg>
                            </div>
                        </button>
                    </div>

                    <div id="collapse-1-investimentos" class="accordion-collapse collapse"
                        data-bs-parent="#accordion-default">
                        <div class="accordion-body mt-2">
                            <div class="alert alert-primary mb-0">
                                <div class="col-12">
                                    <div class="d-flex justify-content-between w-100">
                                        <div class="text-start">
                                            <strong>Tipo</strong>
                                            <br>
                                            CDB
                                        </div>

                                        <div class="text-end">
                                            <strong>Investido</strong>
                                            <br>
                                            R$ 500,00
                                        </div>
                                    </div>

                                    <hr class="my-3">

                                    <div class="d-flex justify-content-between w-100">
                                        <div class="text-start">
                                            <strong>Tipo</strong>
                                            <br>
                                            FIIS
                                        </div>

                                        <div class="text-end">
                                            <strong>Investido</strong>
                                            <br>
                                            R$ 100,00
                                        </div>
                                    </div>

                                    <hr class="my-3">

                                    <div class="row  align-items-center">
                                        <div class="col-6 text-center">
                                            <strong>Total:</strong>
                                        </div>
                                        <div class="col-6 text-center">
                                            <strong>R$: 600,00</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <hr class="my-3">

            {{-- BUTTON --}}
            <div class="col-sm-12 mt-3">
                <a class="btn btn-outline-primary w-100" href="{{ route('investimento.index') }}">
                    Gerenciar investimentos
                </a>
            </div>
        </div>
    </div>
</div>
