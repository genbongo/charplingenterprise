@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container-fluid">
        <div class="row">
            <h4 class="center">Orders Report</h4>
        </div>
        <div class="row">
            <div class="col-md-6" style="padding:0px;">
                <select class="form-control float-left" id="filter_status" style="width: 300px;">
                    <option value="ALL">ALL</option>
                    <option value="PENDING">PENDING</option>
                    <option value="FOR DELIVERY">FOR DELIVERY</option>
                    <option value="UNDELIVERED">UNDELIVERED</option>
                    <option value="REPLACEMENT">REPLACEMENT</option>
                    <option value="DAMAGES">DAMAGES</option>
                    <option value="COMPLETED">COMPLETED</option>
                </select>
            </div>
            <div class="col-md-6" style="padding:0px;">
                <button class="btn btn-info ml-auto float-right" onclick="printData();" id="print_data">Print</button> &nbsp;
                <!-- <button class="btn btn-danger ml-auto float-right mr-2" id="pdf">PDF</button> -->
                <button class="btn btn-success ml-auto float-right mr-2" onclick="exportEx('xls');" id="export_data">XLS</button>
            </div>
        </div>
    </div>
    <br>
    <br>
    <table style="width: 100%" border="1" id="order_list_html" cellpadding="10">
        <thead>
            <tr>
                <th colspan="8" style="text-align: center;"> <span id="selected_status"></span> ORDERS </th>
            </tr>
            <tr>
                <th>INVOICE NO.</th>
                <th>CLIENT NAME</th>
                <th>EMAIL</th>
                <th>CONTACT NO.</th>
                <th>STORE NAME</th>
                <th>TOTAL</th>
                <th>DATE ORDERED</th>
                <th>DELIVERY DATE</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<script src="{{ asset('js/jspdf.min.js') }}"></script>
<script src="{{ asset('js/jspdf.plugin.autotable.min.js') }}"></script>
<script src="{{ asset('js/tableHTMLExport.js') }}"></script>
<script type="text/javascript">
    $('#pdf').on('click',function(){
        $("#salesReportTableReport").tableHTMLExport({
            type:'pdf',
            filename:'top_product.pdf',
            orientation:'p'
        });
    })
    function printData()
    {
        var divToPrint=document.getElementById("order_list_html");
        newWin= window.open("");
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        newWin.close();
    }
    function exportEx(type) {
        $('#order_list_html').tableExport({
            filename: 'Orders_%DD%-%MM%-%YY%',
            format: type,
            cols: '1,2,3,4,5,6,7,8'
        });
    }
    $(function () {
        //ajax setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('change', '#filter_status', function(e){
            e.preventDefault();
            order_reports($(this).val())
        })

        order_reports($("#filter_status").val())

        // $(document).on('change')

        function order_reports(filter_status){
            $("#selected_status").text(filter_status)
            $.getJSON( "{{ url('order/reports/json') }}" + '/'+ filter_status, function( data ) {
                if(!data.length){
                    $("#export_data").prop('disabled', true)
                    $("#print_data").prop('disabled', true)
                } else {
                    $("#export_data").prop('disabled', false)
                    $("#print_data").prop('disabled', false)
                }
                var htmlData = ''
                $.each(data, function( index, row ) {
                    htmlData += `<tr>
                        <td>${row.invoice_no}</td>
                        <td>${row.fullname ?  row.fullname : 'NA'}</td>
                        <td>${row.email ? row.email: 'NA'}</td>
                        <td>${row.contact_num ? row.contact_num: 'NA'}</td>
                        <td>${row.store_name ? row.store_name : 'NA'}</td>
                        <td>${parseFloat(row.total_price).toFixed(2)}</td>
                        <td>${row.date_ordered}</td>
                        <td>${row.delivery_date}</td>
                        </tr>`
                    htmlData += `<tr>
                            <th colspan="9" style="text-align:left;">
                                ITEMS
                            </th>
                        </tr>`   
                    htmlData +=`<tr>
                        <td colspan="9">
                            <table style="width: 100%;border:0px;" border="1" cellpadding="3">
                                <tr>
                                    <th>Id</th>
                                    <th>Product</th>
                                    <th>Size</th>
                                    <th>Qty</th>
                                    <th style="text-align:right;">Sub Total</th>
                                </tr>` 
                    $.each(row.items, function( x, y ) {
                        htmlData += `
                                    <tr>
                                        <td>${y.id}</td>
                                        <td>${y.product_name}</td>
                                        <td>${y.size}</td>
                                        <td>${y.quantity_ordered}</td>
                                        <td style="text-align:right;">${y.ordered_total_price}</td>
                                    </tr>
                                `
                    }); 
                    htmlData += `</table>
                            </td>
                        </tr>` 
                });
               $("#order_list_html").find('tbody').html("").append(htmlData) 
            });
        }
    });
</script>
@endsection
