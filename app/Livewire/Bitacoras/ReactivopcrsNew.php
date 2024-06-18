<?php

namespace App\Livewire\Bitacoras;

use App\Models\pcr;
use App\Models\reactivos;
use Livewire\Component;
use Livewire\WithPagination;

class ReactivopcrsNew extends Component
{

    //&---------------paginacion-------------------------------
    use WithPagination;

    //&---------------Filtros----------------------------------
    public $reactivos;
    public $search_registro="";

    public function mount()
    {
        $this->reactivos = reactivos::all();

    }

    public function render()
    {
        $rpcrs=pcr::where('no_registro','LIKE','%' . $this->search_registro . '%')->paginate(10);
        return view('livewire.bitacoras.reactivopcrs-new',compact('rpcrs'));
    }
}
