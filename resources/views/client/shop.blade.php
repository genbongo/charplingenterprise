@inject('prod','App\Product')
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5 class="text-center">All Products</h5>
            </div>
            <div class="card-body">
                <div class="row text-center text-lg-left">
                    @foreach($prod->getProduct() as $product)
                        @if($product->quantity == 0)
                        <div class="col-lg-3 col-md-4 col-6 pointer div-prod item">
                            <span class="notify-badge">Sold Out</span>
                            <img class="img-fluid img-thumbnail card-img-top shop-img" style="height:200px" src="{{ asset('img/product').'/'.$product->product_image}}" alt="">
                            <div class="padding-all-10px">
                                <h5>{{ $product->name }}</h5>
                            </div>
                        </div>
                        @else
                        <div class="col-lg-3 col-md-4 col-6 pointer div-prod item" data-val="{{ $product->id }}">
                            <img class="img-fluid img-thumbnail card-img-top shop-img" style="height:200px" src="{{ asset('img/product').'/'.$product->product_image}}" alt="">
                            <div class="padding-all-10px">
                                <h5>{{ $product->name }}</h5>
                            </div>
                        </div>
                        @endif
                        
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

{{-- pre-order modal --}}
<div class="modal fade" id="preOrderModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pre Order</h4>
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
                            <button class="btn btn-success full-width-button" id="btnAddToCart">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        //ajax setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //declare local variables
        var prod_id = '';
        var prod_image = '';
        var prod_name = '';
        var prod_desc = '';
        var prod_stocks_qty = '';

        $('body').on('click', '.div-prod', function(){
            var current_id = $(this).attr("data-val");
            $.get("{{ url('edit_product') }}" + '/' + current_id, function (data) {

                //set local variables data
                prod_id = data.product.id;
                prod_name = data.product.name;
                prod_desc = data.product.description;
                prod_stocks_qty = data.stocks[0].quantity;
                $('#product_images').html("")
                var name = data.product.product_image.split('.')
                var url  = "{{ asset('img/product') }}" +"/"+ data.product.product_image
                var jsx = `<div class="carousel-item active">
                    <img class="d-block w-100" src="${url}" alt="${name[0]}">
                  </div>`

                $('#product_images').append(jsx)

                $("#div-modal-title").html(data.product.name);

                //call the function that will populate the size dropdown
                populateSizeDropdown(data.stocks);

                //call the function that will populate the flavor dropdown
                // populateFlavorDropdown(data);

                var price = data.stocks[0].price; //$("#size_id").find(':selected').attr("data-price");
                var promo = data.stocks[0].promo; //$("#size_id").find(':selected').attr("data-promo");
                if(parseFloat(promo) > 0){
                    $("#div-modal-text").html("<span style='text-decoration: line-through;color:red;'>&#8369; " + parseFloat(price).toFixed(2) + "</span> &nbsp; &nbsp;<span>&#8369; " + promo.toFixed(2) + "</span>");
                } else {
                    $("#div-modal-text").html("<span>&#8369; " + parseFloat(price).toFixed(2) + "</span>");
                }
                
                $("#div-stocks-qty").html(prod_stocks_qty);
                $("#quantity").val('')
                $('#preOrderModal').modal('show');
            });
        });

        //when size is changed
        $("#size_id").change(() =>{
            var price = $("#size_id").find(':selected').attr("data-price");
            var promo = $("#size_id").find(':selected').attr("data-promo");
            var stock = $("#size_id").find(':selected').attr("data-stock");
            

            var qty = $("#quantity").val();
            if(parseFloat(promo) > 0){
                $("#div-modal-text").html("<span style='text-decoration: line-through;color:red;'>&#8369; " + parseFloat(price).toFixed(2) + "</span> &nbsp; &nbsp;<span>&#8369; " + parseFloat(promo).toFixed(2) + "</span>");
            } else {
                $("#div-modal-text").html("<span>&#8369; " + parseFloat(price).toFixed(2) + "</span>");
            }
            if(parseFloat(promo) > 0){
                price = promo
            }
            // $("#div-modal-text").html("&#8369; " + price + ".00");
            $("#div-stocks-qty").html(stock);
            $("#totalPrice").html("&#8369; " + parseFloat(price * qty).toFixed(2) + "");
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
        //when the quantity event is blurred
        $(document).on('input',"#quantity",function(e) {
            e.preventDefault();
            var current_val = $(this).val();
            calc(current_val)
        });

        //when button add to cart is clicked
        $("#btnAddToCart").click(function(){

            swal({
                title: "Are you sure?",
                text: "It will be stored in your cart.",
                icon: "info",
                buttons: true,
                dangerMode: false,
            })
            .then((isTrue) => {
                if (isTrue) {

                    //get all the values
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
                            // console.log("printing response");
                            // console.log(response);

                            $('#preOrderModal').modal('hide');

                            swal("Information", response.message);
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }
            });

        });

        //create a function that will populate the size dropdown
        function populateSizeDropdown(data){
            // console.log(variation_size, variation_price)
            // var variation_size = data.variation.size.split(",");
            // var variation_price = data.variation.price.split(",");
            // var variation_promo = data.variation.promo.split(",");
            // var output = '';

            // $("#totalPrice").html("&#8369; " + (variation_promo[0] > 0 ? variation_promo[0] : variation_price[0]) + ".00");

            // for(var i = 0; i < variation_size.length; i++){
            //     if(variation_size[i])
            //         output += '<option value="'+ variation_size[i] +'" data-price="'+ variation_price[i] +'" data-promo="'+ variation_promo[i] +'">'+ variation_size[i] +'</option>';
            // }

            // $("#size_id").html(output);


            var output = '';    

            // $("#totalPrice").html("&#8369; " +(data[0].promo > 0 ? data[0].promo : data[0].price).toFixed(2));
            $("#totalPrice").html("&#8369; 0.00");

            if(data.length){
                $.each(data, function(key, row){
                    output += '<option value="'+ row.size +'" data-id="'+ row.id +'" data-stock="'+ row.quantity +'" data-price="'+ row.price +'" data-promo="'+ row.promo +'">'+ row.size +'</option>';
                })
            } else {
                output += `<option val="no available size"></option>`;
            }
            $("#size_id").html(output);
        }

        //create a function that will populate the flavor dropdown
        function populateFlavorDropdown(data){

            var  variation_flavor = data.variation.flavor.split(",").filter(flavor => flavor != '');

            var output = '';

            for(var i = 0; i < variation_flavor.length; i++){
                if(variation_flavor[i])
                    output += '<option value="'+ variation_flavor[i] +'">'+ variation_flavor[i] +'</option>';
            }

            $("#flavor_id").html(output);
        }

    });
</script>

@endsection
