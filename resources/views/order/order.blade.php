@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container-fluid">
        <h4 class="center">Manage Orders</h4>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header-1">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active refresh_table" data-value="order-tab-pending" data-toggle="tab" href="#order-tab-pending" role="tab" aria-controls="profile" aria-selected="true">PENDING</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link refresh_table"  data-value="order-tab-undelivered" data-toggle="tab" href="#order-tab-undelivered" role="tab" aria-selected="false">FOR DELIVERY</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link refresh_table"  data-value="order-replacement" data-toggle="tab" href="#order-replacement" role="tab" aria-selected="false">UNDELIVERED</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link refresh_table" data-value="order-damage" data-toggle="tab" href="#order-damage" role="tab" aria-selected="false">REPLACEMENT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link refresh_table" data-value="order-tab-tran-his" data-toggle="tab" href="#order-tab-tran-his" role="tab" aria-selected="false">DAMAGES</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="order-tab-pending" role="tabpanel">
                        <table style="width: 100%;" id="dataTable" class="table table-striped table-bordered">
                            <thead class="bg-indigo-1 text-white">
                            <tr>
                                <th>ID</th>
                                <th>Invoice #</th>
                                <th>Client</th>
                                {{-- <th>Total</th> --}}
                                <th>Date Ordered</th>
                                <th>Delivery Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade show" id="order-tab-undelivered" role="tabpanel">
                        <table style="width: 100%;" id="undeliveredTable" class="table table-striped table-bordered">
                            {{-- <thead class="bg-indigo-1 text-white">
                            <tr>
                                <th>ID</th>
                                <th>Client</th>
                                <th>Product</th>
                                <th>Image</th>
                                <th>Qty</th>
                                <th>Amount</th>
                                <th>Date Ordered</th>
                                <th>Delivery Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody> --}}
                            <thead class="bg-indigo-1 text-white">
                                <tr>
                                    <th>ID</th>
                                    <th>Invoice #</th>
                                    <th>Client</th>
                                    {{-- <th>Total</th> --}}
                                    <th>Date Ordered</th>
                                    <th>Delivery Date</th>
                                    <th>Attempt</th>
                                    <th>Replacement</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade show" id="order-replacement" role="tabpanel">
                        <table style="width: 100%;" id="replacementTable" class="table table-striped table-bordered">
                        <thead class="bg-indigo-1 text-white">
                        {{-- <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Issued By</th>
                            <th>Client</th>
                            <th>Products</th>
                            <th>Files</th>
                            <th>Reason</th>
                            <th>Status</th>
                            <th width="280px">Action</th>
                        </tr> --}}
                        <tr>
                            <th>ID</th>
                            <th>Invoice #</th>
                            <th>Client</th>
                            {{-- <th>Total</th> --}}
                            <th>Date Ordered</th>
                            <th>Delivery Date</th>
                            <th>Attempt</th>
                            <th>Replacement</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade show" id="order-damage" role="tabpanel">
                        <table style="width: 100%;" id="damageTable" class="table table-striped table-bordered">
                        <thead class="bg-indigo-1 text-white">
                        {{-- <tr>
                            <th>ID</th>
                            <th>Client</th>
                            <th>Product Name</th>
                            <th>Images</th>
                            <th width="280px">Action</th>
                        </tr> --}}
                        <tr>
                            <th>Rep ID</th>
                            <th>Report Type</th>
                            <th>Issued By</th>
                            <th>Client</th>
                            <th>Store</th>
                            <th>Products</th>
                            <th>Files</th>
                            {{-- <th>Quantity</th> --}}
                            <th>Status</th>
                            <th>Reason</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade show" id="order-tab-tran-his" role="tabpanel">
                        <table style="width: 100%;" id="historyTable" class="table table-striped table-bordered">
                            <thead class="bg-indigo-1 text-white">
                            <tr>
                                <th>Rep ID</th>
                                <th>Report Type</th>
                                <th>Issued By</th>
                                <!-- <th>Client</th> -->
                                <!-- <th>Store</th> -->
                                <th>Products</th>
                                <th>Files</th>
                                <th>Status</th>
                                <th>Reason</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
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
                    <input type="hidden" name="pending_date_to_display" id="pending_date_to_display">
                    {{-- <input type="hidden" name="pending_order_id" id="pending_order_id"> --}}
                    <input type="hidden" name="pending_contact" id="pending_contact">
                    <input type="hidden" name="pending_client_id" id="pending_client_id">
                    <input type="hidden" name="pending_invoice" id="pending_invoice">
                    <input type="hidden" name="pending_amount" id="pending_amount">
                    {{-- <input type="hidden" name="pending_order_id" id="pending_order_id">
                    <input type="hidden" name="pending_product_id" id="pending_product_id">
                    <input type="hidden" name="pending_product_qty" id="pending_product_qty">
                    <input type="hidden" name="pending_contact" id="pending_contact">
                    
                    <input type="hidden" name="pending_amount" id="pending_amount">
                    <input type="hidden" name="pending_client_id" id="pending_client_id">
                    <div class="form-group">
                        <label for="txt_pending_product" class="col-sm-12 control-label">Product</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="txt_pending_product" readonly disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txt_pending_qty" class="col-sm-12 control-label">Quantity</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="txt_pending_qty" readonly disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txt_pending_amount" class="col-sm-12 control-label">Amount</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="txt_pending_amount" readonly disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txt_pending_delivery_date" class="col-sm-12 control-label">Delivery date</label>
                        <div class="col-sm-12">
                            <input type="date" name="delivery_date" class="form-control" id="delivery_date">
                        </div>
                    </div> --}}
                    <div class="wrap_modal">
                    <div class="form-group">
                        <label for="txt_pending_delivery_date" class="col-sm-12 control-label">Delivery date</label>
                        <div class="col-sm-12">
                            <input type="date" name="delivery_date" class="form-control" id="delivery_date">
                        </div>
                    </div>
                    <div class="col-sm-offset-12 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="btnConfirmPendingOrder">Confirm</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- update pending modal--}}
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

{{-- update reschedule modal--}}
<div class="modal fade" id="updateReschedModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Reschedule Order</h4>
            </div>
            <div class="modal-body">
                <form id="frmReschedOrder" name="frmReschedOrder" class="form-horizontal">
                    <input type="hidden" name="resched_order_id" id="resched_order_id">
                    <input type="hidden" name="resched_contact" id="resched_contact">
                    <input type="hidden" name="resched_date_to_display" id="resched_date_to_display">
                    <input type="hidden" name="resched_amount" id="resched_amount">
                    <div class="form-group">
                        <label for="txt_resched_product" class="col-sm-12 control-label">Product</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="txt_resched_product" readonly disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txt_resched_qty" class="col-sm-12 control-label">Quantity</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="txt_resched_qty" readonly disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txt_resched_amount" class="col-sm-12 control-label">Amount</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="txt_resched_amount" readonly disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="txt_resched_delivery_date" class="col-sm-12 control-label">Delivery date</label>
                        <div class="col-sm-12">
                            <input type="date" name="txt_resched_delivery_date" class="form-control" id="txt_resched_delivery_date">
                        </div>
                    </div>
                    <div class="col-sm-offset-12 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="btnConfirmReschedOrder">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- display reason modal--}}
<div class="modal fade" id="displayReasonModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Failed Delivery Report</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="txt_history_reason" class="col-sm-12 control-label">Reason for failed delivery:</label>
                    <div class="col-sm-12">
                        <textarea class="form-control" id="txt_history_reason" readonly disabled></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- display file images --}}
<div class="modal fade" id="displayModalImagesHere" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Product Report Images</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row text-center text-lg-left" id="divModalImages"></div>
            </div>
        </div>
    </div>
</div>

{{-- set replacement schedule--}}
<div class="modal fade" id="fileReplacementDelivery" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Are you sure?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="replacementDelivery" name="replacementDelivery" class="form-horizontal">
                    
                    <input type="hidden" name="id" id="reportId" value="">
                     <input type="hidden" name="replacement_delivery_to_display" id="replacement_delivery_to_display">
                    <div class="form-group">
                        
                        <label for="txt_resched_delivery_date" class="col-sm-12 control-label"><h4 class="mb-3">Once approved, it will be confirmed</h4></label>
                        <label for="txt_resched_delivery_date" class="col-sm-12 control-label">Delivery date</label>
                        <div class="col-sm-12">
                            <input type="date" name="txt_replacement_delivery_date" class="form-control" id="txt_replacement_delivery_date">
                        </div>
                    </div>
                    <div class="col-sm-offset-12 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="btnConfirmReschedOrder">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- display file images --}}
<div class="modal fade" id="displayFileModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Product Report Images</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row text-center text-lg-left" id="divContentImages"></div>
            </div>
        </div>
    </div>
</div>

{{-- display Products --}}
<div class="modal fade" id="displayProductsModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Products</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="divModalProducts">
            </div>
            <div class="modal-footer" hidden>
                <div class="row text-center">
                    <button class="btn btn-success" id="replaceProduct">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- update pending modal--}}
<div class="modal fade" id="undeliveredModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Order Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmPendingOrder" name="frmPendingOrder" class="form-horizontal">
                    <table class="table table-stripped" id="pending_orders_free">
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
                                <td><strong id="get_modal_total_free">0</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- display Reason --}}
<div class="modal fade" id="displayReason" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row text-center text-lg-left">
                    <div class="col-md-12"  id="reason_div"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        function onHashChange() {
            var hash = window.location.hash;
            console.log(hash)
            if (hash) {
                // using ES6 template string syntax
                $(`[data-toggle="tab"][href="${hash}"]`).trigger('click');
            }
        }

        window.addEventListener('hashchange', onHashChange, false);
        onHashChange();
    });
    $(() => {

        //ajax setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        /* -------------------------------------------------------------------------------
                                        PENDING ORDER LIST
        -------------------------------------------------------------------------------- */
        
        // datatable
        var table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            paging      : false,
            ajax: "{{ url('order') }}",
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
                        return moment(data).format('MMMM D YYYY, h:mm:ss a');
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
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });


        // edit pending order
        function getPendingOrders(invoice_id, type, setId){
            if(['all','pending'].indexOf(type) !== -1){
                $('.wrap_modal').show()
            } else {
                $('.wrap_modal').hide()
            }
            $.getJSON( "{{ url('order/pending') }}" + '/'+ invoice_id + '/' + type + '/' + setId, function( data ) {
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
                        if(['all','pending'].indexOf(type) !== -1){
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

        $('body').on('click', '.editPendingOrder, .editReschedOrder', function (e) {
            e.preventDefault();
            //get the data
            const invoice_id = $(this).data("id");
            var type         = $(this).data("type");
            var setId        = $(this).data("set");
            getPendingOrders(invoice_id, type, setId)

            var invoice_no = $(this).data('invoice');
            $("#pending_invoice").val(invoice_no);
            // const product_id = $(this).attr("data-prodid");
            const contact = $(this).attr("data-num");
            // const prodname = $(this).attr("data-prodname");
            // const qty = $(this).attr("data-qty");
            const total = $(this).attr("data-total");
            const client_id = $(this).attr("data-client");
            $("#pending_client_id").val(client_id);
            // //set the data
            // $("#pending_order_id").val(order_id);
            $("#pending_contact").val(contact);
            // $("#pending_product_id").val(product_id);
            // $("#pending_product_qty").val(qty);
            // $("#pending_contact").val(contact);
            // $("#txt_pending_product").val(prodname);
            // $("#pending_amount").val(total);
            // $("#txt_pending_qty").val(qty);
            // $("#txt_pending_amount").val(total);
            // $("#pending_client_id").val(client_id);
        });

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
                        getPendingOrders(invoice_id, 'pending', 0)
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            
        })

        //when button confirm order is clicked
        $("#frmPendingOrder").on('submit', function(e) {
            e.preventDefault();

            if(!$("#delivery_date").val()){

                swal("Error", "Please select a date to deliver!")

            }else{
                //get the value of delivery date
                const delivery_date = moment($("#delivery_date").val()).format('MMMM D YYYY');

                //set the value for date to disdplay
                $("#pending_date_to_display").val(delivery_date);

                //disable the button
                $("#btnConfirmPendingOrder").attr("disabled", "disabled");

                $.ajax({
                    url:"{{ url('order') }}",
                    method:"POST",
                    data:new FormData(this),
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        // console.log("printing data");
                        // console.log(data);

                        swal("Information", "Order has been successfully confirmed!").then(res => {
                            $('#updatePendingModal').modal('hide');
                            // table.draw();
                            drawAllTable()
                        })

                        //disable the button
                        $("#btnConfirmPendingOrder").removeAttr("disabled");

                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }

        })





        /* -------------------------------------------------------------------------------
                                        UNDELIVERED LIST
        -------------------------------------------------------------------------------- */
        // datatable
        // var undeliverTable = $('#undeliveredTable').DataTable({
        //     processing: true,
        //     serverSide: true,
        //     ajax: "{{ url('undeliver') }}",
        //     columns: [
        //         // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        //         {data: 'id', name: 'id'},
        //         {
        //             data: 'fname', name: 'fname',
        //             "render": function(data, type, full, meta){
        //                 return full.lname + ', ' + full.fname
        //             }
        //         },
        //         {data: 'name', name: 'name'},
        //         {   
        //             data: 'product_image', name: 'product_image',
        //             "render": function (data, type, full, meta) {
        //                 return "<a data-fancybox='' href='{{ URL('img/product') }}/"+ data +"'><img src='{{ URL('img/product') }}/"+ data +"' height='20'></a>";
        //             },
        //         },
        //         {
        //             data: 'quantity_ordered', name: 'quantity_ordered',
        //             "render": function(data, type, full, meta){
        //                 return data + " pcs"
        //             }
        //         },
        //         {
        //             data: 'ordered_total_price', name: 'ordered_total_price',
        //             "render": function(data, type, full, meta){
        //                 return "&#x20b1; " + data
        //             }
        //         },
        //         {
        //             data: 'created_at', name: 'created_at',
        //             "render": function (data, type, full, meta) {
        //                 return moment(data).format('MMMM D YYYY, h:mm:ss a');
        //             },
        //         },
        //         {
        //             data: 'delivery_date', name: 'delivery_date',
        //             "render": function (data, type, full, meta) {
        //                 let output = '';
        //                 if(full.is_cancelled == 1){
        //                     output = '<span class="text-danger font-weight-bold">(To be reschedule)</span>'
        //                 }else{
        //                     output = moment(data).format('MMMM D YYYY');
        //                 }

        //                 return output
        //             },
        //         },
        //         {data: 'action', name: 'action', orderable: false, searchable: false},
        //     ]
        // });

        var undeliverTable = $('#undeliveredTable').DataTable({
            processing: true,
            serverSide: true,
            paging    : false,
            ajax: "{{ url('undeliver') }}",
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
                        return moment(data).format('MMMM D YYYY, h:mm:ss a');
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
                {data: 'attempt', name: 'attempt'},
                {
                    data: 'is_replacement', name: 'is_replacement',
                    "render": function (data, type, full, meta) {
                        return data == 1 ? 'Yes' : 'No'
                    },
                },
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        function getPendingOrdersUndelivered(invoice_id){
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
                    htmlData += `<td>${row.quantity_ordered}</td>`
                    htmlData +=`<td>${row.ordered_total_price}
                            <input type='hidden' name='order[${i}][product_id]' value='${row.prodID}'>
                            <input type='hidden' name='order[${i}][order_id]' value='${row.id}'>
                            <input type='hidden' name='order[${i}][amount]' value='${row.ordered_total_price}'></td>
                    </tr>`
                    i++
                });
               $("#get_modal_total_free").text(total.toFixed(2)) 
               $("#pending_amount").val(total.toFixed(2)) 
               $("#pending_orders_free").find('tbody').html("").append(htmlData) 
               $('#undeliveredModal').modal('show');
            });
        }

        $(document).on('click', '.viewDetails', function(e){
            e.preventDefault();
            const invoice_id = $(this).data("id");
            getPendingOrdersUndelivered(invoice_id)
            // viewDetails
            // undeliveredModal
        })

        // edit resched order
        // $('body').on('click', '.editReschedOrder', function () {
        //     //get the data
        //     const order_id = $(this).attr("data-id");
        //     const contact = $(this).attr("data-num");
        //     const prodname = $(this).attr("data-prodname");
        //     const qty = $(this).attr("data-qty");
        //     const total = $(this).attr("data-total");

        //     //set the data
        //     $("#resched_order_id").val(order_id);
        //     $("#resched_contact").val(contact);
        //     $("#txt_resched_product").val(prodname);
        //     $("#resched_amount").val(total);
        //     $("#txt_resched_qty").val(qty);
        //     $("#txt_resched_amount").val(total);
            
        //     $('#updateReschedModal').modal('show');
        // });

        //when button confirm order is clicked
        $("#frmReschedOrder").on('submit', function(e) {
            e.preventDefault();

            if(!$("#txt_resched_delivery_date").val()){

                swal("Error", "Please select a date to reschedule the delivery!")

            }else{
                //get the value of delivery date
                const resched_delivery_date = moment($("#txt_resched_delivery_date").val()).format('MMMM D YYYY');

                //set the value for date to disdplay
                $("#resched_date_to_display").val(resched_delivery_date);

                //disable the button
                $("#btnConfirmReschedOrder").attr("disabled", "disabled");

                $.ajax({
                    url:"{{ url('undeliver') }}",
                    method:"POST",
                    data:new FormData(this),
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        console.log("printing data");
                        console.log(data);

                        swal("Information", "Order has been successfully confirmed!").then(res => {
                            $('#updateReschedModal').modal('hide');
                            // undeliverTable.draw();
                            drawAllTable()
                        })

                        //disable the button
                        $("#btnConfirmReschedOrder").removeAttr("disabled");

                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }

        })


        $(document).on('click', '#replaceProduct', function() {
            const inpts = $('input[name ="quantity')
            let arrs = [];

            inpts.map(input => {
                arrs.push({
                    'id': inpts[input].id,
                    'value': inpts[input].value
                })
            });

            const formData = new FormData;
            formData.append('props', JSON.stringify(arrs));
            $.ajax({
                url:"{{ url('update/replacement') }}",
                method:"POST",
                data: formData,
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    drawAllTable()
                    //disable the button
                    $('#displayProductsModal').modal('hide');
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

        /* -------------------------------------------------------------------------------
                                    REPLACEMENT LIST
        -------------------------------------------------------------------------------- */
        $(document).on('keyup', '.qty_update', function(e){
            e.preventDefault();

            var id       = $(this).data('id')
            var price    = $(this).data('price')
            var quantity = $(this).val()
            if(!quantity)
                quantity = 0;

            var total = price * quantity

            $('#sub_total_'+id).text(total.toFixed(2))

            var sum = 0;
            $('.sub_total').each(function(){
                sum += parseFloat($(this).text());
            });
            $('.all_total').text(sum.toFixed(2))
        })
        $(document).on('click', '.displayProducts', function(){
            const products =JSON.parse($(this).attr("data-val"));
            $('#displayProductsModal').modal('show');
            $('#divModalProducts').empty();

            var header = `<div class="row">
                            <div class="col-5"><b> Product (size) </b></div>
                            <div class="col-2"><b> Price </b></div>
                            <div class="col-3"><b> Quantity </b></div>
                            <div class="col-2"><b> Total </b></div>
                        </div>`
            $('#divModalProducts').append(header)

            // products.map(product => {
            //     var jsx =`
            //         <div class="row">
            //             <div class="col-4">
            //                 ${product.name}
            //             </div>
            //              <div class="col-4">
            //                 ${product.size}
            //             </div>
            //              <div class="col-4">
            //                 <input type="number" id="${product.id}" value="${product.quantity}" name="quantity" class="form-control" />
            //             </div>
            //         </div>`;
            //     $('#divModalProducts').append(jsx)
            // })
            var total = 0;
            var jsx = ''
            products.map(product => {
                
                total += (product.quantity * product.price)
                jsx  +=`
                    <div class="row">
                        <div class="col-5">
                            ${product.name}  ( ${product.size} )
                        </div>
                        <div class="col-2">
                            ${product.price.toFixed(2)}
                        </div>
                        <div class="col-3 mt-1">
                            ${product.quantity} <input type="hidden" class="qty_update" data-id="${product.id}" id="${product.id}" data-price='${product.price}' value="${product.quantity}" required placeholder='0' name="quantity" style='width:100px;'/>
                        </div>
                        <div class="col-2">
                            <span class='sub_total' id="sub_total_${product.id}">${(product.quantity * product.price).toFixed(2)} 
                        </div>
                    </div>`;     
            })
            jsx += `<div class="row">
                        <div class="col-10">&nbsp;</div>
                            <div class="col-2"><strong class='all_total'>${total.toFixed(2)}</strong></div>
                        </div>`
            // jsx += `<div class="row">
            //             <div class="form-group">
            //                 <label for="txt_resched_delivery_date" class="col-sm-12 control-label">Delivery date</label>
            //                 <div class="col-12">
            //                     <input type="date" name="txt_replacement_delivery_date" class="form-control" id="txt_replacement_delivery_date">
            //                 </div>
            //             </div>
            //         </div>`            
            $('#divModalProducts').append(jsx)
        });

        $(document).on('click', '.btnDisplayImages', function(){
            $('#divContentImages').empty()
            const images =JSON.parse($(this).attr("data-val"));
            $('#displayFileModal').modal('show');
            images.map(image => {
                var jsx =`
                    <div class="row">
                        <div class="col-4 m-2">
                            <img src="{{ URL('img/filereport') }}/${image.file_report_image}" style="height:101px;"/>
                        </div>
                    </div>`;
                $('#divContentImages').append(jsx)
            })
        });


        $(document).on('click', '.editDamageOrder', function(){
            const products = JSON.parse($(this).attr("data-val"));
            const clientid = $(this).attr("data-clientid");
            const product_report_id = $(this).attr("data-id");
            const storeid = $(this).attr("data-store");
            const report_type = $(this).attr("data-type");
            $('#displayProductsModal').modal('show');
            $('#divModalProducts').empty();

            var header = `<div class="row">
                            <div class="col-5"><b> Product (size) </b></div>
                            <div class="col-2"><b> Price </b></div>
                            <div class="col-3"><b> Quantity </b></div>
                            <div class="col-2"><b> Total </b></div>
                        </div>`
            $('#divModalProducts').append(header)

            var total = 0;
            var jsx = ''
            var i   = 0;
            products.map(product => {
                total += (product.quantity * product.price)
                jsx  +=`<form id='checkoutDamageOrder'>
                    <div class="row">
                        <div class="col-5">
                            ${product.name}  ( ${product.size} )
                        </div>
                        <div class="col-2">
                            ${product.price.toFixed(2)}
                        </div>
                        <div class="col-3 mt-1">
                            <input type="text" class="qty_update" 
                                data-id="${product.id}" 
                                id="${product.id}" 
                                data-price='${product.price}' 
                                value="${product.quantity}" 
                                required 
                                placeholder='0' 
                                name="damage[${i}][quantity]" 
                                style='width:100px;'/>
                            <input type="hidden" value="${product.id}"  name="damage[${i}][id]"/>
                            <input type="hidden" value="${product.product_stock_id}"  name="damage[${i}][product_stock_id]"/>
                            <input type="hidden" value="${product.product_id}"  name="damage[${i}][product_id]"/>
                            <input type="hidden" value="${product.price}"  name="damage[${i}][price]"/>
                            <input type="hidden" value="${product.size}"  name="damage[${i}][size]"/>
                        </div>
                        <div class="col-2">
                            <span class='sub_total' id="sub_total_${product.id}">${(product.quantity * product.price).toFixed(2)} 
                        </div>
                    </div>`;     
                i++;
            })
            jsx += `<div class="row">
                        <div class="col-10">&nbsp;</div>
                            <div class="col-2"><strong class='all_total'>${total.toFixed(2)}</strong></div>
                    </div>`
                     jsx += `<div class="row">
                        <div class="form-group col-lg-6">
                            <label for="txt_resched_delivery_date" class="col-sm-12 control-label">Delivery date</label>
                            <div class="col-lg-12">
                                <input type="date" name="damage_delivery_date" class="form-control" id="damage_delivery_date">
                            </div>
                        </div>
                    </div>`  
            jsx += `<div class="modal-footer">
                        <div class="row text-center">
                            <input type="hidden" value="${clientid}" id="data_client_id" name="data_client_id"/>
                            <input type="hidden" value="${report_type}" id="data_client_id" name="report_type"/>
                            <input type="hidden" value="${storeid}" id="data_store_id" name="data_store_id"/>
                            <input type="hidden" value="${product_report_id}" id="data_report_id" name="product_report_id"/>
                            <button type='submit' id='is_loading' class="btn btn-success">Checkout</button>
                        </div>
                    </div>
                </form>`            
            $('#divModalProducts').append(jsx)
        });

        $(document).on('submit', '#checkoutDamageOrder', function(e){
            e.preventDefault()

            if(!$("#damage_delivery_date").val()){
                swal("Error", "Please select a date to schedule the delivery!")
                return 
            }
            swal({
                title: "Are you sure you want to checkout?",
                icon: "info",
                buttons: true,
                dangerMode: false,
            })
            .then((isTrue) => {
                if (isTrue) {
                    $("#is_loading").text('Submitting..').prop('disabled', true)
                    $.ajax({
                        data: $(this).serialize(),
                        url: "{{ url('damage-cart') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function (data) {
                            $("#is_loading").text('Confirm').removeAttr('disabled')
                            replacementTable.draw()
                            swal("Information", data.message).then(function() {
                                window.location = "order#order-tab-undelivered";
                            })
                            $("#displayProductsModal").modal('hide')
                        },
                        error: function (data) {
                            $("#is_loading").text('Confirm').removeAttr('disabled')
                            console.log('Error:', data);
                        }
                    });
                }
            });
        })

        // datatable
        // var replacementTable = $('#replacementTable').DataTable({
        //     processing: true,
        //     serverSide: true,
        //     ajax: "{{ url('order_replacement') }}",
        //     columns: [
        //         // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        //         {data: 'id', name: 'id'},
        //         {data: 'report_type', name: 'report_type'},
        //         {data: 'issued_name', name: 'issued_name'},
        //         {data: 'client_name', name: 'client_name'},
        //         // {
        //         //     data: 'client', name: 'client',
        //         //     render: function(data, type, full, meta){
        //         //         var a = JSON.parse(full.client)
        //         //         return a.lname + ', ' + a.fname;
        //         //     }
        //         // },
        //         {
        //             data: 'products', 
        //             name: 'products',
        //             render: function(data, type, full, meta) {
        //                 return "<a href='#' class='displayProducts' data-val='"+full.products+"'>View Lists</a>"
        //             }
        //         },
        //         {
        //             data: 'file_report_image', name: 'file_report_image',
        //             render: function(data, type, full, meta){
        //                 let output = ''
        //                 if(data != ""){
        //                     output = "<a href='#' class='btnDisplayImages' data-val='"+full.images+"'>View Files</a>"
        //                 }

        //                 return output
        //             }
        //         },
        //         {data: 'reason', name: 'reason'},
        //         {
        //             data: 'is_replaced', name: 'is_replaced',
        //             "render": function (data, type, full, meta) {
        //                 var output = '';

        //                 // if (full.delivery_date != null) {
        //                     if(data == 0){
        //                         output = '<span class="text-warning font-weight-bold">Pending</span>'
        //                     }else if(data == 1){
        //                         output = '<span class="text-success font-weight-bold">Approved</span>'
        //                     }else{
        //                         output = '<span class="text-danger font-weight-bold">Not Approved</span>'
        //                     }
        //                 // } else {
        //                 //     output = '<span class="text-success font-weight-bold">On-delivery</span>'
        //                 // }
        //                 return output;
        //             }
        //         },
        //         {data: 'action', name: 'action', orderable: false, searchable: false},
        //     ]
        // });

        var replacementTable = $('#replacementTable').DataTable({
            processing: true,
            serverSide: true,
            paging    : false,
            // ajax: "{{ url('undeliver') }}",
            ajax: "{{ url('order_replacement') }}",
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
                        return moment(data).format('MMMM D YYYY, h:mm:ss a');
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
                {data: 'attempt', name: 'attempt'},
                {
                    data: 'is_replacement', name: 'is_replacement',
                    "render": function (data, type, full, meta) {
                        return data == 1 ? 'Yes' : 'No'
                    },
                },
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });


        //  replacement cancel order
        $(document).on('click', '.cancelOrder', function(e){
                e.preventDefault()
                var invoice_id = $(this).data('id')
            swal({
                title: "Are you sure you want to cancel?",
                icon: "info",
                buttons: true,
                dangerMode: false,
            })
            .then((isTrue) => {
                if (isTrue) {
                    //set params
                    var params = {};
                    params.invoice_id = invoice_id;
                    $.ajax({
                        data: params,
                        url: "{{ url('order/cancel/') }}" + '/' + invoice_id,
                        type: "POST",
                        dataType: 'json',
                        success: function (data) {
                            swal("Information", "Order has been successfully cancelled!").then(res => {
                            // table.draw();
                            drawAllTable()
                        })
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }
            });
            });

        //display when set delivery is clicked
        $(document).on('click', '.editReplacementOrder ', function(e){

            const product_report_id = $(this).attr("data-id")

            $("#reportId").val(product_report_id);

            $("#fileReplacementDelivery").modal("show");
        });

        $("#replacementDelivery").on('submit', function(e) {
            e.preventDefault();

            if(!$("#txt_replacement_delivery_date").val()){

                swal("Error", "Please select a date to reschedule the delivery!")

            }else{
                //get the value of delivery date
                const resched_delivery_date = moment($("#txt_replacement_delivery_date").val()).format('MMMM D YYYY');

                //set the value for date to disdplay
                $("#replacement_delivery_to_display").val(resched_delivery_date);

                //disable the button
                $("#btnConfirmReschedOrder").attr("disabled", "disabled");

                $.ajax({
                    url:"{{ url('replacement/set-deliver') }}",
                    method:"POST",
                    data:new FormData(this),
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        swal("Information", "Order Replacement has been successfully confirmed!").then(res => {
                            $('#updateReschedModal').modal('hide');
                            // undeliverTable.draw();
                            drawAllTable()
                        })

                        $("#fileReplacementDelivery").modal("hide");

                        //disable the button
                        $("#btnConfirmReschedOrder").removeAttr("disabled");

                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }

        })

        //when display dot is clicked
        $(document).on('click', '.btnDisplayImages', function(){

            //get the data
            const product_report_id = $(this).attr("data-val")

            $.get("{{ url('order_replacement') }}" + '/' + product_report_id + '/edit', function (data) {

                var output = '';

                const file_images = data.product_file_report;

                for(var i = 0; i < file_images.length; i++){
                    console.log(file_images[i])
                    output += '<div class="col-lg-4 col-md-4 col-4">' +
                                "<a data-fancybox='' href='{{ URL('img/filereport') }}/"+ file_images[i].file_report_image +"'><img src='{{ URL('img/filereport') }}/"+ file_images[i].file_report_image +"' class='img-fluid img-thumbnail card-img-top' style='height:100px;width:100px'></a>" +
                            '</div>'
                }

                $("#divModalImages").html(output)

            })

            //display the modal
            $("#displayModalImagesHere").modal("show")
        })


        //when replacement order is approved
        // $(document).on('click', '.editReplacementOrder', function(){
        //     const reportid = $(this).attr("data-id")
        //     const clientid = $(this).attr("data-clientid")
        //     const params = {
        //         reportid,
        //         clientid,
        //         action: "approve_replacement"
        //     }
        //     swal({
        //         title: "Are you sure?",
        //         text: "Once approved, it will be confirmed",
        //         icon: "warning",
        //         buttons: true,
        //         dangerMode: false,
        //     })
        //     .then((isTrue) => {
        //         if (isTrue) {
        //             $.ajax({
        //                 type: "POST",
        //                 url: "{{ url('order_replacement') }}",
        //                 data: params,
        //                 success: function (data) {
        //                     drawAllTable();
        //                     swal(data.message, {
        //                         icon: "success",
        //                     });
        //                     // console.log(data)
        //                 },
        //                 error: function (data) {
        //                     console.log('Error:', data);
        //                 }
        //             });
        //         }
        //     });
        // })

        //when replacement order is approved
        $(document).on('click', '.editDisapproveReplacement', function(){
            const reportid = $(this).attr("data-id")
            const clientid = $(this).attr("data-clientid")
            const params = {
                reportid,
                clientid,
                action: "disapprove_replacement"
            }
            swal({
                title: "Are you sure?",
                text: "Once disapproved, it will be not be undone!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((isTrue) => {
                if (isTrue) {
                    $.ajax({
                        type: "POST",
                        url: "{{ url('order_replacement') }}",
                        data: params,
                        success: function (data) {
                            drawAllTable();
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




        /* -------------------------------------------------------------------------------
                                    DAMAGE LIST
        -------------------------------------------------------------------------------- */
        // datatable
        // var damageTable = $('#damageTable').DataTable({
        //     processing: true,
        //     serverSide: true,
        //     ajax: "{{ url('order_damage') }}",
        //     columns: [
        //         // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        //         {data: 'damageid', name: 'damageid'},
        //         {
        //             data: 'clientName', name: 'clientName',
        //             render: function(data, type, full, meta){
        //                 return full.lname + ', ' + full.fname;
        //             }
        //         },
        //         {data: 'prodname', name: 'prodname'},
        //         {
        //             data: 'is_replaced', name: 'is_replaced',
        //             "render": function (data, type, full, meta) {
        //                 var output = '';
        //                 if(data === 0){
        //                     output = '<span class="text-warning font-weight-bold">Pending</span>'
        //                 }else if(data === 1){
        //                     output = '<span class="text-success font-weight-bold">Approved</span>'
        //                 }else{
        //                     output = '<span class="text-danger font-weight-bold">Not Approved</span>'
        //                 }
        //                 return output;
        //             }
        //         },
        //         {data: 'action', name: 'action', orderable: false, searchable: false},
        //     ]
        // });

        var damageTable = $('#damageTable').DataTable({
            processing: true,
            serverSide: true,
            paging    : false,
            // ajax: "{{ url('file_replacement') }}",
            ajax: {
                url: "{{ url('file_replacement') }}",
                data: function(e){
                    e.type = 'replacement'
                }
            },
            columns: [
                // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'id', name: 'id'},
                {data: 'report_type', name: 'report_type'},
                {data: 'issued_by', name: 'issued_by'},
                {data: 'client_name', name: 'client_name'},
                {data: 'store_name', name: 'store_name'},
                {
                    data: 'products', 
                    name: 'products',
                    render: function(data, type, full, meta) {
                        return "<a href='#' class='displayProducts' data-val='"+full.products+"'>View Lists</a>"
                    }
                },
                {
                    data: 'file_report_image', name: 'file_report_image',
                    render: function(data, type, full, meta){
                        let output = ''
                        if(data != ""){
                            output = "<a href='#' class='btnDisplayImages' data-val='"+full.images+"'>View Files</a>"
                        }

                        return output
                    }
                },
                // {data: 'quantity', name: 'quantity'},
                {
                    data: 'is_replaced', name: 'is_replaced',
                    "render": function (data, type, full, meta) {
                        var output = '';
                        if(data === 0){
                            output = '<span class="text-warning font-weight-bold">Pending</span>'
                        }else if(data === 1){
                            output = '<span class="text-success font-weight-bold">Approved</span>'
                        }else{
                            output = '<span class="text-danger font-weight-bold">Declined</span>'
                        }
                        return output;
                    }
                },
                // {data: 'reason', name: 'reason'},
                {
                    data: 'reason', name: 'reason',
                    render: function(data, type, full, meta){
                        let output = '(empty)'
                        if(data != ""){
                            output = "<a href='#' id='btnReason' data-val='"+data+"'>View</a>"
                        }
                        return output
                    }
                },
                {data: 'action', name: 'action', orderable: false, searchable: false,
                    render: function(data, type, full, meta) {
                        var output = ''
                        if(!full.is_replaced){
                            output += "<a href='javascript:void(0)' data-id='"+full.id+"' data-store='"+full.store_id+"' class='btn btn-primary btn-sm editDamageOrder' data-type='replacement' data-clientid='"+full.client_id+"'  data-val='"+full.products+"'>Approve </a>";
                            output += "<a href='javascript:void(0)' data-id='"+full.id+"'  data-clientid='"+full.client_id+"' class='btn btn-danger btn-sm editDisapproveDamage mt-1'>Decline</a>";
                        } else {
                            output = 'NA';
                        }
                       return  output
                    }
                },
            ]
        });

        $(document).on('click', '#btnReason', function(e){
            e.preventDefault();
            var str = $(this).data('val')
            $("#displayReason").modal('show')
            $("#reason_div").html(str)

        })

        //when display dot is clicked
        $(document).on('click', '.btnDisplayImages', function(){

            //get the data
            const product_damage_id = $(this).attr("data-val")

            $.get("{{ url('order_damage') }}" + '/' + product_damage_id + '/edit', function (data) {

                var output = '';

                const file_images = data.product_file_damage;

                for(var i = 0; i < file_images.length; i++){
                    console.log(file_images[i])
                    output += '<div class="col-lg-4 col-md-4 col-4">' +
                                "<a data-fancybox='' href='{{ URL('img/filedamage') }}/"+ file_images[i].file_damage_image +"'><img src='{{ URL('img/filedamage') }}/"+ file_images[i].file_damage_image +"' class='img-fluid img-thumbnail card-img-top' style='height:100px;width:100px'></a>" +
                            '</div>'
                }

                $("#divModalImages").html(output)

            })

            //display the modal
            $("#displayModalImagesHere").modal("show")
        })

        //when damage order is approved
        // $(document).on('click', '.editDamageOrder', function(){
        //     const damageid = $(this).attr("data-id")
        //     const clientid = $(this).attr("data-clientid")
        //     const params = {
        //         damageid,
        //         clientid,
        //         action: "approve_damage"
        //     }
        //     swal({
        //         title: "Are you sure?",
        //         text: "Once approved, it will be confirmed",
        //         icon: "warning",
        //         buttons: true,
        //         dangerMode: false,
        //     })
        //     .then((isTrue) => {
        //         if (isTrue) {
        //             $.ajax({
        //                 type: "POST",
        //                 url: "{{ url('order_damage') }}",
        //                 data: params,
        //                 success: function (data) {
        //                     drawAllTable();
        //                     swal(data.message, {
        //                         icon: "success",
        //                     });
        //                     // console.log(data)
        //                 },
        //                 error: function (data) {
        //                     console.log('Error:', data);
        //                 }
        //             });
        //         }
        //     });
        // })

        //when damage order is approved
        $(document).on('click', '.editDisapproveDamage', function(){
            const damageid = $(this).attr("data-id")
            const clientid = $(this).attr("data-clientid")
            const params = {
                damageid,
                clientid,
                action: "disapprove_damage"
            }
            swal({
                title: "Are you sure?",
                text: "Once disapproved, it will be not be undone!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((isTrue) => {
                if (isTrue) {
                    $.ajax({
                        type: "POST",
                        url: "{{ url('order_damage') }}",
                        data: params,
                        success: function (data) {
                            drawAllTable();
                            swal(data.message, {
                                icon: "success",
                            });
                            // console.log(data)
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }
            });
        })






        /* -------------------------------------------------------------------------------
                                    TRANSACTION HISTORY LIST
        -------------------------------------------------------------------------------- */
        // datatable
        var historyTable = $('#historyTable').DataTable({
            processing: true,
            serverSide: true,
            paging    : false,
            // ajax: "{{ url('file_replacement') }}",
            ajax: {
                url: "{{ url('file_replacement') }}",
                data: function(e){
                    e.type = 'damages'
                }
            },
            columns: [
                // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'id', name: 'id'},
                {data: 'report_type', name: 'report_type'},
                {data: 'issued_by', name: 'issued_by'},
                // {data: 'client_name', name: 'client_name'},
                // {data: 'store_name', name: 'store_name'},
                {
                    data: 'products', 
                    name: 'products',
                    render: function(data, type, full, meta) {
                        return "<a href='#' class='displayProducts' data-val='"+full.products+"'>View Lists</a>"
                    }
                },
                {
                    data: 'file_report_image', name: 'file_report_image',
                    render: function(data, type, full, meta){
                        let output = ''
                        if(data != ""){
                            output = "<a href='#' class='btnDisplayImages' data-val='"+full.images+"'>View Files</a>"
                        }

                        return output
                    }
                },
                // {data: 'quantity', name: 'quantity'},
                {
                    data: 'is_replaced', name: 'is_replaced',
                    "render": function (data, type, full, meta) {
                        var output = '';
                        if(data === 0){
                            output = '<span class="text-warning font-weight-bold">Pending</span>'
                        }else if(data === 1){
                            output = '<span class="text-success font-weight-bold">Approved</span>'
                        }else{
                            output = '<span class="text-danger font-weight-bold">Declined</span>'
                        }
                        return output;
                    }
                },
                // {data: 'reason', name: 'reason'},
                {
                    data: 'reason', name: 'reason',
                    render: function(data, type, full, meta){
                        let output = '(empty)'
                        if(data != ""){
                            output = "<a href='#' id='btnReason' data-val='"+data+"'>View</a>"
                        }
                        return output
                    }
                },
                {data: 'action', name: 'action', orderable: false, searchable: false,
                    render: function(data, type, full, meta) {
                        var output = ''
                        if(!full.is_replaced){
                            output += "<a href='javascript:void(0)' data-id='"+full.id+"' data-store='"+full.store_id+"' data-type='damages' class='btn btn-primary btn-sm editDamageOrder mt-1' data-clientid='"+full.client_id+"'  data-val='"+full.products+"'>Approve </a> ";
                            output += "<a href='javascript:void(0)' data-id='"+full.id+"'  data-clientid='"+full.client_id+"' class='btn btn-danger btn-sm editDisapproveDamage mt-1'>Decline</a>";
                        } else {
                            output = 'NA';
                        }
                       return  output
                    }
                },
            ]
        });

        // var historyTable = $('#historyTable').DataTable({
        //     processing: true,
        //     serverSide: true,
        //     paging    : false,
        //     ajax: "{{ url('history') }}",
        //     columns: [
        //         // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        //         // {data: 'id', name: 'id'},
        //         // {
        //         //     data: 'fullname', name: 'fullname',
        //         //     "render": function(data, type, full, meta){
        //         //         return data.fullname
        //         //     }
        //         // },
        //         // {data: 'name', name: 'name'},
        //         // {   
        //         //     data: 'product_image', name: 'product_image',
        //         //     "render": function (data, type, full, meta) {
        //         //         return "<a data-fancybox='' href='{{ URL('img/product') }}/"+ data +"'><img src='{{ URL('img/product') }}/"+ data +"' height='20'></a>";
        //         //     },
        //         // },
        //         // {
        //         //     data: 'quantity_ordered', name: 'quantity_ordered',
        //         //     "render": function(data, type, full, meta){
        //         //         return data + " pcs"
        //         //     }
        //         // },
        //         // {
        //         //     data: 'ordered_total_price', name: 'ordered_total_price',
        //         //     "render": function(data, type, full, meta){
        //         //         return "&#x20b1; " + data
        //         //     }
        //         // },
        //         // {
        //         //     data: 'created_at', name: 'created_at',
        //         //     "render": function (data, type, full, meta) {
        //         //         return moment(data).format('MMMM D YYYY');
        //         //     },
        //         // },
        //         // {
        //         //     data: 'delivery_date', name: 'delivery_date',
        //         //     "render": function (data, type, full, meta) {
        //         //         let output = '';
        //         //         if(data === '1010-10-10'){
        //         //             output = '<span class="text-info font-weight-bold">(Not set)</span>'
        //         //         }else{
        //         //             if(full.is_cancelled == 1){
        //         //                 output = '<span class="text-danger font-weight-bold">(To be reschedule)</span>'
        //         //             }else{
        //         //                 output = moment(data).format('MMMM D YYYY');
        //         //             }
        //         //         }


        //         //         return output
        //         //     },
        //         // },
        //         {data: 'id', name: 'id'},
        //         {data: 'invoice_no', name: 'invoice_no'},
        //         {
        //             data: 'fullname', name: 'fullname',
        //             "render": function(data, type, full, meta){
        //                 return full.fullname
        //             }
        //         },
        //         {data: 'total_price', name: 'total_price'},
        //         {
        //             data: 'date_ordered', name: 'date_ordered',
        //             "render": function (data, type, full, meta) {
        //                 return moment(data).format('MMMM D YYYY');
        //             },
        //         },
        //         {
        //             data: 'delivery_date', name: 'delivery_date',
        //             "render": function (data, type, full, meta) {
        //                 let output = '';
        //                 if(full.delivery_date == null){
        //                     output = '<span class="text-info font-weight-bold">(Not set)</span>'
        //                 }else{
        //                     output = moment(data).format('MMMM D YYYY');
        //                 }

        //                 return output
        //             },
        //         },
        //         {
        //             data: 'attempt', name: 'attempt',
        //             render: function(data, type, full, meta){
                        
        //                 let output = parseInt(data) + 1
        //                 let times = output > 1 ? "times" : "time"

        //                 return output + " " + times
        //             }
        //         },
                
                
        //         {
        //             data: 'reason', name: 'reason',
        //             render: function(data, type, full, meta){
        //                 let output = ''
        //                 if(data != ""){
        //                     output = "<a href='#' class='btnDisplayReason' data-reason='"+data+"'>View</a>"
        //                 }
        //                 return output
        //             }
        //         },
        //         {
        //             data: 'is_completed', name: 'is_completed',
        //             render: function(data, type, full, meta){
        //                 let output = ''
        //                 // let output = full.is_approved == 1 ? '<span class="text-info font-weight-bold">Approved</span><br/>' : '<span class="text-danger font-weight-bold">Pending</span><br/>';

        //                 if(full.is_completed == 1){
        //                     output += '<span class="text-success font-weight-bold">Completed</span>'
        //                 }
        //                 if(full.is_cancelled == 1){
        //                     output += '<span class="text-danger font-weight-bold">Cancelled</span>'
        //                 }
        //                 if(full.is_rescheduled == 1){
        //                     output += '<span class="text-info font-weight-bold">Rescheduled</span>'
        //                 }

        //                 return output
        //             }
        //         },
        //         {data: 'action', name: 'action', orderable: false, searchable: false},
        //     ]
        // });

        //when reason dot is clicked
        $(document).on('click', '.btnDisplayReason', function(){

            //get the data
            const reason = $(this).attr("data-reason")

            //set the data
            $("#txt_history_reason").val(reason)

            //display the modal
            $("#displayReasonModal").modal("show")
        })

        function drawAllTable(){
            table.draw()
            undeliverTable.draw()
            replacementTable.draw()
            damageTable.draw();
            historyTable.draw()
        }

        $(document).on('click', '.refresh_table', function(e){
            e.preventDefault();
            tab = $(this).data('value')
            switch (tab) {
                case 'order-tab-pending':
                    table.draw()
                break;
                case 'order-tab-undelivered':
                    undeliverTable.draw()
                break;
                case 'order-replacement':
                    replacementTable.draw()
                break;
                case 'order-damage':
                    damageTable.draw();
                break;
                case 'order-tab-tran-his':
                    historyTable.draw()
                break;
            }

            var uri = window.location.toString(); 
  
            if (uri.indexOf("#") > 0) { 
                var clean_uri = uri.substring(0,  
                                uri.indexOf("#")); 
  
                window.history.replaceState({},  
                        document.title, clean_uri); 
            } 
        })

    })
</script>

@endsection