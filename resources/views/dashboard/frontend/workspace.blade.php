<?php
//$stock_number = $_POST['stock_number'];
//return $stock_number;

$client = new \GuzzleHttp\Client();
$response = $client->request('GET', 'http://mis.twse.com.tw/stock/api/getStockInfo.jsp?ex_ch=tse_2330.tw_20200729&_=CURRENT_TIME',['verify' => false]);

echo $response->getStatusCode().'<br>'; // 200
echo $response->getHeaderLine('content-type').'<br>'; // 'application/json; charset=utf8'

$data = $response->getBody();

$json_output = json_decode($data, true); 
print_r($json_output);//ALL STOCK DATA


//echo $json_output['msgArray'][0]['z'];//'z' means stock price right now.
$price = $json_output['msgArray'][0]['z'];
//return $price;
echo $price;

echo date("Ymd");

?>