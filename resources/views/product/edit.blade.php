@extends('layouts.app')

@section('content')
<div class="container">
    <h3>{{ $product->name}}</h3>
    <div class="row">
        <div class="col-md-3 padding-2px">
            <div class="card">
                <div class="card-header">Stocks</div>
                <div class="card-body">
                    <form id="productForm" method="POST">
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                        <div class="form-group">
                            <label for="name" class="col-sm-12 control-label">Size</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="size" name="size" maxlength="50" required placeholder="ex. 100ml">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-12 control-label">Quantity</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="quantity" name="quantity" maxlength="50" required placeholder="ex.100">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-12 control-label">Price</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="price" name="price" maxlength="50" required placeholder="ex. 10">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-12 control-label">Threshold</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="threshold" name="threshold" maxlength="50" required placeholder="ex. 10">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-12 control-label">Promo</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="promo" name="promo" maxlength="50" value="0" placeholder="ex. 10">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-12 control-label">Status</label>
                            <div class="col-sm-12">
                                <select class="form-control" name="status" id="status">
                                    <option value="0">Available</option>
                                    <option value="1">UnAvailable</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success full-width-button" id="btnUpdateProduct">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-9 padding-2px">
            <form id="variationForm" name="variationForm">
                <div class="card">
                    <div class="card-header">List of Stocks</div>
                    <div class="card-body">
                        <div class="col-md-12" style="padding:0px;">
                            <select class="form-control float-right" id="filter_status" style="width: 300px;">
                                <option value="0">Available</option>
                                <option value="1">Phased out</option>
                                <option value="2">Running Low</option>
                                <option value="3">Out of Stocks</option>
                                <option value="all">All</option>
                            </select>
                        </div>
                        <br><br>
                        <table id="stocks_table" class="table table-striped table-bordered">
                            <thead class="bg-indigo-1 text-white">
                            <tr>
                                {{-- <th>ID</th> --}}
                                <th>Size</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Threshold</th>
                                <th>Promo</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">

    $( document ).ready(function() {

        //ajax setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //get data table
        // datatable
        var table = $('#stocks_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('stocks-table') }}",
                data: function(e){
                    e.product_id    = $('#product_id').val();
                    e.filter_status = $('#filter_status').val();
                }
            },
            columns: [
                // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                // {data: 'id', name: 'id'},
                {data: 'size', name: 'size'},
                {data: 'quantity', name: 'quantity'},
                {data: 'price', name: 'price'},
                {data: 'threshold', name: 'threshold'},
                {data: 'promo', name: 'promo'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $(document).on('change', '#filter_status', function(e){
            e.preventDefault();
            table.ajax.reload();
        })
        
        //edit stocks
        $(document).on('click', '.editStock', function(e){
            e.preventDefault();
            var id = $(this).data('id')
            $.get("{{ url('stocks') }}" + '/edit/' + id, function (data) {
                $('#id').val(data.id)
                $('#size').val(data.size)
                $('#quantity').val(data.quantity)
                $('#price').val(data.price)
                $('#threshold').val(data.threshold)
                $('#promo').val(data.promo)
                $('#status').val(data.status)
                $("#btnUpdateProduct").text('Update')
            })
        })

        //save edit stocks
        $(document).on('submit', '#productForm', function(e){
            e.preventDefault();
            if(confirm("Do you want to submit this data?")){
                $.ajax({
                    data: $(this).serialize(),
                    url: "{{ url('save-edit-stocks') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        table.ajax.reload();
                        $('#id').val('')
                        $('#productForm').trigger("reset");
                        swal("Information", data.message);
                        $("#btnUpdateProduct").text('Submit')
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }
        });
    })

</script>
@endsection
