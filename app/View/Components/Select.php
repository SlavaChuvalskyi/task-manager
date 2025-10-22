<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Select extends Component
{
    public function __construct(
        public string $name,
        public array $options = [],
        public ?string $value = null,
        public ?string $wrapperClass = "w-full",
        public ?string $className = "min-h-[45px] border border-stone-200 rounded-md px-3 py-2 outline-none focus-visible:none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm",
        public ?string $label = null,
        public ?bool $disabledDefault = true
    )
    {
    }

    public function render()
    {
        return view('components.select');
    }
}
