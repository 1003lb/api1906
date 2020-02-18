<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\GoodsStaistic;
use App\Model\Goods;
use Illuminate\Support\Facades\Redis;
class GoodsController extends Controller
{
 public function detail(Request $request){
$goods_id=$request->get('id');
 	$goods_key='str:goods:info:'.$goods_id;
echo 'redis_key:'.$goods_key;
$cache=Redis::get($goods_key);
var_dump($cache);
if($cache){
echo "有缓存";
}else{
echo "无缓存";
}
echo 'goods_id:'.$goods_id;
$goods_info=Goods::where(['id'=>$goods_id])->first();
//echo print_r($goods_info->toArray());


$j_goods_info=json_encode($goods_info);
Redis::set($goods_key,$j_goods_info);
//print_r($goods_info);
$arr=$goods_info;

    echo "商品ID：". $goods_id."<hr>";
    $ua=$_SERVER['HTTP_USER_AGENT'];
    $data=[
    		'goods_id'=>$goods_id,
    		'ua'=>$ua,
    		'ip'=>$_SERVER['REMOTE_ADDR'],
    		'created_at'=>date("Y-m-d H:i:s"),
    ];
    $id=GoodsStaistic::insertGetId($data);
    var_dump($id);echo "<br>";
    $pv =GoodsStaistic::where(['goods_id'=>$goods_id])->count();
    echo "当前pv:".$pv;echo "<br>";
    
    $uv=GoodsStaistic::where(['goods_id'=>$goods_id])->distinct('ua')->count('ua');
    echo "当前uv:".$uv;echo "<br>";
    }

 
}
