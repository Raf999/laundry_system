<?php

namespace App\Livewire\Staff;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Reports extends Component
{
    #[Layout('layouts.staff.app')]
    #[Title('Reports')]
    public function render()
    {
        return view('livewire.staff.reports');
    }
}
