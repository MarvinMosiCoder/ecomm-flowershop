@extends('user-frontend.components.content')
@section('css')
<link rel="stylesheet" href="{{ asset('css/cart-detail.css')}}">
<link rel="stylesheet" href="{{ asset('css/vouchers.css')}}">
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
        --c: #E36176; /* the active color */
        
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

    /* .fixed {
        position: fixed;
    } */
    .cart{
        margin-top: 50px;
    }
    .modal{
        margin-top: 50px;
    }
    @media (max-width: 750px) {
        /* .fixed {
            position: static;
        } */
        .cart{
            margin-top: 100px;
        }
        .modal{
            margin-top: 40px;
        }
    }

    .isShipping {
        text-decoration-line: line-through; 
    }

</style>
@section('content')
    <section class="cart" id="cart">
        <h3>Place Order</h3>
        <form action="" id="CartDetailedForm">
            <div class="row">
                <div class="col-md-6">
                    <a id="btnAddress" data-toggle="modal" data-target="#addressModal">
                        <div class="custom-card address">
                            <input type="hidden" name="address_id" id="address_id" value="{{$my_address->add_id}}">
                            <div class="arrow pull-right" style="margin-top: 20px; !important; font-size: 25px !important">&#62;</div>
                            <h5><i class="fas fa-map-marker-alt"></i> {{ $my_address->fullname }} | {{ $my_address->phone_number }}</h5>
                            <p>{{ $my_address->house_no .' '. $my_address->brgyDesc .' '. $my_address->citymunDesc . ', ' . $my_address->region_desc .' '. $my_address->postal_code}}</p>
                        
                        </div>
                    </a>
                    <a id="btnVouchers" data-toggle="modal" data-target="#vouchersModal">
                        <div class="custom-card free-shipping ">
                            <div class="arrow pull-right" style="font-size: 20px !important">&#62;</div>
                            <h6 style="padding-top:5px"> <i class="	fas fa-ticket-alt"></i> Platform vouchers</h6>
                        </div>
                    </a>
                    <div class="custom-card payment">
                        <span style="font-weight: bold">Payment method</span><br>
                        @foreach($payment_type as $payment)
                            <label style="cursor: pointer"> 
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
                    
                    <hr>
                </div>
              
                <div class="col-md-6">
                    <div class="fixed" style="border-left: 1px solid #b0adad">
                        @foreach($my_cart_detail as $cart)
                            <input type="hidden" value="{{csrf_token()}}" name="_token" id="token">
                            <input type="hidden" value="{{$cart->cart_id}}" name="cart_id" id="cart_id{{$cart->cart_id}}">
                            
                            <div class="shopping-cart-pay" >
                                <div class="item-cart">
                                    <div class="image">
                                        <img src="{{URL::to('vendor/crudbooster/inventory_images').'/'.$cart->file_name}}" alt="" height="100" width="100">
                                    </div>
                                    
                                    <div class="description">
                                        <span style="color: #000">{{$cart->flower_name}}</span>
                                        <span style="font-size: 12px">{{$cart->item_description}}</span>
                                    </div>
                                    
                                    <div class="quantity">
                                        <input type="text" class="qty" name="name" value="{{$cart->quantity}}" data-id="{{$cart->cart_id}}">
                                    </div>
                                    <div class="price">
                                        <input type="hidden" class="total-price-hidden" value="{{$cart->cart_price}}" id="totalPrice{{$cart->cart_id}}">
                                        <span data-id="{{$cart->cart_id}}">₱{{$cart->cart_price}}</span>
                                    </div>
                                </div>
                                <div class="standard_shipping" style="padding-left: 30px; padding-top:30px;">
                                    <div class="form-group">
                                        <label>Standard shipping</label>
                                        <input type="hidden" value="{{$cart->standard_shipping}}" class="shipping">
                                        <label class="pull-right" id="isShipping" style="margin-right: 10%">₱{{number_format($cart->standard_shipping,2)}}</label><br>
                                        <label><i class="fa fa-clock"></i> Estimated delivery</label>
                                        <label class="pull-right" style="margin-right: 7%">test date</label>
                                    </div>
                                    
                                </div>
                               
                            </div>
                            
                        @endforeach
                        <div class="title" style="color: black; ">
                            <h5>Order summary</h5>
                            Subtotal: <input type="hidden" id="hidden-subtotal"> <span id="price" class="pull-right">₱0</span><br>
                            Shipping: <input type="hidden" id="hidden-shipping"> <span id="shipping" class="pull-right">₱0</span><br>
                            Total: <span id="totalPrice" class="pull-right">₱0</span>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="button-area mt-3">
                <div class="footer text-center">
                    <p class="text-center">By replacing an order, you agree to the <span style="color:#000;font-style:bold"><a href="">Shop Terms of Use and Sale</a></span> and acknowledge that you have read the <span style="color:#000;font-style:bold"><a href="">Shop Privacy Policy.</a><span></p>
                </div>
                <div class="check-area">
                    <button type="submit" class="btn btn-primary btn-lg font-weight-medium auth-form-btn" id="add-to-cart"><span class="mr-2 icon-payment"></span>Pay</button>
                </div>
            </div>
            
            {{-- MODAL ADDRESS AREA --}}
            <div class="modal fade" id="addressModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Select Address</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="myAddresses custom-card">
                                @foreach ($my_all_address as $item)
                                <label style="cursor: pointer; color:">
                                    <h5><input type="radio" class="address" name="address" value="{{$item->add_id}}" data-id="{{$item->add_id}}"> {{ $item->fullname }} | {{ $item->phone_number }}</h5>
                                    <span style="margin-left: 20px">
                                        <p style="margin-left: 25px">{{ $item->house_no .' '. $item->brgyDesc .' '. $item->citymunDesc . ', ' . $item->region_desc .' '. $item->postal_code}}</p>
                                        @if($item->is_default)
                                            <button style="margin-left: 25px" class="btn btn-outline-primary">Default</button>
                                        @endif
                                    </span>
                                </label>
                                    <hr>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- MODAL VOUCHERS AREA --}}
            <div class="modal fade" id="vouchersModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="vouchersModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Select Vouchers</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="background:#DDD !important">
                           
                                <div class="container">
                                    @foreach($vouchers as $voucher)
                                        <div class="item" data-id={{$voucher->id}}>
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
                                            <input type="radio" class="vouchers_id pull-right" name="voucher_id" value="{{$voucher->id}}" data-id="{{$voucher->id}}">
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
                    </div>
                </div>
            </div>
        </form>
    </section>

@section('script-js')
  <script>
    $(document).ready(function(){
        $('#price').text(`₱${calculatePrice().toFixed(2)}`);
        $('#hidden-subtotal').val(calculatePrice().toFixed(2));
        $('#shipping').text(`₱${calculateShipping().toFixed(2)}`);
        $('#hidden-shipping').val(calculateShipping().toFixed(2));
        $('#totalPrice').text(`₱${calculateTotalPrice().toFixed(2)}`);

        $('input:radio[name="address"]').on('change',function() {
            const selectedValue = $(this).val();
            $.ajax({
                url:"{{ route('selected-address')}}",
                type:"POST",
                dataType:'json',
                data:{
                    _token:"{{csrf_token()}}",
                    selectedId: selectedValue,
                },
                success:function(res){
                    appendAddress(res.items);
                    $("#addressModal .close").click()
                },
                error:function(res){
                    alert('Failed')
                },
            });
        });

        $('.item').on("click", function(){
            const id = $(this).attr('data-id');
            $('input:radio[data-id="'+id+'"]').prop('checked', true);
        });

    });

    function appendAddress(data){
        console.log(data);
        $('.address').empty();
        const new_address = `
            <input type="hidden" name="address_id" id="address_id" value="${data.add_id}">
            <div class="arrow pull-right" style="margin-top: 20px; !important; font-size: 25px !important">&#62;</div>
            <h5>${data.fullname } | ${data.phone_number}</h5>
            <p>${data.house_no +' '+ data.brgyDesc +' '+ data.citymunDesc + ', ' + data.region_desc +' '+ data.postal_code}</p>
        `;
        $('.address').append(new_address);
    }
  
    function calculatePrice() {
        let totalQuantity = 0;
        $('.total-price-hidden').each(function() {
            let qty = 0;
            if($(this).val().trim()) {
                qty = parseInt($(this).val().replace(/,/g, ''));
            }

            totalQuantity += qty;
        });
        return totalQuantity;
    }

    function calculateShipping() {
        let totalShipping = 0;
        $('.shipping').each(function() {
            let value = 0;
            if($(this).val().trim()) {
                value = parseInt($(this).val().replace(/,/g, ''));
            }
            totalShipping += value;
        });
        return totalShipping;
    }

    function calculateTotalPrice() {
        let totalPrice = 0;
        
        let price = 0;
        if($('#hidden-subtotal').val().trim()) {
            price = parseInt($('#hidden-subtotal').val().replace(/,/g, '')) + parseInt($('#hidden-shipping').val().replace(/,/g, ''));
        }
        totalPrice += price;
        return totalPrice;
    }
  </script>
@endsection


