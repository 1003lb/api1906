<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Model\UserModel;
class UserController extends Controller
{
  public function info(){
  	 $user_info=[
	 'user_name'=>'yanan',
	 'email'=>'yanan@qq.com',
	 'age'=>11,
	 'date'=>date('Y-m-d H:i:s')
	 ];
	 //echo json_encode($user_info);
	return $user_info;
  }

  public function reg(Request $request){
  	//echo "<p>";print_r($_POST);echo "</p>";
$data=$request->input();
$user_name=$request->input('user_name');
echo 'user_name:'.$user_name;

$user_info=[
	 'user_name'=>$request->input('user_name'),
	  'email'=>$request->input('email'),
	   'pass'=>'123456abc'
	 ];
	 $id=UserModel::insertGetId($user_info);
	 echo "自增id:".$id;
  }
}
