@include('employer.layouts.header')

@yield('main-section')

@if (request()->routeIs('employer.home'))
    @include('employer.layouts.footer')
@else
    @include('employer.layouts.footer')
@endif
