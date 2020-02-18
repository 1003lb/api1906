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
	echo "接收到的数据";
	echo "<p>";dump($_GET);echo "</p>";
   }
public function post1(){
	//$data=file_get_contents("php://input");
	//var_dump($data);
		echo "我是api开头";
 	print_r($_POST);
 	print_r($_FILES);
 		echo "我是api结尾";
	}
public function post2(){
 	print_r($_POST);
	}
public function post3(){
 	//print_r($_POST);
// $json=file_get_contents("php://input");
  //var_dump($data);
//	$arr=json_decode($json,true);
	echo "<p>";print_r($_POST);echo "</p>";
	}
	//获取当前完整的url地址
 public function getUrl(){
 	//协议http HTTPS
 	$scheme=$_SERVER['REQUEST_SCHEME'];
 	//域名
 	$host=$_SERVER['HTTP_HOST'];
 	//请求url
 	$uri=$_SERVER['REQUEST_URI'];
 	$url=$scheme.'://'.$host.$uri;
 	echo '当前url：'.$url;echo '<hr>';
	       echo "<p>";print_r($_SERVER);echo "</p>";
	     }

public function RedisStr1(){
	$key='name';
	$val="yanan";
	Redis::set($key,$val);die;
}
public function RedisStr2(){
	$token="dsdghgfhghngghghjg";
	$key='user_token';
	$goods_info=[
	'id'=>12345,
	'goods_name'=>'Iphonex',
	'price'=>800000,
	'img'=>'fghjgjjkhjhjhf'
	];
	Redis::set($key,$token);
	Redis::expire($key,600);
	}

	public function count1(){
		//使用ua识别用户
		$ua=$_SERVER['HTTP_USER_AGENT'];
		echo $ua."<hr>";
		$u=md5($ua);
		echo "md5 ua".$u."<hr>";
		$u=substr($u,5,5);
		echo "u:".$u."<hr>";
				//限制次数
	$max= env('API_ACCESS_COUNT'); //接口限制访问次数

	//判断是否到上限
		$key=$u.':count1';
		echo $key."<hr>";
		$number=Redis::get($key);
		echo "现有访问次数：".$number."<hr>";


		//超过上限
		
		if($number>$max){
			$timeout = env('API_TIMEOUT_SECOND');
			Redis::expire($key,$timeout);
			echo "接口访问受限,超过了访问次数".$max."<hr>";
			echo "请".$timeout.'秒后访问'."<hr>";
		         die;
		}
		//redis计数
	$count=Redis::incr($key);
		echo $count."<hr>";
		echo "访问正常";

		//限定10秒内不能访问
	}

	public function api2(){
		$ua=$_SERVER['HTTP_USER_AGENT'];
		$u=md5($ua);
		$u=substr($u,5,5);
		echo "U:".$u."<hr>";
		//获取当前url
		$uri=$_SERVER['REQUEST_URI'];
		echo "URL:".$uri."<hr>";

		$md5_uri=substr(md5($uri), 0,8);
		echo $md5_uri."<hr>";

		//$key=$u.':'.$md5_uri.':count';
		$key='count:uri'.$u.':'.$md5_uri;
		echo 'Redis Key:'.$key."<hr>";

		$count=Redis::get($key);
		echo "当前接口计数:".$count."<hr>";
		$max= env('API_ACCESS_COUNT'); //接口限制访问次数
		echo "接口访问最大次数：".$max."<hr>";
		if($count > $max){
				echo "<script>alert('别老瞎刷接口');</script>";
			die;
		}
		Redis::incr($key);
	}

	public function api3(){

		$ua=$_SERVER['HTTP_USER_AGENT'];
		$u=md5($ua);
		$u=substr($u,5,5);
		echo "U:".$u."<hr>";
		//获取当前url
		$uri=$_SERVER['REQUEST_URI'];
		echo "URL:".$uri."<hr>";

		$md5_uri=substr(md5($uri), 0,8);
		echo $md5_uri."<hr>";

		//$key=$u.':'.$md5_uri.':count';
		$key='count:uri'.$u.':'.$md5_uri;
		echo 'Redis Key:'.$key."<hr>";

		
	}

}




