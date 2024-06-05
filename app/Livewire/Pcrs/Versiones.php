<?php

namespace App\Livewire\Pcrs;

use App\Models\vpcrs;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;


#[Lazy()]
class Versiones extends Component
{

    use WithPagination;

    #[Reactive]
    public $pcrVercionId;


    //---------------Lazy-------------------------------
    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }

    public function render()
    {
        $vpcrs=vpcrs::where('pcr_id','=',$this->pcrVercionId)->paginate(10);
        return view('livewire.pcrs.versiones',compact('vpcrs'));
    }
}
