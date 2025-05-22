@extends('baseLayout.layout')

@section('title', 'Editar')

@section('content')
    @include("productsComponent.productCodeEdit")
    @section('scripts')
        @include("extraComponents.inputMask")
    @endsection
@endsection
