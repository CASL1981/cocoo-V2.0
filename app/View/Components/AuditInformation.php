<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AuditInformation extends Component
{
    public $audit;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($audit)
    {
        $this->audit = $audit;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.audit-information');
    }
}
