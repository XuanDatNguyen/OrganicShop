<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    protected $fillable = ['id','name','slug','image','description','category_id','is_promotion','unit_id'];

	public $timestamps = true;
}
