<?php

namespace App\Livewire\Analises;

use App\Models\vanalises;
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
    public $VersionAnalisId;

    //---------------Lazy-------------------------------
    public function placeholder()
    {
       return view('livewire.placeholders.skeleton');
    }

    public function render()
    {
        $vanalises=vanalises::where('analisis_id','=',$this->VersionAnalisId)->paginate(10);
        return view('livewire.analises.version',compact('vanalises'));
    }
}
