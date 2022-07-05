<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    @if(app()->getLocale() == 'ar')
        dir="rtl"
    @else
        dir="ltr"
    @endif
>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ __('lang.Moda') }} | @yield('title')</title>
        <link rel="stylesheet" href="{{asset("css/web/necessary.css")}}">
        <link rel="stylesheet" href="{{asset("css/web/auth.css")}}">
        <!-- Styles -->
        @yield('styles')
    </head>
    <body>
        <div class="message">
        @if(session()->has('banerror'))
        <div class="fail">
            {{session()->get('banerror')}}
        </div>
        @endif
        </div>
        <div class="loginForm">
            {{ $slot }}
        </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('scripts')
    </body>
</html>
