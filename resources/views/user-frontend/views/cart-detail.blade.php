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
        <h3>Your Cart</h3>
        <form action="{{ route('submit-checkout') }}" method="POST" id="checkOutCart">
            <div class="title text-center">
                Your Cart
            </div>
            <div class="checkbox-area">
                <span><input type="checkbox" id="checkAll"> Select all</span>
            </div>
            @if($my_cart_detail->isNotEmpty())
                @foreach($my_cart_detail as $cart)
                    <input type="hidden" value="{{csrf_token()}}" name="_token" id="token">
                    {{-- <input type="hidden" value="{{$cart->cart_id}}" name="cart_id" id="cart_id{{$cart->cart_id}}"> --}}
                    
                    <div class="shopping-cart">
                        <div class="item">
                            <div class="buttons">
                                <span class="check-btn"> <input type="checkbox" name="cart_id[]" value="{{$cart->cart_id}}" class="form-check-input check" > </span>
                            </div>
                        
                            <div class="image">
                                <img src="{{URL::to('vendor/crudbooster/inventory_images').'/'.$cart->file_name}}" alt="" height="100" width="100">
                            </div>
                            
                            <div class="description">
                                <span>{{$cart->flower_name}}</span>
                                <span>{{$cart->item_description}}</span>
                                <span>White</span>
                            </div>
                            
                            <div class="quantity">
                                <button class="minus-button" type="button" name="button" id="minus-id{{$cart->cart_id}}" data-id="{{$cart->cart_id}}">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <input type="text" class="qty" name="name" value="{{$cart->quantity}}" data-id="{{$cart->cart_id}}">
                                <button class="plus-button" type="button" name="button" id="plus-id{{$cart->cart_id}}" data-id="{{$cart->cart_id}}">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                            <input type="hidden" class="total-price-hidden" value="{{$cart->cart_price}}" id="totalPrice{{$cart->cart_id}}">
                            <div class="total-price" data-id="{{$cart->cart_id}}">₱{{$cart->cart_price}}</div>
                    
                            <div class="deletes">
                                <span class="deletes-btn"><a type="button" data-id="{{$cart->cart_id}}" value="{{$cart->cart_id}}" class="removeCart"> <i class="fa fa-times-circle"></i> </a></span>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="title text-center" style="color: black">
                    Subtotal: <span id="totalQty">0</span>
                </div>
                <div class="submit-area">
                    <button type="submit" class="btn btn-primary btn-lg font-weight-medium auth-form-btn" id="add-to-cart"> <span class="mr-2 icon-shopping-cart"></span> Checkout</button>
                </div>
            @else
                    <div class="text-center">
                        No Orders
                    </div>
            @endif
        </form>
    </section>

@section('script-js')
    {{-- <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script> --}}

    <script type="text/javascript">
        function preventBack() {    
            window.history.forward();
        }
        window.onunload = function() {
            null;
        };
        setTimeout("preventBack()", 0);
        $(document).ready(function(){
            isEqualOne();
            $('#totalQty').text(`₱${calculateTotalPrice()}`);
            $('.removeCart').on('click', function(e) {
                e.preventDefault();
                var id = $(this).attr('data-id');
                var token = $('#token').val();
               
                $.ajaxSetup({
                    headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                });
                $.ajax({
                    url: "{{ route('remove.to.cart') }}",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        _token: token,
                        id: id
                    },
                    success: function (data) {
                        console.log(data.count);
                        if (data.status == "success") {
                            if($("#countCart").val() === ""){
                                jQuery("#countCart").html(data.count);
                            }else{
                                parseInt($("#countCart").val())+data.count;
                            }
                            Swal.fire({
                                type: data.status,
                                title: data.msg,
                                icon:'success'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });  
                        } else if (data.status == "error") {
                            Swal.fire({
                                type: data.status,
                                title: data.msg,
                                icon:'error'
                            });
                        }
                    
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });     
            
            });   
        });

        //CHECKBOX
        $('#checkAll').change(function() {
            if(this.checked) {
                $(".check").prop("checked", true);
            }
            else{
                $(".check").prop("checked", false);
            }
        });

        //SUBMIT
        $("#add-to-cart").click(function(event) {
            event.preventDefault();
            var Ids = [];
            $.each($('input[name="cart_id[]"]:checked'), function(){
                Ids.push($(this).val());
            });
            var token = $('#token').val();
            var check = $('input:checkbox:checked').length;
            
            if (check == 0) {
                Swal.fire({
                    type: 'error',
                    title: 'Please select checkout!',
                    icon: 'error',
                    confirmButtonColor: "#367fa9",
                }); 
                event.preventDefault(); 
            }else{
                $('#checkOutCart').submit(); 
            }

        });
    
        $('.minus-button').on('click', function(e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            const input = $('.item');
            const qty = input.find('input[data-id="'+id+'"]');
            const newQty = parseInt(qty.val()) - 1;
            if(qty){
                qty.val(newQty);
            }
            var token = $('#token').val();
            $.ajax({
                url: "{{ route('less.qty.cart') }}",
                type: "POST",
                dataType: 'json',
                data: {
                    _token: token,
                    id: id
                },
                success: function (data) {
                    if (data.status == "success") {
                        const input = $('.item');
                        const qty = input.find('div[data-id="'+data.item.id+'"]');
                        const price = input.find('input[id="totalPrice'+data.item.id+'"]');
                        if(qty){
                            qty.text(`₱${data.item.price}`);
                        }
                        if(price){
                            price.val(data.item.price);
                            $('#totalQty').text(`₱${calculateTotalPrice()}`);   
                        }
                    } 
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });  
            isEqualOne();
            $('#totalQty').text(`₱${calculateTotalPrice()}`);

        });
        
        $('.plus-button').on('click', function(e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            const input = $('.item');
            const qty = input.find('input[data-id="'+id+'"]');
            const newQty = parseInt(qty.val()) + 1;
            if(qty){
                qty.val(newQty);
            }
        
            var token = $('#token').val();
            $.ajax({
                url: "{{ route('add.qty.cart') }}",
                type: "POST",
                dataType: 'json',
                data: {
                    _token: token,
                    id: id
                },
                success: function (data) {
                    if (data.status == "success") {
                        const input = $('.item');
                        const qty = input.find('div[data-id="'+data.item.id+'"]');
                        const price = input.find('input[id="totalPrice'+data.item.id+'"]');
                        if(qty){
                            qty.text(`₱${data.item.price}`);
                        }
                        if(price){
                            price.val(data.item.price);
                            $('#totalQty').text(`₱${calculateTotalPrice()}`);   
                        }
                    } 
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });  
            isEqualOne();
            $('#totalQty').text(`₱${calculateTotalPrice()}`);
        });

        function isEqualOne(){
            const inputs = $('.qty').get();
            let disabled = true;
            inputs.forEach(input => {
                const currentVal = $(input).val();
                const id = $(input).attr('data-id'); 
                if(currentVal <= 1) {
                    disabled = true;
                }else{
                    disabled = false;
                }
                $('#minus-id'+id).attr('disabled',disabled);
            });
        }

        function calculateTotalPrice() {
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

    </script>
@endsection


