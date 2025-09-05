
@extends('layout.layout')
@section('page-title', 'Investimento')
@section('content')
    <div class="col-12" x-data="investimento">
        <div class="card">
            <div class="card-header">
                <x-card.title title="Meus investimentos" buttonText="Novo Investimento" />
            </div>
            <div class="card-body">
                @include('investimento.parts.index.meus-investimentos')
            </div>
        </div>

        <x-modal.form title="Adicionar investimento" action="{{ route('investimento.store') }}">
            <x-slot:form>
                @include('investimento.parts.index.form-novo-investimento')
            </x-slot:form>
        </x-modal.form>
    </div>
@endsection
