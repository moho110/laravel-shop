<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attributes extends Model
{
    public $timestamps = false;
    protected $table = "attributes";

    public function GoodsCats() {
    	return $this->belongsTo('App\Models\GoodsCats','id');
    }
}
