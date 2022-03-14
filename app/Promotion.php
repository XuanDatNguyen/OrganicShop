<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table = "promotions";

    protected $fillable = ['id','title','slug','content','image','percent','estimate','status'];

	public $timestamps = true;
}
