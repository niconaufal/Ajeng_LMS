<?php

namespace App\View\Components;

use Carbon\Carbon;
use Illuminate\View\Component;

class FooterAuth extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $year = Carbon::now()->format('Y');

        return view('components.footer-auth', compact('year'));
    }
}
