<?php

namespace App\Classes\Search\Filters\User;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Classes\Search\Utils\Order;

class EmailFilter
{

    public static function apply(Builder $query, Request $request)
    {

        if ($request->email) {

            $query->where('email', 'like', '%' . $request->email . '%');

        }

        $query = Order::orderBy($query, $request, 'email');

        return $query;

    }

}
