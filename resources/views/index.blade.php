@extends('guest-frontend.guest-content')
@section('css')
<style>
    .page-item.active .page-link{
        z-index: 3;
        color: #fff !important  ;
        background-color: #E36176 !important;
        border-color: #E36176 !important;
        border-radius: 50%;
        padding: 6px 12px;
    }
    .page-link{
        z-index: 3;
        color: #E36176 !important;
        background-color: #fff;
        border-color: #007bff;
        border-radius: 50%;
        padding: 6px 12px !important;
    }
    .page-item:first-child .page-link{
        border-radius: 30% !important;
    }
    .page-item:last-child .page-link{
        border-radius: 30% !important;   
    }
    .pagination li{
        padding: 3px;
    }
    .disabled .page-link{
        color: #212529 !important;
        opacity: 0.5 !important;
    }
</style>
@section('content')
<!-- home section starts  -->

<section class="home" id="home">
    <div class="content">
        <h3>Products</h3>
    </div>
</section>

<!-- home section ends -->
<!-- prodcuts section starts  -->

<section class="products" id="products">
    {{-- <h1 class="heading"> latest <span>products</span> </h1>
    @if($flowers->isNotEmpty())  
       
        <div class="box-container">
            @foreach($flowers as $flower)
                <div class="box">
                    @if($flower->percent_sale != 0)
                    <span class="discount">{{$flower->percent_sale}}%</span>
                    @endif
                    <div class="image">
                        <a href="{{ url('flowershop/details'.$flower->id) }}">
                          <img src="{{URL::to('vendor/crudbooster/inventory_images').'/'.$flower->file_name}}" alt="">
                        </a>
                    </div>
               
                    <div class="content">
                        <h3><a class="alink" href="{{ url('flowershop/details'.$flower->id) }}">{{$flower->flower_name}}</a></h3>
                        <h3><a class="alink" href="{{ url('flowershop/details'.$flower->id) }}">{{$flower->item_description}}</a></h3>
                        <div class="price">  
                            ₱{{abs(number_format((($flower->percent_sale/100) * $flower->price)  - $flower->price, 2, '.', ''))}} 
                            @if($flower->percent_sale != 0) <span>₱{{$flower->price}}</span> @endif
                        </div>
                    </div>
             
                </div>
            @endforeach
        </div>
    
    @else
     <h2 style="text-align:center">No Available Products</h2>
    @endif
    <br>
    <div class="d-flex justify-content-center">
        {!! $flowers->links() !!}
    </div> --}}
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-2 _leftNav mb-30">

                <div class="card leftNav cate-sect mb-30">
                    <h3>Refine By:<span class="_t-item">(0 items)</span></h3>
                    <div class="col-12 p-0" id="catFilters"></div>
                </div>

                <div class="card leftNav cate-sect">

                    <div class="accordion" id="accordionExample">
                        <div class="card-header" id="headingTwo">
                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                Categories</button>
                        </div>

                        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo"
                        data-parent="#accordionExample">
                        <div class="panel-body">

                            <?php $counter=0; ?>
                            @if(!empty($main_category))
                            @foreach ($main_category as $category)
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox"
                                    attr-name="{{$category->description}}"
                                    class="custom-control-input category_checkbox" id="{{$category->id}}">
                                <label class="custom-control-label"
                                    for="{{$category->id}}">{{ucfirst($category->description)}}</label>
                            </div>
                            <?php $counter++; ?>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-10 mb-30">
                <div class="card rightSide h-100 mb-0">
                    <h1><span class="greencolor category_name_heading" id="headerTitle"></span></h1>
                    <div class="row causes_div">
                        @foreach($flowers as $flower)
                        {{-- @if($flower->percent_sale != 0)
                            <span class="discount">{{$flower->percent_sale}}%</span>
                        @endif --}}
                        <div class="col-lg-3">
                            <div class="card" style="width: 100%;height:90%">
                                <div class="img-card" style="width: 100%;height:100%">
                                    <a href="{{ url('flowershop/details/'.$flower->inv_id) }}">
                                        @if($flower->file_name)
                                            <img style="width:100%; height:100%" class="card-img-top" src="{{URL::to('vendor/crudbooster/inventory_images').'/'.$flower->file_name}}" alt="Card image cap">
                                        @else
                                            <img style="width:100%; height:100%" class="card-img-top" src="{{URL::to('images/default-image.jpg')}}" alt="Card image cap">
                                        @endif
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="content">
                                        <h3><a class="alink" href="{{ url('flowershop/details'.$flower->inv_id) }}">{{$flower->flower_name}}</a></h3>
                                        <div class="price">  
                                            ₱{{abs(number_format((($flower->percent_sale/100) * $flower->price)  - $flower->price, 2, '.', ''))}} 
                                            @if($flower->percent_sale != 0) <span>₱{{$flower->price}}</span> @endif
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        </div>
                        @endforeach
                    </div>
                </div>
                <br>
                <div class="d-flex justify-content-center">
                    {!! $flowers->links() !!}
                </div>
            </div>
        </div>
    </div>
    
</section>

@section('script-js')
<script type="text/javascript">
    var APP_URL = {!! json_encode(url('/')) !!}
    $(document).ready(function() {
        $(document).on('click', '.category_checkbox', function () {

            var ids = [];

            var counter = 0;
            $('#catFilters').empty();
            $('.category_checkbox').each(function () {
                if ($(this).is(":checked")) {
                    ids.push($(this).attr('id'));
                    $('#catFilters').append(`<div class="alert fade show alert-color _add-secon" role="alert"> ${$(this).attr('attr-name')}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> </div>`);
                    counter++;
                }
            });

            $('._t-item').text('(' + ids.length + ' items)');

            if (counter == 0) {
                // $('.causes_div').empty();
                // $('.causes_div').append('No Data Found');
                fetchProductDetails();
            } else {
                fetchProductDetails(ids);
            }
            
        });

    });

    function fetchProductDetails(id) {

        $('.causes_div').empty();
        let ids = 0;
        if(id != null){
            ids = id
        }else{
            ids = 0;
        }
        $.ajax({
            type: 'GET',
            url: 'get_product_details/' + ids,
            success: function (response) {
                var response = JSON.parse(response);
                const img_url = APP_URL+'/vendor/crudbooster/inventory_images/';
                const detail_url = APP_URL+'/flowershop/details/';
            
                if(response.length == 0){
                    $('.causes_div').append('<div class="col-lg-12 mt-4 text-center">No Data Found</div>');
                }else{
                    response.forEach(element => {
                        var discountedPrice = ((element.percent_sale / 100) * element.price) - element.price;
                        // Format the discounted price to 2 decimal places
                        var formattedDiscount = Math.abs(Number.parseFloat(discountedPrice).toFixed(2));
                        if(element.percent_sale != 0){
                            var percentage = element.price;
                        }
                        $('.causes_div').append(`
                        <div class="col-lg-3">
                            <div class="card" style="width: 100%;height:90%">
                                <div class="img-card" style="width: 100%;height:100%">
                                        <a href="${detail_url+element.inv_id}">
                                            <img style="width:100%; height:100%" src="${img_url}${element.file_name}" alt="" />
                                        </a>
                                    
                                </div>
                                <div class="card-body">
                                    <div class="content">
                                        <h3><a class="alink" href="${detail_url+element.inv_id}">${element.flower_name}</a></h3>
                                        <div class="price">  
                                            ₱${formattedDiscount}
                                            <span>₱${percentage}</span> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`);
                    });
                }
            }
        });
    }

    $('.right-cta-menu').on('click', '.search-toggle', function(e) {
        var selector = $(this).data('selector');

        $(selector).toggleClass('show').find('.search-input').focus();
        $(this).toggleClass('active');

        e.preventDefault();
    });
</script>

@endsection