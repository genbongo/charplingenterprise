@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container-fluid">
        <div class="row">
            <h4 class="center">Cart</h4>
            <button class="btn btn-info ml-auto" id="btnCheckout">Checkout</button>
        </div>
    </div>
    <br>
    <table id="dataTable" class="table table-striped table-bordered">
        <thead class="bg-indigo-1 text-white">
        <tr>
            <th></th>
            <th>Cart ID</th>
            <th width='40'>Image</th>
            <th>Name</th>
            <th>Size</th>
            {{-- <th>Flavor</th> --}}
            <th>Quantity</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
{{-- Message Modal--}}
<div class="modal fade" id="messageCart" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Message</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4 style="color:red;">Please check item and checkout!</h4>
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
        var table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('cart') }}",
            columns: [
                // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {
                    data: 'select', 
                    name: 'select', 
                    orderable: false, 
                    render: function(data, type, full, meta) {
                        return `<input type="checkbox" name="checkoutIds[]" class="checkout" value="${full.id}" style="margin: 9px; transform: scale(1.5)">`;
                    }
                },
                {data: 'id', name: 'id'},
                {
                    data: 'product_image', name: 'product_image',
                    "render": function (data, type, full, meta) {
                        var url  = "{{ asset('img/product') }}" +"/"+ data
                        return "<a data-fancybox='' href='"+ url +"' align='center'><img src='"+ url +"' height='40' width='40'></a>";
                    },
                },
                {data: 'product_name', name: 'product_name'},
                {data: 'size', name: 'size'},
                // {data: 'flavor', name: 'flavor'},
                {data: 'quantity', name: 'quantity'},
                {
                    data: 'subtotal', name: 'subtotal',
                    "render": function (data, type, full, meta) {
                        return "&#8369; " + data +".00" ;
                    },
                },
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        // create or update cart
        $('#btnCheckout').click(function (e) {

            var ids = $('.checkout:checked').map(function(){
                return this.value;
            }).get();

            if (!ids.length) {
                $("#messageCart").modal('show')
                return;
            }

            swal({
                title: "Are you sure?",
                text: "Once confirmed, you will be redirect to transaction page",
                icon: "info",
                buttons: true,
                dangerMode: false,
            })
            .then((isTrue) => {
                if (isTrue) {
                    $.ajax({
                        data: {
                            ids
                        },
                        url: "{{ url('save_cart') }}",
                        type: "GET",
                        dataType: 'json',
                        success: function (data) {
                            //redirect to transaction page
                            if(data){
                                window.location = "{{ url('transaction') }}"
                            }
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }
            });
        });

        // delete cart
        $('body').on('click', '.deleteCart', function () {
            var cart_id = $(this).data("id");

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to retreive this",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((isTrue) => {
                if (isTrue) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ url('cart') }}" + '/' + cart_id,
                        success: function (data) {
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
        });

    });
</script>
@endsection