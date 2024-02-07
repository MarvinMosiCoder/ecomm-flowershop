@extends('crudbooster::admin_template')
@push('head')
<style type="text/css">   
    .select2-selection__choice{
            font-size:14px !important;
            color:black !important;
    }
    .select2-selection__rendered {
        line-height: 31px !important;
    }
    .select2-container .select2-selection--single {
        height: 35px !important;
    }
    .select2-selection__arrow {
        height: 34px !important;
    }
    .firstRow {
        padding: 10px;
        margin-left: 10px;
    }

    .binput {
    border:none;
    border-bottom: 1px solid rgba(18, 17, 17, 0.5);
    }

    input.binput:read-only {
        background-color: #fff;
    }
   
</style>
@endpush
@section('content')
<!-- link -->
@if(g('return_url'))
	<p class="noprint"><a title='Return' href='{{g("return_url")}}'><i class='fa fa-chevron-circle-left '></i> &nbsp; {{trans("crudbooster.form_back_to_list",['module'=>CRUDBooster::getCurrentModule()->name])}}</a></p>       
@else
	<p class="noprint"><a title='Main Module' href='{{CRUDBooster::mainpath()}}'><i class='fa fa-chevron-circle-left '></i> &nbsp; {{trans("crudbooster.form_back_to_list",['module'=>CRUDBooster::getCurrentModule()->name])}}</a></p>       
@endif
  <div class='panel panel-default'>
    <div class='panel-heading'>  
        Add Sales Form
    </div>
    <form action='{{CRUDBooster::mainpath('add-save')}}' method="POST" id="addSales" enctype="multipart/form-data">
        <input type="hidden" value="{{csrf_token()}}" name="_token" id="token">
          
    <div class='panel-body'>    
    <section id="loading">
        <div id="loading-content"></div>
    </section>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label"><span style="color:red">*</span> Item</label>
                    <select required selected data-placeholder="Choose item" name="inv_id" id="inv_id" class="form-select select2" style="width:100%;">
                        @foreach($items as $res)
                            <option value=""></option>
                            <option value="{{ $res->id }}">{{ $res->flower_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label"><span style="color:red">*</span> Price</label>
                    <input type="text" class="form-control binput" placeholder="Price" name="price" id="price" readonly>
                    <input type="hidden" class="form-control" id="defaultPrice">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label"><span style="color:red">*</span> Stock</label>
                    <input type="text" class="form-control binput" placeholder="Stock" id="stock" readonly>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label"><span style="color:red">*</span> Quantity</label>
                    <input class="form-control binput" type="text" placeholder="Quantity" name="quantity" id="quantity">
                    <div id="error" style="display:none">
                       <span id='notif' class='label label-danger'> Quantity Exceed to stock!</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label"><span style="color:red">*</span> Payment Type</label>
                    <select required selected data-placeholder="Choose Payment Type" name="payment_type" id="payment_type" class="form-select select2" style="width:100%;">
                        @foreach($payment_type as $res)
                            <option value=""></option>
                            <option value="{{ $res->payment_name }}">{{ $res->payment_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div> 
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label"><span style="color:red">*</span> Customet Name</label>
                    <input class="form-control binput" type="text" placeholder="Customer Name" name="customer_name" id="customer_name">
                </div>
            </div> 
            {{-- <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label"><span style="color:red">*</span> Date of Purchase</label>
                    <input class="form-control binput date" type="text" placeholder="Date of Purchase" name="date_of_purchase" id="date_of_purchase">
                </div>
            </div>  --}}
        </div>
    </div>
    
    <hr>

    </div>
    <div class='panel-footer'>
        <a href="{{ CRUDBooster::mainpath() }}" class="btn btn-default"> Cancel</a>
        <button class="btn btn-primary pull-right" type="submit" id="btnSubmit"> <i class="fa fa-save" ></i> Save</button>
    </div>
    </form>
  </div>
@endsection
@push('bottom')
    <script type="text/javascript">
        function preventBack() {    
            window.history.forward();
        }
         window.onunload = function() {
            null;
        };
        setTimeout("preventBack()", 0);
        $('.select2').select2({});
        $(".date").datetimepicker({
            viewMode: "days",
            format: "YYYY-MM-DD",
            dayViewHeaderFormat: "MMMM YYYY",
        });
       
        //ITEM CHAANGE
        $('#inv_id').change(function(){
            var inv_id =  this.value;
            $.ajax
                ({ 
                    type: 'POST',
                    url: "{{ route('get.inventory.price') }}",
                    data: {
                        "id": inv_id
                    },
                    success: function(result) {
                        console.log(result.price);
                        $('#price').val(result.price);   
                        $('#stock').val(result.stock);   
                        $('#defaultPrice').val(result.price);   
                    }
            });
        });

        //multiply price by qty
        $("#quantity").on("keyup", function(e) {
            var qty = parseInt($(this).val());
            var current_price = $('#price').val() * qty;
            if (e.keyCode === 8) {
                $('#price').val($('#defaultPrice').val());
                if(qty > $('#stock').val()){
                    $("#error").show();
                    $('#btnSubmit').attr('disabled',true);
                }else{
                    $("#error").hide();
                    $('#btnSubmit').attr('disabled',false);
                }
                return false;
            }else{
                $('#price').val(current_price);
                if(qty > $('#stock').val()){
                    $("#error").show();
                    $('#btnSubmit').attr('disabled',true);
                }else{
                    $("#error").hide();
                    $('#btnSubmit').attr('disabled',false);
                }
            }

            if(qty > $('#stock').val()){
                $("#error").show();
                $('#btnSubmit').attr('disabled',true);
            }else{
                $("#error").hide();
                $('#btnSubmit').attr('disabled',false);
            }
            
        });

        $("#removeImageHeader").click(function(e) {
            e.preventDefault(); // prevent default action of link
            $('.header_images').attr('src', ""); //clear image src
            $("#image").val(""); // clear image input value
            $('.header_images').remove();
            $("#removeImageHeader").toggle(); // hide remove link.
        });
        $("#btnSubmit").click(function(event) {
            event.preventDefault();
            if ($('#inv_id').val() === "") {
                swal({
                    type: 'error',
                    title: 'Please select Item!',
                    icon: 'error',
                    confirmButtonColor: "#367fa9",
                }); 
            }else if ($('#quantity').val() === "") {
                swal({
                    type: 'error',
                    title: 'Quantity required!',
                    icon: 'error',
                    confirmButtonColor: "#367fa9",
                }); 
            }else if ($('#payment_type').val() === "") {
                swal({
                    type: 'error',
                    title: 'Please choose payment!',
                    icon: 'error',
                    confirmButtonColor: "#367fa9",
                }); 
            }else if ($('#customer_name').val() === "") {
                swal({
                    type: 'error',
                    title: 'Customer name required!',
                    icon: 'error',
                    confirmButtonColor: "#367fa9",
                }); 
            }
            // else if ($('#date_of_purchase').val() === "") {
            //     swal({
            //         type: 'error',
            //         title: 'Date of purchase required!',
            //         icon: 'error',
            //         confirmButtonColor: "#367fa9",
            //     }); 
            // }
            else{
                swal({
                    title: "Are you sure?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#41B314",
                    cancelButtonColor: "#F9354C",
                    confirmButtonText: "Yes, send it!",
                    width: 450,
                    height: 200
                    }, function () {
                        $("#addSales").submit();                                                   
                });
            }
           
        });

    </script>
@endpush