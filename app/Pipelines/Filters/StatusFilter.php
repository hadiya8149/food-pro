<?php

namespace App\Pipelines\Filters;

use Closure;

class StatusFilter
{
    public function handle($query, Closure $next)
    {
        if (request()->has('status')) {
            $query->where('status', request()->status);
        }

        return $next($query);
    }
}