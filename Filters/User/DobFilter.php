<?php

namespace App\Classes\Search\Filters\User;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Classes\Search\Utils\Order;

class DobFilter
{

    public static function apply(Builder $query, Request $request)
    {

        if ($request->dob) {

            $query->where('dob', $request->dob);

        }

        $query = Order::orderBy($query, $request, 'dob');


        return $query;

    }

}
