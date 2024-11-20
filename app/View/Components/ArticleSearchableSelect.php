<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ArticleSearchableSelect extends Component
{
    /**
     * Create a new component instance.
     */
    public $articles;
    public $name;
    public $id;
    
    public function __construct($articles, $name, $id = null)
    {
        $this->articles = $articles;
        $this->name = $name;
        $this->id = $id ?? uniqid('searchable-select-');
    }

    /**
     * Get the view / contents that represent the component.
    */
    public function render(): View|Closure|string
    {
        return view('components.article-searchable-select');
    }
}
