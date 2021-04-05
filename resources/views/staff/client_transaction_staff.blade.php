@extends('layouts.app')

@section('content')
<div class="container">
    {{-- <div class="container-fluid">
        <div class="row mb-3">
            <h4 class="center">All Transactions</h4>
        </div>
    </div> --}}
    <div class="container-fluid">
        <div class="row">
            <h4 class="center">All Transactions</h4>
        </div>
        <div class="row">
            <div class="col-md-6" style="padding:0px;">
                
            </div>
            <div class="col-md-6" style="padding:0px;">
                <select class="form-control float-right" id="filter_status" style="width: 300px;">
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                    <option value="pending">Impending</option>
                </select>
            </div>
            
        </div>
    </div>
    <br>
    <table id="dataTable" class="table table-striped table-bordered">
        <thead class="bg-indigo-1 text-white">
        {{-- <tr>
            <th>ID</th>
            <th>Client</th>
            <th>Store Name</th>
            <th>Store Address</th>
            <th>Status</th>
            <th>Action</th>
        </tr> --}}
        <tr>
            <th>ID</th>
            <th>Invoice #</th>
            <th>Client</th>
            <th>Ordered</th>
            <th>Delivery</th>
            <th align="center">Attempt</th>
            <th align="center">Replacement</th>
            <th align="center">Status</th>
            <th align="center">Action</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    {{-- <button class="btn btn-danger" id="emergency_report" style="position: absolute;bottom: 40px;right: 20px">
        Emergency Report
    </button> --}}
</div>

{{-- update failed delivery--}}
<div class="modal fade" id="updateFailedOrder" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Failed Delivery Report</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmCancelledOrder" name="frmCancelledOrder" class="form-horizontal">
                    <input type="hidden" name="failed_order_id" id="failed_order_id">
                    <div class="form-group">
                        <label for="txt_cancelled_reason" class="col-sm-12 control-label">Reason:</label>
                        <div class="col-sm-12">
                            <select class="custom-select mb-3" name="cancel_option" id="cancel_option" required>
                            <option value="1">Client Cancel</option>
                            <option value="2">Delivery Cancel</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txt_cancelled_reason" class="col-sm-12 control-label">Reason:</label>
                        <div class="col-sm-12">
                            <textarea name="txt_cancelled_reason" class="form-control" id="txt_cancelled_reason" style="height: 150px;"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-offset-12 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="btnConfirmCancelledOrder">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- update failed delivery--}}
<div class="modal fade" id="displayOrderDetails" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Order Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmPendingOrder" name="frmPendingOrder" class="form-horizontal">
                    <input type="hidden" name="failed_order_id" id="failed_order_id">
                    <div class="form-group">
                        <label for="txt_product" class="col-sm-12 control-label">Product</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="txt_product" readonly disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txt_qty" class="col-sm-12 control-label">Quantity</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="txt_qty" readonly disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txt_amount" class="col-sm-12 control-label">Amount</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="txt_amount" readonly disabled>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- emergency report--}}
<div class="modal fade" id="emergencyModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Failed Delivery Report</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="emergencyCancel" name="emergencyCancel" class="form-horizontal">
                    <div class="form-group">
                        <label for="txt_cancelled_reason" class="col-sm-12 control-label">Reason:</label>
                        <select class="custom-select mb-3" name="emergency_cancel_option" id="emergency_cancel_option" value="2" disabled required>
                          <option value="2">Delivery Cancel</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="txt_cancelled_reason" class="col-sm-12 control-label">Reason:</label>
                        <div class="col-sm-12">
                            <textarea name="txt_emergency_reason" class="form-control" id="txt_emergency_reason" style="height: 150px;"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-offset-12 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="emergencyCancel">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- update pending modal--}}
<div class="modal fade" id="updatePendingModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Order Confirmation</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmPendingOrder" name="frmPendingOrder" class="form-horizontal">
                    <table class="table table-stripped" id="pending_orders">
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
                                <td><strong id="get_modal_total">0</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="float-right" id="pending_modal">
                        <input type="hidden" id="set_id_invoice">
                        <button type="button" class="btn btn-primary" id="btnConfirmPendingOrder">Completed</button>
                    </div>
                </form>
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

        //display the date here...
        $("#date_here").html(moment().format('MMMM D YYYY'));

        // datatable
        // var table = $('#dataTable').DataTable({
        //     processing: true,
        //     serverSide: true,
        //     ajax: "{{ url('staff-transaction') }}",
        //     columns: [
        //         // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        //         {
        //             data: 'id', name: 'id',
        //             "render": function(data, type, full, meta){
        //                 return '<a href="#" class="btnDisplayOrderDetail" data-prod="'+ full.name +'" data-qty="'+ full.quantity_ordered +'" data-total="'+ full.ordered_total_price +'">'+ data +'</a>'
        //             }
        //         },
        //         {data: 'name', name: 'name'},
        //         {data: 'store_name', name: 'store_name'},
        //         {data: 'store_address', name: 'store_address'},
        //         {data: 'status', name: 'status'},
        //         {data: 'action', name: 'action', orderable: false, searchable: false},
        //     ]
        // });

        var table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            // ajax: "{{ url('staff-transaction') }}",
            ajax: {
                url: "{{ url('staff-transaction') }}",
                data: function(e){
                    e.filter_status = $('#filter_status').val();
                }
            },
            columns: [
                // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'id', name: 'id'},
                {data: 'invoice_no', name: 'invoice_no'},
                {
                    data: 'fullname', name: 'fullname',
                    "render": function(data, type, full, meta){
                        return full.fullname
                    }
                },
                // {data: 'total_price', name: 'total_price'},
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
                            output = moment(data).format('MMMM D YYYY'); //, h:mm:ss a
                        }

                        return output
                    },
                },
                {data: 'attempt', name: 'attempt'},
                {
                    data: 'is_replacement', name: 'is_replacement',
                    "render": function (data, type, full, meta) {
                        return data == 1 ? 'Yes' : 'No'
                    },
                },
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $(document).on('change', '#filter_status', function(e){
            e.preventDefault();
            table.ajax.reload();
        })

        // edit pending order
        function getPendingOrders(invoice_id, type){
            if(type == 0){
                $("#pending_modal").show();
            } else {
                $("#pending_modal").hide();
            }
           $("#set_id_invoice").val(invoice_id)
            $.getJSON( "{{ url('order/items/completed/') }}" + '/'+ invoice_id, function( data ) {
                var htmlData = ''
                var total = 0;
                var i = 0
                $.each(data, function( index, row ) {
                    total += row.ordered_total_price
                    htmlData += `<tr>
                        <td>${row.id}</td>
                        <td>${row.name}</td>
                        <td>${row.size}</td>
                        <td><a data-fancybox='' href='/img/product/${row.product_image}'><img src='/img/product/${row.product_image}' height='20'></a></td>`
                    if(type == 0){
                        htmlData += `<td><input type='number' name='order[${i}][quantity]' value='${row.quantity_ordered}' data-iid='${invoice_id}' data-id='${row.id}' class="modal_qty" style='width:60px;' placeholder='0'></td>`
                    } else {
                        htmlData += `<td>${row.quantity_ordered}</td>`
                    }
                    htmlData +=`<td>${row.ordered_total_price}
                            <input type='hidden' name='order[${i}][product_id]' value='${row.prodID}'>
                            <input type='hidden' name='order[${i}][order_id]' value='${row.id}'>
                            <input type='hidden' name='order[${i}][amount]' value='${row.ordered_total_price}'></td>
                    </tr>`
                    i++
                });
               $("#get_modal_total").text(total.toFixed(2)) 
               $("#pending_amount").val(total.toFixed(2)) 
               $("#pending_orders").find('tbody').html("").append(htmlData) 
               $('#updatePendingModal').modal('show');
            });
        }

        $('body').on('click', '.editCompleteOrder, .viewCompleteOrder', function (e) {
            e.preventDefault();
            //get the data
            const invoice_id = $(this).data("id");
            const type = $(this).data("type");
            getPendingOrders(invoice_id, type)
        });

        $(document).on('keyup', '.modal_qty', function(e){
            e.preventDefault()
            var order_id            = $(this).data('id'),
                invoice_id          = $(this).data('iid'),
                quantity_ordered    = $(this).val()
                $.ajax({
                    url:"{{ url('order/update/quantity') }}",
                    method:"POST",
                    data:{id: order_id, quantity_ordered: quantity_ordered},
                    dataType:'JSON',
                    success: function (data) {
                        getPendingOrders(invoice_id, 0)
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            
        })

        $(document).on('click', '#emergency_report', function() {
            $('#emergencyModal').modal('show');
        });

        $('#emergencyCancel').on('submit', function(e) {
            e.preventDefault();

            //get the data
            const reason = $("#txt_emergency_reason").val();
            const cancel_option = $("#emergency_cancel_option").val();

            if(reason === ''){
                return swal("Error", "Please fill in the reason!")
            }
            //set parameters
            const params = {
                reason,
                cancel_option,
                "action": "cancel"
            }

            $.ajax({
                type: "POST",
                url: "{{ url('emergency') }}",
                data: params,
                success: function (data) {
                    //hide the modal
                    $('#emergencyModal').modal("hide");
                    table.draw();
                    swal(data.message, {
                        icon: "success",
                    });
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        })

        //when complete order button is clicked
        $(document).on('click', '#btnConfirmPendingOrder', function() {
            swal({
                title: "Are you sure?",
                text: "Once confirmed, it will set the order as completed.",
                icon: "warning",
                buttons: true,
                dangerMode: false,
            })
            .then((isTrue) => {
                if (isTrue) {

                    //get the current order id
                    const invoice_id = $("#set_id_invoice").val();

                    //set params
                    const params = {
                        'invoice_id': invoice_id,
                        "action" : "completed"
                    }

                    $.ajax({
                        type: "POST",
                        url: "{{ url('main') }}",
                        data: params,
                        success: function (data) {
                            $('#updatePendingModal').modal('hide');
                            table.draw();
                            swal(data.message, {
                                icon: "success",
                            });
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }
            });
        })

        //when cancel order is clicked
        $(document).on('click', '.editCancelOrder', function() {

            //get the current id
            const order_id = $(this).attr("data-id");

            //set the id to DOM
            $("#failed_order_id").val(order_id)

            //show the modal
            $('#updateFailedOrder').modal("show");
        })

        //when cancel order is clicked
        $(document).on('click', '.btnDisplayOrderDetail', function() {

            //get the current id
            const product = $(this).attr("data-prod");
            const qty = $(this).attr("data-qty");
            const amount = $(this).attr("data-total");

            //set the data to DOM
            $("#txt_product").val(product)
            $("#txt_qty").val(qty)
            $("#txt_amount").val(amount)

            //show the modal
            $('#displayOrderDetails').modal("show");
        })

        //when confirm button is clicked
        $("#frmCancelledOrder").on('submit', function(e) {
            e.preventDefault();

            //get the data
            const order_id = $("#failed_order_id").val();
            const reason = $("#txt_cancelled_reason").val();
            const cancel_option = $("#cancel_option").val();

            if(reason === ''){
                return swal("Error", "Please fill in the reason!")
            }

            //set parameters
            const params = {
                order_id,
                reason,
                cancel_option,
                "action": "cancel"
            }

            $.ajax({
                type: "POST",
                url: "{{ url('main') }}",
                data: params,
                success: function (data) {

                    //hide the modal
                    $('#updateFailedOrder').modal("hide");

                    table.draw();
                    swal(data.message, {
                        icon: "success",
                    });
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });

        })
    })
</script>

@endsection