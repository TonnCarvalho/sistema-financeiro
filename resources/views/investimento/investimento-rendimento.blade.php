@php
    use App\Helpers\FormataMoeda;
@endphp
@extends('layout.layout')
@section('page-title', 'Investimento - Adiciona rendimento')
@section('content')
    <div x-data="investimento">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="avatar avatar-xl"
                                style="
                            background-image: url({{ $investimento->contaBancaria->banco->image }});">
                            </span>
                        </div>
                        <div class="col">
                            <div class="card-title">
                                <div class="d-flex gap-3">

                                    <div>
                                        <span class="text-secondary">
                                            Valor bruto
                                        </span>
                                        <div class="fs-2">
                                            R$: {{ FormataMoeda::formataMoeda($investimento->valor_bruto) }}
                                        </div>
                                    </div>
                                    <div>
                                        <span class="text-secondary">
                                            Valor liquido
                                        </span>
                                        <div class="fs-2">
                                            R$: {{ FormataMoeda::formataMoeda($investimento->valor_liquido) }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-subtitle mt-1 fs-3">
                                {{ $investimento->nome }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('investimentoCdb.insertRendimentoCdb', $investimento->id) }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12 col-sm-6">

                                <label for="novo_valor_bruto" class="form-label required">
                                    Valor bruto
                                    <span class="text-danger">
                                        @error('novo_valor_bruto')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </label>
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <x-icons.icon-cifrao />
                                    </span>
                                    <input type="text" id="novo_valor_bruto" class="form-control form-control-lg"
                                        name="novo_valor_bruto" autofocus>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <label for="novo_valor_liquido" class="form-label required">
                                    Valor liquido
                                    <span class="text-danger">
                                        @error('novo_valor_liquido')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </label>
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <x-icons.icon-cifrao />
                                    </span>
                                    <input type="text" id="novo_valor_liquido" class="form-control form-control-lg"
                                        name="novo_valor_liquido">
                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <label for="novo_valor_liquido" class="form-label">
                                    Data
                                </label>
                                <div class="input-icon">
                                    <span
                                        class="input-icon-addon"><!-- Download SVG icon from http://tabler.io/icons/icon/calendar -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                            <path
                                                d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z">
                                            </path>
                                            <path d="M16 3v4"></path>
                                            <path d="M8 3v4"></path>
                                            <path d="M4 11h16"></path>
                                            <path d="M11 15h1"></path>
                                            <path d="M12 15v3"></path>
                                        </svg></span>
                                    <input type="date" class="form-control" name="data"
                                        id="datepicker-icon-prepend" value="{{ now()->format('Y-m-d') }}">
                                </div>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary px-5">Adicionar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- //TODO resumo de rendimento --}}
        {{-- @include('investimento.parts.rendimento.resumo') --}}

    </div>
    @vite(['resources/js/alpine/investimento.js'])
@endsection
