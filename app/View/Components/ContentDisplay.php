<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ContentDisplay extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $konten;
    public $layout;

    public function __construct($konten, $layout)
    {
        $this->konten = $konten;
        $this->layout = $layout;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.content-display');
    }
}
