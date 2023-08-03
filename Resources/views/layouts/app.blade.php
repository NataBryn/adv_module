@extends('layouts.backend')

@section('styles')
    @yield('css-code')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/banners.css') }}">
@endsection

@section('content')
    @if(config('banners.errors_panel'))
        @include('banners::elements.messages')
    @endif
    @yield('banners-content')
@endsection

@section('scripts')
    <script src="{{ asset('assets/backend/js/banners.js') }}"></script>
    @yield('js-code')
@endsection
