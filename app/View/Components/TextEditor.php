<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextEditor extends Component
{
    public $id;
    public $name;
    public $height;
    public $content;

    public function __construct($id, $name, $height = '200px', $content = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->height = $height;
        $this->content = $content;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.text-editor');
    }
}
