<?php

namespace App\Livewire\Extraccion;

use App\Models\vextraccion;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy()]
class Versiones extends Component
{
    
    use WithPagination;

    #[Reactive]
    public $extraccionIdVercion;

    //&================================================Ver Verciones =================================================================================================

    public $view_version = false;
    public $extraVer = [
        'no_registro' => '',
        'fecha' => '',
        'analisis' => '',
        'metodo_id' => '',
        'conc_ng_ul' => '',
        'd260_280' => '',
        'd260_230' => '',
        'validacion' => '',
        'user_id' => '',
    ];
    public $versionExtraccionId;
    public function view($id)
    {
        $this->view_version = true;
        $this->versionExtraccionId = $id;
        $extraccionpcr = vextraccion::find($id);
        $this->extraVer = [
            'no_registro' => $extraccionpcr->no_registro,
            'fecha' => $extraccionpcr->fecha,
            'analisis' => $extraccionpcr->analisis->nombre,
            'metodo' => $extraccionpcr->metodo->nombre,
            'conc_ng_ul' => $extraccionpcr->conc_ng_ul,
            'd260_280' => $extraccionpcr->dato260_280,
            'd260_230' => $extraccionpcr->dato260_230,
        ];
    }

    public function close_version(){
        $this->view_version = false;
        $this->versionExtraccionId = null;
        $this->reset(['extraVer']);
    }


    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }

    public function render()
    {
        $vextraccions=vextraccion::where('extraccion_id','=',$this->extraccionIdVercion)->paginate(10);
        return view('livewire.extraccion.versiones',compact('vextraccions'));
    }
}
