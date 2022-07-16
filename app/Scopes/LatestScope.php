<?php

namespace App\Scopes;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Scope;

class LatestScope implements Scope
{
    public function apply(Builder $builder, $model)
    {
        $builder->orderBy($model::CREATED_AT, 'desc');
    }
}
