@extends('layouts.app')
@inject('ads', 'App\Ad')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if(Auth::user()->user_role == 99)
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="card text-white bg-success mb-3" style="max-width: 28rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Today(s) <br> Delivery:</h5>
                                    <h1 id="lbl-display-order-to-deliver">0</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card text-white bg-info mb-3" style="max-width: 28rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Order(s) <br> to Approve:</h5>
                                    <h1 id="lbl-display-order-to-approve">0</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card text-white bg-danger mb-3" style="max-width: 28rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Out of <br>stocks Product(s):</h5>
                                    <h1 id="lbl-display-out-of-stock-product">0</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card text-black-50 bg-warning mb-3" style="max-width: 28rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Low of <br>stocks Product(s):</h5>
                                    <h1 id="lbl-low-stocks-product">0</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="card text-black-50 border-primary mb-3" style="width:100%;">
                                <div class="card-body">
                                    <h5 class="card-title">Weekly Sales:</h5>
                                    <canvas id="weeklySalesChart" width="1000" height="400"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row top_product_div">
                        </div>
                    @endif
                    
                    
                    @if(Auth::user()->user_role == 2)
                    <!-- Modal -->
                        @if(\App\Ad::all()->count())
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div id="slider1" class="carousel slide" data-ride="carousel">
                                                <ol class="carousel-indicators">
                                                    @foreach(\App\Ad::all() as $key => $value)
                                                    <li data-target="#carouselExampleCaptions" data-slide-to="{{$key}}" class="{{ $key == 0 ? 'active' : '' }}"></li>
                                                    @endforeach
                                                </ol>
                                                <div class="carousel-inner">
                                                    @foreach(\App\Ad::all() as $key => $value)
                                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                        <img src="{{ 'https://storage.googleapis.com/'.config('googlecloud.storage_bucket').'/img/ads/'.$value->ads_image }}">
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <a class="carousel-control-prev" href="#slider1" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" href="#slider1" role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card text-white bg-success mb-3" style="max-width: 28rem;">
                                    <div class="card-body">
                                        <h5 class="card-title">Order(s) to Receive:</h5>
                                        <a href="/transaction_history#approved"><h1 id="lbl-display-order-to-receive-client">0</h1></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card text-black-50 bg-warning mb-3" style="max-width: 28rem;">
                                    <div class="card-body">
                                        <h5 class="card-title">Order(s) to be Approved:</h5>
                                        <a href="/transaction_history#pending"><h1 id="lbl-display-order-to-approve-client">0</h1></a>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row top_product_div">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // ------------------------------------- CLIENT SCRIPTS --------------------------------//
    @if(Auth::user()->user_role == 2)
        $("#exampleModalCenter").modal("show")

        //call the function for populating the order to receive
        populate_order_to_receive_count_client();

        //create a function that will populate the count of orders to be receive
        function populate_order_to_receive_count_client(){
            $.ajax({
                url: "{{ url('display_order_to_receive_count_for_client') }}",
                method: "GET",
                data: {},
                success: function(response){
                    console.log(response)
                    //return the response to the DOM
                    $("#lbl-display-order-to-receive-client").html(response.count)
                },
                error: function(err){
                    console.log(err)
                }
            })
        }

        //call the function for populating the order to approve
        populate_order_to_approve_count_client();

        //create a function that will populate the count of orders to be approve
        function populate_order_to_approve_count_client(){
            $.ajax({
                url: "{{ url('display_order_to_approve_count_for_client') }}",
                method: "GET",
                data: {},
                success: function(response){
                    console.log(response)
                    //return the response to the DOM
                    $("#lbl-display-order-to-approve-client").html(response.count)
                },
                error: function(err){
                    console.log(err)
                }
            })
        }

    @endif

        
        //call the function that will display the best 3 product of the month
        populate_best_3_product_of_the_month()

        //create a function that will populate the product of the month
        function populate_best_3_product_of_the_month(){
            $.ajax({
                url: "{{ url('display_3_best_product_of_the_month') }}",
                method: "GET",
                data: {},
                success: function(response){
                    $(".top_product_div").html("")
                    // console.log(response)
                   
                    var htmlData = '';
                    $.each(response, function(key, row){
                        var url = "{{ 'https://storage.googleapis.com/'.config('googlecloud.storage_bucket').'/img/product/' }}"
                        var imgHTML = url + row.product_image 
                        htmlData += `<div class="col-sm-4">
                                    <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                                        <a data-fancybox='' href="${url + row.product_image}" id="a-product-of-the-month-1">
                                            <img style="max-height: 14rem;" class="card-img-top" src="${url + row.product_image}"  id="img-product-of-the-month-1"></a>
                                        <div class="card-body">
                                            <h4 class="card-title">Top Products</h4>
                                            <h5 id="lbl-product-of-the-month-1">${row.product_name}</h5>
                                        </div>
                                    </div>
                                </div>`
                    })
                    $(".top_product_div").append(htmlData)
                },
                error: function(err){
                    console.log(err)
                }
            })
        }

    // ------------------------------------- ADMIN SCRIPTS --------------------------------//
    @if(Auth::user()->user_role == 99)

        var ctx = document.getElementById('weeklySalesChart').getContext('2d');
        // var ctxSales = document.getElementById('salesChart').getContext('2d');
        
        const backgroundColor = [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(150, 100, 90, 0.2)',
        ];

        const borderColor = [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)',
            'rgba(150, 100, 90, 1)',
        ];

        //call the function that will display the count
        populate_order_to_deliver_count()

        //create a function that will populate the count of orders to be deliver
        function populate_order_to_deliver_count(){
            $.ajax({
                url: "{{ url('display_order_to_deliver_count') }}",
                method: "GET",
                data: {},
                success: function(response){
                    // console.log(response)
                    //return the response to the DOM
                    $("#lbl-display-order-to-deliver").html((response.count == null ? 0 : response.count))
                    // $("#lbl-display-order-to-deliver").html(100)
                },
                error: function(err){
                    console.log(err)
                }
            })
        }

        populate_low_stocks_producs()

        function populate_low_stocks_producs() {
            $.ajax({
                url: "{{ url('low-stocks') }}",
                method: "GET",
                data: {},
                success: function(response){
                    // console.log(response)
                    //return the response to the DOM
                    $("#lbl-low-stocks-product").html(response.count)
                },
                error: function(err){
                    console.log(err)
                }
            })
        }

        //call the function that will display the count
        populate_order_to_approve_count()

        //create a function that will populate the count of orders to be approve
        function populate_order_to_approve_count(){
            $.ajax({
                url: "{{ url('display_order_to_approve_count') }}",
                method: "GET",
                data: {},
                success: function(response){
                    // console.log(response)
                    //return the response to the DOM
                    $("#lbl-display-order-to-approve").html(response.count)
                },
                error: function(err){
                    console.log(err)
                }
            })
        }

        //call the function that will display the count
        populate_out_of_stocks_product_count()

        //create a function that will populate the count of orders to be deliver
        function populate_out_of_stocks_product_count(){
            $.ajax({
                url: "{{ url('display_out_of_stocks_product_count') }}",
                method: "GET",
                data: {},
                success: function(response){
                    // console.log(response)
                    //return the response to the DOM
                    $("#lbl-display-out-of-stock-product").html(response.count)
                },
                error: function(err){
                    console.log(err)
                }
            })
        }

        //call the function that will display the product of the month
        populate_weekly_sales_data().then(res => {
            var weeklySalesChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: returnDateAndDay(),
                    datasets: [{
                        label: 'Sales',
                        data: res ? res : [1, 2, 3, 4, 5, 6, 7],
                        backgroundColor: backgroundColor,
                        borderColor: borderColor,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        })

        //create a function that will populate the product of the month
        async function populate_weekly_sales_data(){
            const ajaxProm = new Promise((resolve, reject) => {
                $.ajax({
                    url: "{{ url('display_weekly_sales_data') }}",
                    method: "GET",
                    data: returnFirstDayToLastDayOfAWeek(),
                    success: function(response){
                        // console.log("response here: ", response)
                        resolve(response)
                    },
                    error: function(err){
                        console.log(err)
                        reject(err)
                    }
                })
            })

            const items = await ajaxProm;
            
            const result = [
                items.sun.counts,
                items.mon.counts,
                items.tue.counts,
                items.thu.counts,
                items.fri.counts,
                items.sat.counts
            ]

            return result
        }

        //create a function that will return the first day to last day in a week
        function returnFirstDayToLastDayOfAWeek(){
            var curr = new Date; // get current date
            var sun = curr.getDate() - curr.getDay(); // First day is the day of the month - the day of the week
            var mon = sun + 1; // monday is the first day + 1
            var tue = sun + 2; // tuesday is the first day + 2
            var wed = sun + 3; // wednesday is the first day + 3
            var thu = sun + 4; // thursday is the first day + 4
            var fri = sun + 5; // friday is the first day + 5
            var sat = sun + 6; // saturday is the first day + 6

            var sunday = new Date(curr.setDate(sun)).toLocaleDateString('fr-CA');
            var monday = new Date(curr.setDate(mon)).toLocaleDateString('fr-CA');
            var tuesday = new Date(curr.setDate(tue)).toLocaleDateString('fr-CA');
            var wednesday = new Date(curr.setDate(wed)).toLocaleDateString('fr-CA');
            var thursday = new Date(curr.setDate(thu)).toLocaleDateString('fr-CA');
            var friday = new Date(curr.setDate(fri)).toLocaleDateString('fr-CA');
            var saturday = new Date(curr.setDate(sat)).toLocaleDateString('fr-CA');
            
            return {
                sunday,
                monday,
                tuesday,
                wednesday,
                thursday,
                friday,
                saturday
            }

        }

        //create a function that will return the date and day
        function returnDateAndDay(){

            const items = returnFirstDayToLastDayOfAWeek()

            const sun = "Sun" + "(" + items.sunday.substring(5, 10) + ")";
            const mon = "Mon" + "(" + items.monday.substring(5, 10) + ")";
            const tue = "Tue" + "(" + items.tuesday.substring(5, 10) + ")";
            const wed = "Wed" + "(" + items.wednesday.substring(5, 10) + ")";
            const thu = "Thu" + "(" + items.thursday.substring(5, 10) + ")";
            const fri = "Fri" + "(" + items.friday.substring(5, 10) + ")";
            const sat = "Sat" + "(" + items.saturday.substring(5, 10) + ")";

            let arr = [sun, mon, tue, wed, thu, fri, sat];

            return arr

        }



        //call the function that will display the product of the month
        // populate_sales_data().then(res => {

        //     console.log("then promise", res)
            
        //     var weeklySalesChart = new Chart(ctxSales, {
        //         type: 'pie',
        //         data: {
        //             labels: ["Sales", "Loss"],
        //             datasets: [{
        //                 label: 'Total Sales',
        //                 data: [res.sales, res.loss],
        //                 backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)'],
        //                 borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
        //                 borderWidth: 1
        //             }]
        //         },
        //         options: {
        //             scales: {
        //                 yAxes: [{
        //                     ticks: {
        //                         beginAtZero: true
        //                     }
        //                 }]
        //             }
        //         }
        //     });
        // })

        //create a function that will populate the sales data
        async function populate_sales_data(){
            const ajaxProm = new Promise((resolve, reject) => {
                $.ajax({
                    url: "{{ url('display_sales_data') }}",
                    method: "GET",
                    data: {},
                    success: function(sales){
                        // console.log("sales here: ", sales)
                        // resolve(sales)

                        $.ajax({
                            url: "{{ url('display_loss_data') }}",
                            method: "GET",
                            data: {},
                            success: function(loss){
                                // console.log("sales here: ", sales.data.counts, "loss here: ", loss.data.counts)
                                resolve({
                                    sales: sales.data.counts,
                                    loss: loss.data.counts
                                })
                            },
                            error: function(err){
                                // console.log(err)
                                reject(err)
                            }
                        })
                    },
                    error: function(err){
                        // console.log(err)
                        reject(err)
                    }
                })
            })

            const items = await ajaxProm;
            
            const result = items;

            return result
        }

    @endif
</script>

@endsection