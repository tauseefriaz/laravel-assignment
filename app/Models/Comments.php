<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Comments.
 */
class Comments extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'parent_id',
        'name',
        'comment',
    ];

    protected $guarded = ['id'];
    protected $parents;

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function count($comment)
    {
        $parent = $comment->parent;

        if ($parent != null) {
            $this->parents++;
            $this->count($parent);
        }

        return $this->parents;
    }

    protected static function boot()
    {
        static::creating(function ($model) {
            $count = $model->count($model);

            if ($count > 3) {
                return false;
            } else {
                return true;
            }
        });
    }

}
