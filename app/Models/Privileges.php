<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\ModelTree;
use Encore\Admin\Traits\AdminBuilder;

class Privileges extends Model
{
	use ModelTree, AdminBuilder;
    public $timestamps = false;
    protected $table = "privileges";

    public function __construct(array $attributes = [])
    {
    	parent::__construct($attributes);
    	$this->setParentColumn('menuId'); //父ID
    	$this->setTitleColumn('privilegeName'); //区域名称
    }

    public function privileges()
    {
    	return $this->hasMany(Privileges::class, 'id',$this->getKeyName());
    }

    /**
     * 该分类的子分类
     */
    public function child()
    {
        return $this->hasMany(get_class($this), 'menuId', $this->getKeyName());
    }
 
    /**
     * 该分类的父分类
     */
    public function parent()
    {
        return $this->hasOne(get_class($this), $this->getKeyName(), 'menuId');
    }
}
