<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class action extends Component
{
    /**
     * Create a new component instance.
     */
    public $datas;
    public $id;
    public function __construct($id, $datas)
    {
        $this->id = $id;
        $this->datas = $datas;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $id = $this->id;
        $datas = $this->datas;
        return view('components.action', compact('id', 'datas'));
    }
}
