@include('layouts.header')

@yield('main-section')

@if (request()->routeIs('home'))
    @include('layouts.footer')
@else
    @include('layouts.footer')
@endif
