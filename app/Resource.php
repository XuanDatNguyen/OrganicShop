<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $table = 'resources';

	protected $fillable = ['product_id','article_id'];

	public $timestamps = false;
}
