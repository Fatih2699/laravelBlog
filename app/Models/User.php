<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Query\Builder as DatabaseQueryBuilder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public const LOCALES = [
        'en'=>'English',
        'tr'=>'Türkçe',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email',
        'email_verified_at',
        'created_at',
        'updated_at',
        'is_admin',
        'locale'
    ];

    public function blogPost(){

        return $this->hasMany('App\Models\BlogPost');
    }

    public function comments(){

        return $this->hasMany('App\Models\Comment');
    }

    public function commentsOn(){

        return $this->morphMany('App\Models\Comment','commentable')->latest();

    }

    public function scopeWithMostBlogPost(){
        return $this->withCount('blogPost')->orderBy('blog_post_count','desc');
    }

    public function image(){
        return $this->morphOne('App\Models\Image','imageable');
    }

    public function scopeWithMostBlogPostLastMonth(){
        return $this->withCount(['blogPost'=>function(){
            $this->whereBetween(static::CREATED_AT,[now()->subMonths(1),now()]);
        }])
        ->having('blog_post_count','>=','2')
        ->orderBy('blog_post_count','desc');
    }

    public function scopeThatHasCommentedOnPost(Builder $query,BlogPost $post)
    {
        return $query->whereHas('comments',function($query)use($post){
            return $query->where('commentable_id','=',$post->id)
            ->where('commentable_type','=',BlogPost::class) ;
        });
    }

    public function scopeThatIsAnAdmin(Builder $query)
    {
        return $query->where('is_admin',true);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
