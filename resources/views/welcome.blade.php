@extends('baseLayout.layout')

@section('title', 'Home')

@section('content')
    <!-- Preloader -->



    @include("homeComponents.homeContentWrapper")
    @section('scripts')
        @include("extraComponents.chart")
    @endsection


@endsection


