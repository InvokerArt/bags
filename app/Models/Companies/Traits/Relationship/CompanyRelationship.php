<?php

namespace App\Models\Companies\Traits\Relationship;

trait CompanyRelationship
{

    //分类多对多
    public function categories()
    {
        return $this->belongsToMany('App\Models\Companies\CategoryCompany', 'category_company', 'company_id', 'category_id');
    }

    //用户一对多反向
    public function user()
    {
        return $this->belongsTo('App\Models\Users\User');
    }

    public function favorites()
    {
        return $this->morphMany('App\Models\Favorites\Favorite', 'favorite');
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
        $this->categories()->sync($Categories);
    }

    public function certifications()
    {
        return $this->hasMany('App\Models\Certifications\Certification', 'user_id', 'user_id');
    }
}
