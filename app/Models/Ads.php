<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    public $timestamps = false;
    protected $table = "ads";

    public function AdPositions() {
    	return $this->belongsTo('App\Models\AdPositions','id');
    }
}
