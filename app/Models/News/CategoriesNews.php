<?php

namespace App\Models\News;

use Baum\Node;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\News\CategoriesNews
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 * @property string $name
 * @property boolean $is_active
 * @property string $slug
 * @property string $description
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\News\CategoriesNews $parent
 * @property-read \Baum\Extensions\Eloquent\Collection|\App\Models\News\CategoriesNews[] $children
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News\CategoriesNews whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News\CategoriesNews whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News\CategoriesNews whereLft($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News\CategoriesNews whereRgt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News\CategoriesNews whereDepth($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News\CategoriesNews whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News\CategoriesNews whereIsActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News\CategoriesNews whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News\CategoriesNews whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News\CategoriesNews whereMetaTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News\CategoriesNews whereMetaKeywords($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News\CategoriesNews whereMetaDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News\CategoriesNews whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News\CategoriesNews whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Baum\Node withoutNode($node)
 * @method static \Illuminate\Database\Query\Builder|\Baum\Node withoutSelf()
 * @method static \Illuminate\Database\Query\Builder|\Baum\Node withoutRoot()
 * @method static \Illuminate\Database\Query\Builder|\Baum\Node limitDepth($limit)
 * @mixin \Eloquent
 */
class CategoriesNews extends Node
{
    /**
    * Table name.
    *
    * @var string
    */
    protected $table = 'categories_news';

    //////////////////////////////////////////////////////////////////////////////

    //
    // Below come the default values for Baum's own Nested Set implementation
    // column names.
    //
    // You may uncomment and modify the following fields at your own will, provided
    // they match *exactly* those provided in the migration.
    //
    // If you don't plan on modifying any of these you can safely remove them.
    //

    // /**
    //  * Column name which stores reference to parent's node.
    //  *
    //  * @var string
    //  */
    // protected $parentColumn = 'parent_id';

    // /**
    //  * Column name for the left index.
    //  *
    //  * @var string
    //  */
    // protected $leftColumn = 'lft';

    // /**
    //  * Column name for the right index.
    //  *
    //  * @var string
    //  */
    // protected $rightColumn = 'rgt';

    // /**
    //  * Column name for the depth field.
    //  *
    //  * @var string
    //  */
    // protected $depthColumn = 'depth';

    // /**
    //  * Column to perform the default sorting
    //  *
    //  * @var string
    //  */
    // protected $orderColumn = null;

    // /**
    // * With Baum, all NestedSet-related fields are guarded from mass-assignment
    // * by default.
    // *
    // * @var array
    // */
    // protected $guarded = array('id', 'parent_id', 'lft', 'rgt', 'depth');

    //
    // This is to support "scoping" which may allow to have multiple nested
    // set trees in the same database table.
    //
    // You should provide here the column names which should restrict Nested
    // Set queries. f.ex: company_id, etc.
    //

    // /**
    //  * Columns which restrict what we consider our Nested Set list
    //  *
    //  * @var array
    //  */
    // protected $scoped = array();

    //////////////////////////////////////////////////////////////////////////////

    //
    // Baum makes available two model events to application developers:
    //
    // 1. `moving`: fired *before* the a node movement operation is performed.
    //
    // 2. `moved`: fired *after* a node movement operation has been performed.
    //
    // In the same way as Eloquent's model events, returning false from the
    // `moving` event handler will halt the operation.
    //
    // Please refer the Laravel documentation for further instructions on how
    // to hook your own callbacks/observers into this events:
    // http://laravel.com/docs/5.0/eloquent#model-events
    
    public function news()
    {
        $this->belongsToMany('App\Models\News\News');
    }
}
