<?php

namespace App\Models\Backend\Companies\Traits\Relationship;

trait CompaniesRelationship
{

    //分类多对多
    public function categories()
    {
        return $this->belongsToMany('App\Models\Backend\Companies\CategoriesCompanies', 'category_company', 'companys_id', 'category_id');
    }

    //用户一对多反向
    public function user()
    {
        return $this->belongsTo('App\Models\Access\User\User');
    }

    //添加分类数据到中间表
    public function attachCategory($Category)
    {
        if (is_object($Category)) {
            $Category = $Category->getKey();
        }

        if (is_array($Category)) {
            $Category = $Category['id'];
        }

        $this->Categories()->attach($Category);
    }

    //添加分类数据到中间表
    public function attachCategories($Categories)
    {
        foreach ($Categories as $Category) {
            $this->attachCategory($Category);
        }
    }

    //更新分类数据到中间表
    public function syncCategories($Categories)
    {
        $this->Categories()->sync($Categories);
    }
}
