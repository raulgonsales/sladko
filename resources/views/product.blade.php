@extends('layouts.app')

@section('title', 'Main Page')

@section('pagescript')
    <script src="{{ asset('js/jssor.slider.min.js') }}"></script>
@stop
@section('pagestyle')
    <link rel="stylesheet" href="{{ asset('css/product-gallery.css') }}">
@stop

@section('content')
    <div class="product-page">
        <div class="container">
            <div class="breadcrumb">
                {{ $breadcrumb }}
            </div>

            @if(!$product['error'])
                <div class="product-info">
                    <div class="product-gallery col-7">
                        @include('includes.product-gallery')
                    </div>
                        <div class="product-description col-5">
                            <h3>{{ $product->name }}</h3>
                            <p class="price"><b>Cena: </b>{{ $product->price }} Kc</p>
                            <p class="descriptions">
                                {{ $product->description }}
                            </p>
                        </div>
                </div>
            @else
                <div class="alert alert-danger">
                    <strong>Error!</strong> {{ $product['error'] }}. <a href="{{ route('main') }}">Go to main page</a>
                </div>

            @endif
        </div>
    </div>
@endsection