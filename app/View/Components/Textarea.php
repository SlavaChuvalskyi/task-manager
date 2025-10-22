<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Textarea extends Component
{

    public function __construct(
        public string $name,
        public ?string $value = '',
        public ?string $placeholder = "",
        public ?string $wrapperClassName = "",
        public ?string $className = "min-h-[100px] border border-stone-200 rounded-lg px-3 py-2 text-sm outline-none focus-visible:none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 resize-y",
        public ?string $label = null,
        public ?bool $required = false,
    )
    {
    }

    public function render()
    {
        return view('components.textarea');
    }
}
