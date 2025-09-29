<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Reports extends Component
{
    #[Layout('layouts.employee')]
    #[Title('Reports')]
    public function render()
    {
        return view('livewire.employees.reports');
    }
}
