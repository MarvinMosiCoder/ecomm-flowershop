<!DOCTYPE html>
<html lang="en">
<head>
    @include('guest-frontend.plugins.guest-plugin')
    @yield('plugins')
    <title>flowershop</title>
    @yield('css')
</head>
<body>
 
<section class="main_section">
    {{-- Sidebar and Content Script --}}
    {{-- @include('guest-frontend.guest-sidebar') --}}
    @include('guest-frontend.guest-topbar')
    @yield('content')
</section>

{{-- Frontend script --}}
@include('guest-frontend.plugins.guest-script')

{{-- Your Script  --}}
@yield('script-js')

</body>
</html>
