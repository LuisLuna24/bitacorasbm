<?php

namespace App\Livewire\Extraccion;

use App\Models\equipos_extraccion;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;

class Equipos extends Component
{
    //--WithPagination as WithPagination; functionginacion-------------------------------
    use WithPagination;

    #[Reactive]
    public $extraccionIdVer;

    public function render()
    {
        $equipos_extraccion=equipos_extraccion::where('extraccion_id','=',$this->extraccionIdVer)->paginate(10);
        return view('livewire.extraccion.equipos',compact('equipos_extraccion'));
    }
}
