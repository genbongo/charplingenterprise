@inject('variation','App\Variation')
@extends('layouts.app')

@section('content')
<div class="container">
    {{-- <div class="container-fluid">
        <div class="row">
            <h4 class="center">Manage Product</h4>
            <button class="btn btn-info ml-auto" id="createNewProduct">Create Product</button>
        </div>
    </div>
    <br> --}}
    <div class="container-fluid">
        <div class="row">
            <h4 class="center">Manage Product</h4>
        </div>
        <div class="row">
            <div class="col-md-6" style="padding:0px;">
                <select class="form-control float-left" id="filter_status" style="width: 300px;">
                    <option value="0">Available</option>
                    <option value="1">Phased out</option>
                    {{-- <option value="2">Running Low</option>
                    <option value="3">Out of Stocks</option> --}}
                    <option value="all">All</option>
                </select>
            </div>
            <div class="col-md-6" style="padding:0px;">
                <button class="btn btn-info ml-auto float-right" id="createNewProduct">Create Product</button>
            </div>
        </div>
    </div>
    <br>
    <table id="dataTable" class="table table-striped table-bordered">
        <thead class="bg-indigo-1 text-white">
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Description</th>
            {{-- <th>Stocks</th> --}}
            {{-- <th>Threshold</th> --}}
            <th>Status</th>
            <th width="280px">Action</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

{{-- create/update product modal--}}
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
                <form id="productForm" name="productForm" class="form-horizontal" enctype="multipart/form-data">
                    <div class="alert alert-danger" role="alert" id="error_message" style="display:none;"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="product_id" id="product_id">
                            <div class="form-group">
                                <label for="name" class="col-sm-12 control-label">Product Name</label>
                                <div class="col-sm-12">
                                    <input type="hidden" class="form-control" id="name1" name="name1">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Product name"
                                           value="" maxlength="50" required="" autocomplete="off" onkeypress="return onlyLetters(event)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12 control-label">Product Description</label>
                                <div class="col-sm-12">
                                    <input for="description" type="text" class="form-control" id="description" name="description"
                                           placeholder="Enter Product Description"
                                           value="" maxlength="255" required="" autocomplete="off" onkeypress="return onlyLetters(event)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12 control-label">Product Image</label>
                                <div class="col-sm-12">
                                    <label class="new-avatar hidden"><span class="far fa-plus-square"></span>
                                        <input id="product_image" name="product_image" type="file" onchange="validateFileType()" accept="image/jpg,image/png,image/jpeg"  class="text-center center-block file-upload"/>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-12 control-label">Status</label>
                                <div class="col-sm-12">
                                    <select class="form-control" name="is_deleted" id="is_deleted">
                                        <option value="0">Available</option>
                                        <option value="1">Phase out</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-offset-12 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="saveBtn">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- update pending modal--}}
<div class="modal fade" id="lowStocksModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Low / Out of stocks</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-stripped" id="stock_out_low_body">
                    <thead>
                        <tr>
                            <th>Size</th>
                            <th>Quantity</th>
                            <th>Threshold</th>
                            <th>Price</th>
                            <th>Type</th>
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
    function validateFileType(){
        var fileName = document.getElementById("product_image").value;
        var idxDot = fileName.lastIndexOf(".") + 1;
        var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
        if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
            //TO DO
        }else{
            alert("Only jpg/jpeg and png files are allowed!");
        }   
    }
    //declare global variable
    var variation_data = [];

    $(function () {
        //ajax setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

       $(document).on('click', '.viewLowStocks', function(e){
            e.preventDefault()
            var product_id = $(this).data('id')
            $.getJSON( "/product/json/"+product_id, function( data ) {
               console.log(data)
                var htmlData = ''
                $.each(data, function( index, row ) {
                    htmlData += `<tr>
                        <td>${row.size}</td>
                        <td>${row.quantity}</td>
                        <td>${row.threshold}</td>
                        <td>${parseFloat(row.price).toFixed(2)}</td>
                        <td>${(row.quantity == 0 ? 'Out of stock' : 'Low stock')}</td>
                    </tr>`
                });
               $("#stock_out_low_body").find('tbody').html("").append(htmlData) 
               $('#lowStocksModal').modal('show');
            });
       }) 

        // datatable
        var table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            // ajax: "{{ url('product') }}",
            ajax: {
                url: "{{ url('product') }}",
                data: function(e){
                    e.filter_status = $('#filter_status').val();
                }
            },
            columns: [
                // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'id', name: 'id'},
                {   
                    data: 'product_image', name: 'product_image',
                    "render": function (data, type, full, meta) {
                        return "<a data-fancybox='' href='{{ URL('img/product') }}/"+ data +"'><img src='{{ URL('img/product') }}/"+ data +"' height='40' width='40'></a>";
                    },
                    "orderable": false
                },
                // {   
                //     data: 'product_image', name: 'product_image',
                //     "render": function (data, type, full, meta) {
                //         // 'https://storage.googleapis.com/'.$storageBucketName.'/'.$googleCloudStoragePath
                //         return `<a data-fancybox='' href='${data}'><img src='${data}' height='40' width='40'></a>`;
                //     },
                //     "orderable": false
                // },
                {data: 'name', name: 'name'},
                {data: 'description', name: 'description'},
                // {data: 'quantity', name: 'quantity'},
                // {data: 'threshold', name: 'threshold'},
                {data: 'is_deleted', name: 'is_deleted'},
                // {
                //     data: 'is_deleted', name: 'is_deleted',
                //     "render": function (data, type, full, meta) {
                //         var output = '';
                //         if(data == 0){
                //             output = '<span class="text-success font-weight-bold">Available</span>';
                //         }else{
                //             output = '<span class="text-danger font-weight-bold"">Phased out</span>';
                //         }
                //         return output;
                //     },
                // },
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $(document).on('change', '#filter_status', function(e){
            e.preventDefault();
            table.ajax.reload();
        })

        // create new product
        $('#createNewProduct').click(function () {
            $(".list-group-flush").html("")
            $('#product_image').attr("required", "");
            $('#saveBtn').html("Submit");
            $('#product_id').val("");
            $('#name1').val("");
            $('#productForm').trigger("reset");
            $('#modelHeading').html("Create Product");
            $('#ajaxModel').modal('show');
        });

        // edit product
        $('body').on('click', '.editProduct', function () {
            var product_id = $(this).data('id');
            $.get("{{ url('product') }}" + '/edit/' + product_id, function (data) {
                $('#product_image').removeAttr("required");
                $('#modelHeading').html("Edit Product");
                $('#saveBtn').html('Update');
                $('#product_id').val(data.id);
                $('#name').val(data.name);
                $('#name1').val(data.name);
                $('#description').val(data.description);
                $('#is_deleted').val(data.is_deleted);
                $('#ajaxModel').modal('show');
            })
        });

        // create or update product
        $(document).on('submit', '#productForm', function (e) {
            e.preventDefault();
            // $(this).html('Saving..');
            $('#saveBtn').html('Submitting..').prop('disabled',true);
            $("#error_message").html("").hide()
            $.ajax({
                url:"{{ url('product') }}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    if(data.status == 'exist'){
                        $('#saveBtn').html('Submit').prop('disabled',false);
                        $("#error_message").html(data.message).show()
                        return
                    } else {
                        swal("Information", data.message);
                        $('#product_id').val('');
                        $('#name1').val('');
                        $('#productForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();
                        $('#saveBtn').html('Submit').prop('disabled',false);
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Submit').prop('disabled',false);
                }
            });
        });
        
        //when form for stock is submitted
        $("#stockForm").on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url:"{{ url('stock') }}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    table.draw();
                    $('#stockModal').modal('hide');
                    swal("Information", data.message);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        })

        // delete product
        $('body').on('click', '.deleteProduct', function () {
            var product_id = $(this).data("id");
            var stat = $(this).data("stat");

            var swal_text = '';

            if(stat == 0){
                swal_text = 'Once deleted, you will not be able to retreive this!';
            }else{
                swal_text = 'Once activated, you will be able to retreive this!';
            }

            swal({
                title: "Are you sure?",
                text: swal_text,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((isTrue) => {
                if (isTrue) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ url('product') }}" + '/' + product_id,
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

    /* ----------------- size and flavor functionalites -------------------*/

    let cSize = "<?php echo $variation->size ?>".split(",");
    let cFlavor = "<?php echo $variation->flavor ?>".split(",");

    // let ccSize = variation_data[0].size.split(",");
    // let ccFlavor = variation_data[0].flavor.split(",");

    // console.log("printing variation_data");
    // console.log(variation_data);

    (function( $ ){
        $.fn.Size = function() {
          return this.each(function() {
            $list = $('<ul class="list-group list-group-flush" />');

            for(let i=cSize.length;i--;){
              if(!cSize[i]) continue;
              $list.append($('<li class="multipleInput-size"><span> '+ cSize[i] +'</span></li>')
                .append($('<a href="#" class="multipleInput-close" title="Remove">x</a>')
                  .click(function(e) {
                    $(this).parent().remove();
                    e.preventDefault();
                  })
                )
              );
            }

            var listing = [];

            // input
            var $input = $('<input name="size" id="size_input"  class="form-control" placeholder="Press semicolon (;) to add sizes" />').keyup(function(event) {
              if(event.which == 186) {
                // key press is space or comma
                var val = $(this).val().slice(0, -1); // remove space/comma from value
                if(listing.indexOf(val) !== -1){
                    return false
                }
                listing.push(val)
                if(listing.length == 0){
                    // $("#size_input").prop('required', true)
                } else {
                    $("#size_input").prop('required', false)
                }
                // append to list of emails with remove button
                $list.append($('<li class="list-group-item multipleInput-size"><span> ' + val + '</span></li>')
                  .append($('<a href="#" class="multipleInput-close" data-val='+val+' title="Remove">x</a>')
                    .click(function(e) {
                      e.preventDefault();
                      $(this).parent().remove();
                      const index = listing.indexOf(val);
                        if (index > -1) {
                            listing.splice(index, 1);
                        }
                        if(listing.length == 0){
                            // $("#size_input").prop('required', true)
                        } else {
                            $("#size_input").prop('required', false)
                        }
                    })
                  )
                );

                // $(this).attr('placeholder', '');
                // empty input
                $(this).val('');
              }
            });

            // container div
            var $container = $('<div class="multipleInput-container"  id="container-size"/>').click(function() {
              $input.focus();
            });

            // insert elements into DOM
            $container.append($list).append($input).insertAfter($(this));

            // add onsubmit handler to parent form to copy emails into original input as csv before submitting
            var $orig = $(this);
            $(this).closest('form').submit(function(e) {
              var sizes = new Array();
              $('.multipleInput-size span').each(function() {
                sizes.push($(this).html());
              });

              sizes.push($input.val());

              $orig.val(sizes.join());
              $('input[name="size"]').val(sizes.join());
            });

            return $(this).hide();
          });
        };

        $.fn.Flavor = function() {
          return this.each(function() {
            $list2 = $('<ul class="list-group list-group-flush" />');

            for(let i=cFlavor.length;i--;){
              if(!cFlavor[i]) continue;
              $list2.append($('<li class="multipleInput-flavor"><span> '+ cFlavor[i] +'</span></li>')
                .append($('<a href="#" class="multipleInput-close" title="Remove">x</a>')
                  .click(function(e) {
                    $(this).parent().remove();
                    e.preventDefault();
                  })
                )
              );
            }

            // input
            // var $input2 = $('<input name="flavor" class="form-control" placeholder="Press semicolon (;) to add flavors" onkeypress="return onlyLetters(event)" />').keyup(function(event) {

            //   if(event.which == 186) {
            //     // key press is space or comma
            //     var val = $(this).val().slice(0, -1); // remove space/comma from value

            //     // append to list of emails with remove button
            //     $list2.append($('<li class="list-group-item multipleInput-flavor"><span> ' + val + '</span></li>')
            //       .append($('<a href="#" class="multipleInput-close" title="Remove">x</a>')
            //         .click(function(e) {
            //           $(this).parent().remove();
            //           e.preventDefault();
            //         })
            //       )
            //     );

            //     $(this).attr('placeholder', '');
            //     // empty input
            //     $(this).val('');
            //   }
            // });

            // container div
            var $container = $('<div class="multipleInput-container" id="container-flavor" />').click(function() {
            //   $input2.focus();
            });

            // insert elements into DOM
            // $container.append($list2).append($input2).insertAfter($(this));

            // add onsubmit handler to parent form to copy emails into original input as csv before submitting
            var $orig = $(this);

            $(this).closest('form').submit(function(e) {

              var flavors = new Array();
              $('.multipleInput-flavor span').each(function() {
                flavors.push($(this).html());
              });

            //   flavors.push($input2.val());

              $orig.val(flavors.join());
              $('input[name="flavor"]').val(flavors.join());
            });

            return $(this).hide();
          });
        };
    })( jQuery );

    $('#size').Size();
    $('#flavor').Flavor();

</script>
@endsection
