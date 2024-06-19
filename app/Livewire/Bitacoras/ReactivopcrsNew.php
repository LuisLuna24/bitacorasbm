<?php

namespace App\Livewire\Bitacoras;

use App\Models\pcr;
use App\Models\reactivopcrs;
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

    
    //&---------------Crear------------------------------------

    public $selectedTagsPcr=[];
    public $reactivo,$fecha_apertura;

    public function create(){
        //Validaciones
        $this->validate([
            'reactivo' => 'required',
            'fecha_apertura' =>'required|date',
            'selectedTagsPcr' =>'required',
        ],[
            'reactivo.required' => 'Seleccione unn reactivo',
            'fecha_apertura.required' => 'La fecha de apertura es requerida',
            'fecha_apertura.date' => 'La fecha de apertura debe ser una fecha valida',
            'selectedTagsPcr.required' => 'El seleccione almenos una bitacora',
        ]);

        $rpcr = reactivopcrs::create([
            'reactivo_id' => $this->reactivo,
            'fecha_apertura' => $this->fecha_apertura,
            'user_id' => auth()->user()->id,
        ]);
        $rpcr->pcrs()->attach($this->selectedTagsPcr);

        $this->reset(['reactivo', 'fecha_apertura','selectedTagsPcr']);
        session()->flash('message', 'Registro creado con exito');
    }

    public function render()
    {
        $rpcrs=pcr::where('no_registro','LIKE','%' . $this->search_registro . '%')->paginate(10);
        return view('livewire.bitacoras.reactivopcrs-new',compact('rpcrs'));
    }
}
