<?php

namespace App\Livewire\Pcrs;

use App\Models\vpcrs;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;


#[Lazy()]
class Versiones extends Component
{

    use WithPagination;

    #[Reactive]
    public $pcrVercionId;

    //&================================================Ver Verciones =================================================================================================

    public $view_version = false;
    public $sanitizado = false;
    public $tiempouvs = false;
    public $pcrVersion = [
        'no_registro' => '',
        'analisis' => '',
        'fecha' => '',
        'resultado' => '',
        'agarosa' => '',
        'voltaje' => '',
        'tiempo' => '',
        'sanitizo' => '',
        'tiempouv' => '',
        'selectedTagsEspecie' => [],
        'selectedTagsEquipo' => [],
    ];
    public $versionPcrId;
    public function view($id)
    {
        $this->view_version = true;
        $this->versionPcrId = $id;
        $vpcr = vpcrs::find($id);
        $this->pcrVersion = [
            'no_registro' => $vpcr->no_registro,
            'analisis' => $vpcr->analisis->nombre,
            'fecha' => $vpcr->fecha,
            'resultado' => $vpcr->resultado,
            'agarosa' => $vpcr->agarosa,
            'voltaje' => $vpcr->voltaje,
            'tiempo' => $vpcr->tiempo,
            'sanitizo' => $vpcr->sanitizo,
            'tiempouv' => $vpcr->tiempouv,
            'selectedTagsEspecie' => $vpcr->especies->pluck('id')->toArray(),
            'selectedTagsEquipo' => $vpcr->equipos->pluck('id')->toArray(),
        ];
        $this->sanitizado = $vpcr->sanitizo;
        $this->tiempouvs = $vpcr->tiempouv;
    }

    public function close_version(){
        $this->view_version = false;
        $this->versionPcrId = null;
        $this->reset(['pcrVersion']);
    }


    //---------------Lazy-------------------------------
    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }

    public function render()
    {
        $vpcrs = vpcrs::where('pcr_id', '=', $this->pcrVercionId)->orderByDesc('version')->paginate(10);
        return view('livewire.pcrs.versiones', compact('vpcrs'));
    }
}
