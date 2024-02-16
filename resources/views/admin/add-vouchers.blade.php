@extends('crudbooster::admin_template')
@push('head')
<style type="text/css">   
    .select2-selection__choice{
            font-size:14px !important;
            /* color:black !important; */
            color: #fff !important;
    }
    .select2-selection__rendered {
        line-height: 31px !important;
        background-color: #fff !important;
    }
    .select2-container .select2-selection--single {
        height: 35px !important;
        background-color: #fff !important;
    }
    .select2-selection__arrow {
        height: 34px !important;
        background-color: #fff !important;
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
        Assets Inventory Form
    </div>
    <form action='{{CRUDBooster::mainpath('add-save')}}' method="POST" id="InventoryForm" enctype="multipart/form-data">
        <input type="hidden" value="{{csrf_token()}}" name="_token" id="token">
        <div class='panel-body'>    
        <section id="loading">
            <div id="loading-content"></div>
        </section>
        <div class="row">
            <div class="col-md-12">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label"><span style="color:red">*</span> Voucher Type</label>
                    <select required selected data-placeholder="Choose Flower Type" name="flower_type" id="flower_type" class="form-select select2" style="width:100%;">
                       
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label"><span style="color:red">*</span> Voucher From</label>
                    <select required selected data-placeholder="Choose Flower Type" name="flower_type" id="flower_type" class="form-select select2" style="width:100%;">
                       
                    </select>
                </div>
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label"><span style="color:red">*</span>  Voucher Name</label>
                    <input type="text" class="form-control binput" style="" placeholder="Item Description" name="item_description" id="item_description">
                </div>
            </div>   
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label"><span style="color:red">*</span> Minimum Spend</label>
                    <input class="form-control binput" type="text" placeholder="Price" name="price" id="price">
                </div>
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label"><span style="color:red">*</span> Percentage</label>
                        <input class="form-control binput" type="text" placeholder="Percentage Sale" name="percent_sale" id="percent_sale">
                    </div>
                </div>    
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label"><span style="color:red">*</span> Image</label>
                        <input type="file" class="form-control binput" style="" name="image[]" id="image" multiple accept="image/png, image/gif, image/jpeg">
                        <div class="gallery" style="margin-bottom:5px; margin-top:15px"></div>
                        <a class="btn btn-xs btn-danger" style="display:none; margin-left:10px" id="removeImageHeader" href="#"><i class="fa fa-remove"></i></a>
                    
                    </div>
                </div>  
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label"><span style="color:red">*</span> Start Date</label>
                        <input class="form-control binput" type="date" placeholder="Percentage Sale" name="percent_sale" id="percent_sale">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label"><span style="color:red">*</span> Start End</label>
                        <input class="form-control binput" type="date" placeholder="Percentage Sale" name="percent_sale" id="percent_sale">
                    </div>
                </div>
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
        $('.select2').select2({});
        setTimeout("preventBack()", 0);

        $(function() {
        // Multiple images preview in browser
        var imagesPreview = function(input, placeToInsertImagePreview) {

            if (input.files) {
                var filesAmount = input.files.length;

                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        $($.parseHTML('<img height="120px" class="header_images" width="180px;" hspace="10" data-action="zoom">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }

        };

            $('#image').on('change', function() {
                imagesPreview(this, 'div.gallery');
                $("#removeImageHeader").toggle(); 
            });
        });
        $("#removeImageHeader").click(function(e) {
            e.preventDefault(); // prevent default action of link
            $('.header_images').attr('src', ""); //clear image src
            $("#image").val(""); // clear image input value
            $('.header_images').remove();
            $("#removeImageHeader").toggle(); // hide remove link.
        });
        $("#btnSubmit").click(function(event) {
            e.preventDefault();
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
                    $("#InventoryForm").submit();                                                   
            });
        });

    </script>
@endpush