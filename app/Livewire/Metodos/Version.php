<?php

namespace App\Livewire\Metodos;

use App\Models\vmetodos;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy]
class Version extends Component
{

    //---------------paginacion-------------------------------
    use WithPagination;

    #[Reactive]
    public $VersionMetodoId;

    //---------------Lazy-------------------------------
    public function placeholder()
    {
       return view('livewire.placeholders.skeleton');
    }

    public function render()
    {
        $vmetodos=vmetodos::where('metodo_id','=',$this->VersionMetodoId)->paginate(10);
        return view('livewire.metodos.version',compact('vmetodos'));
    }
}
