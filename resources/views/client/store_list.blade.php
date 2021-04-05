@inject('areas','App\Area')
@extends('layouts.app')

@section('content')
<div class="container">
    {{-- <div class="container-fluid">
        <div class="row">
            <h4 class="center">{{ $client->fname . " ". $client->lname  }}</h4>
            <button class="btn btn-info ml-auto" id="addNewstore">Create Store</button>
        </div>
    </div>
    <br> --}}
    <div class="container-fluid">
        <div class="row">
            <h4 class="center">{{ $client->fname . " ". $client->lname  }}</h4>
        </div>
        <div class="row">
            <div class="col-md-6" style="padding:0px;">
                <select class="form-control float-left" id="filter_status" style="width: 300px;">
                    <option value="0">Pending</option>
                    <option value="1">Active</option>
                    <option value="2">Inactive</option>
                    <option value="all">All</option>
                </select>
            </div>
            <div class="col-md-6" style="padding:0px;">
                <button class="btn btn-info ml-auto float-right" id="addNewstore">Create Store</button>
            </div>
        </div>
    </div>
    <br>
    <table id="dataTable" class="table table-striped table-bordered">
        <thead class="bg-indigo-1 text-white">
        <tr>
            <th>Store ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Area</th>
            <th>Staff Assigned</th>
            <th>Status</th>
            <th width="280px">Action</th>
        </tr>   
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

{{-- create/update client modal--}}
<div class="modal fade" id="formModal" aria-hidden="true">
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
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="user_id" id="user_id" value="{{ $client->id }}">
                            <div class="form-group">
                                <label for="name" class="col-sm-12 control-label">Store Name</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="store_name" name="store_name" placeholder="Enter Store Name"
                                           value="" maxlength="50" required="" autocomplete="off" onkeypress="return onlyLetters(event)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address" class="col-sm-12 control-label">Store Address</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="store_address" name="store_address" placeholder="Enter Address"
                                           value="" maxlength="50" required="" autocomplete="off" onkeypress="return onlyLetters(event)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lname" class="col-sm-12 control-label">Area</label>
                                <div class="col-sm-12">
                                    <select  class="form-control" id="area_id" name="area_id" required>
                                        <option value='' selected>Please Select Area</option>
                                        @foreach(\App\Area::all() as $area )
                                            <option value="{{$area->id}}">{{ $area->area_name.": ".$area->area_code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
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
<style>
.dropbtn {background-color: #4CAF50;color: white;padding: 5px;font-size: 12px;border: none;cursor: pointer;border-radius: 3px;margin-left: 3px;}
.dropdown {position: relative;display: inline-block;}
.dropdown-content {display: none;position: absolute;background-color: #f9f9f9;box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);min-width: 100px;z-index: 1;}
.dropdown-content a {color: black;padding: 12px 16px;text-decoration: none;display: block;}
.dropdown-content a:hover {background-color: #f1f1f1}
.dropdown:hover .dropdown-content {display: block;}
.dropdown:hover .dropbtn { background-color: #3e8e41;}
</style>
<script type="text/javascript">

    $(document).ready(function(){
        //ajax setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        const id = {!! $client->id !!};
        // datatable
        var table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: `/client/${id}/stores`,
                data: function(e){
                    e.filter_status = $('#filter_status').val();
                }
            },
            columns: [
                // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'id', name: 'id'},
                {data: 'store_name', name: 'store_name'},
                {data: 'store_address', name: 'store_address'},
                {data: 'area', name: 'area'},
                {
                    data: 'fullname', name: 'fullname',
                    "render": function (data, type, full, meta) {
                        var output = '';

                        if(full.fullname){
                            output = full.fullname;
                        }else{
                            output = 'NA';
                        }

                        return output;
                    },
                },
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

        $(document).on('change', '#filter_status', function(e){
            e.preventDefault();
            table.ajax.reload();
        })

        // deacttivate store
         $('body').on('click', '.deactivate', function () {
            var store_id = $(this).data("id");

            var swal_text = 'Are you sure you want to deactivate the store?';

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

        // deacttivate store
        $('body').on('click', '.activate', function () {
            var store_id = $(this).data("id");

            var swal_text = 'Are you sure you want to activate the store?';

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

        $('#addNewstore').on('click', () => {
            $("#id").val('')
            $("#storeForm").trigger("reset")
            $('#saveBtn').text("Save")
            $('#modelHeading').text('Create Store')
            $('#formModal').modal('show')
        });  

        // status_update
        $('body').on('click', '.status_update', function () {
            var client_id = $(this).data("id");
            var store_id = $(this).data("store_id");
            var status = $(this).data("status");
            var swal_text = ''
            if(status == 'decline'){
                swal_text = 'Are you sure you want to decline this store?';
            }else if(status == 'accept'){
                swal_text = 'Are you sure you want to accept this store?';
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
                    $("#status_update_"+store_id).text("Sending");
                    $.ajax({
                        type: "GET",
                        url: "{{ url('client/stores/modified') }}" + '/' + client_id +'/'+status+'/'+store_id,
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
        
        $(document).on('click', ".editStore", function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $.get("{{ url('client/stores/edit') }}" + '/' + id, function (data) {
                $('#saveBtn').text("Update")
                $("#id").val(data.id)
                $('#user_id').val(data.user_id);
                $('#store_name').val(data.store_name);
                $('#store_address').val(data.store_address);
                $('#area_id').val(data.area_id);
                $('#modelHeading').text('Edit Store')
                $('#formModal').modal('show')
            })
        })
        
        $(document).on('submit', '#storeForm', function(e){
            e.preventDefault();
            $.ajax({
                    data: $(this).serialize(),
                    url: "{{ url('client/stores/add') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#storeForm').trigger("reset");
                        $('#formModal').modal('hide');
                        table.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save');
                    }
                });
            return
        })
    });
</script>
@endsection
