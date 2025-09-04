@php
    use App\Helpers\FormataMoeda;
@endphp
@extends('layout.layout')
@section('page-title', 'Investimento')
@section('content')
    <div class="col-12" x-data="investimento">
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
                                        <strong>R$:</strong> {{ FormataMoeda::formataMoeda(1000.0) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
        <x-modal.form title="Adicionar investimento" action="{{ route('investimento.store') }}">
            <x-slot:form>
                {{-- nome --}}
                <div class="mb-3">
                    <label for="nome" class="form-label required">
                        Nome
                    </label>
                    <input type="text" id="nome" class="form-control" name="nome" x-model="investimento.nome">

                    <template x-if="errors.nome">
                        <span class="text-danger">Campo obrigatório</span>
                    </template>
                </div>
                {{-- banco --}}
                <div class="mb-3">
                    <label for="conta_bancaria" class="form-label required">
                        Banco
                    </label>
                    <select name="conta_bancaria" id="conta_bancaria" class="form-control"
                        x-model="investimento.conta_bancaria">
                        <option value="" selected disabled>Selecione</option>
                        @foreach ($banco as $banco)
                            <option value="{{ $banco->id }}">
                                {{ $banco->nome }}
                            </option>
                        @endforeach
                    </select>

                    <template x-if="errors.conta_bancaria">
                        <span class="text-danger">Campo obrigatório</span>
                    </template>
                </div>
                {{-- valor --}}
                <div class="mb-3">
                    <label for="valor" class="form-label">
                        Quanto quer guardar
                    </label>
                    <input type="text" class="form-control" name="valor" id="valor" x-model="investimento.valor">
                </div>
                {{-- tipo --}}
                <div class="mb-3">
                    <label for="tipo_investimento" class="form-label">
                        Qual tipo do investimento
                    </label>
                    <select name="tipo_investimento" id="tipo_investimento" class="form-control"
                        x-model="investimento.tipo_investimento">
                        <option value=""selected disabled>Selecione</option>
                        <option value="cdb">CBD</option>
                        <option value="fiis">FIIS</option>
                    </select>
                    <template x-if="errors.tipo_investimento">
                        <span class="text-danger">Campo obrigatório</span>
                    </template>
                </div>
            </x-slot:form>
        </x-modal.form>
    </div>

@endsection
