<?php

namespace App\Models\Comments;

use Illuminate\Database\Eloquent\Model;
use App\Models\Comments\Traits\Relationship\CommentsRelationship;

/**
 * App\Models/Comments\Comment
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $parent_id
 * @property string $body
 * @property integer $commentable_id
 * @property string $commentable_type
 * @property boolean $status 状态//0回收站//1待审核//2通过
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models/Comments\Comment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models/Comments\Comment whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models/Comments\Comment whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models/Comments\Comment whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models/Comments\Comment whereCommentableId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models/Comments\Comment whereCommentableType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models/Comments\Comment whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models/Comments\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models/Comments\Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models/Comments\Comment whereDeletedAt($value)
 * @mixin \Eloquent
 */
class Comment extends Model
{
    use CommentsRelationship;
}
