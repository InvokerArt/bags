<?php

namespace App\Repositories\Backend\Companies;

use App\Exceptions\GeneralException;
use App\Models\Backend\Companies\Company;
use App\Models\Backend\Companies\CategoriesCompanies;
use Carbon;
use DB;
use Auth;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class CompaniesRepository implements CompaniesInterface
{



    public function getForDataTable()
    {
        /**
         * withCount--统计关联的结果而不实际的加载它们。
         */
        return Company::all();
    }

    public function create($input)
    {
        $companys = new Companies;
        $companys->title = $input['title'];
        //$companys->slug = $input['slug'];
        $companys->user_id = Auth::guard('admin')->id();
        $companys->subtitle = $input['subtitle'];
        $companys->content = $input['content'];
        $companys->image = $input['image'];
        $companys->published_at = $input['published_at'] ? $input['published_at'] : Carbon::now();

        DB::transaction(function () use ($companys, $input) {
            if ($companys->update()) {
                $tag = $input['tag'] ? $input['tag'] : [];
                $categories_id = explode(',', $input['categories_id']);
                $attachTags = [];
                if ($tag) {
                    $tags = explode(',', $tag);
                    foreach ($tags as $tag) {
                        $hasTag = Tag::where('name', $tag)->first();
                        if ($hasTag) {
                            array_push($attachTags, $hasTag->id);
                        } else {
                            $newTag['name'] = $tag;
                            //新标签
                            $tag = $this->tags->create($newTag);
                            array_push($attachTags, $tag->id);
                        }
                    }
                    //更新标签记录
                    $companys->attachTags($attachTags);
                }
                $companys->attachCategories($categories_id);

                return true;
            }

            throw new GeneralException("添加失败");
        });
    }

    public function update(Company $company, $input)
    {
        $companys->title = $input['title'];
        $companys->subtitle = $input['subtitle'];
        $companys->content = $input['content'];
        $companys->image = $input['image'];
        $companys->published_at = $input['published_at'] ? $input['published_at'] : Carbon::now();

        DB::transaction(function () use ($companys, $input) {
            if ($companys->update()) {
                $tag = $input['tag'] ? $input['tag'] : [];
                $categories_id = explode(',', $input['categories_id']);
                $attachTags = [];
                if ($tag) {
                    $tags = explode(',', $tag);
                    foreach ($tags as $tag) {
                        $hasTag = Tag::where('name', $tag)->first();
                        if ($hasTag) {
                            array_push($attachTags, $hasTag->id);
                        } else {
                            $newTag['name'] = $tag;
                            //新标签
                            $tag = $this->tags->create($newTag);
                            array_push($attachTags, $tag->id);
                        }
                    }
                    //更新标签记录
                    $companys->syncTags($attachTags);
                }
                $companys->syncCategories($categories_id);

                return true;
            }

            throw new GeneralException("更新失败");
        });
    }

    public function destroy($id)
    {
    }

    public function restore($id)
    {
    }

    public function delete($id)
    {
    }
}
