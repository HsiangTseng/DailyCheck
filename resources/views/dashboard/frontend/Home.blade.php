<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>DailyCheck| </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->
<link href="{{ asset('architectui_vendor/main.css') }}" rel="stylesheet">
<script src="{{ asset('gentelella_vendors/jquery/dist/jquery.min.js') }}"></script>

</head>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <!-- ================Start Header================ -->
        @include('dashboard.layouts.header')
        <!-- ================End Header================ -->


        <div class="app-main">

            @include('dashboard.layouts.sidebar')  

            <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="row">
                        <?php
                            //Check the session data
                            /*$data = Session::all();
                            var_dump($data);*/

                            function echoStockCard($stock_number, $stock_name, $card_index)
                            {
                                echo '<div class="col-md-6 col-xl-4">';
                                    echo '<div class="card mb-3 widget-content">';
                                        echo '<div class="widget-content-outer">';
                                            echo '<div class="widget-content-wrapper">';
                                                echo '<div class="widget-content-left">';
                                                    echo '<div id= "stock_'.$card_index.'_name" class="widget-heading">名稱</div>';
                                                    echo '<div class="widget-subheading">'.$stock_number.'</div>';
                                                echo '</div>';
                                                echo '<div class="widget-content-right">';
                                                    echo '<div id= "stock_'.$card_index.'_price" class="widget-numbers text-primary">取得資料中</div>';
                                                echo '</div>';
                                            echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                            }
                            $Stock = Session::get('user_stock_list');
                            $front_end_stock = $Stock;
                            $front_end_stock_array = explode("-",$front_end_stock);
                            foreach($front_end_stock_array as $key => $value)
                            {
                                echoStockCard($value, 'SEAN', $key);
                            }
                        ?>
                        <script>
                            var stock_list = '{{$Stock ?? '2330'}}';
                            var stock_array = stock_list.split("-");
                            var refresh_interval = 20000;
                            
                            //Use ajax get the stock price per n sec;
                            function getPrice(){
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                                });
                            $.ajax({
                                    type:"POST",
                                    url:'/PostGetPrice',
                                    data:{stock_number:stock_array},
                                    success:function(stock_price){
                                            //alert(stock_price);
                                            var stock_array = stock_price.split("-");
                                            for (var i = 0 ; i < stock_array.length ; i++)
                                            {
                                              var id = "stock_"+i+"_price";
                                              document.getElementById(id).innerHTML= stock_array[i];
                                            }
                                            //document.getElementById("stock_1_price").innerHTML= stock_price;
                                    },
                                    error:function(){ 
                                        alert("Get Stock Price API ERROR");
                                    },
                                    complete: function () {
                                        setTimeout(getPrice, refresh_interval);//If call ajax complete, call function again per interval.
                                    }
                                  })
                            }
                            setTimeout(getPrice, "1000");//First time call ajax.

                            $(document).ready(function() {
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                    });
                                $.ajax({
                                        type:"POST",
                                        url:'/PostGetName',
                                        data:{stock_number:stock_array},
                                        success:function(stock_name){
                                                //alert(stock_price);
                                                var stock_array = stock_name.split("-");
                                                for (var i = 0 ; i < stock_array.length ; i++)
                                                {
                                                  var id = "stock_"+i+"_name";
                                                  document.getElementById(id).innerHTML= stock_array[i];
                                                }
                                                //document.getElementById("stock_1_price").innerHTML= stock_price;
                                        },
                                        error:function(){ 
                                            alert("Get Stock Name API ERROR");
                                        },
                                      })
                              });
                        </script>
                        <!-- Example Card-->
                        <!--div class="col-md-6 col-xl-4">
                            <div class="card mb-3 widget-content">
                                <div class="widget-content-outer">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Total Orders</div>
                                            <div class="widget-subheading">Last year expenses</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-success">1896</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div-->
                    </div>
                </div>
            </div>
            <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>
<script type="text/javascript" src="{{ asset('architectui_vendor/main.js') }}"></script>
</body>
</html>
