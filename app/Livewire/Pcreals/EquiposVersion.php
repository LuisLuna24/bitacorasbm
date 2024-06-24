<?php

namespace App\Livewire\Pcreals;

use App\Models\equipos_vpcreals;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;

class EquiposVersion extends Component
{

    use WithPagination;

    #[Reactive]
    public $versionPcrealId;


    public function render()
    {
        $equipos = equipos_vpcreals::where('vpcreals_id','=',$this->versionPcrealId)->paginate(10);
        return view('livewire.pcreals.equipos-version', compact('equipos'));
    }
}
