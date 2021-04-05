@inject('user','App\User')
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container-fluid">
        <div class="row">
            <h4 class="center">Manage Fridge</h4>
            <button class="btn btn-info ml-auto" id="createNewFridge">Create Fridge</button>
        </div>
    </div>
    <br>
    <table id="dataTable" class="table table-striped table-bordered">
        <thead class="bg-indigo-1 text-white">
        <tr>
            <th>Fridge ID</th>
            <th>Model</th>
            <th>Description</th>
            <th>Client</th>
            {{-- <th>Location</th> --}}
            <th>Status</th>
            <th width="200px">Action</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

{{-- create/update fridge modal--}}
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
                <form id="fridgeForm" name="fridgeForm" class="form-horizontal">
                    <input type="hidden" name="fridge_id" id="fridge_id">
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="form-group">
                        <label for="fridge_name" class="col-sm-12 control-label">Fridge Model</label>
                        <div class="col-sm-12">
                            <input name="model" class="form-control" placeholder="Panasonic - 000000" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Description</label>
                        <div class="col-sm-12">
                            <input name="description" placeholder="Enter Description" class="form-control"required/>
                        </div>
                    </div>
                    {{-- <input type="hidden" name="status" value=1> --}}
                    <input type="hidden" name="cmb_user">
                    <input type="hidden" name="location">
                    <div class="form-group" hidden>
                        <label class="col-sm-12 control-label">Status</label>
                        <div class="col-sm-12">
                            <select name="status" id="status" class="form-control">
                                {{-- @foreach(config('fridge.status') as $key => $label)
                                    <option value="{{ $key  }}"> {{ $label }}</option>
                                @endforeach --}}
                                <option value="1"> UnAvailable</option>
                            </select>
                        </div>
                    </div>
<!--                     <div class="form-group">
                        <label class="col-sm-12 control-label">Client</label>
                        <div class="col-sm-12">
                            <select name="cmb_user" id="cmb_user" class="form-control" onchange="getAndSetLocation(this.options[this.selectedIndex].getAttribute('data-address'))">
                                <option value="0" data-address="None">Select User</option>
                                @foreach($user->where('user_role', 2)->get() as $usr)
                                    <option value="{{ $usr->id  }}" data-address="{{ $usr->address }}"> {{ $usr->fname.' '.$usr->lname }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> -->
                    <div class="col-sm-offset-12 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="saveBtn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Assign fridge modal--}}
<div class="modal fade" id="assignFridge" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Assign Client</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="assignForm" name="fridgeForm" class="form-horizontal">
                    <input type="hidden" name="fridge_id" id="to_be_fridge_id">
                    <input type="hidden" name="client_id" id="client_id">
                    <input type="hidden" name="store_id" id="store_id">

                    <div class="form-group">
                        <label class="col-sm-12 control-label">Client</label>
                        <div class="col-sm-12">
                            <select id="assigned-client" name="assigned-client" class="form-control">
                                @foreach(\App\User::where('user_role', '=', 2)->get() as $key => $user)
                                    <option 
                                        value="{{ $user->id  }}"
                                    >
                                        {{ $user->fname.' '.$user->lname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-sm-12 control-label">Stores</label>
                        <div class="col-sm-12">
                            <select id="client-stores" name="client-store" class="form-control" required="">
                                 <option 
                                    value=""
                                    disabled
                                    selected 
                                >Please Select Store</option>
                                @foreach(\App\User::where('user_role', '=', 2)->first()->stores as $store)
                                    <option 
                                        value="{{ $store }}"
                                    >
                                        {{ $store->store_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-sm-12 control-label">Address</label>
                        <div class="col-sm-12">
                            <input 
                                name="location" 
                                placeholder="Address" 
                                class="form-control" 
                                id="store-location"
                                disabled
                                value="" 
                            />
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

{{-- Fridget History Modal--}}
<div class="modal fade" id="fridge_history_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Fridge History</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-stripped" id="store_list_html">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Store</th>
                            <th>Address</th>
                            <th>Status</th>
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

<script type="text/javascript">
    $(function () {
        //ajax setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.fridge_history', function(e){
            e.preventDefault();
            var fridge_id = $(this).data('id')
            $.getJSON( "/fridge/history/"+fridge_id, function( data ) {
                var htmlData = ''
                var status = ``
                $.each(data, function( index, row ) {
                    htmlData += '<tr>'
                        htmlData +='<td>'+ row.id + '</td>'
                        htmlData += '<td>'+ row.store_name + '</td>'
                        htmlData += '<td>'+row.store_address+'</td>'
                        htmlData += '<td>'
                        htmlData += '<select id="fridge_status" width="60">'
                        htmlData += '<option value="available" data-id='+ row.id +' ' + (row.status == 'available' ? 'selected' : row.status) + '>Available</option>'
                        htmlData += '<option value="unavailable" data-id='+ row.id +' ' + (row.status == 'unavailable' ? 'selected' : row.status) + '>UnAvailable</option>'
                        htmlData += '</select>'
                        htmlData += '</td>'
                        htmlData += '<td>' + moment(row.created_at).format('MMMM D YYYY') + '</td>'
                        htmlData += '</tr>'
                });
               $("#store_list_html").find('tbody').html("").append(htmlData) 
               $("#fridge_history_modal").modal('show')
            });
        })

        $(document).on('change', '#fridge_status', function(e){
            e.preventDefault();
            var status = $(this).val()
            var id = $("#fridge_status option:selected").attr("data-id");
            $.get( "/fridge/edit/history/"+status+'/'+id+'/'+'setA', function( data ) {
                swal('Status has been changed.', {
                                icon: "success",
                            });
            });
        })


        // datatable
        var table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('fridge') }}",
            columns: [
                // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'id', name: 'id'},
                {data: 'model', name: 'model'},
                {data: 'description', name: 'description'},
                {data: 'assignee', name: 'assignee'},
                // {data: 'store_address', name: 'store_address'},
                {
                    data: 'status', name: 'status',
                    "render": function (data, type, full, meta) {
                        var output = '';
                        if(data == 1){
                            output = '<span class="text-success font-weight-bold">Available</span>';
                        } else if(data == 2){
                            output = '<span class="text-danger font-weight-bold"">UnAvailable</span>';
                        }
                        else if(data == 3){
                            output = '<span class="text-warning font-weight-bold"">Pull Out</span>';
                        }
                        else if(data == 4){
                            output = '<span class="text-primary font-weight-bold"">Deployed</span>';
                        }
                        // if(full.is_deleted == 1){
                        //     output = '<span class="text-danger font-weight-bold"">Deleted</span>';
                        // }else{
                        //     if(data == 1){
                        //         output = '<span class="text-success font-weight-bold">Available</span>';
                        //     }else if(data == 2){
                        //         output = '<span class="text-info font-weight-bold">In Use</span>';
                        //     }else{
                        //         output = '<span class="text-danger font-weight-bold"">For pull out</span>';
                        //     }
                        // }
                        
                        return output;
                    },
                },
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        // create new fridge
        $('#createNewFridge').click(function () {
            $('#saveBtn').html("Create");
            $('#fridge_id').val('');
            $('#fridgeForm').trigger("reset");
            $('#modelHeading').html("Create New Fridge");
            $('#ajaxModel').modal('show');
        });

        // create or update fridge
        $('#saveBtn').click(function (e) {
            e.preventDefault();

            var cmb_user = $("#cmb_user option:selected").val();

            if(cmb_user == 0){
                swal("Error", "Please select a User to proceed!");
            }else{
                $(this).html('Saving..');

                $.ajax({
                    data: $('#fridgeForm').serialize(),
                    url: "{{ url('fridge') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#fridgeForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();
                        $('#saveBtn').html('Save');
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save');
                    }
                });
            }
        });

        // edit fridge
        $('body').on('click', '.editFridge', function () {
            var fridge_id = $(this).data('id');
            $.get("{{ url('fridge') }}" + '/' + fridge_id + '/edit', function (data) {
                $('#modelHeading').html("Edit Fridge");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#fridge_id').val(data.id);
                $('input[name="model"]').val(data.model);
                $('input[name="description"]').val(data.description);
                $('input[name="status"]').val(data.status);
                $('input[name="cmb_user"]').val(data.user_id);
                $('input[name="location"]').val(data.location);
                $('#location').val(data.location);
                $('#status').val(data.status);
            })
        });

         // Assign Fridge
        $('body').on('click', '.assignFridge', function () {
            var fridge_id = $(this).data('id');
            $('#to_be_fridge_id').val(fridge_id);
            $('#assignFridge').modal('show');
        });

        // client on change
        $('#assigned-client').on('change', function () {
            const id = this.value
            $.get("{{ url('client') }}" + '/' + id + '/stores/json', function (data) {
                $('#client-stores').html('')
                data.map((store, idx) => {
                    $('#client-stores').append($('<option>', { 
                        value: store.id,
                        text : store.store_name,
                        selected : idx == 0
                    }));
                })
                 if ( data.length) {
                    $('#store-location').val(data[0].store_address)
                    $('#store_id').val(data[0].id)
                }

            })
        })

        // client-stores on change
        $('#client-stores').on('change', function () {
           const data = JSON.parse(this.value)
           $('#store-location').val(data.store_address)
           $('#store_id').val(data.id)
           $('#client_id').val(data.user_id)
        })

        $('#assignForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url:"{{ url('assign-fridge') }}",
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    $('#assignForm').trigger("reset");
                    $('#assignFridge').modal('hide');
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save');
                }
            });
        })

        // delete fridge
        $('body').on('click', '.deleteFridge', function () {
            var fridge_id = $(this).data("id");
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
                        url: "{{ url('fridge') }}" + '/' + fridge_id,
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

        // delete fridge
        $('body').on('click', '.pullOutFridge', function () {
            var fridge_id = $(this).data("id");

            swal({
                title: "Are you sure?",
                text: "Pull out this fridge",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((isTrue) => {
                if (isTrue) {
                    $.ajax({
                        type: "POST",
                        url: "{{ url('pull-out') }}",
                        data: {id: fridge_id},
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

    //------------------------------FUNCTION--------------------------//
    function getAndSetLocation(user){
        console.log(user)

        document.getElementById('location').value = address;
    }
</script>
@endsection
