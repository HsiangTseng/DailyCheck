<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stock_number = $_POST['stock_number'];
        $stock_code = 'tse_'.$stock_number.'.tw_'.date("Ymd");
        $client = new \GuzzleHttp\Client();
        //Stock URL ==>> 'http://mis.twse.com.tw/stock/api/getStockInfo.jsp?ex_ch=tse_2330.tw_20200729&_=CURRENT_TIME'
        $response = $client->request('GET', 'http://mis.twse.com.tw/stock/api/getStockInfo.jsp?ex_ch='.$stock_code.'&_=CURRENT_TIME',['verify' => false]);

        //echo $response->getStatusCode().'<br>'; // 200
        //echo $response->getHeaderLine('content-type').'<br>'; // 'application/json; charset=utf8'

        $data = $response->getBody();

        $json_output = json_decode($data, true); 
        //print_r($json_output);//ALL STOCK DATA


        //echo $json_output['msgArray'][0]['z'];//'z' means stock price right now.
        $price = $json_output['msgArray'][0]['z'];
        return $price;
        //return Response::json(array('price' => $price));

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
