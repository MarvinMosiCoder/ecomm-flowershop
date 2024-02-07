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
    <a href="#" class="site-menu-toggle js-menu-toggle d-inline-block d-xl-none mt-lg-2 ml-3"><span class="icon-menu h3 m-0 p-0 mt-2"></span></a>
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="site-logo col-6"><a href="{{ route('flowershop') }}">ARMANI FLOWERSHOP</a></div>

        <nav class="mx-auto site-navigation">
          
          <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
            <li class="d-lg-none"> <a href="{{ route('login.perform') }}"><span class="icon-user"></span> Log In</a></li>
            <li><a href="index.html">About Us</a></li>
            <li><a href="about.html">Products</a></li>
            <li class="has-children">
              <a href="job-listings.html">Flower Types</a>
              <ul class="dropdown">
                <li><a href="job-single.html">Dried Flowers</a></li>
                <li><a href="post-job.html">Fresh Flowers</a></li>
              </ul>
            </li>

            <li><a href="contact.html">Contact</a></li>
            <li class="d-lg-none"><a href="#" class="shopping-cart fas fa-shopping-cart"></a></li>
            
          </ul>
        </nav>

        <div class="right-cta-menu text-right d-flex aligin-items-center col-6">
          <div class="ml-auto">
            <a href="post-job.html" class="btn btn-outline-dark border-width-2 d-lg-inline-block"><span class="icon-search"></span></a>
            <a href="post-job.html" class="btn btn-outline-dark border-width-2 d-lg-inline-block"><span class="icon-shopping-cart"></span></a>
            <a href="{{ route('login.perform') }}" class="btn btn-primary border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-lock_outline"></span>Log In</a>
          </div>
        </div>
    
      </div>
    </div>
  </header>