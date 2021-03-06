<?php

namespace App\Repositories\Backend\Favorites;

use App\Exceptions\GeneralException;
use App\Models\Favorite;
use DB;
use Auth;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class FavoriteRepository extends Repository
{
    /**
     * 关联储存模型
     */
    const MODEL = Favorite::class;

    /**
     * 是否已经收藏.
     *
     * @param $product_id
     * @param $user_id
     *
     * @return bool
     */
    public function userIsFavorite($model, $favorite_id, $user_id)
    {
        return $this->query()->where([
            'user_id'      => $user_id,
            'favorite_id'   => $favorite_id,
            'favorite_type' => $this->favoriteModel($model),
        ])->exists();
    }

    public function favoriteModel($input)
    {
        switch ($input) {
            case 'product':
                return 'App\Models\Product';
                break;
            case 'job':
                return 'App\Models\Job';
                break;
            case 'demand':
                return 'App\Models\Demand';
                break;
            case 'supply':
                return 'App\Models\Supply';
                break;
            case 'topic':
                return 'App\Models\Topic';
            case 'news':
                return 'App\Models\News';
                break;
            case 'company':
                return 'App\Models\Company';
                break;
            case 'exhibition':
                return 'App\Models\Exhibition';
                break;
            
            default:
                # code...
                break;
        }
    }

    public function destroyFavorite($input)
    {
        $favorite = $this->query()->where(['favorite_id' => $input->favorite_id, 'user_id' => Auth::id(), 'favorite_type' => $this->favoriteModel($input->favorite_type)])->firstOrFail();
        parent::delete($favorite);
    }
}
