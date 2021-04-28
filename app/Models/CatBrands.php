<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatBrands extends Model
{
    public $timestamps = false;
    protected $table = "cat_brands";

    public function GoodsCats() {
    	return $this->belongsTo('App\Models\GoodsCats','id');
    }

    public function Brands() {
    	return $this->belongsTo('App\Models\Brands','id');
    }
}
