<?php

namespace App\Classes\Search\Filters\User;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Classes\Search\Utils\Order;

class VerifiedFilter
{

    public static function apply(Builder $query, Request $request)
    {

        if (isset($request->verified)) {

            if($request->verified == 1) {

                $query->where('email_verified_at', '!=', NULL);

            }else {

                $query->where('email_verified_at', NULL);

            }

        }

        $query = Order::orderBy($query, $request, 'email_verified_at');

        return $query;

    }

}
