<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    public $timestamps = false;
    protected $table = "brands";

    public function CatBrands() {
        return $this->belongsToMany('App\Models\CatBrands');
    }
}
