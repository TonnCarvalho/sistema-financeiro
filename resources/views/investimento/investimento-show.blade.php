
@extends('layout.layout')
@section('page-title', 'Investimento')
@section('content')
    {{-- <div>
        Investimento: {{ $investimento }}
    </div> --}}
    @include('investimento.parts.show.investimento')
    @include('investimento.parts.show.extrato')
@endsection
