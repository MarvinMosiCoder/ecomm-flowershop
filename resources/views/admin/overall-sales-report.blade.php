@extends('crudbooster::admin_template')
    @push('head')
    
        <style type="text/css">   
            table.dataTable td.dataTables_empty {
                text-align: center;    
            }
            .active{
                font-weight: bold;
                font-size: 13px;
                color:#3c8dbc
            }
            .modal-content  {
                -webkit-border-radius: 3px !important;
                -moz-border-radius: 3px !important;
                border-radius: 3px !important; 
            }
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
    
        </style>
    @endpush
@section('content')

<div class='panel panel-default'>
    <div class='panel-heading'>
    Overall Sales Reports
    </div>

        <div class='panel-body' style="overflow-x: scroll">
           
        <div class="row" style="margin:5px">   
            <!-- <button type="button" id="btn-export" class="btn btn-primary btn-sm btn-export" style="margin-bottom:10px"><i class="fa fa-download"></i>
                <span>Export Data</span>
            </button> -->
            <button type="button" id="btn-export" class="btn btn-primary btn-sm btn-export" data-toggle="modal" data-target="#myModal" style="margin-bottom:10px"><i class="fa fa-download"></i>
             <span>Export Report</span>
            </button>
            <button type="button" id="btn-export" class="btn btn-success btn-sm btn-export" data-toggle="modal" data-target="#myModal" style="margin-bottom:10px"><i class="fa fa-search"></i>
                <span>Export reports by date range</span>
               </button>
            <table class='table table-hover table-striped table-bordered' id="table_dashboard">
            
                <thead>
                    <tr class="active">
                        <th width="auto">Type</th>
                        <th width="auto">Items</th>
                        <th width="auto">Price</th>
                        <th width="auto">Stock</th>
                        <th width="auto">total Qty Sales</th>
                        <th width="auto">Total Sales Amount</th>
                        <th width="auto">Store</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reports as $key => $val)
                        <td>{{$val['description']}}</td>  
                        <td>{{$val['flower_name']}}</td>  
                        <td>{{$val['price']}}</td>  
                        <td>{{$val['stock']}}</td>  
                        <td>{{$val['sales'] ? optional($val->sales)['quantity'] : 0}}</td>  
                        <td>{{$val['sales'] ? optional($val->sales)['sales_price'] : 0}}</td>  
                        <td>{{$val['store_name']}}</td> 
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <th><strong>Total:</strong></th>
                    <?php for($x=1;$x<=5;$x++): ?>
                        <th></th>
                    <?php endfor;?>
                </tfoot>
            </table>
        </div>                 
        </div>
</div>

<!-- Modal Edit Start-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria- 
labelledby="exportModalLabel" aria-hidden="true">
<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria- 
                label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title text-center" id="exportModalLabel">Filter Export</h3>
        </div>
        <div class="modal-body">
            <form  id="filterForm" method='post' target='_blank' name="filterForm" action="{{route('filter-reports')}}">
                <input type="hidden" value="{{csrf_token()}}" name="_token" id="token">
                <input type="hidden" value="1" name="overwrite" id="overwrite">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label require"> Date From</label>
                            <input type="text" class="form-control date" name="from"  id="from" placeholder="Please Select Date">
                        </div>
                    </div>  
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label require"> Date To</label>
                            <input type="text" class="form-control date" name="to"  id="to" placeholder="Please Select Date">
                        </div>
                    </div>  
                </div>
        </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btnExport">Export</button>
            </div>
        </form>
    </div>
</div>
</div>
<!-- Modal Edit End-->

@endsection

@push('bottom')
<script src=
"https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js" >
    </script>
    <script src=
"https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" >
    </script>
        <script src=
"https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js" >
    </script>

    <script type="text/javascript">
        $(function(){
            $('body').addClass("sidebar-collapse");
        });
       var table;
       $(document).ready(function() {
        let targetColumns = [3,4,5,6];
           table = $("#table_dashboard").DataTable({
                ordering:false,
                language: {
                    searchPlaceholder: "Search"
                },
                lengthMenu: [
                    [20, 25, 50, 100, -1],
                    [20, 25, 50, 100, "All"],
                    ],
                buttons: [
                    {
                        extend: "excel",
                        title: "Overall Sales Report",
                        footer: true,
                        exportOptions: {
                        columns: ":not(.not-export-column)",
                            modifier: {
                            page: "current",
                        }
                        },
                    },
                    ],

                footerCallback : function ( row, data, start, end, display ) {
                    var api = this.api();
                    api.columns(targetColumns, {
                        page: 'current'
                    }).every(function() {
                        var sum = this.data().reduce(function(a, b) {
                            var x = parseFloat(a) || 0;
                            var y = parseFloat(b) || 0;
                            return x + y;
                        }, 0);
                        $(this.footer()).html(sum.toLocaleString(undefined,{}));
                    });
                }
     
                
            });
          
            $("#btn-export").on("click", function () {
                table.button(".buttons-excel").trigger();
            });

            $('#erf_number,#status, #category').select2({})
            $(".date").datetimepicker({
                    viewMode: "days",
                    format: "YYYY-MM-DD",
                    dayViewHeaderFormat: "MMMM YYYY",
            });

            $('#btnExport').click(function(event) {
                event.preventDefault();
                var from = $('#from').val();
                var to = $('#to').val();
                if(from > to){
                    swal({
                        type: 'error',
                        title: 'Invalid Date of Range',
                        icon: 'error',
                        confirmButtonColor: "#367fa9",
                    }); 
                    event.preventDefault(); // cancel default behavior
                    return false;
                }else{
                    $('#filterForm').submit(); 
                }
               
            });
        });
 
    </script>
@endpush