<?php

namespace App\Livewire\Bitacoras;

use App\Models\pcr;
use App\Models\reactivopcrs as ModelsReactivopcrs;
use App\Models\reactivos;
use DragonCode\Contracts\Cashier\Resources\Model;
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

    public function update(){
        $this->validate([
            'rpcrEdit.reactivo' =>'required',
            'rpcrEdit.fecha_apertura' =>'required|date',
            'rpcrEdit.selectedTagsPcr' =>'required',
        ]);

        $rpcr = ModelsReactivopcrs::find($this->ReacPcrEditId);
        $rpcr->update([
           'reactivo_id' => $this->rpcrEdit['reactivo'],
            'fecha_apertura' => $this->rpcrEdit['fecha_apertura'],
        ]);
        $rpcr->pcrs()->sync($this->rpcrEdit['selectedTagsPcr']);

        $this->edit_register = false;
        session()->flash('message', 'Registro actualizado con exito');
        $this->reset(['rpcrEdit']);
    }

    //!=================================================================== View ================================================================

    

    public function render()
    {
        $pcrs = ModelsReactivopcrs::all();
        $rpcrs = pcr::where('no_registro', 'LIKE', '%' . $this->search_registro . '%')->paginate(3);
        return view('livewire.bitacoras.reactivopcrs', compact('pcrs', 'rpcrs'));
    }
}
