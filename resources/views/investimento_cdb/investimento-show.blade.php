@extends('layout.layout')
@section('page-title', 'Investimento - CDB')
@section('content')
    @include('investimento_cdb.parts.show.detalhes')
    @include('investimento_cdb.parts.show.extrato_resumo')
@endsection
