<?php
namespace App\Scopes;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class DeletedAdminScope implements Scope{
    public function apply(Builder $builder,$model)
    {
        if(Auth::check()&&Auth::user()->is_admin){
            $builder->withTrashed();
            //$builder->withoutGlobalScope('Illuminate\Database\Eloquent\SoftDeletingScope');
        }
    }
}