<?php

namespace App\Livewire\Reactivos;

use App\Models\reactivos_pcrs;
use Livewire\Component;
use Livewire\WithPagination;

class Pcr extends Component
{

    use WithPagination;

    //----------------------------------------------------------------filtros
    public $datos = 10;
    public $estate='';
    public $search='';
    public $date=''; 



    public function render()
    {
        $reactivo_pcrs = reactivos_pcrs::where('validacion','LIKE','%'.$this->estate.'%')->where('fecha_apertura','LIKE','%' . $this->search . '%')->where('created_at','LIKE','%' . $this->date . '%')->paginate($this->datos);
        return view('livewire.reactivos.pcr', compact('reactivo_pcrs'));
    }
}
