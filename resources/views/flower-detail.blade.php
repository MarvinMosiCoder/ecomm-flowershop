@extends('guest-frontend.guest-content')
@section('content')
    <section class="details" id="details">
        <div class="topMenu" style="display: none">
            <div class="row">
                <div class="col-md-6">
                    <span class="close">X</span>
                    <h3> <i class="fa fa-check"></i> ADDED TO YOUR CART</h3>
                </div>
                <div class="col-md-6">
                    Cart Subtotal P600
                </div>
            </div>
        </div>
        <form action="" id="addToCartForm">
            @csrf
            <input type="hidden" value="{{csrf_token()}}" name="_token" id="token">
            <input type="hidden" value={{$flowers->id}} name="inv_id" id="inv_id">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{URL::to('vendor/crudbooster/inventory_images').'/'.$flowers->file_name}}" alt="" height="300" width="500">
                </div>
                <div class="col-md-6">
                    <div class="content-details">
                        <h1>{{$flowers->flower_name}}</h1>
                        <div class="price">  
                            ₱{{abs(number_format((($flowers->percent_sale/100) * $flowers->price)  - $flowers->price, 2, '.', ''))}} 
                            @if($flowers->percent_sale != 0) <span>₱{{$flowers->price}}</span> @endif
                        </div>
                        <div class="add-to-cart-section mb-2">
                            <select name="quantity" id="quantity" class="form-select" style="width: 20%; margin-top:10px">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                            <button type="submit" class="btn btn-primary btn-lg font-weight-medium auth-form-btn" id="add-to-cart">Add to cart</button>
                            <button type="submit" class="btn btn-primary btn-lg font-weight-medium auth-form-btn" id="add-to-cart">Buy now</button>
                        <div class="description">
                        <p>{{$flowers->item_description}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <!-- review section starts  -->

    <section class="review" id="review">

        <h1 class="heading"> customer's <span>review</span> </h1>
        
        <div class="box-container">
        
            <div class="box">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti asperiores laboriosam praesentium enim maiores? Ad repellat voluptates alias facere repudiandae dolor accusamus enim ut odit, aliquam nesciunt eaque nulla dignissimos.</p>
                <div class="user">
                    <img src="images/pic-1.png" alt="">
                    <div class="user-info">
                        <h3>john deo</h3>
                        <span>happy customer</span>
                    </div>
                </div>
                <span class="fas fa-quote-right"></span>
            </div>
        
            <div class="box">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti asperiores laboriosam praesentium enim maiores? Ad repellat voluptates alias facere repudiandae dolor accusamus enim ut odit, aliquam nesciunt eaque nulla dignissimos.</p>
                <div class="user">
                    <img src="images/pic-2.png" alt="">
                    <div class="user-info">
                        <h3>john deo</h3>
                        <span>happy customer</span>
                    </div>
                </div>
                <span class="fas fa-quote-right"></span>
            </div>
        
            <div class="box">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti asperiores laboriosam praesentium enim maiores? Ad repellat voluptates alias facere repudiandae dolor accusamus enim ut odit, aliquam nesciunt eaque nulla dignissimos.</p>
                <div class="user">
                    <img src="images/pic-3.png" alt="">
                    <div class="user-info">
                        <h3>john deo</h3>
                        <span>happy customer</span>
                    </div>
                </div>
                <span class="fas fa-quote-right"></span>
            </div>
        
        </div>
            
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
    
    $(document).ready(function(){
       
        $("#add-to-cart").click(function(e) {
            var modal = document.getElementById("myModal");
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
            });
            $.ajax({
                data: $('#addToCartForm').serialize(),
                url: "{{ route('add.to.cart') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if (data.status == 'success') {
                        $('.topMenu').fadeIn();
                        if($("#countCart").val() === ""){
                            $("#countCart").html(data.count);
                        }else{
                            parseInt($("#countCart").val())+data.count;
                        }
                    } else if (data.status == 'error') {
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
        $(".close").click(function(e) {
            $('.topMenu').fadeOut();
        });
    });
</script>
@endsection


