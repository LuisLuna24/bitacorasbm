<?php

namespace App\Livewire\Bitacoraextraccion;

use App\Models\extraccion;
use App\Models\reactivoextraccions;
use App\Models\reactivos;
use Livewire\Component;
use Livewire\WithPagination;

class ReactivoextraccionsNew extends Component
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
            'selectedTagsPcr' =>'required|unique:pcreal_reactivopcreals,pcreal_id',
        ],[
            'reactivo.required' => 'Seleccione unn reactivo',
            'fecha_apertura.required' => 'La fecha de apertura es requerida',
            'fecha_apertura.date' => 'La fecha de apertura debe ser una fecha valida',
            'selectedTagsPcr.required' => 'El seleccione almenos una bitacora',
            'selectedTagsPcr.unique' => 'Esta bitacora ya fue registrada',
        ]);

        $rpcr = reactivoextraccions::create([
            'reactivo_id' => $this->reactivo,
            'fecha_apertura' => $this->fecha_apertura,
            'user_id' => auth()->user()->id,
        ]);
        $rpcr->extraccions()->attach($this->selectedTagsPcr);

        $this->reset(['reactivo', 'fecha_apertura','selectedTagsPcr']);
        session()->flash('message', 'Registro creado con exito');
    }

    public function render()
    {
        $rextraccions=extraccion::where('no_registro','LIKE','%' . $this->search_registro . '%')->paginate(10);
        return view('livewire.bitacoraextraccion.reactivoextraccions-new',compact('rextraccions'));
    }
}
