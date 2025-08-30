@extends('layout.layout')
@section('page-title', 'Editar conta')
@section('content')
    <x-modal.confirma-exclusao action="" message="Deseja excluir está conta?" />

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="" method="post">
                    @csrf
                    <div class="mb-3">

                        <div class="mb-3">
                            <label for="nome" class="form-label required">Nome</label>
                            <input type="text" id="nome" class="form-control" name="nome"
                                value="{{ $dados_bancario->nome }}">
                        </div>

                        <div class="mb-3">
                            <label for="banco" class="form-label">Banco</label>
                            <select name="banco" id="banco" class="form-control">
                                <option @if (!@empty($dados_bancario->banco) ? 'selected' : '')  @endif>

                                </option>

                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="saldo" class="form-label">Saldo</label>
                            <input type="text" id="saldo" class="form-control" name="saldo"
                                value="{{ $dados_bancario->saldo }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" />
                                <span class="form-check-label">Incluir no saldo atual</span>
                            </label>
                        </div>

                </form>
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
                <a type="button" class="btn btn-light btn-sm py-2 mx-3" href="{{ route('conta-bancaria.index') }}">
                    Cancelar
                </a>
                <button type="button" class="btn btn-ghost-danger btn-sm p-2" data-bs-toggle="modal"
                    data-bs-target="#confirmaExclusao" data-id=''>
                    Excluir
                </button>
            </div>
        </div>
    </div>

@endsection
