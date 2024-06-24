<?php

namespace App\Livewire\Pcrs;

use App\Models\equipos_vpcr;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;

class EquiposVersion extends Component
{

    use WithPagination;

    #[Reactive]
    public $versionPcrId;


    public function render()
    {
        $equipos = equipos_vpcr::where('vpcrs_id','=',$this->versionPcrealId)->paginate(10);
        return view('livewire.pcrs.equipos-version',compact('equipos'));
    }
}
