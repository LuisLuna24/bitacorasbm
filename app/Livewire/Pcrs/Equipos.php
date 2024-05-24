<?php

namespace App\Livewire\Pcrs;

use App\Models\pcrs_equipos;
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
        $equipos_pcr = pcrs_equipos::where('pcr_id','=',$this->especiesPcrId)->paginate($this->datos);
        return view('livewire.pcrs.equipos',compact('equipos_pcr'));
    }
}
