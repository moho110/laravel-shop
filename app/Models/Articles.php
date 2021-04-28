<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    public $timestamps = false;
    protected $table = "articles";

    public function ArticleCats() {
    	return $this->belongsTo('App\Models\ArticleCats','id');
    }
}
