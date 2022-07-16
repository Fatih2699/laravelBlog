<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    protected $guarded=[];
    public function blogPosts()
    { 
        //return $this->belongsToMany('App\Models\BlogPost')->withTimestamps()->as('tagged');
        return $this->morphedByMany('App\Models\BlogPost','taggable')->withTimestamps()->as('tagged');
    }

    public function comments(){
        return $this->morphedByMany('App\Models\Comment','taggable')->withTimestamps()->as('tagged');
    }
}