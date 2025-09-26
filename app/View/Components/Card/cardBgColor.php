<?php

namespace App\View\Components\card;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class cardBgColor extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $bgColor = 'bg-success-lt',
        public string $title = '',
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card.card-bg-color');
    }
}
