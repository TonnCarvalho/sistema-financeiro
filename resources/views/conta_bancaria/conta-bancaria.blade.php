@php
    use App\Helpers\FormataMoeda;
@endphp

@extends('layout.layout')
@section('page-title', 'Contas Bancarias')
@section('content')
    <div x-data="contaBancaria">

        <div class="col-12">

            <div class="card">
                <div class="card-body">
                    <x-card.title title="Minhas Contas" buttonText="Nova conta" />
                    @foreach ($contasBancarias as $contaBancaria)
                        <a href="{{ route('conta-bancaria.show', $contaBancaria->id) }}"
                            class="text-body cursor-pointer ">
                            <div class="row align-items-center mb-3">

                                <div class="col-auto">
                                    <span class="avatar rounded-circle"
                                        style="background-image: url({{ $contaBancaria->banco->image }})">
                                    </span>
                                </div>

                                <div class="col">
                                    <strong>
                                        {{ $contaBancaria->nome }}
                                    </strong>
                                </div>

                                <div class="col-auto text-center">
                                    <span class="text-secondary">Saldo</span>
                                    <br>
                                    <strong>
                                        R$: {{ FormataMoeda::formataMoeda($contaBancaria->saldo) }}
                                    </strong>
                                </div>

                                <div class="col-auto text-secondary">
                                    <x-icons.icon-chevron-right />
                                </div>
                            </div>
                        </a>
                        @if (!$loop->last)
                            <hr class="my-3">
                        @endif
                    @endforeach
                </div>
            </div>

            <x-modal.form title="Adicionar conta" action="{{ route('conta-bancaria.store') }}">
                <x-slot:form>

                    <div class="mb-3">
                        <label for="nome" class="form-label required">
                            Nome
                        </label>

                        <input type="text" id="nome" class="form-control" name="nome" placeholder="Ex: Itau"
                            x-model="accountBank.nome" value="{{ old('nome') }}">

                        <template x-if="errors.nome">
                            <span class="text-danger">Campo obrigatório</span>
                        </template>

                    </div>

                    <div class="mb-3">
                        <label for="banco_id" class="form-label required">Banco</label>
                        <select name="banco_id" id="banco_id" class="form-control" x-model="accountBank.banco_id"
                            {{ old('banco_id') }}>
                            <option value="" selected disabled>Selecione</option>
                            @foreach ($bancos as $banco)
                                <option value="{{ $banco->id }}">{{ $banco->nome }}</option>
                            @endforeach
                        </select>

                        <template x-if="errors.banco_id">
                            <span class="text-danger">Campo obrigatório</span>
                        </template>
                    </div>

                    <div class="mb-3">
                        <label for="saldo" class="form-label required">Saldo</label>
                        <input id="saldo" class="form-control " name="saldo" value="{{ old('saldo') }}"
                            x-model="accountBank.saldo">

                        <template x-if="errors.saldo">
                            <span class="text-danger">Campo obrigatório</span>
                        </template>
                    </div>

                    <div class="mb-3">
                        <label class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="mostra_saldo"
                                x-model="accountBank.mostra_saldo" />
                            <span class="form-check-label">Incluir no saldo atual</span>
                        </label>
                    </div>

                </x-slot:form>
            </x-modal.form>
        </div>
    </div>
@endsection
