<?php

namespace App\Livewire\Especies;

use App\Models\vespecies;
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
    public $VersionEspecieId;

    //---------------Lazy-------------------------------
    public function placeholder()
    {
       return view('livewire.placeholders.skeleton');
    }

    public function render()
    {
        $vespecies=vespecies::where('especie_id','=',$this->VersionEspecieId)->paginate(10);
        return view('livewire.especies.version',compact('vespecies'));
    }
}
