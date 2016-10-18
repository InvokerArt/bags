<?php

namespace App\Models\Backend\Comments;

use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\Comments\Traits\Relationship\CommentsRelationship;

/**
 * App\Models\Backend\Comments\Comment
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
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Backend\Comments\Comment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Backend\Comments\Comment whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Backend\Comments\Comment whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Backend\Comments\Comment whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Backend\Comments\Comment whereCommentableId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Backend\Comments\Comment whereCommentableType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Backend\Comments\Comment whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Backend\Comments\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Backend\Comments\Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Backend\Comments\Comment whereDeletedAt($value)
 * @mixin \Eloquent
 */
class Comment extends Model
{
    use CommentsRelationship;
}
