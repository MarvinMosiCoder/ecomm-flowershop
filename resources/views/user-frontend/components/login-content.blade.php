<!DOCTYPE html>
<html lang="en">
<head>
    @include('user-frontend.plugins.login-plugin')
    @yield('plugins')
    <title>flowershop</title>
    @yield('css')
</head>
<body>
 
<section class="main_section">
    {{-- Sidebar and Content Script --}}
    @include('user-frontend.components.login-topbar')
    @yield('content')
</section>

{{-- Frontend script --}}
@include('user-frontend.plugins.login-script')

{{-- Your Script  --}}
@yield('script-js')

</body>
</html>
