<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SideBarTitle extends Component
{
    public $title,$icon;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title="Menu Title",$icon="fa-pages")
    {
        $this->title = $title;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.side-bar-title');
    }
}
