<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\ModelTree;
use Encore\Admin\Traits\AdminBuilder;

class GoodsCats extends Model
{
    public $timestamps = false;
    protected $table = "goods_cats";

    use ModelTree, AdminBuilder;

    public function __construct(array $attributes = [])
    {
    	parent::__construct($attributes);
    	$this->setParentColumn('parentId'); //父ID
    	$this->setOrderColumn('catSort'); //排序
    	$this->setTitleColumn('catName'); //分类名称
    }

    public function goodscats()
    {
    	return $this->hasMany(GoodsCats::class, 'id',$this->getKeyName());
    }

    /**
     * 该分类的子分类
     */
    public function child()
    {
        return $this->hasMany(get_class($this), 'parentId', $this->getKeyName());
    }
 
    /**
     * 该分类的父分类
     */
    public function parent()
    {
        return $this->hasOne(get_class($this), $this->getKeyName(), 'parentId');
    }

    public function Attributes() {
        return $this->belongsToMany('App\Models\Attributes');
    }

    public function CatBrands() {
        return $this->belongsToMany('App\Models\CatBrands');
    }
}
