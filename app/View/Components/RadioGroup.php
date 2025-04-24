<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RadioGroup extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public array $options
        //Associative array of options with keys as values and values as labels, whe we use array_is_list of php 8.1 +
        // public array $options = ['option1' => 'Option 1', 'option2' => 'Option 2']
    )
    {
        //
    }

    public function optionsWhithLabels(): array
    {
        return array_is_list($this->options)?
        array_combine($this->options, $this->options)
        :$this->options;
        // or just use this
        // return isset($this->options[0])?
        // array_combine($this->options, $this->options)
        // :$this->options;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.radio-group');
    }
}
