<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customers";

    protected $fillable = ['name','address','phone','email','user_id'];

	public $timestamps = true;
}
