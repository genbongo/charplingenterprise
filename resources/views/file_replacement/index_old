@extends('layouts.app')
@inject('products','App\Product')

@section('content')
<div class="container">
    <div class="container-fluid">
        <div class="row">
            <h4 class="center">Manage Damage Report</h4>
            <button class="btn btn-info ml-auto" id="createNewProdReport">Create Damage Report</button>
        </div>
    </div>
    <br>
    <table id="dataTable" class="table table-striped table-bordered">
        <thead class="bg-indigo-1 text-white">
        <tr>
            <th>Rep ID</th>
            <th>Report Type</th>
            <th> {{ Auth::user()->user_role == 1 ? 'Client' : 'Issued By'}}</th>
            <th>Store</th>
            <th>Products</th>
            <th>Attached File</th>
            {{-- <th>Quantity</th> --}}
            <th>Status</th>
            <th>Reason</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

{{-- create/update file_replacement modal--}}
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="prodReportForm" name="prodReportForm" class="form-horizontal" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <label>Report Type:</label>
                        <select class="form-control" id="report_type" name="report_type">
                            <option value="Replacement">Replacement</option>
                            @if (Auth::user()->user_role != 2)
                            <option value="Delivery Issues">Delivery Issues</option>
                            @endif
                        </select>
                    </div>

                    @if(Auth::user()->user_role != 2)
                        <div class="form-group">
                            <input type="hidden" id="fileCount" name="fileCount">
                            <label>Client:</label>
                            <select class="form-control" id="client_id" name="client_id" required>
                                <option value="">Please select a client</option>
                                @foreach(\App\User::where('user_role', 2)->get() as $user)
                                    <option value="{{ $user->id }}">{{ $user->fname }} {{ $user->lname }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    
                    
                    <div class="form-group">
                        <input type="hidden" id="fileCount" name="fileCount">
                        <label>Store :</label>
                        <select class="form-control" id="store_list" name="store" required>
                            <option value="">Please select a Store</option>
                            @if(Auth::user()->user_role == 2)
                                @foreach(Auth::user()->stores as $store)
                                    <option value="{{ $store->id }}">{{ $store->store_name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group" id="product_list">
                        <div class="row" id="row-1">
                            <div class="col-lg-5">
                                <select class="form-control" id="product" name="product[0]">
                                    <option value="" disabled="" selected>Select Product</option>
                                    @foreach(\App\Product::all() as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <select class="form-control" id="size-1" name="size[0]" required>
                                    <option value="">Select Size</option>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <input type="number" class="form-control"  name="quantity[0]" placeholder="Qty" required>
                            </div>
                            <div class="col-lg-3 pl-3 pt-1">
                               
                            </div>
                        </div>
                    </div>
                    <div id="appendhere">
                    </div>
                    <div class="d-flex form-group justify-content-center">
                        <button type="button" class="btn btn-success" id="addProduct">
                            Add another Product
                        </button>
                    </div>
                    <div class="form-group">
                        <label class="new-avatar hidden"><span class="far fa-plus-square"></span>
                            <input id="file_report_image" name="file_report_image[]" type="file" multiple required="" class="text-center center-block file-upload"/>
                        </label>
                    </div>
                    <div class="form-group">
                        <label>Reason:</label>
                        <textarea class="form-control" id="reason" rows="5" placeholder="Reason.." name="reason" required></textarea>
                    </div>
                    <div class="form-group">
                        <button style="width: 100%;" type="submit" class="btn btn-primary" id="saveBtn">Save</button>
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
                <h4 class="modal-title">Attached Files</h4>
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
                <div class="row">
                    <div class="col-5"><b> Product (size) </b></div>
                    <div class="col-2"><b> Price </b></div>
                    <div class="col-3"><b> Quantity </b></div>
                    <div class="col-2"><b> Total </b></div>
                </div>
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

    let productsNum = 1; 

    const products = {!! \App\Product::all() !!}
    
    const displayOptions = () => {
        let options = '';

        products.map(product => {
            options += `<option value="${product.id}">${product.name}</option>`
        });
        return options;
    }

    $('#addProduct').on('click', function(){
        var newProduct = `<div class="row mt-2" id="row-${productsNum+1}">
            <div class="col-lg-5">
                <select class="form-control" id="product" name="product[${productsNum+1}]" required>
                    <option value="" disabled="" selected>Select Product</option>
                    ${displayOptions()}
                </select>
            </div>
            <div class="col-lg-4">
                <select class="form-control" id="size-${productsNum+1}" name="size[${productsNum+1}]" required>
                    <option value="">Select Size</option>
                </select>
            </div>
            <div class="col-lg-3">
                <input type="number" class="form-control"  name="quantity[${productsNum+1}]" required placeholder="Qty">
            </div>
            <div class="col-lg-4 pl-3 pt-1">
                <button class="btn btn-sm btn-danger removeRow" row-id="row-${productsNum+1}">X</button>
            </div>
        </div>`;
        productsNum++;
        $('#appendhere').append(newProduct);
    });

    $(document).on('click', '.removeRow', function(e) {
      const id = $(this).attr("row-id");
      $(`#${id}`).remove();
    });

    $(document).on('click', '#report_type', function(e){
        e.preventDefault();
        if($(this).val() == 'Delivery Issues'){
            $('#client_id').attr('disabled', true).val('')
            $('#store_list').attr('disabled', true).val('')
        } else {
            $('#client_id').attr('disabled', false)
            $('#store_list').attr('disabled', false)
        }
    })

     $(document).on('change', '#product', function(){
        const id = $(this).val();
        const sizeSelect = $(this).parent().siblings()[0].children[0].id

        

         $.get("{{ url('get-sizes') }}" + '/' + id, function (data) {
            let sizeOptions = '';

            $.each(data, function(price, size){
                $(`#${sizeSelect}`).append(`<option data-price="${price}" value="${size +'-'+ price }" value="${size}">${size}</option>`)
            })

            // data.map(size => {
            //     if(size != null){
            //         $(`#${sizeSelect}`).append(`<option value="${size}">${size}</option>`)
            //     }
            // });
         });
     })

     $(document).on('click', '#btnReason', function(e){
        e.preventDefault();
        var str = $(this).data('val')
        $("#displayReason").modal('show')
        $("#reason_div").html(str)

    })

    $('#client_id').on('change', function() {
        const id = this.value;

        $.get(`/client/${id}/stores/json`, function (stores) {

            var storeInput = '';
            storeInput += '<option value="" disabled>Please select a Store</option>'
            stores.map(store => {
              storeInput += '<option value="'+store.id+'">'+store.store_name+'</option>'
            })
            //embed it to DOM
            $("#store_list").empty().append(storeInput)
        })
    
    })

    $(document).on('click', '.displayProducts', function(){
        const products =JSON.parse($(this).attr("data-val"));
        $('#divContentImages').empty()
        $('#divModalProducts').empty();
        $('#displayProductsModal').modal('show');
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
                    <div class="col-3">
                        ${product.quantity}
                    </div>
                    <div class="col-2">
                        ${(product.quantity * product.price).toFixed(2)}
                    </div>
                </div>`;     
        })
        jsx += `<div class="row">
                    <div class="col-10">&nbsp;</div>
                        <div class="col-2"><strong>${total.toFixed(2)}</strong></div>
                    </div>`
        $('#divModalProducts').append(jsx)
    });

    $(document).on('click', '.btnDisplayImages', function(){
        const images =JSON.parse($(this).attr("data-val"));

        $('#displayFileModal').modal('show');

        $('#divContentImages').empty()

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
            ajax: "{{ url('file_replacement') }}",
            columns: [
                // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'id', name: 'id'},
                {data: 'report_type', name: 'report_type'},
                {data: 'full_name', name: 'full_name'},
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
                // {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        // create new file_replacement
        $('#createNewProdReport').click(function () {
            $('#saveBtn').html("Create");
            $('#prodReport_id').val('');
            $('#prodReportForm').trigger("reset");
            $('#modelHeading').html("Create Damage Report");
            $('#ajaxModel').modal('show');
        });

        // create or update file_replacement
        $('#prodReportForm').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                url:"{{ url('file_replacement') }}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    $("#appendhere").html("")
                    $('#prodReportForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();
                    $('#saveBtn').html('Save');
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save');
                }
            });
        });

        //if product is changed
        $('#product_id').change(function(){

            //store the current id of the product
            const currentID = $("#product_id option:selected").val();
            
            //get the vairations of the current product
            $.get("{{ url('edit_product') }}" + '/' + currentID, function (data) {

                //variations here such as flavors and size
                var flavor_list = data.variation.flavor.slice(0, -1).split(",")
                var size_list = data.variation.size.slice(0, -1).split(",")

                var flavor_output = '';
                var size_output = '';
                for(var i = 0; i < flavor_list.length; i++){
                    flavor_output += '<option value="'+flavor_list[i]+'">'+flavor_list[i]+'</option>'
                }
                for(var i = 0; i < size_list.length; i++){
                    size_output += '<option value="'+size_list[i]+'">'+size_list[i]+'</option>'
                }
                
                //embed it to DOM
                $("#flavor_id").empty().append(flavor_output)
                $("#size_id").empty().append(size_output)

            })
        })

        //when display dot is clicked
        $(document).on('click', '.btnDisplayImages', function(){

            //get the data
            const product_report_id = $(this).attr("data-val")

            $.get("{{ url('file_replacement') }}" + '/' + product_report_id + '/edit', function (data) {

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
            $("#displayReasonModal").modal("show")
        })
    });
</script>
@endsection
