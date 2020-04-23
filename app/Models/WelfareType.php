<?php

namespace App\Models;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class WelfareType extends Model
{
    use ModelTree, AdminBuilder;

    protected $fillable = [
        'pid', 'cate_name', 'sort'
    ];

    protected $with = [
        'parent'
    ];


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setParentColumn('pid');  // 父ID
        $this->setOrderColumn('sort'); // 排序
        $this->setTitleColumn('cate_name'); // 分类名称
    }

    /**
     * 该分类的子分类
     */
    public function child()
    {
        return $this->hasMany(get_class($this), 'pid', $this->getKeyName());
    }

    /**
     * 该分类的父分类
     */
    public function parent()
    {
        return $this->hasOne(get_class($this), $this->getKeyName(), 'pid');
    }

    public function welfare()
    {
        return $this->hasMany(Welfare::class);
    }
}
