<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Customers extends Component
{
    #[Layout('layouts.employee')]
    public function render()
    {
        return view('livewire.employees.customers');
    }
}
