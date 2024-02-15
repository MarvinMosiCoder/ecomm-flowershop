@extends('user-frontend.components.content')
@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.css?v=2')}}">
<link rel="stylesheet" href="{{ asset('css/switch-checkbox.css')}}">

<style>
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
    .addresses{
        margin-top: 55px;
    }
    .modal{
        margin-top: 30px;
    }
    @media (max-width: 750px) {
        .addresses{
            margin-top: 85px;
        }
        .modal{
            margin-top: 40px;
        }
    }
   

</style>
@section('content')
    <section class="addresses" id="addresses">
        <h3 class="text-center">My Addresses</h3>
        <form action='#' method="POST" id="AddAddressForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{csrf_token()}}" name="_token" id="token">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="myAddresses custom-card">
                        @if($my_addresses->isNotEmpty())
                            @foreach ($my_addresses as $item)
                                <h5>{{ $item->fullname }} | {{ $item->phone_number }}</h5>
                                <p>{{ $item->house_no .' '. $item->brgyDesc .' '. $item->citymunDesc . ', ' . $item->region_desc .' '. $item->postal_code}}</p>
                                @if($item->is_default)
                                    <button class="btn btn-outline-primary">Default</button>
                                @endif
                                <hr>
                            @endforeach
                        @else
                            <div class="text-center">
                                No Address
                            </div>
                        @endif
                        
                    </div>
                    <div class="footer mt-2">
                        <a class="btn btn-primary text-white" id="btnAdd" data-toggle="modal" data-target="#addressModal"> <i class="fa fa-plus-circle"></i> Add New Address</a>
                    </div>
                </div>
            </div>
            
            <div class="modal fade" id="addressModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">New Address</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <label>Contact</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Fullname">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Phone Number">
                                </div>
                            </div>
                        
                            <label>Address</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select selected data-placeholder="Select your region" name="region" id="region" class="select2" style="width: 100%">
                                            @foreach ( $regions as $region )
                                                <option value=""></option>
                                                <option value="{{ $region->regCode }}">{{ $region->regDesc }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select selected data-placeholder="Select Province" class="select2" name="province" id="province" style="width: 100%">
                        
                                        </select>
                                    </div>
                                </div>
                            </div>
        
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select selected data-placeholder="Select City" class="select2" name="city" id="city" style="width: 100%">
                        
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select selected data-placeholder="Select Brgy" class="select2" name="brgy" id="brgy" style="width: 100%">
                        
                                        </select>
                                    </div>
                                </div>
                            </div>
        
                            <div class="form-group">
                                <input type="text" name="postal_code" id="postal_code" class="form-control" placeholder="Postal Code">
                            </div>
                            <div class="form-group">
                                <input type="text" name="house_no" id="house_no" class="form-control" placeholder="House No.">
                            </div>
        
                            <label>Setting</label>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Set as Default Address</label>
                                    <label class="switch pull-right">
                                        <input type="checkbox" value="1" name="is_default" id="is_default">
                                        <span class="slider round"></span>
                                    </label>
                                    
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Label As:</label>
                                    <div class="pull-right">
                                        <input type="radio" value="work" id="work" name="label_as">
                                        <label for="work" class="label_as">Work</label>
                                        <input type="radio" value="home" id="home" name="label_as">
                                        <label for="home" class="label_as">Home</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">  
                            <button type="button" class="btn btn-primary btn-block" id="addAddress">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <!-- Modal -->
   

@section('script-js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2();
        });
       
        //GET PROVINCE
        $('#province').attr('disabled', true);
        $('#region').on('change',function() {
            const selectedValue = $(this).val();
            $('#province').attr('disabled', false);
            $.ajax({
                url:"{{ route('getProvince')}}",
                type:"POST",
                dataType:'json',
                data:{
                    _token:"{{csrf_token()}}",
                    location_id: selectedValue,
                },
                success:function(res){
                    console.log(res);
                    populateProvince(res);
                },
                error:function(res){
                    alert('Failed')
                },
            });
        });

        function populateProvince(res){
            const result = res.items;
            var i;
            var showData = [];
            showData[0] = "<option value=''></option>";
            for (i = 0; i < result.length; ++i) {
                var j = i + 1;
                showData[j] = "<option value='"+result[i].provCode+"'>"+result[i].provDesc+"</option>";
            }
            $('#province').html(showData); 
           
        }

        //GET city
        $('#city').attr('disabled', true);
        $('#province').on('change',function() {
            const selectedValue = $(this).val();
            $('#city').attr('disabled', false);
            $.ajax({
                url:"{{ route('getCity')}}",
                type:"POST",
                dataType:'json',
                data:{
                    _token:"{{csrf_token()}}",
                    location_id: selectedValue,
                },
                success:function(res){
                    console.log(res);
                    populateCity(res);
                },
                error:function(res){
                    alert('Failed')
                },
            });
        });

        function populateCity(res){
            const result = res.items;
            var i;
            var showData = [];
            showData[0] = "<option value=''></option>";
            for (i = 0; i < result.length; ++i) {
                var j = i + 1;
                showData[j] = "<option value='"+result[i].citymunCode+"'>"+result[i].citymunDesc+"</option>";
            }
            $('#city').html(showData); 
           
        }

        //GET BRGY
        $('#brgy').attr('disabled', true);
        $('#city').on('change',function() {
            const selectedValue = $(this).val();
            $('#brgy').attr('disabled', false);
            $.ajax({
                url:"{{ route('getBrgy')}}",
                type:"POST",
                dataType:'json',
                data:{
                    _token:"{{csrf_token()}}",
                    location_id: selectedValue,
                },
                success:function(res){
                    console.log(res);
                    populateBrgy(res);
                },
                error:function(res){
                    alert('Failed')
                },
            });
        });

        function populateBrgy(res){
            const result = res.items;
            var i;
            var showData = [];
            showData[0] = "<option value=''></option>";
            for (i = 0; i < result.length; ++i) {
                var j = i + 1;
                showData[j] = "<option value='"+result[i].id+"'>"+result[i].brgyDesc+"</option>";
            }
            $('#brgy').html(showData); 
           
        }

        $("#addAddress").click(function(event) {
        
            $.ajax({
                data: $('#AddAddressForm').serialize(),
                url: "{{ route('add-address') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if (data.status == "success") {
                        Swal.fire({
                            type: data.status,
                            title: data.message,
                            icon:'success'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#AddAddressForm').trigger("reset");
                                 location.reload();
                            }
                        });       
                        
                    } else if (data.status == "error") {
                        Swal.fire({
                            type: data.status,
                            title: data.message,
                            icon:'success'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#AddAddressForm').trigger("reset");
                            location.reload();
                            }
                        });  
                        
                    }                                        
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });  
        });
    </script>
@endsection


