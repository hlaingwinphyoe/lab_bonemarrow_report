<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ListGroup extends Component
{
    public $link,$title;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($link="#",$title="Sample")
    {
        $this->title = $title;
        $this->link = $link;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.list-group');
    }
}
