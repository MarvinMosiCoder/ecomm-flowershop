<!DOCTYPE html>
<html lang="en">
<head>
    @include('user-frontend.plugins.user-frontend-plugin')
    {{-- @yield('plugins') --}}
    <title>Gashapon</title>
    @yield('css')
</head>
<body>
@auth    
<section class="main_section">
    {{-- Sidebar and Content Script --}}
    {{-- @include('user-frontend.components.sidebar') --}}
    @include('user-frontend.components.topbar')
    @yield('content')
</section>

{{-- Frontend script --}}
@include('user-frontend.plugins.user-frontend-script')

{{-- Your Script  --}}
@yield('script-js')
@endauth
</body>
</html>
