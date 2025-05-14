@extends('baseLayout.layout')

@section('title', 'Produtos')

@section('content')
    @include("productsComponent.productsContentWrapper")
    @include("extraComponents.table")

@endsection

