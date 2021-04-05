@inject('areas','App\Area')
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container-fluid">
        <div class="row">
            <h4 class="center">Store</h4>
            <button class="btn btn-info ml-auto" id="createNewStore">Create Store</button>
        </div>
    </div>
    <br>
    <table id="dataTable" class="table table-striped table-bordered">
        <thead class="bg-indigo-1 text-white">
        <tr>
            <th>Store ID</th>
            <th>Store Name</th>
            <th>Store Address</th>
            <th>Area</th>
            <th>Staff Assigned</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

{{-- create/update store modal--}}
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
                <form id="storeForm" name="storeForm" class="form-horizontal">
                    <input type="hidden" name="store_id" id="store_id">
                    <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                    <div class="form-group">
                        <label for="store_name" class="col-sm-12 control-label">Store Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="store_name" name="store_name" placeholder="Enter Store Name"
                                   value="" maxlength="50" required="" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Store Address</label>
                        <div class="col-sm-12">
                            <input for="store_address" type="text" class="form-control" id="store_address" name="store_address"
                                   placeholder="Enter Store Address"
                                   value="" required="" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="area_id" class="col-sm-12 control-label">Designated Location</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="area_id" name="area_id">
                                @foreach($areas->all() as $area)
                                  <option value="{{ $area->id }}">{{ $area->area_name." : ".$area->area_code }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-offset-12 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="saveBtn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- update fridge modal--}}
<div class="modal fade" id="fridgeListModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Fridge List</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmPendingOrder" name="frmPendingOrder" class="form-horizontal">
                    <table class="table table-stripped" id="store_list_html">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Model</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Date Created</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </form>
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
            ajax: "{{ url('store') }}",
            columns: [
                // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'id', name: 'id'},
                {data: 'store_name', name: 'store_name'},
                {data: 'store_address', name: 'store_address'},
                {data: 'area_name', name: 'area_name'},
                {data: 'fullname', name: 'fullname'},
                {
                    data: 'is_deleted', name: 'is_deleted',
                    "render": function (data, type, full, meta) {
                        var output = '';
                        if(full.is_deleted == 0){
                            output = '<span class="text-warning font-weight-bold"">Pending</span>';
                        }else if(full.is_deleted == 1){
                            output = '<span class="text-success font-weight-bold">Active</span>';
                        } else {
                            output = '<span class="text-danger font-weight-bold"">In-Active</span>';
                        }
                        return output;
                    },
                },
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        // create new store
        $('#createNewStore').click(function () {
            $('#saveBtn').html("Create");
            $('#store_id').val('');
            $('#storeForm').trigger("reset");
            $('#modelHeading').html("Create New Store");
            $('#ajaxModel').modal('show');
        });

        // create or update store
        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Saving..');

            $.ajax({
                data: $('#storeForm').serialize(),
                url: "{{ url('store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#storeForm').trigger("reset");
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

        // edit store
        $('body').on('click', '.editStore', function () {
            var store_id = $(this).data('id');
            $.get("{{ url('store') }}" + '/' + store_id + '/edit', function (data) {
                $('#modelHeading').html("Edit Store");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#store_id').val(data.id);
                $('#area_id').val(data.area_id);
                $('#store_name').val(data.store_name);
                $('#store_address').val(data.store_address);
            })
        });

        // delete store
        $('body').on('click', '.deleteStore', function () {
            var store_id = $(this).data("id");
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
                        url: "{{ url('store') }}" + '/' + store_id,
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

        $(document).on('click', '.viewFridge', function(e){
            e.preventDefault()
            var store_id = $(this).data('id')
            $.getJSON( "/client/stores/fridge/"+store_id, function( data ) {
                var htmlData = ''
                $.each(data, function( index, row ) {
                    htmlData += `<tr>
                        <td>${row.id}</td>
                        <td>${row.model}</td>
                        <td>${row.description}</td>
                        <td>${row.status}</td>
                        <td>${moment(row.created_at).format('MMMM D YYYY')}</td></tr>`
                });
               $("#store_list_html").find('tbody').html("").append(htmlData) 
               $('#fridgeListModal').modal('show');
            });
        })

    });
</script>
@endsection
