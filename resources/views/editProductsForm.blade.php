@extends('baseLayout.layout')

@section('title', 'editar')

@section('content')
    @include("productsComponent.editProductsContentWrapper")
    @include("components.inputMask")
@endsection
