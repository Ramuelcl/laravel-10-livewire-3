<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class tw_card extends Component
{
    public $title;
    public $showCloseButton;
    public $showCancelButton;
    public $showChangeButton;
    public $textCancel = "Cancel";
    public $textChange = "Save";

    public function __construct($title = null, $showCloseButton = false, $showCancelButton = true, $showChangeButton = true, $textCancel = null, $textChange = null)
    {
        $this->title = $title;
        $this->showCloseButton = $showCloseButton;
        $this->showCancelButton = $showCancelButton;
        $this->showChangeButton = $showChangeButton;

        $this->textCancel = $textCancel ?? $this->textCancel;
        $this->textChange = $textChange ?? $this->textChange;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tw_card');
    }
}
