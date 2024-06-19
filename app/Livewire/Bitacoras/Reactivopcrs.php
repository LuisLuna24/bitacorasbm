<?php

namespace App\Livewire\Bitacoras;

use App\Models\pcr;
use App\Models\reactivopcrs as ModelsReactivopcrs;
use App\Models\reactivos;
use Livewire\Component;
use Livewire\WithPagination;

class Reactivopcrs extends Component
{
    //&---------------paginacion-------------------------------
    use WithPagination;

    //&---------------Filtros----------------------------------
    public $reactivos;
    public $search_registro = "";

    public function mount()
    {
        $this->reactivos = reactivos::all();
    }

    //&=================================================================== Nuevo ================================================================
    public $create_new = false;

    public function new()
    {
        $this->create_new = true;
    }

    public function create()
    {
    }

    public function cancel_new()
    {
        $this->create_new = false;
    }


    //!=================================================================== Edit ================================================================

    public $edit_register = false;
    public $ReacPcrEditId;
    public $rpcrEdit = [
        'reactivo' => '',
        'fecha_apertura' => '',
        'selectedTagsPcr' => [],
    ];

    public function edit($id)
    {
        $this->edit_register = true;
        $this->ReacPcrEditId = $id;
        $rpcr = ModelsReactivopcrs::find($id);
        $this->rpcrEdit = [
            'reactivo' => $rpcr->reactivo_id,
            'fecha_apertura' => $rpcr->fecha_apertura,
            'selectedTagsPcr' => $rpcr->pcrs->pluck('id')->toArray(),
        ];
    }



    public function render()
    {
        $pcrs = ModelsReactivopcrs::all();
        $rpcrs = pcr::where('no_registro', 'LIKE', '%' . $this->search_registro . '%')->paginate(3);
        return view('livewire.bitacoras.reactivopcrs', compact('pcrs', 'rpcrs'));
    }
}
