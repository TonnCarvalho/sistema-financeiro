@extends('layout.layout')
@section('page-title', 'Editar conta')
@section('content')
    <x-modal.confirma-exclusao action=" {{ route('conta-bancaria.destroy', $contasBancarias->id) }} "
        message="Deseja excluir está conta?" />

    @if (session('success'))
        <x-alert.alert-success message="{{ session('success') }}" />
    @endif

    <div class="col-12" x-data="contaBancaria({{ $contasBancarias }})">
        <div class="card">
            <form action="{{ route('conta-bancaria.update', $contasBancarias->id) }}" method="POST"
                x-on:submit.prevent="sendEdit({{ $contasBancarias->id }})">
                <div class="card-body">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">

                        <div class="mb-3">
                            <label for="nome" class="form-label required">Nome</label>
                            <input type="text" id="nome" name="nome" class="form-control"
                                x-model="accountBankEdit.nome">

                            <template x-if="errors.nome">
                                <span class="text-danger">Campo obrigatório</span>
                            </template>
                        </div>


                        <div class="mb-3">
                            <label for="banco" class="form-label">Banco</label>
                            <select name="banco_id" id="banco_id" class="form-control" x-model="accountBankEdit.banco_id">
                                @foreach ($bancos as $banco)
                                    <option @if ($contasBancarias->banco_id == $banco->id) selected @endif value="{{ $banco->id }}">
                                        {{ $banco->nome }}
                                    </option>
                                @endforeach
                            </select>
                            <template x-if="errors.banco_id">
                                <span class="text-danger">Campo obrigatório</span>
                            </template>
                        </div>

                        <div class="mb-3">
                            <label for="saldo" class="form-label">Saldo</label>
                            <input type="text" id="saldo" class="form-control" name="saldo"
                                x-model="accountBankEdit.saldo">
                            <template x-if="errors.saldo">
                                <span class="text-danger">Campo obrigatório</span>
                            </template>
                        </div>

                        <div class="mb-3">
                            <label class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="mostra_saldo"
                                    x-model="accountBankEdit.mostra_saldo"
                                    @if ($contasBancarias->mostra_saldo == 1) checked @endif />
                                <span class="form-check-label">Incluir no saldo atual</span>
                            </label>
                        </div>

                    </div>
                    <div class="card-footer d-none d-sm-block">
                        <button type="submit" class="btn btn-success px-6">
                            Salvar
                        </button>
                        <a type="button" class="btn btn-light mx-3" href="{{ route('conta-bancaria.index') }}">
                            Cancelar
                        </a>
                        <button type="button" class="btn btn-ghost-danger" data-bs-toggle="modal"
                            data-bs-target="#confirmaExclusao">
                            Excluir
                        </button>
                    </div>

                    <div class="card-footer d-sm-none d-flex justify-content-between">
                        <button type="submit" class="btn btn-success btn-sm py-2 px-6">
                            Salvar
                        </button>
                        <a type="button" class="btn btn-light btn-sm py-2 mx-3"
                            href="{{ route('conta-bancaria.index') }}">
                            Cancelar
                        </a>
                        <button type="button" class="btn btn-ghost-danger btn-sm p-2" data-bs-toggle="modal"
                            data-bs-target="#confirmaExclusao" data-id=''>
                            Excluir
                        </button>
                    </div>
            </form>
        </div>
    </div>

@endsection
