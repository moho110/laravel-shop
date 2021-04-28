<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdPositions extends Model
{
    public $timestamps = false;
    protected $table = "ad_positions";

    public function Ads() {
    	return $this->belongsToMany('App\Models\Ads');
    }
}
