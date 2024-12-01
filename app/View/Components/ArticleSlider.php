<?php

namespace App\View\Components;

use App\Models\Article;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ArticleSlider extends Component
{
    public $articles;
    public $type;
    public $sliderTitle;
    public $sliderDescription;
    public $sliderUrl;

    /**
     * Create a new component instance.
     */
    public function __construct($type, $sliderTitle, $sliderDescription, $sliderUrl)
    {
        switch ($type) {
            case 'newest':
                $this->newest();
                break;
            case 'popular':
                $this->popular();
                break;
            case 'important':
                $this->important();
                break;
            default:
                $this->newest();
                break;
        }

        $this->sliderTitle = $sliderTitle;
        $this->sliderDescription = $sliderDescription;
        $this->sliderUrl = $sliderUrl;
    }

    private function newest() {
        $this->articles = Article::query()
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->limit(5)
            ->get();
    }

    private function popular() {
        $this->articles = Article::query()
            ->where('type', 'like', 'berita')
            ->whereNotNull('published_at')
            ->orderBy('views', 'desc')
            ->limit(5)
            ->get();
    }

    private function important() {
        $this->articles = Article::query()
            ->where('type', 'informasi')
            ->whereNotNull('published_at')
            ->orderBy('views', 'desc')
            ->limit(5)
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.article-slider');
    }

}
