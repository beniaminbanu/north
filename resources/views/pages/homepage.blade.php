@extends('layouts.main')
@push('styles')
    <link rel="stylesheet" href="{{ asset('plugins/owl/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/owl/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/home.css') }}">
@endpush
@section('content')
    @include("pages.home.carousel")
    @include("pages.home.about-us")
    @include("pages.home.formular")
    @include("pages.home.cuisine")
    @include("pages.home.locationlounge")
    @include("pages.home.socialmedia")
@endsection

@once
    @push('scripts')
        <script src="{{ asset('plugins/owl/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('js/pages/homepage.js') }}"></script>
    @endpush
@endonce
