<?php

namespace App\Livewire\Equipos;

use App\Models\vequipos;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy]
class Version extends Component
{
    use WithPagination;

    #[Reactive]
    public $VersionEquipoId;

    //---------------Lazy-------------------------------
    public function placeholder()
    {
       return view('livewire.placeholders.skeleton');
    }

    public function render()
    {
        $vequipos=vequipos::where('equipo_id','=',$this->VersionEquipoId)->paginate(10);
        return view('livewire.equipos.version',compact('vequipos'));
    }
}
