<?php

namespace App\Livewire\Employees;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Dashboard extends Component
{
    #[Layout('layouts.employee')]
    #[Title('Dashboard')]
    public function render()
    {
        return view('livewire.employees.dashboard');
    }
}
