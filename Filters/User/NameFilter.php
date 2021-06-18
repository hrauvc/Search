<?php

namespace App\Classes\Search\Filters\User;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Classes\Search\Utils\Order;

class NameFilter
{

	public static function apply (Builder $query, Request $request)
	{

		if($request->name) {

	    	$query->where('name', 'like', '%' . $request->name . '%');
	    	
	    }

	    $query = Order::orderBy($query, $request, 'name');

	    return $query;

	}

}