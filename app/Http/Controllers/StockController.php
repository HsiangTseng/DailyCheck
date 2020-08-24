<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MyDB\StockModel;
use Validator;


// This Controller let the front-end can get the stock's data (ex : stock's name , stock's price)
class StockController extends Controller
{
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

    public function getName()
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
        $response = $client->request('GET', 'http://mis.twse.com.tw/stock/api/getStockInfo.jsp?ex_ch='.$stock_code.'&_=CURRENT_TIME',['verify' => false]);
        $data = $response->getBody();
        $json_output = json_decode($data, true); 
        //print_r($json_output);//ALL STOCK DATA

        //echo $json_output['msgArray'][0]['z'];//'z' means stock price right now.
        if(count($stock_array)==1)
        {
            $name = $json_output['msgArray'][0]['n'];
            return $price;
        }
        else if(count($stock_array)>1)
        {
            $name = $json_output['msgArray'][0]['n'];
            foreach($stock_array as $key => $value)
            {
                if($key > 0)
                {
                    $name = $name.'-'.$json_output['msgArray'][$key]['n'];
                }
            }
            return $name;
        }
    }

    public function editStockList()
    {
        $input = request()->all();
        var_dump($input);
        $rules = [
            'stock_list'=>[
                'required',
                'max:100',
            ],

        ];
        $validator = Validator::make($input, $rules);
        if($validator->fails())
        {
            return redirect('/EditStock')
            ->withErrors($validator)
            ->withInput();
            //withInput let the blade.php can use old data, like {{ old('account') }}
        }
 
        $Stock = StockModel::find($input['user_id']);
        $Stock->stock_list = $input['stock_list'];
        $Stock->save();

        session()->put('user_stock_list',$input['stock_list']);
        return redirect('Home');

    }
}
