<?php

namespace App\Livewire\Pcreals;

use App\Models\especies_pcreal;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;

class Especies extends Component
{
    use WithPagination;

    #[Reactive]
    public $especiesPcrId;

    public $datos=5;

    public function render()
    {
        $especies_pcr = especies_pcreal::where('pcreal_id','=',$this->especiesPcrId)->paginate($this->datos);

        return view('livewire.pcreals.especies',compact('especies_pcr'));
    }
}
