@extends('layouts.app')

@section('title', 'Main Page')

@section('content')
    <div class="container">
        <p>Main page content</p>
    </div>
    <div class="reviews content-block">
        @include('includes.reviews')
    </div>
    <div class="contacts content-block">
        @include('includes.contacts')
    </div>
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2605.7792328152595!2d16.59149074793
        2223!3d49.22371376951403!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4712940ed0da90d3%3A0xd901
        512340738cd8!2sHusitsk%C3%A1%2C+612+00+Brno-Kr%C3%A1lovo+Pole!5e0!3m2!1sen!2scz!4v1526324322097"
                width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
@endsection