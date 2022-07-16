<?php

namespace App\Models;

use App\Scopes\DeletedAdminScope;
use App\Scopes\LatestScope;
use App\Traits\Taggable;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class BlogPost extends Model
{
    use HasFactory;
    use SoftDeletes, Taggable;

    protected $fillable = ['title', 'content', 'user_id'];


    public function comments()
    {

        return $this->morphMany('App\Models\Comment', 'commentable')->latest();
    }

    public function image()
    {

        return $this->morphOne('App\Models\Image', 'imageable');
    }

    public function user()
    {

        return $this->belongsTo('App\Models\User');
    }


    public function scopeLatest()
    {
        return $this->orderBy(static::CREATED_AT, 'desc');
    }

    public function scopeMostCommented()
    {
        
        return $this->withCount('comments')->orderBy('comments_count', 'desc');
    }

    public function scopeLatestWithRelations()
    {

        return $this->latest()
            ->with('comments')
            ->with('user')
            ->with('tags');
    }

    public static function boot()
    {
        static::addGlobalScope(new DeletedAdminScope);
        parent::boot();
    }
}
