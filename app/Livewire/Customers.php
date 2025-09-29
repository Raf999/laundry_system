<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Customers extends Component
{
    #[Layout('layouts.employee')]
    #[Title('Customers')]
    public function render()
    {
        return view('livewire.employees.customers');
    }
}
