<?php

namespace App;

use Illuminate\Support\{Arr, Str};

class Sortable
{
    protected $currentUrl;
    protected $currentColumn;
    protected $currentDirection;
    protected $query = [];

    public function __construct($currentUrl)
    {
        $this->currentUrl = $currentUrl;
    }

    public function appends(array $query)
    {
        $this->query = $query;
    }

    public function setCurrentOrder($sortField)
    {
        $direction = 'asc';

        if(Str::of($sortField)->startsWith('-')) {
            $direction = 'desc';
            $sortField = Str::of($sortField)->substr(1);
        }

        $this->currentColumn = $sortField;
        $this->currentDirection = $direction;
    }

    public function url($sortField)
    {
        if($this->isSortingBy($sortField, 'asc'))
        {
            // $sortField = Str::of($sortField)->prepend('-');
            return $this->buildSortableUrl($sortField, 'desc');
        }

        // return $this->currentUrl . '?sort=' . $sortField;
        return $this->buildSortableUrl($sortField, 'asc');
    }

    protected function buildSortableUrl($column, $direction)
    {
        $fragment = $direction == 'desc' ? '-' : '';
        $appendQuery = ! empty($this->query) &&  Arr::isAssoc($this->query)
            ?  Arr::query($this->query) . '&'
            : '';

        return $this->currentUrl . '?'. $appendQuery . 'sort=' . $fragment . $column;
    }

    public function classes($column)
    {
        if($this->isSortingBy($column, 'asc')) {
            return 'fas fa-sort-up fa-fw';
        }

        if($this->isSortingBy($column, 'desc')) {
            return 'fas fa-sort-down fa-fw';
        }

        return 'fas fa-sort text-black-50 fa-fw';
    }

    protected function isSortingBy($column, $direction)
    {
        return $this->currentColumn == $column && $this->currentDirection == $direction;
    }

    public function getColumn()
    {
        return $this->currentColumn;
    }

    public function getDirection()
    {
        return $this->currentDirection;
    }
}
