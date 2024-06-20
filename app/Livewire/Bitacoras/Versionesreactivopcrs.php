<?php

namespace App\Livewire\Bitacoras;

use App\Models\vreactivopcrs;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;

class Versionesreactivopcrs extends Component
{
    //&---------------paginacion-------------------------------
    use WithPagination;

    #[Reactive]
    public $VercionReactivoId;


    public function render()
    {
        $vrpcr = vreactivopcrs::where('reactivopcr_id', '=',$this->VercionReactivoId)->orderByDesc('id')->paginate(10);
        return view('livewire.bitacoras.versionesreactivopcrs',compact('vrpcr'));
    }
}
