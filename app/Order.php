<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";

    protected $fillable = ['id','recipient','recipient_email','recipient_phone','recipient_address','order_note','order_total','customer_id','statuses_id'];

	public $timestamps = true;
}
