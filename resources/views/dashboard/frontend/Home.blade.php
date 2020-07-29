<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- jQuery -->
        <script src="{{ asset('gentelella_vendors/jquery/dist/jquery.min.js') }}"></script>
    </head>


    <body>
        <p>Hello, {{$User ?? 'No user data'}}</p>
        <p>Your Stock Number : {{$Stock ?? 'No stock data'}}</p>
    

        <button onclick="getPrice()">GET PRICE!</button>
        <script>//Get the stock price per interval by ajax.
            var refresh_interval = 5000;

            function getPrice(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
            $.ajax({
                    type:"POST",
                    url:'/PostGetPrice',
                    data:{stock_number:'2330'},
                    success:function(stock_price){
                           alert("Stock Price : "+stock_price);
                    },
                    error:function(){ 
                        alert("error!!!!");
                    },
                    complete: function () {
                        setTimeout(getPrice, refresh_interval);//If call ajax complete, call function again per interval.
                    }
                 })
            }

            setTimeout(getPrice, refresh_interval);//First time call ajax.
        </script>
    </body>

</html>
