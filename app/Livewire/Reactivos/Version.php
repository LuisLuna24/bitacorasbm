<?php

namespace App\Livewire\Reactivos;

use App\Models\vreactivos;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;

class Version extends Component
{

    use WithPagination;

    #[Reactive]
    public $VersionReactivoId;


    //---------------Lazy-------------------------------
    public function placeholder()
    {
       return view('livewire.placeholders.skeleton');
    }

    public function render()
    {
        $vreactivos=vreactivos::where('reactivo_id','=',$this->VersionReactivoId)->paginate(10);
        return view('livewire.reactivos.version',compact('vreactivos'));
    }
}
