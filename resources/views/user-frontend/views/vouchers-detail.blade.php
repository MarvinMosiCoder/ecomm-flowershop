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
                <h3 class="text-center text-white pt-3">Free shipping</h3>
                <div class="container my-5">
                    <div class="row">
                        @foreach($vouchers as $voucher)
                            <div class="col-sm-6">
                                <div class="coupon bg-white rounded mb-2 d-flex justify-content-between">
                                    <div class="kiri p-5">
                                        <div class="icon-container ">
                                            <div class="icon-container_box mt-2">
                                                <img src="{{URL::to('images/freeshipping.png')}}" width="85" alt="totoprayogo.com" class="" />
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="divider">
                                        <div class="info m-3 d-flex align-items-center">
                                        </div>
                                    </div>

                                    <div class="tengah py-3 d-flex w-100 justify-content-start">
                                        <div>
                                            <p class="event">{{$voucher->percentage}}% {{$voucher->vouchers_name}}</p>
                                            <h4 class="event">₱{{$voucher->min_spend}} Min Spend</h4>
                                            
                                            <p><a href="#" class="btn btn-sm btn-outline-danger">Sitewide</a></p>
                                        
                                            <div class="fix"></div>
                                            <div class="loc">
                                                <p>{{$voucher->percentage}}%  used. valid til {{$voucher->end_date}}</p>
                                            </div>
                                        </div>
                                    
                                    </div>
                                    <div class="p-4" style="margin-top:10%">
                                        @if(in_array($voucher->id, $my_vouchers))
                                            <span class="pull-right"><a href="#" class="btn btn-outline-success btn-sm">Use</a></span>
                                        @else
                                            <span class="pull-right"><button class="btn btn-success btn-sm" data-id="{{$voucher->id}}" id="btn-claim" style="background-color:#00A86B !important">Claim</button></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="custom-card-vouchers mt-3">
                <h3 class="text-center text-white pt-3">Exclusive Vouchers</h3>
                <div class="container my-5">
                    <div class="row">
                        @foreach($vouchers as $voucher)
                            <div class="col-sm-6">
                                <div class="exclusive-coupon bg-white rounded mb-2 d-flex justify-content-between">
                                    <div class="kiri p-5">
                                        <div class="icon-container ">
                                            <div class="icon-container_box mt-2">
                                                <img src="{{URL::to('images/freeshipping.png')}}" width="85" alt="totoprayogo.com" class="" />
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="exclusive-coupon-divider">
                                        <div class="info m-3 d-flex align-items-center">
                                        </div>
                                    </div>

                                    <div class="exclusive-coupon-detail py-3 d-flex w-100 justify-content-start">
                                        <div>
                                            <p class="event">{{$voucher->percentage}}% {{$voucher->vouchers_name}}</p>
                                            <h4 class="event">₱{{$voucher->min_spend}} Min Spend</h4>
                                            
                                            <p><a href="#" class="btn btn-sm btn-outline-danger">Sitewide</a></p>
                                        
                                            <div class="fix"></div>
                                            <div class="loc">
                                                <p>{{$voucher->percentage}}%  used. valid til {{$voucher->end_date}}</p>
                                            </div>
                                        </div>
                                    
                                    </div>
                                    <div class="p-4" style="margin-top:10%">
                                        @if(in_array($voucher->id, $my_vouchers))
                                            <span class="pull-right"><a href="#" class="btn btn-outline-success btn-sm">Use</a></span>
                                        @else
                                            <span class="pull-right"><button class="btn btn-success btn-sm" data-id="{{$voucher->id}}" id="btn-claim" style="background-color:#00A86B !important">Claim</button></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
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


