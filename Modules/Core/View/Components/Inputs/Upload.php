<?php

namespace Modules\Core\View\Components\Inputs;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Upload extends Component
{
    public function __construct() {}

    public function render(): View
    {
        return view('core::components.inputs.upload');
    }
}
