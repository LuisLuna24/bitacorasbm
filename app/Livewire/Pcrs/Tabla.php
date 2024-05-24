<?php

namespace App\Livewire\Pcrs;

use App\Models\pcr;
use App\Models\pcrs;
use Livewire\Component;
use Livewire\WithPagination;

class Tabla extends Component
{
    use WithPagination;

    //----------------------------------------------------------------filtros
    public $datos=10;

   

    //----------------------------------------------------------------View
    public $view_view=false;
    public $especiesPcrId;
    public $sanitizado=false;
    public $tiempouv=false;
    public $VerPcr=[
        'no_registro'=>'',
        'analisis'=>'',
        'fecha'=>'',
        'resultado'=>'',
        'agarosa'=>'',
        'voltaje'=>'',
        'tiempo'=>'',
        'sanitizo'=>'',
        'tiempouv'=>'',

    ];
    public function view($id){
        $this->view_view=true;
        $this->especiesPcrId=$id;
        $pcr = pcr::find($id);
        $this->VerPcr = [
            'no_registro' => $pcr->no_registro,
            'analisis' => $pcr->analisis->nombre,
            'fecha' => $pcr->fecha,
            'resultado' => $pcr->resultado,
            'agarosa' => $pcr->agarosa,
            'voltaje' => $pcr->voltaje,
            'tiempo' => $pcr->tiempo,
            'sanitizo' => $pcr->sanitizo,
            'tiempouv' => $pcr->tiempouv,
        ];
        $this->sanitizado = $pcr->sanitizo;
        $this->tiempouv = $pcr->tiempouv;
    }

    public function render()
    {
        $pcrs = pcr::paginate($this->datos);
        return view('livewire.pcrs.tabla',compact('pcrs'));
    }
}
