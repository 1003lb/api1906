<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoodsStaistic extends Model
{
    public $primaryKey='id';
         public $table='p_goods_statistic';
         public $timestamps=false;
	 	//黑名单 表设计中允许为空的
	    protected $guarded = [];	
}
