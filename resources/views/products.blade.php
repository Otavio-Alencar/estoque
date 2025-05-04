@extends('HomeLayout.head')

@section('title', 'Produtos')

@section('content')

    @include("HomeLayout.header")
    @include("HomeLayout.mainSidebar")
    @include("HomeLayout.productsContentWrapper")

    @include("HomeLayout.footer")
    @include("components.table")

@endsection

