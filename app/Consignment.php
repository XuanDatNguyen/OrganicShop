<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consignment extends Model
{
    protected $table = "consignments";

    protected $fillable = ['id','estimate','purchase_price','sale_price','qty','status','current_qty','sold_qty','change_qty' ,'vendor_id','product_id'];

	public $timestamps = true;
}
