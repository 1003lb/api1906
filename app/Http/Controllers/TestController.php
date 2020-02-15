<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use GuzzleHttp\Client;
class TestController extends Controller
{
   public function index(){
	   echo "加油";
	   $key='1906';
	   $val=time();
	   Redis::set($key,$val); //set

	   $value=Redis::get($key);//获取key的值
	   echo 'value:'.$val;
   }

  public function test001(){
	   echo "加油武汉";
	 
   }

 public function test002(){
	 $user_info=[
	 'user_name'=>'yanan',
	 'email'=>'yanan@qq.com',
	 'age'=>11
	 ];
	 echo json_encode($user_info);
	// return $user_info;
   }
public function getAccessToken(){
	$app_id='wx0c07147423577602';
	$appsecret='f611f1e6030d909b04c00f8371ad11bc';
$url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$app_id.'&secret='.$appsecret;
echo $url;echo "<hr>";
//使用file_get_contents发送get请求
$response=file_get_contents($url);
var_dump($response);echo "<hr>";

$arr=json_decode($response,true);
 //print_r($arr);

	}

	public function curl1(){
		$app_id='wx0c07147423577602';
	$appsecret='f611f1e6030d909b04c00f8371ad11bc';
$url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$app_id.'&secret='.$appsecret;
echo $url;
echo "<hr>";
//初始化
$ch=curl_init($url);
//设置参数选项
	curl_setopt($ch,CURLOPT_HEADER,0);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);//0启用浏览器输出 1关闭浏览器输出 可用变量接收响应
	
	//执行会话
	$response=curl_exec($ch);
	//捕获错误
	$errno=curl_errno($ch);
	$error=curl_error($ch);
	echo "错误码：".$errno;echo "<br>";
	echo "错误信息：".$error;die;
	//dump($error);die;
	//关闭会话
	curl_close($ch);

	//echo "服务器响应的数据：";echo "<br>";
	//echo $response;

	//$arr=json_decode($response,true);
 //print_r($arr);
	}
public function curl2(){
$access_token='';
$url='https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$access_token;
$menu=[
  "button"=>[
  	[
  		"type" => "click",
  		"name" => "CURL",
  		"key" => "curl001",

  		]
  	]
 ];
//初始化
$ch=curl_init($url);
//设置参数选项
	curl_setopt($ch,CURLOPT_HEADER,0);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);//0启用浏览器输出 1关闭浏览器输出 可用变量接收响应
	//post请求
	curl_setopt($ch,CURLOPT_POST,true);
	//发送json数据 #form-data格式
curl_setopt($ch,CURLOPT_HTTPHEADER,['Content-Type:application/json']);
	curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($menu));
	//执行curl会话
	$response=curl_exec($ch);

	//捕获错误
	$errno=curl_errno($ch);
	$error=curl_error($ch);
	if($errno > 0){
	echo "错误码：".$errno;echo "<br>";
	echo "错误信息：".$error;die;
	die;
	}
	
	//关闭会话
	curl_close($ch);
	echo "错误码：".$errno;echo "<br>";
	echo "错误信息：".$error;die;
}

	public function guzzle1(){

	$app_id='wx0c07147423577602';
	$appsecret='f611f1e6030d909b04c00f8371ad11bc';
$url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$app_id.'&secret='.$appsecret;
//echo $url;echo "<hr>";
$client=new Client();	
$response=$client->request('GET',$url);
//$data=$response->getBody();
//echo $data;//获取服务端响应的数据
dd($respones);
	}

public function get1(){
	print_r($_GET);
   }
public function post1(){
	//$data=file_get_contents("php://input");
	//var_dump($data);
 	print_r($_POST);
	}
public function post2(){
 	print_r($_POST);
	}
public function post3(){
 	//print_r($_POST);
 $json=file_get_contents("php://input");
  //var_dump($data);
	$arr=json_decode($json,true);
	echo "<p>";print_r($arr);echo "</p>";
	}
 public function post5(){
	        echo 6;
	     }



}




