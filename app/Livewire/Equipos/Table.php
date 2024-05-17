<?php

namespace App\Livewire\Equipos;

use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy]
class Table extends Component
{
    public function render()
    {
        return view('livewire.equipos.table');
    }
}
