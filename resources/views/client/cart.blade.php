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
            <th>&nbsp;</th>
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


{{-- pre-order modal --}}
<div class="modal fade" id="preOrderModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Cart</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card" style="width: 100%;">
                            <div class="card-body padding-all-10px">
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner" id="product_images"></div>
                                </div>
                                <br> 
                                <h5 class="card-title" id="div-modal-title"></h5>
                                <p class="card-text" id="div-modal-text"></p>
                            </div>
                            <div class="card-body padding-all-10px">
                                <p class="card-text">Stocks: 
                                    <span id="div-stocks-qty">0</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="size_id" class="col-md-12 col-form-label">Size:</label>
                            <div class="col-md-12">
                                <input type="hidden" name="cart_id" id="cart_id">
                                <select class="form-control" id="size_id" name="size_id"></select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="quantity" class="col-md-12 col-form-label">Quantity:</label>
                            <div class="col-md-12">
                                <input 
                                    class="form-control" 
                                    type="number" 
                                    id="quantity" 
                                    name="quantity" 
                                    placeholder="0"
                                />
                            </div>
                        </div>
                        <div class="form-group">
                            <div id="totalPrice"></div>
                            <button class="btn btn-success full-width-button" id="btnAddToCart">Update</button>
                        </div>
                    </div>
                </div>
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

        $("#quantity").on("keypress keyup blur",function (event) {    
           $(this).val($(this).val().replace(/[^\d].+/, ""));
            if ((event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });

         //declare local variables
        var prod_id = '';
        var prod_image = '';
        var prod_name = '';
        var prod_desc = '';
        var prod_stocks_qty = '';

        // datatable
        var table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('cart') }}",
            columns: [
                {data: 'select', name: 'select', orderable: false},
                {data: 'id', name: 'id'},
                // {
                //     data: 'product_image', name: 'product_image',
                //     render: function (data, type, full, meta) {
                //         var url  = "{{ 'https://storage.googleapis.com/'.config('googlecloud.storage_bucket').'/img/product/' }}"+ data
                //         return "<a data-fancybox='' href='"+ url +"' align='center'><img src='"+ url +"' height='40' width='40'></a>";
                //     },
                //     orderable: false
                // },
                {
                    data: 'product_image', name: 'product_image',
                    "render": function (data, type, full, meta) {
                        var url  = "{{ asset('img/product') }}" +"/"+ data
                        return "<a data-fancybox='' href='"+ url +"' align='center'><img src='"+ url +"' height='40' width='40'></a>";
                    },
                },
                {data: 'product_name', name: 'product_name',},
                {data: 'size', name: 'size'},
                {data: 'quantity', name: 'quantity'},
                {
                    data: 'subtotal', name: 'subtotal',
                    "render": function (data, type, full, meta) {
                        return "&#8369; " + data +".00" ;
                    }
                },
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            initComplete: function( settings, json ) {
                setTimeout(() => {
                    $('th').removeClass('sorting_asc');
                },100)
            }
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
                        url: "{{ url('save_cart') }}",
                        type: "POST",
                        data: { ids:ids },
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

        /** 
            ################ EDIT CART HERE ##############################3
        */
        //when button add to cart is clicked
        $("#btnAddToCart").click(function(){
            var quantity = $("#quantity").val();
            if(parseInt(quantity) <= 0){
                swal("Error", "Sorry, There was an error adding this product to your cart. ");
                return
            } else {
                    swal({
                        title: "Are you sure?",
                        text: "It will update your cart.",
                        icon: "info",
                        buttons: true,
                        dangerMode: false,
                    })
                    .then((isTrue) => {
                        if (isTrue) {

                            //get all the values
                            var cart_id = $("#cart_id").val();
                            var size = $("#size_id").val();
                            var price = $("#size_id").find(':selected').attr("data-price");
                            var promo = $("#size_id").find(':selected').attr("data-promo");
                            var prod_stocks_qty = $("#size_id").find(':selected').attr("data-stock");
                            var product_stock_id = $("#size_id").find(':selected').attr("data-id");
                            // var flavor = $("#flavor_id").val();
                            var quantity = $("#quantity").val();
                        
                            //check if the current quantity selected is greater than the current stocks
                            if(parseFloat(quantity) > parseFloat(prod_stocks_qty)){
                                return swal("Error", "Sorry! You’ve reached the stock limit. Please enter a lesser quantity.");
                            }

                            if(!size || !price || !quantity){
                                return swal("Error", "Sorry, There was an error adding this product to your cart. ");
                            }

                            if(parseFloat(promo) > 0){
                                price = promo
                            }
                            //declare a parameters to be stored in session
                            var params = {};

                            //set value to parameter
                            params.cart_id              = cart_id;
                            params.product_id           = prod_id;
                            params.product_stock_id     = product_stock_id;
                            params.product_image        = prod_image;
                            params.product_name         = prod_name;
                            params.product_description  = prod_desc;
                            params.size                 = size;
                            params.flavor               = '';
                            params.price                = price;
                            params.quantity             = quantity;
                            params.subtotal             = price * quantity;

                            $.ajax({
                                type: "POST",
                                url: "{{ url('cart') }}",
                                data: params,
                                success: function (response) {
                                    table.draw();
                                    $('#preOrderModal').modal('hide');
                                    swal("Information", response.message);
                                },
                                error: function (data) {
                                    console.log('Error:', data);
                                }
                            });
                        }
                    });
                }
            });

        $('#dataTable').on('click', '.div-prod', function(){
            var current_id          = $(this).data("val"),
                product_stock_id    = $(this).data("stock_id"),
                selected_quantity   = $(this).data("quantity")
                cart_id   = $(this).data("id")
            $.get("{{ url('edit_product') }}" + '/' + current_id, function (data) {
                $("#cart_id").val(cart_id)
                //set local variables data
                prod_id = data.product.id;
                prod_name = data.product.name;
                prod_desc = data.product.description;
                prod_stocks_qty = data.stocks[0].quantity;
                $('#product_images').html("")
                var name = data.product.product_image.split('.')
                var url  = "{{ asset('img/product') }}" +"/"+ data.product.product_image
                // var url  = "{{ 'https://storage.googleapis.com/'.config('googlecloud.storage_bucket').'/img/product/' }}" + data.product.product_image
                var jsx = `<div class="carousel-item active">
                    <img class="d-block w-100" src="${url}" alt="${name[0]}">
                  </div>`

                $('#product_images').append(jsx)

                $("#div-modal-title").html(data.product.name);

                //call the function that will populate the size dropdown
                populateSizeDropdown(data.stocks, product_stock_id);

                //call the function that will populate the flavor dropdown
                // populateFlavorDropdown(data);
                var price = data.stocks[0].price;
                var promo = data.stocks[0].promo;
                if(parseFloat(promo) > 0){
                    $("#div-modal-text").html("<span style='text-decoration: line-through;color:red;'>&#8369; " + parseFloat(price).toFixed(2) + "</span> &nbsp; &nbsp;<span>&#8369; " + promo.toFixed(2) + "</span>");
                } else {
                    $("#div-modal-text").html("<span>&#8369; " + parseFloat(price).toFixed(2) + "</span>");
                }
                
                $("#div-stocks-qty").html(prod_stocks_qty);
                $("#quantity").val(selected_quantity).trigger('input')
                $('#preOrderModal').modal('show');
            });
        });

        //when the quantity event is blurred
        $(document).on('input',"#quantity",function(e) {
            e.preventDefault();
            var current_val = $(this).val();
            calc(current_val)
        });

        function calc(current_val){
            var stock = $("#size_id").find(':selected').attr("data-stock");
            if(parseFloat(current_val) == 0 || parseFloat(current_val) == ''){
                $("#quantity").val(0);
            }else{
                var price = $("#size_id").find(':selected').attr("data-price");
                var promo = $("#size_id").find(':selected').attr("data-promo");
                if(parseFloat(promo) > 0){
                    price = promo
                }
                if(parseFloat(current_val) > parseInt(stock)){
                    current_val = stock;
                    $("#quantity").val(current_val);
                }
                setTimeout( () => {
                        const totalPrice = price * current_val;
                        $("#totalPrice").html("&#8369; " + parseFloat(totalPrice).toFixed(2));
                },100)
            }
        }

        //create a function that will populate the size dropdown
        function populateSizeDropdown(data, product_stock_id ){
            var output = '';    
            $("#totalPrice").html("&#8369; 0.00");

            if(data.length){
                $.each(data, function(key, row){
                    output += '<option value="'+ row.size +'" ' + (product_stock_id == row.id ? "selected" : "") + ' data-id="'+ row.id +'" data-stock="'+ row.quantity +'" data-price="'+ row.price +'" data-promo="'+ row.promo +'">'+ row.size +'</option>';
                })
            } else {
                output += `<option val="no available size"></option>`;
            }
            $("#size_id").html(output);
        }

    });
</script>
@endsection