<?php

namespace App\Livewire\Bitacorapcreal;

use App\Models\pcreal_vreactivopcreals;
use App\Models\reactivos;
use App\Models\vpcreals;
use App\Models\vreactivopcreals;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;

class Versionesreactivopcreals extends Component
{//&---------------paginacion-------------------------------
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
        $rpcr = vreactivopcreals::find($id);
        $this->rpcrView = [
            'reactivo' => $rpcr->reactivo_id,
            'fecha_apertura' => $rpcr->fecha_apertura,
            'selectedTagsPcr' => $rpcr->pcreals->pluck('id')->toArray(),
        ];
    }

    public function cancel_view()
    {
        $this->view_register = false;
        $this->reset(['rpcrView']);
    }

    


    public function render()
    {
        $vrpcr = vreactivopcreals::where('reactivopcreals_id', '=',$this->VercionReactivoId)->orderByDesc('id')->paginate(10);
        $vpcreals=pcreal_vreactivopcreals::where('vreactivopcreals_id','=',$this->ReacPcrViewId)->paginate(10);
        return view('livewire.bitacorapcreal.versionesreactivopcreals',compact('vrpcr','vpcreals'));
    }
}
