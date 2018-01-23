@extends('adminlte::page')

@section('title', 'Home - GoodBank')

@section('content_header')
    <h1>Sistema GoodBank</h1>
@stop

@section('content')
    <h3><b>Bem vindo, a sua conta Sr: {{$user}}</b></h3>
@stop