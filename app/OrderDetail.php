<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = "order_details";

    protected $fillable = ['product_id','order_id','qty','total_amount'];

	public $timestamps = true;
}
