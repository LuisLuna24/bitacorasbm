<?php

namespace App\Livewire\Bitacoras;

use App\Models\pcr;
use App\Models\pcrs_reactivopcr;
use App\Models\reactivopcrs as ModelsReactivopcrs;
use App\Models\reactivos;
use App\Models\vreactivopcrs;
use DragonCode\Contracts\Cashier\Resources\Model;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;


#[Lazy()]
class Reactivopcrs extends Component
{
    //&---------------paginacion-------------------------------
    use WithPagination;

    //&---------------Filtros----------------------------------
    public $reactivos;
    public $search_registro = "";

    public $datos = 10;
    public $estate='';
    public $search='';
    public $date=''; 

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
    public $ReacPcrEditId='';
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

    public function update()
    {
        $this->validate([
            'rpcrEdit.reactivo' => 'required',
            'rpcrEdit.fecha_apertura' => 'required|date',
            'rpcrEdit.selectedTagsPcr' => 'required',
        ]);

        $rpcr = ModelsReactivopcrs::find($this->ReacPcrEditId);

        $vrpcr= vreactivopcrs::create([
            'reactivopcr_id'=>$this->ReacPcrEditId,
            'version'=>$rpcr->version+1,
            'reactivo_id' => $rpcr->reactivo_id,
            'fecha_apertura' => $rpcr->fecha_apertura,
            'validacion'=> $rpcr->validacion,
            'user_id' => auth()->user()->id,
        ]);
        $vrpcr->pcrs()->sync($this->rpcrEdit['selectedTagsPcr']);



        $rpcr->update([
            'reactivo_id' => $this->rpcrEdit['reactivo'],
            'fecha_apertura' => $this->rpcrEdit['fecha_apertura'],
            'version'=>$rpcr->version+1,
        ]);
        $rpcr->pcrs()->sync($this->rpcrEdit['selectedTagsPcr']);

        $this->edit_register = false;
        session()->flash('message', 'Registro actualizado con exito');
        $this->reset(['rpcrEdit']);
    }

    //!=================================================================== View ================================================================

    public $view_register = false;
    public $ReacPcrViewId;
    public $rpcrView = [];

    public function view($id)
    {
        $this->view_register = true;
        $this->ReacPcrViewId = $id;
        $rpcr = ModelsReactivopcrs::find($id);
        $this->rpcrView = [
            'reactivo' => $rpcr->reactivo_id,
            'fecha_apertura' => $rpcr->fecha_apertura,
            'selectedTagsPcr' => $rpcr->pcrs->pluck('id')->toArray(),
        ];
    }

    public function cancel_view()
    {
        $this->view_register = false;
        $this->reset(['rpcrView']);
    }

    //&=================================================================== Validar ================================================================

    public $validar_register=false;

    public function validar(){
        $this->validar_register=true;

    }

    public function validar_view(){
        $rpcr = ModelsReactivopcrs::find($this->ReacPcrViewId);
        $rpcr->update([
            'validacion' => 'Validada',
        ]);
        $this->validar_register=false;
        $this->view_register=false;
        session()->flash('up_msg', 'Registro validado correctamente');
    }

    public function cancel_validar(){
        $this->validar_register=false;
    }

    //!=================================================================== Verciones ================================================================

    public $version_register=false;
    public $VercionReactivoId;

    public function version($id){
        $this->version_register=true;
        $this->VercionReactivoId=$id;
    }


    //!=================================================================== lazy ================================================================

    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }

    //!=================================================================== render ================================================================

    public function render()
    {
        $pcrs = ModelsReactivopcrs::where('created_at','LIKE','%' . $this->date . '%')->where('validacion','LIKE','%' . $this->estate . '%')->paginate($this->datos);
        $rpcrs = pcr::where('no_registro', 'LIKE', '%' . $this->search_registro . '%')->paginate(10);
        $vrpcr = pcrs_reactivopcr::where('reactivopcrs_id', 'LIKE', '%' . $this->ReacPcrViewId . '%')->paginate(10);
        return view('livewire.bitacoras.reactivopcrs', compact('pcrs', 'rpcrs', 'vrpcr'));
    }
}
