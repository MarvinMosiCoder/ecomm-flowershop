<!-- First you need to extend the CB layout -->
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

            img[data-action="zoom"] {
                cursor: pointer;
                cursor: -webkit-zoom-in;
                cursor: -moz-zoom-in;
            }
            .image-holder {
                position: relative;
                z-index: 666;
                -webkit-transition: all 300ms;
                    -o-transition: all 300ms;
                        transition: all 300ms;
            }
            .zoom-overlay {
                z-index: 1000;
                background: #fff;
                top: 0;
                left: ;
                right: 0;
                bottom: 0;
                pointer-events: none;
                filter: "alpha(opacity=0)";
                opacity: 0;
                -webkit-transition:      opacity 300ms;
                    -o-transition:      opacity 300ms;
                        transition:      opacity 300ms;
            }
            .zoom-overlay-open .zoom-overlay {
                filter: "alpha(opacity=100)";
                opacity: 1;
            }
            .zoom-overlay-open,
            .zoom-overlay-transitioning {
                cursor: default;
                z-index: 1000;
                position: relative;
            }
            .body_gallery_image {
                display:flex;
            }
       
        </style>
    @endpush
@section('content')
<!-- Your custom  HTML goes here -->
<div class='panel panel-default'>
    <div class='panel-heading'>Add Form</div>
      <div class='panel-body'><br>
          <div id="app">
          <add-inventory :test_view="{{ $test_view }}"></add-inventory>
          </div>
      </div>
    </div>
</div>
<script src="{{ mix('/js/app.js') }}">
</script>
@endsection
@push('bottom')
<script>
   var csrf_token = $('meta[name="csrf-token"]').attr('content');
</script>

@endpush
