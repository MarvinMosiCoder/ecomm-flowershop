@extends('user-frontend.components.content')
@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.css')}}">
<style>
 
</style>
@section('content')
    <section class="profile mt-5" id="profile">
        <h3 class="text-center">Your profile</h3>
            <div class="cardDetails">
                <div class="wrapper">
                    <div class="img-area">
                      <div class="inner-area">
                        <img style="width:100%; height:100%" class="card-img-top" src="{{URL::to('images/default-image.jpg')}}" alt="Card image cap">
                      </div>
                    </div>
                    <div class="name">{{ auth()->user()->username}}</div>
                    <div class="about">Classic Member</div>
                    <div class="follows text-center">
                      <span>50 <br> <p>Followers</p></span>
                      <span>50 <br> <p>Following</p></span>
                      <span>50 <br> <p>Likes</p></span>
                    </div>
                    <div class="buttons">
                        <button>Edit profile</button>
                        <button>Shared profile</button>
                        <button><i class="fa fa-plus-circle"></i></button>
                    </div>
                </div>
                <div class="otherDetails">
                   <ul class="ul-card">
                    
                        <li class="li-card">
                            <a href=""> 
                            <i class="fa fa-shopping-bag"></i> My Orders
                        </a>    
                            <hr>
                            <div class="follows text-center">
                                <span> <a href=""><i class="fa fa-money"></i></a> <p>To Pay</p></span>
                                <span> <a href=""><i class="fas fa-shipping-fast"></i></a> <p>To Ship</p></span>
                                <span> <a href=""><i class="fa fa-truck"></i></a> <p>To Received</p></span>
                                <span> <a href=""><i class="fa fa-star"></i></a> <p>To Rate</p></span>
                            </div>
                        </li>
                    <a href="{{route('my-addresses')}}">
                        <li class="li-card">
                            <i class="fa fa-home"></i> My Addresses
                        </li>
                    </a> 
                    <a href=""> 
                        <li class="li-card">
                            <i class="fa fa-user"></i> Account Settings
                        </li>
                    </a>
                    <a href=""> 
                        <li class="li-card">
                            <i class="fa fa-question-circle"></i> Help Centre
                        </li>
                    </a>
                    <a href=""> 
                        <li class="li-card">
                            <i class="fa fa-info"></i> About
                        </li>
                    </a>
                   </ul>
                </div>
            </div>
           
    </section>

@section('script-js')
    <script type="text/javascript">
       
    </script>
@endsection


