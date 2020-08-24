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
                        <div class="col-md-6">
                            <div class="main-card mb-3 card">
                                <form action="/EditStock" method="post">
                                    @csrf
                                    <div class="card-body"><h5 class="card-title">相關資料設定</h5>
                                        <div class="position-relative form-group"><label class="">Stock List</label><input name="stock_list" id="stock_list_id" placeholder="請填入您的股票代號列表，以「-」號隔開(ex:0050-0056)" class="form-control" 
                                            @if (Session::has('user_account'))
                                                value="{{Session::get('user_stock_list')}}"
                                            @endif>
                                        </div>
                                        <input type="hidden" name="user_id" value="{{Session::get('user_id')}}">
                                        <input type="submit" name="button" class="btn btn-success" value="編輯" />
                                    </div>
                                    @if($errors AND count($errors))
                                        <ul>
                                            @foreach ($errors->all() as $err)
                                                <p style="color:red;">*{{$err}}</p>
                                            @endforeach
                                        </ul>
                                    @endif
                                </form>
                            </div>
                        </div>
                        


                    </div>
                </div>
            </div>
            <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>
<script type="text/javascript" src="{{ asset('architectui_vendor/main.js') }}"></script>
</body>
</html>
