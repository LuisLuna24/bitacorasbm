<?php

namespace App\Livewire\Pcreals;

use App\Models\vpcreals;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy()]
class Versiones extends Component
{

    use WithPagination;

    #[Reactive]
    public $pcrealVercionId;


    //&================================================Ver Verciones =================================================================================================

    public $view_version = false;
    public $sanitizado = false;
    public $tiempouvs = false;
    public $pcrealVersion = [
        'no_registro' => '',
        'analisis' => '',
        'fecha' => '',
        'resultado' => '',
        'sanitizo' => '',
        'tiempouv' => '',
        'observaciones' => '',
        'selectedTagsEspecie' => [],
        'selectedTagsEquipo' => [],
    ];

    public $versionPcrealId;
    public function view($id)
    {
        $this->view_version = true;
        $this->versionPcrealId = $id;
        $pcreal = vpcreals::find($id);
        $this->pcrealVersion = [
            'no_registro' => $pcreal->no_registro,
            'analisis' => $pcreal->analisis_id,
            'fecha' => $pcreal->fecha,
            'resultado' => $pcreal->resultado,
            'sanitizo' => $pcreal->sanitizo,
            'tiempouv' => $pcreal->tiempouv,
            'observaciones' => $pcreal->observaciones,
            'selectedTagsEspecie' => $pcreal->especies->pluck('id')->toArray(),
            'selectedTagsEquipo' => $pcreal->equipos->pluck('id')->toArray(),
        ];
        $this->sanitizado = $pcreal->sanitizo;
        $this->tiempouvs = $pcreal->tiempouv;
    }

    public function close_version(){
        $this->view_version = false;
        $this->versionPcrealId = null;
        $this->reset(['pcrealVersion']);
    }

    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }

    public function render()
    {
        $vpcrs = vpcreals::where('pcreal_id', '=', $this->pcrealVercionId)->paginate(10);
        return view('livewire.pcreals.versiones', compact('vpcrs'));
    }
}
