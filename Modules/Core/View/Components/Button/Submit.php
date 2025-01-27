<?php

namespace Modules\Core\View\Components\Button;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Submit extends Component
{
    public function render(): View
    {
        return view('core::components.buttons.submit');
    }
}
