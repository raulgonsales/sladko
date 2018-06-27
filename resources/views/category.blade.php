@extends('layouts.app')

@section('title', 'Category ' . $title)

@section('content')
    <div class="products">
        <div class="container">
            {!! $breadcrumb !!}
            @include('includes.main-products')
        </div>
    </div>
@endsection