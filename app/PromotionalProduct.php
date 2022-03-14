<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromotionalProduct extends Model
{
    protected $table = 'promotional_products';

	protected $fillable = ['product_id','promotion_id'];

	public $timestamps = false;
}
