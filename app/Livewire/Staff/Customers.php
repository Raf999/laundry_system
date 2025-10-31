<?php

namespace App\Livewire\Staff;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Customers extends Component
{
    #[Layout('layouts.staff.app')]
    #[Title('Customers')]
    public function render()
    {
        return view('livewire.staff.customers');
    }
}
