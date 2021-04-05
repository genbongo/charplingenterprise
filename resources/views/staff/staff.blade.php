@inject('areas','App\Area')
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container-fluid">
        <div class="row">
            <h4 class="center">Manage Staff</h4>
        </div>
        <div class="row">
            <div class="col-md-6" style="padding:0px;">
                <select class="form-control float-left" id="filter_status" style="width: 300px;">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                    <option value="all">All</option>
                </select>
            </div>
            <div class="col-md-6" style="padding:0px;">
                <button class="btn btn-info ml-auto float-right" id="createNewStaff">Create Staff</button>
            </div>
        </div>
    </div>
    <br>
    <table id="dataTable" class="table table-striped table-bordered">
        <thead class="bg-indigo-1 text-white">
        <tr>
            <th>Staff ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Area</th>
            <th>Status</th>
            <th width="280px">Action</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

{{-- create/update staff modal--}}
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
                <form id="staffForm" name="staffForm" class="form-horizontal">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="staff_id" id="staff_id">
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

{{-- assign staff modal--}}
<div class="modal fade" id="assignModal" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Assign Staff</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="assignForm" name="assignForm" class="form-horizontal">
                    <input type="hidden" name="assign_id" id="assign_id">
                    <input type="hidden" name="action" value="assign_staff">
                    <div class="form-group">
                        <label for="fullname" class="col-sm-12 control-label">Staff Full Name:</label>
                        <div class="col-sm-12">
                            <h5 id="fullname"></h5>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="area_id" class="col-md-12 col-form-label">Designated Location:</label>

                        <div class="col-md-12">
                            <select class="form-control" id="area_id" name="area_id">
                                @foreach($areas->all() as $area)
                                    @if (!in_array($area->id, $areas->getNoAvailableArea()))
                                    <option value="{{ $area->id }}">{{ $area->area_name." : ".$area->area_code }}</option>
                                    @endif
                                  
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-sm-offset-12 col-sm-10 mb-4">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    
                    <h4>Re-Assignment Records</h4>
                    <table class="table table-stripped" id="assigned_area_list">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Area</th>
                                <th>Date Assigned</th>
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

{{-- update pending modal--}}
<div class="modal fade" id="storeListModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Store List Assigned</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-stripped" id="store_list_html">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Date Created</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>

<script type="text/javascript">

    $(function () {

        //ajax setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.viewStore', function(e){
            e.preventDefault();
            var user_id = $(this).data('id')
            var area_id = $(this).data('area')
            $.getJSON( "/client/stores/"+user_id+'/'+area_id+"/json", function( data ) {
                var htmlData = ''
                $.each(data, function( index, row ) {
                    htmlData += `<tr>
                        <td>${row.id}</td>
                        <td>${row.store_name}</td>
                        <td>${row.store_address}</td>
                        <td>${moment(row.created_at).format('MMMM D YYYY')}</td>
                    </tr>`
                });
               $("#store_list_html").find('tbody').html("").append(htmlData) 
               $('#storeListModal').modal('show');
            });
        })

        // datatable
        var table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('staff') }}",
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
                {data: 'area', name: 'area'},
                {
                    data: 'is_active', name: 'is_active',
                    "render": function (data, type, full, meta) {
                        var output = '';
                        if(data == 1){
                            output = '<span class="text-success font-weight-bold">Active</span>';
                        }else{
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

        // create new staff
        $('#createNewStaff').click(function () {
            $('#saveBtn').html("Create");
            $('#staff_id').val('');
            $('#fname').removeAttr("disabled");
            $('#mname').removeAttr("disabled");
            $('#lname').removeAttr("disabled");
            $('#email').removeAttr("disabled");
            $('#contact_num').removeAttr("disabled");
            $("#div_password").show();
            $("#saveBtn").removeAttr("disabled").show();
            $('#staffForm').trigger("reset");
            $('#modelHeading').html("Create New Staff");
            $('#ajaxModel').modal('show');
            $("#password").val(randomPassword(10));
        });

        // create or update staff
        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Saving..');
            $.ajax({
                data: $('#staffForm').serialize(),
                url: "{{ url('staff') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#staffForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();
                    $('#saveBtn').html('Save');
                    swal("Information", data.message);
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save');
                }
            });
        });

        // edit staff
        $('body').on('click', '.editStaff', function () {
            var staff_id = $(this).data('id');
            $.get("{{ url('staff') }}" + '/' + staff_id + '/edit', function (data) {
                $('#modelHeading').html("Edit Staff");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#staff_id').val(data.staff.id);
                $('#fname').val(data.staff.fname);
                $('#mname').val(data.staff.mname);
                $('#lname').val(data.staff.lname);
                $('#email').val(data.staff.email);
                $('#contact_num').val(data.staff.contact_num);
                $("#div_password").hide();
                $("#action").val('update_staff_profile');
            })
        });

        // assign staff
        $('body').on('click', '.assignStaff', function () {
            var staff_id = $(this).data('id');
            $.get("{{ url('staff') }}" + '/' + staff_id + '/edit', function (data) {
                $('#assign_id').val(data.staff.id);
                $('#area_id').val(data.staff.area_id);
                $('#fullname').html(data.staff.fname + " " + data.staff.lname);

                var htmlData = ''
                $.each(data.areas, function( index, row ) {
                    htmlData += `<tr>
                        <td>${row.id}</td>
                        <td>${row.area_name + '(' + row.area_code + ')'}</td>
                        <td>${moment(row.date_assigned).format('MMMM D YYYY')}</td>
                    </tr>`
                });
               $("#assigned_area_list").find('tbody').html("").append(htmlData) 

                $('#assignModal').modal('show');
            })
        });

        // assign staff
        $('body').on('submit', '#assignForm', function (e) {
            e.preventDefault();
            $.ajax({
                data: $('#assignForm').serialize(),
                url: "{{ url('staff') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#assignForm').trigger("reset");
                    $('#assignModal').modal('hide');
                    table.draw();
                    $('#saveBtn').html('Save');
                    // swal("Information", data.message);
                    swal("Information", data.message, "success").then(function(){
                        window.location.reload();
                    });
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save');
                }
            });
        });

        // delete staff
        $('body').on('click', '.deleteStaff', function () {
            var staff_id = $(this).data("id");
            var stat = $(this).data("stat");

            var swal_text = '';

            if(stat == 0){
                swal_text = 'Once deactivated, this user cannot be able to login!';
            }else{
                swal_text = 'Once activated, this user will be able to login!';
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
                        url: "{{ url('staff') }}" + '/' + staff_id,
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
