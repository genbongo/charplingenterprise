@extends('layouts.app')

@section('content')
<div class="container">
    <!-- <div class="container-fluid">
        <div class="row">
            <h4 class="center">Order History</h4>
        </div>
    </div> -->
    <div class="container-fluid">
        <div class="row">
            
        </div>
        <div class="row">
            <div class="col-md-6" style="padding:0px;">
                <select class="form-control float-left" id="filter_status" style="width: 300px;">
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="all">All</option>
                </select>
            </div>
            <div class="col-md-6" style="padding:0px;">
            <h4 class="center float-right">Order History</h4>
                <!-- <button class="btn btn-info ml-auto float-left" id="createNewStaff">Create Staff</button> -->
            </div>
        </div>
    </div>
    <br>
    {{-- <table id="dataTable" class="table table-striped table-bordered">
        <thead class="bg-indigo-1 text-white">
        <tr>
            <th>ID</th>
            <th>Product</th>
            <th>Image</th>
            <th>Qty</th>
            <th>Amount</th>
            <th>Date Ordered</th>
            <th>Delivery Date</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table> --}}
    <table style="width: 100%;" id="dataTable" class="table table-striped table-bordered">
        <thead class="bg-indigo-1 text-white">
            <tr>
                <th>ID</th>
                <th>Invoice #</th>
                {{-- <th>Customer</th> --}}
                <th>Total</th>
                <th>Date Ordered</th>
                <th>Delivery Date</th>
                {{-- <th>Attempt</th> --}}
                {{-- <th>Reason</th> --}}
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <br>
    <div class="modal fade" id="HistoryModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Order History</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- <form id="frmPendingOrder" name="frmPendingOrder" class="form-horizontal"> --}}
                        <table class="table table-stripped" id="completed_orders">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product</th>
                                    <th>Size</th>
                                    <th>Image</th>
                                    <th>Qty</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>  
                                    <td colspan="4">&nbsp;</td>  
                                    <td>Total:</td>
                                    <td><strong id="history_total">0</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    {{-- </form> --}}
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(() => {

            //ajax setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            if(window.location.hash) {
                if(window.location.hash == '#approved'){
                    $("#filter_status").val('approved')
                }
            }

            function getCompletedOrders(invoice_id){
            $.getJSON( "{{ url('order/completed') }}" + '/'+ invoice_id, function( data ) {
                var htmlData = ''
                var total = 0;
                var i = 0
                $.each(data, function( index, row ) {
                    total += row.ordered_total_price
                    htmlData += `<tr>
                        <td>${row.id}</td>
                        <td>${row.name}</td>
                        <td>${row.size}</td>
                        <td><a data-fancybox='' href='/img/product/${row.product_image}'><img src='/img/product/${row.product_image}' height='20'></a></td>
                        <td>${row.quantity_ordered}</td>
                        <td>${row.ordered_total_price}</td>
                    </tr>`
                    i++
                });
                $("#completed_orders").find('tbody').html("").append(htmlData) 
                $("#history_total").text(total.toFixed(2)) 
                $('#HistoryModal').modal('show');
            });
        }

            $('body').on('click', '.viewCompletedOrder', function () {
                //get the data
                const invoice_id = $(this).attr("data-id");
                getCompletedOrders(invoice_id)
            });

            // datatable
            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                // ajax: "{{ url('transaction_history') }}",
                ajax: {
                    url: "{{ url('transaction_history') }}",
                    data: function(e){
                        e.filter_status = $('#filter_status').val();
                    }
                },
                columns: [
                    // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    // {data: 'id', name: 'id'},
                    // {data: 'name', name: 'name'},
                    // {   
                    //     data: 'product_image', name: 'product_image',
                    //     "render": function (data, type, full, meta) {
                    //         return "<a data-fancybox='' href='{{ URL('img/product') }}/"+ data +"'><img src='{{ URL('img/product') }}/"+ data +"' height='20'></a>";
                    //     },
                    // },
                    // {
                    //     data: 'quantity_ordered', name: 'quantity_ordered',
                    //     "render": function(data, type, full, meta){
                    //         return data + " pcs"
                    //     }
                    // },
                    // {
                    //     data: 'ordered_total_price', name: 'ordered_total_price',
                    //     "render": function(data, type, full, meta){
                    //         return "&#x20b1; " + data
                    //     }
                    // },
                    // {
                    //     data: 'created_at', name: 'created_at',
                    //     "render": function (data, type, full, meta) {
                    //         return moment(data).format('MMMM D YYYY, h:mm:ss a');
                    //     },
                    // },
                    // {
                    //     data: 'delivery_date', name: 'delivery_date',
                    //     "render": function (data, type, full, meta) {
                    //         let output = '';
                    //         if(data === null){
                    //             output = '<span class="text-info font-weight-bold">(Not set)</span>'
                    //         }else{
                    //             output = moment(data).format('MMMM D YYYY, h:mm:ss a');
                    //         }

                    //         return output
                    //     },
                    // },
                    // {
                    //     data: 'is_approved', name: 'is_approved',
                    //     "render": function (data, type, full, meta) {

                    //         let output = '';

                    //         if(data === 1){
                    //             output = '<span class="text-info font-weight-bold">Approved</span>'

                    //             if(full.is_completed === 1){
                    //                 output = '<span class="text-success font-weight-bold">Completed</span>'
                    //             }
                    //         }else{
                    //             output = '<span class="text-danger font-weight-bold">Pending</span>'
                    //         }

                    //         if(full.cancelled_by > 0){
                    //             output = '<span class="text-danger font-weight-bold">Cancelled</span>'
                    //         }

                    //         return output
                    //     },
                    // },
                    {data: 'id', name: 'id'},
                {data: 'invoice_no', name: 'invoice_no'},
                // {
                //     data: 'fullname', name: 'fullname',
                //     "render": function(data, type, full, meta){
                //         return full.fullname
                //     }
                // },
                {data: 'total_price', name: 'total_price'},
                {
                    data: 'date_ordered', name: 'date_ordered',
                    "render": function (data, type, full, meta) {
                        return moment(data).format('MMMM D YYYY');
                    },
                },
                {
                    data: 'delivery_date', name: 'delivery_date',
                    "render": function (data, type, full, meta) {
                        let output = '';
                        if(full.delivery_date == null){
                            output = '<span class="text-info font-weight-bold">(Not set)</span>'
                        }else{
                            output = moment(data).format('MMMM D YYYY');
                        }

                        return output
                    },
                },
                // {
                //     data: 'attempt', name: 'attempt',
                //     render: function(data, type, full, meta){
                        
                //         let output = parseInt(data) + 1
                //         let times = output > 1 ? "times" : "time"

                //         return output + " " + times
                //     }
                // },
                
                
                // {
                //     data: 'reason', name: 'reason',
                //     render: function(data, type, full, meta){
                //         let output = ''
                //         if(data != ""){
                //             output = "<a href='#' class='btnDisplayReason' data-reason='"+data+"'>View</a>"
                //         }
                //         return output
                //     }
                // },
                {
                    data: 'is_completed', name: 'is_completed',
                    render: function(data, type, full, meta){
                        let output = full.is_approved == 1 ? '<span class="text-info font-weight-bold">Approved</span><br/>' : '<span class="text-danger font-weight-bold">Pending</span><br/>';

                        if(full.is_completed == 1){
                            output += '<span class="text-success font-weight-bold">Completed</span>'
                        }
                        if(full.is_cancelled == 1){
                            output += '<span class="text-danger font-weight-bold">Cancelled</span>'
                        }
                        if(full.is_rescheduled == 1){
                            output += '<span class="text-info font-weight-bold">Rescheduled</span>'
                        }

                        return output
                    }
                },
                {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            history.replaceState("", document.title, window.location.pathname);
            $(document).on('change', '#filter_status', function(e){
                e.preventDefault()
                table.ajax.reload()
            })
        })
    </script>
    
</div>

@endsection