<?php

namespace App\Livewire\Extraccion;

use App\Models\equipos_vextraccion;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;

class EquiposVersion extends Component
{
    use WithPagination;

    #[Reactive]
    public $versionExtraccionId;


    public function render()
    {
        $equipos = equipos_vextraccion::where('vextraccion_id','=',$this->versionExtraccionId)->paginate(10);
        return view('livewire.extraccion.equipos-version',compact('equipos'));
    }
}
