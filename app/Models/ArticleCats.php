<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\ModelTree;
use Encore\Admin\Traits\AdminBuilder;

class ArticleCats extends Model
{
    public $timestamps = false;
    protected $table = "article_cats";

    use ModelTree, AdminBuilder;

    public function __construct(array $attributes = [])
    {
    	parent::__construct($attributes);
    	$this->setParentColumn('parentId'); //父ID
    	$this->setOrderColumn('catSort'); //排序
    	$this->setTitleColumn('catName'); //区域名称
    }

    public function articlecats()
    {
    	return $this->hasMany(Articles::class, 'id',$this->getKeyName());
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

    public function Articles() {
        return $this->belongsToMany('App\Models\Articles');
    }
}
