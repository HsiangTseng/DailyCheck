<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


// This Controller let the front-end can get the stock's data (ex : stock's name , stock's price)
class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPrice()
    {
        $stock_array = $_POST['stock_number'];
        $stock_code = '';
        $test_stock_code = '';
        if(count($stock_array) == 1)// if only post 1 stock
        {
            $stock_code = 'tse_'.$stock_array[0].'.tw_'.date("Ymd");
            $test_stock_code = 'tse_'.$stock_array[0].'.tw_20200731';
        }

        else if(count($stock_array)>1)//if post more than 1 stock
        {
            $stock_code = 'tse_'.$stock_array[0].'.tw_'.date("Ymd");
            $test_stock_code= 'tse_'.$stock_array[0].'.tw_20200731';

            foreach ($stock_array as $key => $value) {
                if($key > 0)
                {
                    $stock_code = $stock_code.'|tse_'.$stock_array[$key].'.tw_'.date("Ymd");
                    $test_stock_code = $test_stock_code.'|tse_'.$stock_array[$key].'.tw_20200731';
                }
            }
        }
            
        $client = new \GuzzleHttp\Client();
        //Stock URL ==>> 'http://mis.twse.com.tw/stock/api/getStockInfo.jsp?ex_ch=tse_2330.tw_20200729&_=CURRENT_TIME'
        $response = $client->request('GET', 'http://mis.twse.com.tw/stock/api/getStockInfo.jsp?ex_ch='.$stock_code.'&_=CURRENT_TIME',['verify' => false]);

        //echo $response->getStatusCode().'<br>'; // 200
        //echo $response->getHeaderLine('content-type').'<br>'; // 'application/json; charset=utf8'

        $data = $response->getBody();

        $json_output = json_decode($data, true); 
        //print_r($json_output);//ALL STOCK DATA


        //echo $json_output['msgArray'][0]['z'];//'z' means stock price right now.
        if(count($stock_array)==1)
        {
            $price = $json_output['msgArray'][0]['z'];
            return $price;
        }
        else if(count($stock_array)>1)
        {
            $price = $json_output['msgArray'][0]['z'];
            foreach($stock_array as $key => $value)
            {
                if($key > 0)
                {
                    $price = $price.'-'.$json_output['msgArray'][$key]['z'];
                }
            }
            return $price;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
