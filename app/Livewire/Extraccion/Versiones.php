<?php

namespace App\Livewire\Extraccion;

use App\Models\vextraccion;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy()]
class Versiones extends Component
{
    
    use WithPagination;

    #[Reactive]
    public $extraccionIdVercion;


    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }

    public function render()
    {
        $vextraccions=vextraccion::where('extraccion_id','=',$this->extraccionIdVercion)->paginate(10);
        return view('livewire.extraccion.versiones',compact('vextraccions'));
    }
}
