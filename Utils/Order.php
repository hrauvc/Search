<?php

namespace App\Classes\Search\Utils;

Class Order
{

	/* Request must have:
	 * orderBy = column name
	 * orderMode = 'asc' | ' desc'
	 */

    public static function orderBy($query, $request, $column)
    {

        if ($request->has('orderBy') && $request->orderBy == $column) {

            $orderMode = ($request->orderMode == 'desc') ? 'desc' : 'asc';

            $query->orderBy($column, $orderMode);

        }

        return $query;

    }

}
