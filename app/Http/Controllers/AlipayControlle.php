<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AlipayControlle extends Controller
{
    public function test1(){
    	//echo __METHOD__;
    	
    		$client=new Client();	

    	$url="https://openapi.alipaydev.com/gateway.do"; //沙箱环境

    	//请求参数
    	$common_param=[
    	'out_trade_no'=>'test_1906'.time()."_".mt_rand(11111,99999),
    	'product_code'=>'FAST_INSTANT_TRADE_PAY',
    	'total_amount'=>'0.01',
    	'subject'=>'测试订单'.mt_rand(11111,99999),
    	];

    	$pub_param=[
    	'app_id'=>env('ALIPAY_APPID'),
    	'method'=>'alipay.trade.page.pay',
    	'charset'=>'utf-8',
    	'sign_type'=>'RSA2',
    	'sign'=>'asdasd',
    	'timestamp'=>date("Y-m-d H:i:s"),
    	'version'=>'1.0',
    	'biz_content'=>json_encode($common_param),
    	];

    	$params=array_merge($common_param,$pub_param);
    	echo "排序前";print_r($params);
    	sort($params);
    	echo "排序后";print_r($params);

    	$str='';
    	foreach ($params as $k => $v) {
    		$str .=$k . '=' . $v .'&';
    	}

    	$str=rtrim($str,'&');
		echo "待签名字符串：".$str;die;

		$priv_key_id=flie_get_contents(storage_path('keys/priv_ali'));
		openssl_sign($str,$sign,$priv_key_id,OPENSSL_ALGO_SHA256);
		echo "签名sign".$sign;die;
		echo "base64:".base64_encode($sign);
		$signature=base64_encode($sign);

    	$request_url=$url . $url.'?'.$str.'&sign='.urlencode($signature);

    	echo "request_url:".$request_url;

    	header("Location".$request_url);

    }
}
