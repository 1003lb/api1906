<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;
class ApiFilter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    	//echo date("Y-m-d H:i:s");
        
    	$uri=$_SERVER['REQUEST_URI'];
		
		$ua=$_SERVER['HTTP_USER_AGENT'];
		
		$md5_uri=substr(md5($uri),5,8);
		$md5_ua=substr(md5($uri),5,8);

		$key='count:uri'.$md5_ua.':'.$md5_uri;
		echo $key;
		$count=Redis::get($key);
		echo "当前访问计数:".$count."<hr>";
		$max= env('API_ACCESS_COUNT'); //接口限制访问次数
		if($count > $max){
				echo "<script>alert('停止你那愚蠢的行为');</script>";

					Redis::expire($key,env('API_TIMEOUT_SECOND'));
			die;
		}
		Redis::incr($key);
		echo "<hr>";
        return $next($request);
    }
}
