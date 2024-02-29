<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Contracts\Pagination\Paginator; // Import the Paginator interface

class Pagination extends Component
{
    public $paginator; // Property to hold the paginator instance

    /**
     * Create a new component instance.
     *
     * @param Paginator $paginator The paginator instance.
     */
    public function __construct(Paginator $paginator)
    {
        $this->paginator = $paginator;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pagination', [
            'paginator' => $this->paginator, // Pass the paginator instance to the view
        ]);
    }
}
