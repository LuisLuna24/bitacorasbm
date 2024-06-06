<?php

namespace App\Livewire\Pcreals;

use App\Models\vpcreals;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy()]
class Versiones extends Component
{
    
    use WithPagination;

    #[Reactive]
    public $pcrealVercionId;


    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }

    public function render()
    {
        $vpcrs=vpcreals::where('pcreal_id','=',$this->pcrealVercionId)->paginate(10);
        return view('livewire.pcreals.versiones',compact('vpcrs'));
    }
}
