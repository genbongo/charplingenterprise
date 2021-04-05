@inject('areas','App\Area')
@extends('layouts.app')

@section('content')
<div class="container">
    {{-- <div class="container-fluid">
        <div class="row">
            <h4 class="center">Manage Clients</h4>
            <button class="btn btn-info ml-auto" id="createNewClient">Create Client</button>
        </div>
    </div> --}}
    <div class="container-fluid">
        <div class="row">
            <h4 class="center">Manage Clients</h4>
        </div>
        <div class="row">
            <div class="col-md-6" style="padding:0px;">
                <select class="form-control float-left" id="filter_status" style="width: 300px;">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                    <option value="2">Pending</option>
                    <option value="all">All</option>
                </select>
            </div>
            <div class="col-md-6" style="padding:0px;">
                <button class="btn btn-info ml-auto float-right" id="createNewClient">Create Client</button>
            </div>
        </div>
    </div>
    <br>
    <table id="dataTable" class="table table-striped table-bordered">
        <thead class="bg-indigo-1 text-white">
        <tr>
            <th>Client ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Status</th>
            <th width="220px">Action</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

{{-- create/update client modal--}}
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
                <form id="clientForm" name="clientForm" class="form-horizontal">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="client_id" id="client_id">
                            <input type="hidden" name="action" id="action">
                            <div class="form-group">
                                <label for="fname" class="col-sm-12 control-label">First Name</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter First Name"
                                           value="" maxlength="50" required="" autocomplete="off" onkeypress="return onlyLetters(event)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mname" class="col-sm-12 control-label">Middle Name</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="mname" name="mname" placeholder="Enter Middle Name"
                                           value="" maxlength="50" required="" autocomplete="off" onkeypress="return onlyLetters(event)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lname" class="col-sm-12 control-label">Last Name</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter Last Name"
                                           value="" maxlength="50" required="" autocomplete="off" onkeypress="return onlyLetters(event)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12 control-label" for="email">Email</label>
                                <div class="col-sm-12">
                                    <input type="email" class="form-control" id="email" name="email"
                                           placeholder="Enter Email"
                                           value="" maxlength="50" required="" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="contact_num" class="col-sm-12 control-label">Contact Number</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" id="contact_num" name="contact_num" placeholder="Enter Contact"
                                           value="" required="" autocomplete="off" onkeypress="return onlyNumbers(event)">
                                </div>
                            </div>
                            <div class="form-group" id="div_password">
                                <label class="col-sm-12 control-label" for="password">Generated Password</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="password" name="password"
                                           placeholder="Enter Password"
                                           value="" maxlength="50" required="" autocomplete="off">
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
            // ajax: "{{ url('client') }}",
            ajax: {
                url: "{{ url('client') }}",
                data: function(e){
                    e.filter_status = $('#filter_status').val();
                }
            },
            columns: [
                // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'id', name: 'id'},
                {data: 'fname', name: 'fname'},
                {data: 'lname', name: 'lname'},
                {data: 'email', name: 'email'},
                {data: 'contact_num', name: 'contact_num'},
                {
                    data: 'is_active', name: 'is_active',
                    "render": function (data, type, full, meta) {
                        var output = '';

                        if(full.is_pending == 1){
                            output = '<span class="text-info font-weight-bold"">Pending</span>';
                        }else{
                            if(full.is_active == 1){
                                output = '<span class="text-success font-weight-bold">Active</span>';
                            }else{
                                output = '<span class="text-danger font-weight-bold"">In-Active</span>';
                            }
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

        // create new client
        $('#createNewClient').click(function () {
            $('#saveBtn').html("Create");
            $('#client_id').val('');
            $('#clientForm').trigger("reset");
            $('#modelHeading').html("Create New Client");
            $('#ajaxModel').modal('show');
            $("#password").val(randomPassword(10));
            $("#div_password").show();
            $("#action").val('');
        });

        // create or update client
        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Saving..').attr('disabled',true);

            $.ajax({
                data: $('#clientForm').serialize(),
                url: "{{ url('client') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#clientForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();
                    $('#saveBtn').html('Save').attr('disabled',false);
                    swal("Information", data.message);
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save');
                }
            });
        });

        // edit client
        $('body').on('click', '.editClient', function () {
            var client_id = $(this).data('id');
            $.get("{{ url('client') }}" + '/' + client_id + '/edit', function (data) {
                $('#modelHeading').html("Edit Client Profile");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#client_id').val(data.id);
                $('#fname').val(data.fname);
                $('#mname').val(data.mname);
                $('#lname').val(data.lname);
                $('#email').val(data.email);
                $('#contact_num').val(data.contact_num);
                $("#div_password").hide();
                $("#action").val('update_client_profile');
            })
        });

        // status_update
        $('body').on('click', '.status_update', function () {
            var client_id = $(this).data("id");
            var status = $(this).data("status");
            var swal_text = ''
            if(status == 'decline'){
                swal_text = 'Once declined, this store will be deleted!';
            }else if(status == 'accept'){
                swal_text = 'Once accepted, this store will be able to login!';
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
                    $("#status_update_"+client_id).text("Sending");
                    $.ajax({
                        type: "GET",
                        url: "{{ url('client/modified') }}" + '/' + client_id +'/'+status,
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

        // delete client
        $('body').on('click', '.deleteClient', function () {
            var client_id = $(this).data("id");
            var stat = $(this).data("stat");

            var swal_text = '';

            if(stat == 1){
                swal_text = 'Once deactivated, this user cannot be able to login!';
            }else if(stat == 2){
                swal_text = 'Once activated, this user will be able to login!';
            }else{
                swal_text = 'Once activated, this user will be approved and able to login!';
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
                    $("#setup_client_"+client_id).text("Sending")
                    $.ajax({
                        type: "DELETE",
                        url: "{{ url('client') }}" + '/' + client_id,
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

        //--------------------------FUNCTION----------------------------------//
        function randomPassword(length) {
            var result           = '';
            var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for ( var i = 0; i < length; i++ ) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }

    });
</script>
@endsection
