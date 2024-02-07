
@section('css')
<style>
  .dropdown-toggle::after {
      display: none;
  }
</style>
<!-- header section starts  -->
<div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close mt-3">
        <span class="icon-close2 js-menu-toggle"></span>
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
  </div> <!-- .site-mobile-menu -->
  
  <!-- NAVBAR -->
  <header class="site-navbar">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="site-logo col-6"><a href="{{ route('home.index') }}">ARMANI FLOWERSHOP</a></div>

        <nav class="mx-auto site-navigation">
          <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
            <li><a href="about.html">Orders</a></li>
            <li>
              <a href="job-listings.html">Vouchers</a>
            </li>
            <li>
              <a href="services.html">Free shipping</a>
            </li>
            <li>  
                <div>
                  
                  @if($my_cart != 0)
                    <span id="countCart" class="count">{{$my_cart}}</span>
                  @endif
                  <a href="{{ route('view-cart') }}" style="height: 32px;" class="btn btn-outline-dark border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-shopping-cart"></span></a>
                </div>
            </li> 
            {{-- <li class="d-lg-none"><a href="{{ route('view-cart') }}" style="width: 22%; padding-left:15px; margin-left:20px" class="btn btn-outline-dark border-width-1 d-lg-inline-block shopping-cart"><span class="mr-2 icon-shopping-cart"></span></a></li> --}}
            <li class="settings">
              <div class="settings-menu">
                <a class="dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown" aria-expanded="false"> <i class="fa fa-cog fa-2x"></i></a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="{{ route('profile') }}"> <i class="fa fa-user-circle-o"></i> My Profile</a></li>
                    <li class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{ route('logout.perform') }}"> <i class="fa fa-sign-out"></i> Logout</a></li>
                </ul>
            </div>
            </li>
          </ul>
        </nav>

        <div class="right-cta-menu text-right d-flex aligin-items-center col-6">  
          <div class="dropdown ml-auto">
              <a href="#" class="site-menu-toggle js-menu-toggle d-inline-block d-xl-none mt-lg-2 ml-3"><span class="icon-menu h3 m-0 p-0 mt-2"></span></a>
          </div>
        </div>

      </div>
    </div>
  </header>