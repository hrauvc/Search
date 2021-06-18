<?php

namespace App\Classes\Search\Filters\User;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Classes\Search\Utils\Order;

class SexFilter
{

    public static function apply(Builder $query, Request $request)
    {

        if ($request->sex) {

            if($request->sex == 'empty') {

                $query->where('sex', NULL);

            }else {

                $query->where('sex', $request->sex);

            }

        }

        $query = Order::orderBy($query, $request, 'sex');

        return $query;

    }

}
