@extends('layout.layout')
@section('page-title', 'Investimento')
@section('content')
    @include('investimento.parts.show.investimento')
    @include('investimento.parts.show.extrato')
@endsection
