<?php

namespace App\Livewire\Pcreals;

use App\Models\equipos_pcreal;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;

class Equipos extends Component
{
    use WithPagination;

    #[Reactive]
    public $especiesPcrId;

    public $datos=5;
    public function render()
    {
        $equipos_pcr = equipos_pcreal::where('pcreal_id','=',$this->especiesPcrId)->paginate($this->datos);
        return view('livewire.pcreals.equipos',compact('equipos_pcr'));
    }
}
