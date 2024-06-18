<?php

namespace App\Livewire\Bitacoras;

use App\Models\pcr;
use App\Models\reactivopcrs as ModelsReactivopcrs;
use App\Models\reactivos;
use Livewire\Component;
use Livewire\WithPagination;

class Reactivopcrs extends Component
{
    //---------------paginacion-------------------------------
    use WithPagination;

    //&===================================================================Nuevo================================================================
    public $create_new=false;

    public function new(){
        $this->create_new=true;
    }

    public function create(){

    }

    public function cancel_new(){
        $this->create_new=false;
    }


    public function render()
    {
        $pcrs= ModelsReactivopcrs::all();
        
        return view('livewire.bitacoras.reactivopcrs',compact('pcrs'));
    }
}
