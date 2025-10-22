<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Icon extends Component
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function render()
    {
        $path = public_path("assets/icons/{$this->name}.svg");

        if (!file_exists($path)) {
            return "<!-- Icon not found: {$this->name} -->";
        }

        // Get raw SVG content
        $svg = file_get_contents($path);

        return function (array $data) use ($svg) {
            $class = $data['attributes']->get('class', '');

            // Inject class and ensure stroke uses currentColor
            $svg = preg_replace('/<svg(.*?)>/', "<svg$1 class=\"$class\">", $svg);
            $svg = preg_replace('/stroke="[^"]*"/', 'stroke="currentColor"', $svg);

            return $svg;
        };
    }
}
