@extends('layouts.app')

@section('content')
<div class="container">
    <!-- <div class="container-fluid">
        <div class="row">
            <h4 class="center">Sales Report</h4>
        </div>
    </div> -->
    <div class="container-fluid">
        <div class="row">
            <h4 class="center">Sales Report</h4>
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
            </div>
        </div>
    </div>
    <br>
    <div style="width:100%;" class="mb-5">
		<canvas id="canvas"></canvas>
	</div>
    <button class="btn btn-info ml-auto float-right" onclick="printData();" id="print_data">Print</button> &nbsp;
    <button class="btn btn-danger ml-auto float-right mr-2" id="export_data">PDF</button>
    <button class="btn btn-success ml-auto float-right mr-2" onclick="exportEx('xls');">XLS</button>
    <br/>
    <br/>
    <table id="salesReportTableReport" class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Months</th>
                <th scope="col">Products</th>
                <th scope="col">Total Items Sold</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
        <tr>
                <th>&nbsp;</th>
                <th scope="col"><span id="set_date"></span> Top Products Report</th>
                <th>&nbsp;</th>
            </tr>
        </tfoot>
    </table>
</div>
<script src="{{ asset('js/jspdf.min.js') }}"></script>
<script src="{{ asset('js/jspdf.plugin.autotable.min.js') }}"></script>
<script src="{{ asset('js/tableHTMLExport.js') }}"></script>
<script>
    $('#export_data').on('click',function(){
        $("#salesReportTableReport").tableHTMLExport({
            type:'pdf',
            filename:'top_product.pdf',
            orientation:'p'
        });
    })
    function printData()
    {
        var divToPrint=document.getElementById("salesReportTableReport");
        newWin= window.open("");
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        newWin.close();
    }

    function exportEx(type) {
        $('#salesReportTableReport').tableExport({
            filename: 'top_products_report%DD%-%MM%-%YY%',
            format: type,
            cols: '1,2,3'
        });
    }
    
    loadSalesReport($('#filter_status').val())  
      
    function loadSalesReport(){
        $("#set_date").text($('#filter_status').val())
        $.ajax({
            url: "{{ url('statistic_reports') }}" + '/' + $("#filter_status").val(),
            method: "GET",
            data: {},
            success: function(response){
                statisticsChart(response.loss, response.sales);
                var htmlData = ''
                $.each(response.list, function(key, row){
                    htmlData += `
                        <tr>
                            <td scope="row">${key}</td>
                            <td>${row.products ? row.products : 'NA'}</td>
                            <td>${row.total ? row.total : 0}</td>
                        </tr>
                    `
                    $("#salesReportTableReport").find('tbody').html("").append(htmlData)
                })
            },
            error: function(err){
                console.log(err)
            }
        })
    }

    $(document).on('change', '#filter_status', function(e){
        e.preventDefault()
        loadSalesReport($(this).val())
    })

    // window.onload = function() {
    //     var ctx = document.getElementById('canvas').getContext('2d');
    //     window.myLine = new Chart(ctx, config);
    // };

    function statisticsChart(data1, data2){
        var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        var config = {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [{
                    label: 'Loss',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: data1,
                    fill: false,
                }, {
                    label: 'Sales',
                    fill: false,
                    backgroundColor: 'rgb(54, 162, 235)',
                    borderColor: 'rgb(54, 162, 235)',
                    data: data2,
                }]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: '2021 Statistic Reports'
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Data'
                        }
                    }]
                }
            }
        };
        var ctx = document.getElementById('canvas').getContext('2d');
        window.myLine = new Chart(ctx, config);
        window.myLine.update();
    }
</script>




<script type="text/javascript">
    $(() => {

        //ajax setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        /* -------------------------------------------------------------------------------
                                    TRANSACTION HISTORY LIST
        -------------------------------------------------------------------------------- */
        // datatable
        var salesReportTable = $('#salesReportTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('sales') }}",
            columns: [
                // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'id', name: 'id'},
                {
                    data: 'fname', name: 'fname',
                    "render": function(data, type, full, meta){
                        return full.lname + ', ' + full.fname
                    }
                },
                {data: 'name', name: 'name'},
                {   
                    data: 'product_image', name: 'product_image',
                    "render": function (data, type, full, meta) {
                        return "<a data-fancybox='' href='{{ URL('img/product') }}/"+ data +"'><img src='{{ URL('img/product') }}/"+ data +"' height='20'></a>";
                    },
                },
                {
                    data: 'quantity_ordered', name: 'quantity_ordered',
                    "render": function(data, type, full, meta){
                        return data + " pcs"
                    }
                },
                {
                    data: 'ordered_total_price', name: 'ordered_total_price',
                    "render": function(data, type, full, meta){
                        return "&#x20b1; " + data
                    }
                },
                {
                    data: 'created_at', name: 'created_at',
                    "render": function (data, type, full, meta) {
                        return moment(data).format('MMMM D YYYY');
                    },
                },
                {
                    data: 'delivery_date', name: 'delivery_date',
                    "render": function (data, type, full, meta) {
                        let output = '';
                        if(data === '1010-10-10'){
                            output = '<span class="text-info font-weight-bold">(Not set)</span>'
                        }else{
                            if(full.is_cancelled == 1){
                                output = '<span class="text-danger font-weight-bold">(To be reschedule)</span>'
                            }else{
                                output = moment(data).format('MMMM D YYYY');
                            }
                        }

                        return output
                    },
                },
                // {
                //     data: 'attempt', name: 'attempt',
                //     render: function(data, type, full, meta){

                //         let output = parseInt(data) + 1
                //         let times = output > 1 ? "times" : "time"

                //         return output + " " + times
                //     }
                // },
                // {
                //     data: 'reason', name: 'reason',
                //     render: function(data, type, full, meta){
                //         let output = ''
                //         if(data != ""){
                //             output = "<a href='#' class='btnDisplayReason' data-reason='"+data+"'>...</a>"
                //         }

                //         return output
                //     }
                // },
                {
                    data: 'is_completed', name: 'is_completed',
                    render: function(data, type, full, meta){
                        let output = full.is_approved == 1 ? '<span class="text-info font-weight-bold">Approved</span><br/>' : '<span class="text-danger font-weight-bold">Pending</span><br/>';

                        if(full.is_completed == 1){
                            output = '<span class="text-success font-weight-bold">Completed</span>'
                        }

                        return output
                    }
                },
            ]
        });

    })
</script>

@endsection