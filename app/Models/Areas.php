<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\ModelTree;
use Encore\Admin\Traits\AdminBuilder;

class Areas extends Model
{
	use ModelTree, AdminBuilder;
    public $timestamps = false;
    protected $table = "areas";

    protected $fillable = ['parentId','areaName','isShow','areaSort','areaKey','areaType','dataFlag'
    ,'createTime'];

    protected $with = [
    	'parent'
    ];

    public function __construct(array $attributes = [])
    {
    	parent::__construct($attributes);
    	$this->setParentColumn('parentId'); //父ID
    	$this->setOrderColumn('areaSort'); //排序
    	$this->setTitleColumn('areaName'); //区域名称
    }

    public function area()
    {
    	return $this->hasMany(Areas::class, 'id',$this->getKeyName());
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
