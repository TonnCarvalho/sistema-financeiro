<div class="col-sm-12 col-md-6">
    <div class="card">

        <div class="card-header position-relative">
            <div class="bg-success position-absolute rounded-pill" style="height: 60px; width: 5px"></div>
            <div class="ms-3">
                <p class="h3 m-0 text-secondary">
                    Receita de Julho
                </p>
                <p class="h2 text-secondary m-0">
                    R$:
                    <strong class="text-black">
                        1.500,00
                    </strong>
                </p>
            </div>
        </div>

        <div class="card-body">
            <x-card.title title="Minhas contas" />

            <div class="row align-items-center">
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
                <div class="col">
                    <span class="text-primary">
                        <strong>
                            R$ 1.000,00
                        </strong>
                    </span>
                </div>
            </div>

            <hr class="my-3">

            <div class="row align-items-center">
                <div class="col-auto">
                    <span class="avatar rounded-circle"
                        style="background-image: url(https://play-lh.googleusercontent.com/NPkx0aiwABB31gBw_CuZO9Rwukhir-BwemxfNlAVjT6smwk6QgUbb3XrmsSSClfzk0dY)">
                    </span>
                </div>
                <div class="col">
                    <strong>
                        NuBank
                    </strong>
                </div>
                <div class="col">
                    <span class="text-primary">
                        <strong>
                            R$ 500,00
                        </strong>
                    </span>
                </div>
            </div>

            <hr class="my-3">

            <div class="col-sm-12">
                <a class="btn btn-outline-primary w-100" href="{{ route('conta-bancaria.index') }}">
                    Gerenciar contas
                </a>
            </div>
        </div>
    </div>
</div>
