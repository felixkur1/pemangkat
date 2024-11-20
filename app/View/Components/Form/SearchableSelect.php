<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SearchableSelect extends Component
{
    /**
     * Create a new component instance.
     */
    public $employees;
    public $name;
    public $id;
    
    public function __construct($employees, $name, $id = null)
    {
        $this->employees = $employees;
        $this->name = $name;
        $this->id = $id ?? uniqid('searchable-select-');
    }

    /**
     * Get the view / contents that represent the component.
    */
    public function render(): View|Closure|string
    {
        return view('components.form.searchable-select');
    }
}
