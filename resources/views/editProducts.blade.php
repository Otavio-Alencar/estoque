@extends('baseLayout.layout')

@section('title', 'Editar')

@section('content')
    @include("productsComponent.productCodeEdit")
    @include("components.inputMask")
@endsection
