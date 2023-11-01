<?php
// app\View\Components\Select2.php
namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select2 extends Component
{
    public $disabled;
    public $multiple;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($disabled = false, $multiple = false)
    {
        $this->disabled = $disabled;
        $this->multiple = $multiple;
    }

    public function render(): View|Closure|string
    {
        return view('components.select2');
    }
}
