@extends('layout.layout')
@section('page-title', 'Investimento')
@section('content')

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <x-card.title title="Meus investimentos" buttonText="Novo Investimento" />
                <div class="col">
                    <img src="" alt="">
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    @for ($i = 0; $i < 7; $i++)
                        <div class="col-6 col-md-2 mb-3 cursor-pointer">
                            <div class="card p-0">
                                <div class="card-header p-1 justify-content-center">
                                    <strong>Banco Inter</strong>
                                </div>
                                <div class="p-1">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTh-dT9pyeTrk30OPa-g9FYrD5wLShxvfozgQ&s"
                                        alt="NomeDoBanco" class="rounded w-100">
                                </div>
                                <div class="card-footer p-1 text-center">
                                    Carro
                                    <br>
                                    <div>
                                        <strong>R$:</strong> 1000.00
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor

                </div>

            </div>
        </div>
    </div>

@endsection
