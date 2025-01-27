<?php

namespace Modules\Core\View\Components;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class SecondDemo extends Component
{
    public $placeholder;
    public $title;
    public $type;
    public $id;
    public $name;
    public $value;

    public function __construct(
        $placeholder,
        $title,
        $type,
        $id,
        $name,
        $value
    ) {
        $this->placeholder = $placeholder;
        $this->title = $title;
        $this->type = $type ?? 'text';
        $this->id = $id;
        $this->name = $name;
        $this->value = $value;
    }

    public function render(): View
    {
        return view('core::components.second-demo');
    }
}
