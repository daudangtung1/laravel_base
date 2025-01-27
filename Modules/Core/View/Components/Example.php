<?php

namespace Modules\Core\View\Components;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Example extends Component
{
    public function __construct() {}

    public function render(): View
    {
        return view('core::components.example');
    }
}
