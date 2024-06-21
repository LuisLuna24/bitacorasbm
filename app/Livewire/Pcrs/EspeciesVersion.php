<?php

namespace App\Livewire\Pcrs;

use App\Models\especies_vpcr;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;

class EspeciesVersion extends Component
{
    use WithPagination;

    #[Reactive]
    public $versionPcrId;

    public function render()
    {
        $especies = especies_vpcr::where('vpcrs_id','=',$this->versionPcrId)->paginate(10);
        return view('livewire.pcrs.especies-version',compact('especies'));
    }
}
