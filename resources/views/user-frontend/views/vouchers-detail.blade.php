@extends('user-frontend.components.content')
@section('css')
<link rel="stylesheet" href="{{ asset('css/vouchers.css?v=2')}}">
<style>

</style>
@section('content')

    <section class="cart" id="cart">
        <form action="{{ route('submit-checkout') }}" method="POST" id="checkOutCart">
            <a href="" class="btn btn-outline-primary pull-right"><i class="fa fa-ticket"></i> <span>My vouchers</span></a>
            <h1 class="upcomming mt-4">VOUCHERS</h1>
           
            <div class="custom-card-free-shipping">
                <div class="container">
                    <h4 style="color: #fff">Free shipping</h4>
                    <hr>
                    @foreach($vouchers as $voucher)
                        <input type="hidden" value="{{csrf_token()}}" name="_token" id="token">
                            <div class="item">
                            <div class="item-right">
                                <h2 class="num" style="color: #fff">Free</h2>
                                <p class="day" style="color: #fff">Shipping</p>
                                <span class="up-border"></span>
                                <span class="down-border"></span>
                            </div> <!-- end item-right -->
                            
                            <div class="item-left">
                                <p class="event">{{$voucher->percentage}}% {{$voucher->vouchers_name}}</p>
                                <h2 class="event">₱{{$voucher->min_spend}} Min Spend</h2>
                                
                                <div class="sce">
                                <p><a href="#" class="btn btn-outline-primary">Sitewide</a></p>
                                </div>
                                @if(in_array($voucher->id, $my_vouchers))
                                    <span class="pull-right"><a href="#" class="btn btn-outline-success btn-sm">Use</a></span>
                                @else
                                    <span class="pull-right"><button class="btn btn-success btn-sm" data-id="{{$voucher->id}}" id="btn-claim" style="background-color:#00A86B !important">Claim</button></span>
                                @endif
                                <div class="fix"></div>
                                <div class="loc">
                                <p>{{$voucher->percentage}}%  used. valid til {{$voucher->end_date}}</p>
                                </div>
                                <div class="fix"></div>
                            
                            </div> <!-- end item-right -->
                            </div> <!-- end item -->
                    @endforeach
                </div>
            </div>

            <div class="custom-card-vouchers">
                <div class="container">
                    <h4 style="color: #fff">Exclusive vouchers</h4>
                    <hr>
                    @foreach($vouchers as $voucher)
                        <input type="hidden" value="{{csrf_token()}}" name="_token" id="token">
                            <div class="item">
                            <div class="item-right">
                                <h2 class="num" style="color: #fff">Free</h2>
                                <p class="day" style="color: #fff">Shipping</p>
                                <span class="up-border"></span>
                                <span class="down-border"></span>
                            </div> <!-- end item-right -->
                            
                            <div class="item-left">
                                <p class="event">{{$voucher->percentage}}% {{$voucher->vouchers_name}}</p>
                                <h2 class="event">₱{{$voucher->min_spend}} Min Spend</h2>
                                
                                <div class="sce">
                                <p><a href="#" class="btn btn-outline-primary">Sitewide</a></p>
                                </div>
                                @if(in_array($voucher->id, $my_vouchers))
                                    <span class="pull-right"><a href="#" class="btn btn-outline-success btn-sm">Use</a></span>
                                @else
                                    <span class="pull-right"><button class="btn btn-success btn-sm" data-id="{{$voucher->id}}" id="btn-claim" style="background-color:#00A86B !important">Claim</button></span>
                                @endif
                                <div class="fix"></div>
                                <div class="loc">
                                <p>{{$voucher->percentage}}%  used. valid til {{$voucher->end_date}}</p>
                                </div>
                                <div class="fix"></div>
                            
                            </div> <!-- end item-right -->
                            </div> <!-- end item -->
                    @endforeach
                </div>
            </div>
        </form>
    </section>

@section('script-js')
    <script type="text/javascript">
        function preventBack() {    
            window.history.forward();
        }
        window.onunload = function() {
            null;
        };
        setTimeout("preventBack()", 0); 
    </script>
@endsection


