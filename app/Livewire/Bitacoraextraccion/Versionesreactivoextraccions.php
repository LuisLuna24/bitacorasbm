<?php

namespace App\Livewire\Bitacoraextraccion;

use App\Models\extraccion_vreactivoextraccions;
use App\Models\reactivos;
use App\Models\vreactivoextraccions;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;

class Versionesreactivoextraccions extends Component
{

    //&---------------paginacion-------------------------------
    use WithPagination;

    #[Reactive]
    public $VercionReactivoId;

    public $reactivos;
    public function mount()
    {
        $this->reactivos = reactivos::all();
    }

    public $view_register = false;
    public $ReacPcrViewId;
    public $rpcrView = [];

    public function view($id)
    {
        $this->view_register = true;
        $this->ReacPcrViewId = $id;
        $rpcr = vreactivoextraccions::find($id);
        $this->rpcrView = [
            'reactivo' => $rpcr->reactivo_id,
            'fecha_apertura' => $rpcr->fecha_apertura,
            'selectedTagsPcr' => $rpcr->extraccions->pluck('id')->toArray(),
        ];
    }

    public function cancel_view()
    {
        $this->view_register = false;
        $this->reset(['rpcrView']);
    }

    public function render()
    {
        $vrpcr = vreactivoextraccions::where('reactivoextraccions_id', '=',$this->VercionReactivoId)->orderByDesc('id')->paginate(10);
        $vpcreals=extraccion_vreactivoextraccions::where('vreactivoextraccions_id','=',$this->ReacPcrViewId)->paginate(10);
        return view('livewire.bitacoraextraccion.versionesreactivoextraccions',compact('vrpcr','vpcreals'));
    }
}
