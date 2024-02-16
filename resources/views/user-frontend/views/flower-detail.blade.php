@extends('user-frontend.components.content')
@section('css')
<style>
    .move-to-cart{
        position:absolute;
        height:200px;
        width:200px;
        z-index:9999;
    }
    .animate{
      opacity:1;
      height:75px;
      width:75px;
      transition:all 0.5s ease-in-out;
    }
    .hide-img{
      opacity:0.5;
      width:0;
      height:0;
      margin-left:75px;
      transition:all .5s ease-in-out;
    }
    .topMenu{
        width: 100%;
        height: 200px;
        background-color: #fff;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        z-index: 99999;
        margin-bottom: 0;
        bottom: 0
    }
</style>
@section('content')

    <section class="details" id="details">
        <form action="" id="addToCartForm">
            @csrf
            <input type="hidden" value="{{csrf_token()}}" name="_token" id="token">
            <input type="hidden" value={{$flowers->id}} name="inv_id" id="inv_id">
            <div class="row">
                <div class="item col-md-6">
                    <img src="{{URL::to('vendor/crudbooster/inventory_images').'/'.$flowers->file_name}}" alt="" height="300" width="300">
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
                        
                        <div class="description mt-4">
                            <p style="color: #203d48; font-size: 16px">{{$flowers->item_description}}</p>
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
            $.ajax({
                data: $('#addToCartForm').serialize(),
                url: "{{ route('add.to.cart') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if (data.status == 'success') {
                        if($("#countCart").val() === ""){
                            $("#countCart").html(data.count);
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


