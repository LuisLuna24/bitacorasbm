<?php

namespace App\Livewire\Bitacoras;

use App\Models\pcr;
use App\Models\reactivopcrs;
use App\Models\reactivos;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;

class ReactivopcrsEdit extends Component
{

    #[Reactive]
    public $ReacPcrEditId;

    //&---------------paginacion-------------------------------
    use WithPagination;

    //&---------------Filtros----------------------------------
    public $reactivos;
    public $search_registro = "";

    public function mount()
    {
        $this->reactivos = reactivos::all();
    }

    //&---------------edit----------------------------------

    public $selectedTagsPcr = [];
    public $reactivo, $fecha_apertura;
    public $rpcrEdit = [
        'reactivo' => '',
        'fecha_apertura' => '',
        'selectedTagsPcr' => [],
    ];

    public function edit()
    {
        $id=$this->ReacPcrEditId;
        
        $rpcr = reactivopcrs::find($id);
        $this->rpcrEdit = [
            'reactivo' => $rpcr->reactivo_id,
            'fecha_apertura' => $rpcr->fecha_apertura,
            'selectedTagsPcr' => $rpcr->pcrs->pluck('id')->toArray(),
        ];
    }


    public function render()
    {
        $rpcrs = pcr::where('no_registro', 'LIKE', '%' . $this->search_registro . '%')->paginate(10);
        return view('livewire.bitacoras.reactivopcrs-edit', compact('rpcrs'));
    }
}
