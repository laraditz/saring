<?php

namespace RaditzFarhan\Saring;

use BadMethodCallException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Filter
{
    /**
     * The query builder.
     *
     * @var object
     */
    public $query;

    /**
     * The request object.
     *
     * @var object
     */
    public $request;

    /**
     * Receive query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \BadMethodCallException
     */
    public function __construct(Builder $query, Request $request)
    {
        $this->query = $query;
        $this->request = $request;
    }

    /**
     * Dynamically handle calls to the class.
     *
     * @param  string  $name
     * @param  array  $arguments
     * @return void
     *
     * @throws \BadMethodCallException
     */
    public function __call($name, $arguments)
    {
        if (method_exists($this->query, $name)) {
            $this->query->$name(...$arguments);
        } else {
            throw new BadMethodCallException(sprintf(
                'Method %s::%s does not exist.',
                get_class(),
                $name
            ));
        }
    }
}
