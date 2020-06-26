<?php

namespace App\View\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\Database\Eloquent\Model;

class ActionsComponent extends Component
{
    public $model;

    /**
     * Size of buttons (based in 'Bootstrap')
     *
     * Supported 'sm', 'lg'
     *
     */
    public $size;

    /**
     * List of allowed actions
     *
     * Supported 'update', 'delete', 'restore', 'forceDelete'
     *
     * @array
     */
    public $allowedActions;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Model $model, $size = '', $allowedActions = ['update', 'delete'])
    {
        $this->model = $model;
        $this->size = $size;
        $this->allowedActions = collect($allowedActions);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.actions-component');
    }

    /**
     * Guess route prefix name based in the model's name.
     * Example: if model is "Post", expect that route has a prefix "posts."
     *
     * @return string
     */
    public function prefix()
    {
        return Str::lower(Str::plural(class_basename($this->model)));
    }

    /**
     * Guess model's name form class name in lower case
     *
     * Example: if model is "App\Post", expect that name is "post"
     *
     * @return string
     */
    public function modelName()
    {
        return Str::lower(class_basename($this->model));
    }
}
