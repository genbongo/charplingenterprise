@extends('layouts.app')

@section('content')
<div class="container">
    <!-- <div class="container-fluid">
        <div class="row">
            <h4 class="center">Quota</h4>
            <button class="btn btn-info ml-auto" id="createNewQuota">Create Quota</button>
        </div>
    </div>
    <br> -->
    <div class="container-fluid">
        <div class="row">
            <h4 class="center">Quota</h4>
        </div>
        <div class="row">
            <div class="col-md-6" style="padding:0px;">
                <select class="form-control float-left" id="filter_status" style="width: 300px;">
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                </select>
            </div>
            <div class="col-md-6" style="padding:0px;">
            <button class="btn btn-info ml-auto float-right" id="createNewQuota">Create Quota</button>
            </div>
        </div>
    </div>
    <br>
    <!-- <table id="dataTable" style="width: 100%" class="table table-striped table-bordered">
        <thead class="bg-indigo-1 text-white">
        <tr>
            <th>Year</th>
            <th>Jan</th>
            <th>Feb</th>
            <th>Mar</th>
            <th>Apr</th>
            <th>May</th>
            <th>Jun</th>
            <th>Jul</th>
            <th>Aug</th>
            <th>Sep</th>
            <th>Oct</th>
            <th>Nov</th>
            <th>Dec</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table> -->
    <table id="quota" style="width: 100%" class="table table-striped table-bordered">
        <thead class="bg-indigo-1 text-white">
        <tr>
            <th>Months</th>
            <th>Quota Value</th>
            <!-- <th>Action</th> -->
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

{{-- create/update quota modal--}}
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="quotaForm" name="quotaForm" class="form-horizontal">
                    <input type="hidden" name="quota_id" id="quota_id">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="quota_year" class="col-sm-12 control-label">Year</label>
                                <div class="col-sm-12">
                                    <select class="form-control" id="quota_year" name="quota_year"></select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="quota_jan" class="col-sm-12 control-label">January Quota</label>
                                <div class="col-sm-12">
                                    <input type="number" onkeypress="return onlyNumbers(event)" class="form-control" id="quota_jan" name="quota_jan" placeholder="Enter January Quota" value="" maxlength="50" required="" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="quota_feb" class="col-sm-12 control-label">February Quota</label>
                                <div class="col-sm-12">
                                    <input type="number" onkeypress="return onlyNumbers(event)" class="form-control" id="quota_feb" name="quota_feb" placeholder="Enter February Quota" value="" maxlength="50" required="" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="quota_mar" class="col-sm-12 control-label">March Quota</label>
                                <div class="col-sm-12">
                                    <input type="number" onkeypress="return onlyNumbers(event)" class="form-control" id="quota_mar" name="quota_mar" placeholder="March Quota name" value="" maxlength="50" required="" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="quota_apr" class="col-sm-12 control-label">April Quota</label>
                                <div class="col-sm-12">
                                    <input type="number" onkeypress="return onlyNumbers(event)" class="form-control" id="quota_apr" name="quota_apr" placeholder="April Quota name" value="" maxlength="50" required="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="quota_may" class="col-sm-12 control-label">May Quota</label>
                                <div class="col-sm-12">
                                    <input type="number" onkeypress="return onlyNumbers(event)" class="form-control" id="quota_may" name="quota_may" placeholder="Enter May Quota" value="" maxlength="50" required="" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="quota_jun" class="col-sm-12 control-label">June Quota</label>
                                <div class="col-sm-12">
                                    <input type="number" onkeypress="return onlyNumbers(event)" class="form-control" id="quota_jun" name="quota_jun" placeholder="Enter June Quota" value="" maxlength="50" required="" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="quota_july" class="col-sm-12 control-label">July Quota</label>
                                <div class="col-sm-12">
                                    <input type="number" onkeypress="return onlyNumbers(event)" class="form-control" id="quota_jul" name="quota_jul" placeholder="Enter July Quota" value="" maxlength="50" required="" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="quota_aug" class="col-sm-12 control-label">August Quota</label>
                                <div class="col-sm-12">
                                    <input type="number" onkeypress="return onlyNumbers(event)" class="form-control" id="quota_aug" name="quota_aug" placeholder="Enter August Quota" value="" maxlength="50" required="" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="quota_sep" class="col-sm-12 control-label">September Quota</label>
                                <div class="col-sm-12">
                                    <input type="number" onkeypress="return onlyNumbers(event)" class="form-control" id="quota_sep" name="quota_sep" placeholder="Enter September Quota" value="" maxlength="50" required="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="quota_oct" class="col-sm-12 control-label">October Quota</label>
                                <div class="col-sm-12">
                                    <input type="number" onkeypress="return onlyNumbers(event)" class="form-control" id="quota_oct" name="quota_oct" placeholder="Enter October Quota" value="" maxlength="50" required="" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="quota_nov" class="col-sm-12 control-label">November Quota</label>
                                <div class="col-sm-12">
                                    <input type="number" onkeypress="return onlyNumbers(event)" class="form-control" id="quota_nov" name="quota_nov" placeholder="Enter November Quota" value="" maxlength="50" required="" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="quota_dec" class="col-sm-12 control-label">December Quota</label>
                                <div class="col-sm-12">
                                    <input type="number" onkeypress="return onlyNumbers(event)" class="form-control" id="quota_dev" name="quota_dev" placeholder="Enter December Quota" value="" maxlength="50" required="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary full-width-button" id="saveBtn">Save</button>
                </form>
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

        //call the function for displaying the years
        displayYears();

        loadSalesReport()

        $(document).on('change', '#filter_status', function(e){
            e.preventDefault()
            loadSalesReport()
        })

        function displayYears(){
            //create all the years to be displayed on the dropdown
            var year_list = '<option value="999999999">Please select year</option>'

            //loop the year to 30 years starting from the current date
            for(var i = 2020; i <= 2050; i++){
                year_list += '<option value="'+i+'">'+i+'</option>';
            }
            //append the list
            $("#quota_year").empty().append(year_list);
            $("#filter_status").empty().append(year_list);
        }

        function loadSalesReport(){
            $("#set_date").text($('#filter_status').val())
            $.ajax({
                url: "{{ url('get/quota/') }}" + '/' + $("#filter_status").val(),
                method: "GET",
                data: {},
                success: function(response){
                    var htmlData = ''
                    var $status = '';
                    var $delete_status = '';
                    var  $delete_btn = '';

                    if(response.is_deleted == 0){
                        $status = 0;
                        $delete_status = 'Delete';
                        $delete_btn = 'btn-danger';
                    }else{
                        $status = 1;
                        $delete_status = 'Activate';
                        $delete_btn = 'btn-success';
                    }

                    $.each(response.list, function(key, row){
                        htmlData += `
                            <tr>
                                <td scope="row">${key}</td>
                                <td>${row}</td>
                            </tr>
                        `
                    })
                    if(response.id > 0){
                    htmlData += `<tr>
                            <td>
                                <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Update Quota" data-id="${response.id}" data-original-title="Edit" class="edit btn btn-primary btn-sm editQuota">Edit</a>
                                <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="'.$delete_status.' Quota" data-stat="${$status}" data-toggle="tooltip" data-id="${response.id}" data-original-title="Delete" class="btn ${$delete_btn} btn-sm deleteQuota">${$delete_status}</a>
                            <td>
                        <td>&nbsp;<td>
                        </tr>`
                    }
                    $("#quota").find('tbody').html("").append(htmlData)
                },
                error: function(err){
                    console.log(err)
                }
            })
        }

        // datatable
        var table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('quota') }}",
            columns: [
                // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'year', name: 'year'},
                {data: 'jan', name: 'jan'},
                {data: 'feb', name: 'feb'},
                {data: 'mar', name: 'mar'},
                {data: 'apr', name: 'apr'},
                {data: 'may', name: 'may'},
                {data: 'jun', name: 'jun'},
                {data: 'jul', name: 'jul'},
                {data: 'aug', name: 'aug'},
                {data: 'sep', name: 'sep'},
                {data: 'oct', name: 'oct'},
                {data: 'nov', name: 'nov'},
                {data: 'dev', name: 'dev'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        // create new quota
        $('#createNewQuota').click(function () {
            $('#saveBtn').html("Create");
            $('#quota_id').val('');
            $('#quotaForm').trigger("reset");
            $('#modelHeading').html("Create New Quota");
            $('#ajaxModel').modal('show');
        });

        // create or update quota
        $('#saveBtn').click(function (e) {
            e.preventDefault();
            // $(this).html('Saving..');
            
            if($("#quota_year").val() == "999999999"){
                return swal("Error", "Please input Year!");
            }
            if($("#quota_jan").val() == ""){
                return swal("Error", "Please input Quta for January!");
            }
            if($("#quota_feb").val() == ""){
                return swal("Error", "Please input Quta for February!");
            }
            if($("#quota_mar").val() == ""){
                return swal("Error", "Please input Quta for March!");
            }
            if($("#quota_apr").val() == ""){
                return swal("Error", "Please input Quta for April!");
            }
            if($("#quota_may").val() == ""){
                return swal("Error", "Please input Quta for May!");
            }
            if($("#quota_jun").val() == ""){
                return swal("Error", "Please input Quta for June!");
            }
            if($("#quota_jul").val() == ""){
                return swal("Error", "Please input Quta for July!");
            }
            if($("#quota_aug").val() == ""){
                return swal("Error", "Please input Quta for August!");
            }
            if($("#quota_sep").val() == ""){
                return swal("Error", "Please input Quta for September!");
            }
            if($("#quota_oct").val() == ""){
                return swal("Error", "Please input Quta for October!");
            }
            if($("#quota_nov").val() == ""){
                return swal("Error", "Please input Quta for November!");
            }
            if($("#quota_dev").val() == ""){
                return swal("Error", "Please input Quta for December!");
            }

            $.ajax({
                data: $('#quotaForm').serialize(),
                url: "{{ url('quota') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#quotaForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();
                    $('#saveBtn').html('Save');
                    // console.log(data)
                    loadSalesReport()
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save');
                }
            });
        });

        // edit quota
        $('body').on('click', '.editQuota', function () {
            var quota_id = $(this).data('id');
            $.get("{{ url('quota') }}" + '/' + quota_id + '/edit', function (data) {
                $('#modelHeading').html("Edit Quota");
                $('#saveBtn').html('Update');
                $('#ajaxModel').modal('show');
                $('#quota_id').val(data.id);
                $('#quota_jan').val(data.jan);
                $('#quota_feb').val(data.feb);
                $('#quota_mar').val(data.mar);
                $('#quota_apr').val(data.apr);
                $('#quota_may').val(data.may);
                $('#quota_jun').val(data.jun);
                $('#quota_jul').val(data.jul);
                $('#quota_aug').val(data.aug);
                $('#quota_sep').val(data.sep);
                $('#quota_oct').val(data.oct);
                $('#quota_nov').val(data.nov);
                $('#quota_dev').val(data.dev);
                $("#quota_year").val(data.year)
                // loadSalesReport()
            })
        });

        // delete quota
        $('body').on('click', '.deleteQuota', function () {
            var quota_id = $(this).data("id");

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to retreive this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((isTrue) => {
                if (isTrue) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ url('quota') }}" + '/' + quota_id,
                        success: function (data) {
                            table.draw();
                            swal(data.message, {
                                icon: "success",
                            });
                            loadSalesReport()
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }
            });
        });

    });
</script>
@endsection
