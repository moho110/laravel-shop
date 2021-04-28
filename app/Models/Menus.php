<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\ModelTree;
use Encore\Admin\Traits\AdminBuilder;

class Menus extends Model
{
	use ModelTree, AdminBuilder;
    public $timestamps = false;
    protected $table = "menus";

    public function __construct(array $attributes = [])
    {
    	parent::__construct($attributes);
    	$this->setParentColumn('parentId'); //父ID
    	$this->setOrderColumn('menuSort'); //排序
    	$this->setTitleColumn('menuName'); //菜单名称
    }

    public function menus()
    {
    	return $this->hasMany(Menus::class, 'id',$this->getKeyName());
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
