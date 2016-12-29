<?php

namespace App\Repositories\Backend\Exhibitions;

use App\Exceptions\GeneralException;
use App\Models\Exhibition;
use App\Models\CategoriesExhibition;
use App\Models\Tag;
use App\Repositories\Backend\Tags\TagsRepository;
use Carbon;
use DB;
use Auth;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class ExhibitionRepository extends Repository
{
    /**
     * 关联储存模型
     */
    const MODEL = Exhibition::class;

    public function getForDataTable()
    {
        /**
         * withCount--统计关联的结果而不实际的加载它们。
         */
        return $this->query()->with('categories');
    }

    public function create($input)
    {
        $exhibition = self::MODEL;
        $exhibition = new $exhibition;
        $exhibition->title = $input['title'];
        //$exhibition->slug = $input['slug'];
        $exhibition->user_id = Auth::guard('admin')->id();
        $exhibition->subtitle = $input['subtitle'];
        $exhibition->address = $input['address'];
        $exhibition->telephone = $input['telephone'];
        $exhibition->content = $input['content'];
        $exhibition->image = $input['image'];
        $exhibition->published_at = $input['published_at'] ? $input['published_at'] : Carbon::now();
        $exhibition->is_excellent = $input['is_excellent'];

        DB::transaction(function () use ($exhibition, $input) {
            if (parent::save($exhibition)) {
                $categories_id = explode(',', $input['categories_id']);
                $exhibition->attachCategories($categories_id);
                return true;
            }

            throw new GeneralException("添加失败");
        });
    }

    public function update(Model $exhibition, array $input)
    {
        $exhibition->title = $input['title'];
        $exhibition->subtitle = $input['subtitle'];
        $exhibition->address = $input['address'];
        $exhibition->telephone = $input['telephone'];
        $exhibition->content = $input['content'];
        $exhibition->image = $input['image'];
        $exhibition->published_at = $input['published_at'] ? $input['published_at'] : Carbon::now();
        $exhibition->is_excellent = $input['is_excellent'];

        DB::transaction(function () use ($exhibition, $input) {
            if (parent::save($exhibition)) {
                $categories_id = explode(',', $input['categories_id']);
                $exhibition->syncCategories($categories_id);

                return true;
            }

            throw new GeneralException("更新失败");
        });
    }

    public function destroy(Model $exhibition)
    {
        $exhibition = $this->query()->find($id);
        if ($exhibition->delete()) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function restore(Model $exhibition)
    {
        $exhibition = $this->query()->find($id);
        if ($exhibition->restore()) {
            return true;
        }
        throw new GeneralException('返回失败！');
    }

    public function delete(Model $exhibition)
    {
        $exhibition = $this->query()->find($id);
        if ($exhibition->forceDelete()) {
            return true;
        }
        throw new GeneralException('删除失败！');
    }

    public function indexByCategories($input)
    {
        $query = $this->query();
        if ($input->categories) {
            $query->whereHas('categories', function ($query) use ($input) {
                $query->where('category_id', $input->categories);
            });
        }
        return $query->orderBy('created_at', 'DESC')->paginate();
    }

    public function createFavorite(Model $exhibition)
    {
        $favorites = $exhibition->favorites()->where('user_id', Auth::id())->count();
        if ($favorites) {
            throw new GeneralException('你已经收藏！');
        }
        $exhibition->favorites()->create(['user_id' => Auth::id()]);
    }

    public function search($input)
    {
        $query = $this->query();
        
        if ($input->categories) {
            $query->whereHas('categories', function ($query) use ($input) {
                $query->where('category_id', $input->categories);
            });
        }
        return $query->where('title', 'like', "%$input->q%")->orWhere('subtitle', 'like', "%$input->q%")->orWhere('content', 'like', "%$input->q%")->paginate();
    }
}
