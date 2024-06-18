<?php

namespace App\Livewire\Reactivos;

use Livewire\Component;

class Index extends Component
{
    public $tipo_bitacora=false;

    public function tipo(){
        $this->tipo_bitacora=true;
    }

    public function close_tipo(){
        $this->tipo_bitacora=false;
    }


    public function render()
    {
        return view('livewire.reactivos.index');
    }
}
