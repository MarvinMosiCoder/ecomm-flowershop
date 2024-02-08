@extends('user-frontend.components.content')
@section('css')
<link rel="stylesheet" href="{{ asset('css/cart-detail.css')}}">
<style>
    .quantity input {
        -webkit-appearance: none;
        border: none;
        text-align: center;
        width: 32px;
        font-size: 16px;
        color: #43484D;
        font-weight: 300;
    }

    input[type=radio] {
        --s: 1em;     /* control the size */
        --c: #009688; /* the active color */
        
        height: var(--s);
        aspect-ratio: 1;
        border: calc(var(--s)/8) solid #939393;
        padding: calc(var(--s)/8);
        background: 
            radial-gradient(farthest-side,var(--c) 94%,#0000) 
            50%/0 0 no-repeat content-box;
        border-radius: 50%;
        outline-offset: calc(var(--s)/10);
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        cursor: pointer;
        font-size: inherit;
        transition: .3s;
    }
    input[type=radio]:checked {
        border-color: var(--c);
        background-size: 100% 100%;
    }

    input[type=radio]:disabled {
        background: 
            linear-gradient(#939393 0 0) 
            50%/100% 20% no-repeat content-box;
        opacity: .5;
        cursor: not-allowed;
    }

    @media print {
        input[type=radio] {
            -webkit-appearance: auto;
            -moz-appearance: auto;
            appearance: auto;
            background: none;
        }
    }

    label {
        display:inline-flex;
        align-items:center;
        gap:10px;
        margin:5px 0;
        cursor: pointer;
    }

    .fixed {
        position: fixed;
    }

</style>
@section('content')

    <section class="cart" id="cart">
        <h3>Checkout</h3>
        <form action="" id="CartDetailedForm">
            <div class="row">
                <div class="col-md-6">
                    <div class="custom-card address clickable">
                        <div class="arrow pull-right" style="margin-top: 20px; !important; font-size: 25px !important">&#62;</div>
                        <h5>{{ $my_address->fullname }} | {{ $my_address->phone_number }}</h5>
                        <p>{{ $my_address->house_no .' '. $my_address->barangay .' '. $my_address->city . ',' . $my_address->region . $my_address->postal_code}}</p>
                        <a href="test"></a>
                    </div>

                    <div class="custom-card free-shipping ">
                        <div class="arrow pull-right" style="font-size: 20px !important">&#62;</div>
                        <h6 style="padding-top:5px"> <i class="fa fa-ticket"></i> Platform vouchers</h6>
                        <a href="test"></a>
                    </div>
             
                    <div class="custom-card payment">
                        @foreach($payment_type as $payment)
                            <label> 
                                @if($payment->id == 4)
                                    <i class="fa fa-money"></i> 
                                @elseif($payment->id == 2)
                                    <i class="fa fa-credit-card"></i> 
                                @elseif($payment->id == 3)
                                    <i class="fa fa-earning"></i> 
                                @endif
                                {{ $payment->payment_name }}
                            </label>
                            <span class="pull-right"><input type="radio" name="payment_type" value="{{$payment->id}}"></span>
                            <br>
                        @endforeach
                    </div>
                    <div class="footer">
                        <p class="text-center">By replacing an order, you agree to the <span style="color:#000;font-style:bold"><a href="">Shop Terms of Use and Sale</a></span> and acknowledge that you have read the <span style="color:#000;font-style:bold"><a href="">Shop Privacy Policy.</a><span></p>
                    </div>
                    <hr>
                    <div class="check-area">
                        <button type="submit" class="btn btn-primary btn-lg font-weight-medium auth-form-btn" id="add-to-cart"><span class="mr-2 icon-payment"></span>Pay</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="fixed" style="border-left: 1px solid #b0adad">
                        @foreach($my_cart_detail as $cart)
                            <input type="hidden" value="{{csrf_token()}}" name="_token" id="token">
                            <input type="hidden" value="{{$cart->cart_id}}" name="cart_id" id="cart_id{{$cart->cart_id}}">
                            
                            <div class="shopping-cart-pay">
                                <div class="item">
                                    <div class="image">
                                        <img src="{{URL::to('vendor/crudbooster/inventory_images').'/'.$cart->file_name}}" alt="" height="100" width="100">
                                    </div>
                                    
                                    <div class="description">
                                        <span>{{$cart->flower_name}}</span>
                                        <span>{{$cart->item_description}}</span>
                                        <span>White</span>
                                    </div>
                                    
                                    <div class="quantity">
                                        
                                        <input type="text" class="qty" name="name" value="{{$cart->quantity}}" data-id="{{$cart->cart_id}}">
                                        
                                    </div>
                                    <input type="hidden" class="total-price-hidden" value="{{$cart->cart_price}}" id="totalPrice{{$cart->cart_id}}">
                                    <div class="total-price" data-id="{{$cart->cart_id}}">₱{{$cart->cart_price}}</div>
                            
                                </div>
                            </div>
                        @endforeach
                        <div class="title text-center" style="color: black">
                            Subtotal: <span id="totalQty">0</span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

@section('script-js')
  <script>
    $(document).ready(function(){
        $('.clickable').click(function(){
            window.location = $(this).find("a").attr("href");
        });        
    });
  
  </script>
@endsection


