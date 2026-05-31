<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BukuCard extends Component
{
    public $buku;
    public $showActions;

    public function __construct($buku, $showActions = true)
    {
        $this->buku = $buku;
        $this->showActions = $showActions;
    }

    public function render(): View|Closure|string
    {
        return view('components.buku-card');
    }
}
