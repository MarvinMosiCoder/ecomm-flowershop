@extends('user-frontend.components.content')
@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.css')}}">
<style>
 
</style>
@section('content')
    <section class="profile mt-5" id="profile">
        <h3 class="text-center">My Addresses</h3>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="myAddresses">
                    @if($my_addresses->isNotEmpty())
                        @foreach ($my_addresses as $item)
                            <h5>{{ $item->fullname }} | {{ $item->phone_number }}</h5>
                            <p>{{ $item->house_no .' '. $item->barangay .' '. $item->city . ',' . $item->region . $item->postal_code}}</p>
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
                    <div class="footer" style="margin-left: 40%">
                        <button class="btn btn-primary mx-auto"> <i class="fa fa-plus-circle"></i> Add New Address</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

@section('script-js')
    <script type="text/javascript">
       
    </script>
@endsection


