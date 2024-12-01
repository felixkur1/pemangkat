<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Footer extends Component
{
    public $phone;
    public $whatsapp;
    public $facebook;
    public $instagram;
    public $youtube;
    
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->phone = "#";
        $this->whatsapp = "#";
        $this->facebook = "#";
        $this->instagram = "#";
        $this->youtube = "#";
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.footer');
    }
}
