@extends('user-frontend.components.content')
@section('css')
<link rel="stylesheet" href="{{ asset('css/cart-detail.css?v=2')}}">
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
</style>
@section('content')

    <section class="cart" id="cart">
        <h3>Checkout</h3>
        <form action="" id="CartDetailedForm">
            <div class="row">
                <div class="col-md-6">
                    <h2>test</h2>
                </div>
                <div class="col-md-6" style="border-left: 1px solid #000">
                    @foreach($my_cart_detail as $cart)
                        <input type="hidden" value="{{csrf_token()}}" name="_token" id="token">
                        <input type="hidden" value="{{$cart->cart_id}}" name="cart_id" id="cart_id{{$cart->cart_id}}">
                        
                        <div class="shopping-cart">
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
        </form>
    </section>

@section('script-js')
  
@endsection


