@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container-fluid">
        <div class="row">
            <h4 class="center">Orders Report</h4>
        </div>
        <div class="row">
            <div class="col-md-6" style="padding:0px;">
                <select class="form-control float-left" id="filter_status" style="width: 300px;">
                    <option value="ALL">ALL</option>
                    <option value="PENDING">PENDING</option>
                    <option value="FOR DELIVERY">FOR DELIVERY</option>
                    <option value="UNDELIVERED">UNDELIVERED</option>
                    <option value="REPLACEMENT">REPLACEMENT</option>
                    <option value="DAMAGES">DAMAGES</option>
                    <option value="CANCELLED">CANCELLED</option>
                    <option value="COMPLETED">COMPLETED</option>
                </select>
            </div>
            <div class="col-md-6" style="padding:0px;">
                From: <input type="date" value="{{date('Y-m-d')}}" id="date_from" style="padding:5px;">
                To:<input type="date" value="{{date('Y-m-d')}}" id="date_to" style="padding:5px;">
                <button class="btn btn-success" id="btnFilter">Filter</button>
                {{-- <button class="btn btn-info ml-auto float-right" onclick="printData();" id="print_data">Print</button> &nbsp; --}}
                <!-- <button class="btn btn-danger ml-auto float-right mr-2" id="pdf">PDF</button> -->
                {{-- <button class="btn btn-success ml-auto float-right mr-2" onclick="exportEx('xls');" id="export_data">XLS</button> --}}
            </div>
        </div>
    </div>
    <br>
    <br>
    <table style="width: 100%" border="1" id="order_list_html" cellpadding="10" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>INVOICE NO.</th>
                <th>DATE OF TRANSACTION</th>
                <th>CLIENT</th>
                <th>STAFF</th>
                <th>TOTAL</th>
                <th>DETAILS</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<div class="modal fade" id="listDetailsModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Order Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-stripped" id="store_list_html">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Product</th>
                            <th>Size</th>
                            <th>Qty</th>
                            <th style="text-align:right;">Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        //ajax setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        // datatable
        var table = $('#order_list_html').DataTable({
            processing: true,
            serverSide: true,
            // ajax: "{{ url('order/reports/json') }}" + '/'+ filter_status + '/'+ date_from + '/' + date_to,
            ajax: {
                url: "{{ url('order/reports/json') }}",
                data: function(e){
                    e.filter_status = $('#filter_status').val();
                    e.date_from = $('#date_from').val();
                    e.date_to = $('#date_to').val();
                }
            },
            columns: [
                {data: 'invoice_no', name: 'invoice_no'},
                {data: 'date_ordered', name: 'date_ordered'},
                {data: 'fullname', name: 'fullname'},
                {data: 'assigned_staff', name: 'assigned_staff'},
                {data: 'total_price', name: 'total_price'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        

        $(document).on('click', '.viewDetails', function(e){
            e.preventDefault();
            var invoice_id = $(this).data('id')
            $.getJSON( "{{ url('order/reports/get-details') }}" + '/' + invoice_id, function( data ) {
                var htmlData = ''
                $.each(data, function( x, y ) {
                        htmlData += `
                                    <tr>
                                        <td>${y.id}</td>
                                        <td>${y.product_name}</td>
                                        <td>${y.size}</td>
                                        <td>${y.quantity_ordered}</td>
                                        <td style="text-align:right;">${parseFloat(y.ordered_total_price).toFixed(2)}</td>
                                    </tr>
                                `
                    }); 
               $("#store_list_html").find('tbody').html("").append(htmlData) 
               $('#listDetailsModal').modal('show');
            });
        })

        $(document).on('click', '#btnFilter', function(e){
            e.preventDefault();
            table.draw()
        })

        $(document).on('change', '#filter_status', function(e){
            e.preventDefault();
            table.draw()
        })

    });
</script>
@endsection
