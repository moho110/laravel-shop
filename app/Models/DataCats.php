<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\ModelTree;
use Encore\Admin\Traits\AdminBuilder;

class DataCats extends Model
{
    public $timestamps = false;
    protected $table = "data_cats";

    use ModelTree, AdminBuilder;

    public function __construct(array $attributes = [])
    {
    	parent::__construct($attributes);
    	$this->setParentColumn('parentId'); //父ID
    	$this->setOrderColumn('catSort'); //排序
    	$this->setTitleColumn('catName'); //区域名称
    }

    public function datacats()
    {
    	return $this->hasMany(Datas::class, 'id',$this->getKeyName());
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
}
