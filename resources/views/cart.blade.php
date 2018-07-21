@extends('layouts.app')

@section('title', 'Cart')

@section('pagescript')
    <script src="{{ asset('js/cart-ajax.js') }}"></script>
@stop

@section('content')
    <div class="cart">
        <div class="container">
            <div class="cart-blocks">

            </div>
        </div>
    </div>
@endsection