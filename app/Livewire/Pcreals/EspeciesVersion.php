<?php

namespace App\Livewire\Pcreals;

use App\Models\especies_vpcreals;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;

class EspeciesVersion extends Component
{
    use WithPagination;

    #[Reactive]
    public $versionPcrealId;

    public function render()
    {
        $especies = especies_vpcreals::where('vpcreals_id','=',$this->versionPcrealId)->paginate(10);
        return view('livewire.pcreals.especies-version',compact('especies'));
    }
}
