@include('freelancer.layouts.header')

@yield('main-section')

@if (request()->routeIs('home'))
    @include('freelancer.layouts.footer')
@else
    @include('freelancer.layouts.footer')
@endif
