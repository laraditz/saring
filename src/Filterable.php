<?php

namespace RaditzFarhan\Saring;

use Illuminate\Http\Request;

trait Filterable
{
    /**
     * Filter scope to receive request.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function scopeFilter($query, Request $request)
    {
        $class_name = class_basename($this);
        $full_class = 'App\\Filters\\'.$class_name.'Filter';

        if (class_exists($full_class)) {
            $filter = new $full_class($query, $request);

            foreach ($request->all() as $key=>$value) {
                if (method_exists($filter, $key)) {
                    $filter->$key($value);
                }
            }
        }
    }
}
