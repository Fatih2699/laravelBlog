<?php

namespace App\Http\ViewComposers;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class ActivityComposer{

    public function compose(View $view){
        $mostCommented= Cache::tags(['blog-post'])->remember('blog-post-commented',now()->addSeconds(10),function(){
            return BlogPost::mostCommented()->take(5)->get();
         });
    
         $mostActive=Cache::remember('users-most-active',60,function(){
            return User::withMostBlogPost()->take(5)->get();
        });
    
         $mostActiveLastMonth=Cache::remember('users-most-active-last-month',60,function(){
            return User::withMostBlogPostLastMonth()->take(3)->get();
         });
         
         $view->with('mostCommented',$mostCommented);
         $view->with('mostActive',$mostActive);
         $view->with('mostActiveLastMonth',$mostActiveLastMonth);
         
    }
}