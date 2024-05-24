<?php

namespace App\Livewire\Pcrs;

use App\Models\pcr;
use App\Models\pcrs_especies;
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
        $especies_pcr = pcrs_especies::where('pcr_id','=',$this->especiesPcrId)->paginate($this->datos);
        return view('livewire.pcrs.especies',compact('especies_pcr'));

    }
}
