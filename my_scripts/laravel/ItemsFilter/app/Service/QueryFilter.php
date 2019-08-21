<?php


namespace App\Service;


use Illuminate\Http\Request;

abstract class QueryFilter
{
    protected $query;
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($query)
    {
        $this->query = $query;
        foreach ($this->filters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }
        return $this->query;
    }

    public function filters()
    {
        return $this->request->all();
    }
}
