<?php

namespace App\Livewire\Pcrs;

use App\Models\analises;
use App\Models\equipos;
use App\Models\especies;
use App\Models\pcr;
use App\Models\pcrs;
use App\Models\vpcrs;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;


#[Lazy]
class Tabla extends Component
{
    use WithPagination;

    //----------------------------------------------------------------filtros
    public $datos = 10;
    public $estate='';
    public $search='';
    public $date=''; 

    

    //----------------------------------------------------------------Mostrar datos
    public $analises, $especies, $equipos,$pcr;
    public function mount()
    {
        $this->analises = analises::all();
        $this->especies = especies::all();
        $this->equipos = equipos::where('estado','=','Activo')->get();
        $this->pcr = pcr::all();
    }


    //----------------------------------------------------------------create
    public $create_new = false;
    public $no_registro, $cantidad, $analisis, $fecha, $resultado, $agarosa, $voltaje, $tiempo, $sanitizo = 0, $tiempouv = 0;
    public $selectedTagsEspecie = [];
    public $selectedTagsEquipo = [];

    public function new()
    {
        $this->create_new = true;
    }
    

    public function create()
    {
        $this->validate([
            'no_registro' => 'required|min:5',
            'analisis' => 'required',
            'fecha' => 'required',
            'agarosa' => 'required|numeric',
            'voltaje' => 'required|numeric',
            'tiempo' => 'required|numeric',
            'selectedTagsEspecie' => 'required',
            'selectedTagsEquipo' => 'required',
            'cantidad' => 'required|numeric|between:1,20',
        ], [
            'no_registro.required' => 'El No. de registro es obligatorio',
            'no_registro.min' => 'El No. de registro debe tener al menos 5 caracteres',
            'no_registro.max' => 'El No. de registro debe tener como maximo 5 caracteres',
            'no_registro.integer' => 'El No. de registro debe ser un numero entero',
            'analisis.required' => 'Seleccione un analisis',
            'fecha.required' => 'Inserte fecha',
            'agarosa.required' => 'Ingrese la cantidad de agarosa',
            'agarosa.numeric' => 'La cantidad de agarosa debe ser un numero',
            'voltaje.required' => 'Ingrese el voltaje',
            'voltaje.numeric' => 'El voltaje debe ser un numero',
            'tiempo.required' => 'Ingrese el tiempo',
            'tiempo.numeric' => 'El tiempo debe ser un numero',
            'selectedTagsEspecie.required' => 'Seleccione una especie',
            'selectedTagsEquipo.required' => 'Seleccione un equipo',
            'cantidad.required' => 'Ingrese la cantidad',
            'cantidad.numeric' => 'La cantidad debe ser un numero',
            'cantidad.between' => 'La cantidad debe estar entre 1 y 20',
        ]);

        for($i=0;$i<$this->cantidad;$i++){
            $pcr = pcr::create([
                'no_registro' => $this->no_registro.'-'.$i+1,
                'fecha' => $this->fecha,
                'analisis_id' => $this->analisis,
                'resultado' => $this->resultado,
                'agarosa' => $this->agarosa,
                'voltaje' => $this->voltaje,
                'tiempo' => $this->tiempo,
                'sanitizo' => $this->sanitizo,
                'tiempouv' => $this->tiempouv,
                'user_id' => auth()->user()->id,
            ]);
            $pcr->especies()->attach($this->selectedTagsEspecie);
            $pcr->equipos()->attach($this->selectedTagsEquipo);
        }
        

        

        $this->create_new = false;
        $this->reset(['no_registro', 'fecha', 'analisis', 'resultado', 'agarosa', 'voltaje', 'tiempo', 'sanitizo', 'tiempouv', 'selectedTagsEspecie', 'selectedTagsEquipo']);

        session()->flash('add_msg', 'PCR agregado correctamente');
    }

    public function cancel_new()
    {
        $this->create_new = false;
    }
    //----------------------------------------------------------------View
    public $view_view = false;
    public $especiesPcrId;
    public $sanitizado = false;
    public $tiempouvs = false;
    public $VerPcr = [
        'no_registro' => '',
        'analisis' => '',
        'fecha' => '',
        'resultado' => '',
        'agarosa' => '',
        'voltaje' => '',
        'tiempo' => '',
        'sanitizo' => '',
        'tiempouv' => '',

    ];
    public function view($id)
    {
        $this->view_view = true;
        $this->especiesPcrId = $id;
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
        $this->tiempouvs = $pcr->tiempouv;
    }

    public function cerrar_view()
    {
        $this->view_view = false;
    }

    // ----------------------------------------------------------------Update
    public $update_new = false;
    public $usanitizado = false;
    public $utiempouvs = false;
    public $pcrIdEdit;
    public $pcrEdit = [
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

    public function edit($id)
    {
        $this->update_new = true;
        $this->pcrIdEdit = $id;
        $pcr = pcr::find($id);
        $this->pcrEdit = [
            'no_registro' => $pcr->no_registro,
            'analisis' => $pcr->analisis_id,
            'fecha' => $pcr->fecha,
            'resultado' => $pcr->resultado,
            'agarosa' => $pcr->agarosa,
            'voltaje' => $pcr->voltaje,
            'tiempo' => $pcr->tiempo,
            'sanitizo' => $pcr->sanitizo,
            'tiempouv' => $pcr->tiempouv,
            'selectedTagsEspecie' => $pcr->especies->pluck('id')->toArray(),
            'selectedTagsEquipo' => $pcr->equipos->pluck('id')->toArray(),
        ];
        $this->usanitizado = $pcr->sanitizo;
        $this->utiempouvs = $pcr->tiempouv;
    }

    public function update()
    {
        $this->validate([
            'pcrEdit.no_registro' => 'required|min:5',
            'pcrEdit.analisis' => 'required',
            'pcrEdit.fecha' => 'required',
            'pcrEdit.resultado' => 'required',
            'pcrEdit.agarosa' => 'required|numeric',
            'pcrEdit.voltaje' => 'required|numeric',
            'pcrEdit.tiempo' => 'required|numeric',
            'pcrEdit.selectedTagsEspecie' => 'required',
            'pcrEdit.selectedTagsEquipo' => 'required',
        ], [
            'pcrEdit.no_registro.required' => 'El No. de registro es obligatorio',
            'pcrEdit.no_registro.min' => 'El No. de registro debe tener al menos 5 caracteres',
            'pcrEdit.no_registro.max' => 'El No. de registro debe tener como maximo 6 caracteres',
            'pcrEdit.analisis.required' => 'Seleccione un analisis',
            'pcrEdit.fecha.required' => 'Inserte fecha',
            'pcrEdit.resultado.required' => 'Seleccione resultado',
            'pcrEdit.agarosa.required' => 'Ingrese la cantidad de agarosa',
            'pcrEdit.agarosa.numeric' => 'La cantidad de agarosa debe ser un numero',
            'pcrEdit.voltaje.required' => 'Ingrese el voltaje',
            'pcrEdit.voltaje.numeric' => 'El voltaje debe ser un numero',
            'pcrEdit.tiempo.required' => 'Ingrese el tiempo',
            'pcrEdit.tiempo.numeric' => 'El tiempo debe ser un numero',
            'pcrEdit.selectedTagsEspecie.required' => 'Seleccione una especie',
            'pcrEdit.selectedTagsEquipo.required' => 'Seleccione un equipo'
        ]);

        $pcr = pcr::find($this->pcrIdEdit);

        $vrpcr= vpcrs::create([
            'pcr_id' => $this->pcrIdEdit,
            'no_registro' => $pcr->no_registro,
            'version' => $pcr->version+1,
            'fecha' => $pcr->fecha,
            'analisis_id' => $pcr->analisis_id,
            'resultado' => $pcr->resultado,
            'agarosa' => $pcr->agarosa,
            'voltaje' => $pcr->voltaje,
            'tiempo' => $pcr->tiempo,
            'sanitizo' => $pcr->sanitizo,
            'tiempouv' => $pcr->tiempouv,
            'user_id' => auth()->user()->id,
        ]);
        $vrpcr->equipos()->attach($pcr->equipos->pluck('id')->toArray());
        $vrpcr->especies()->attach($pcr->equipos->pluck('id')->toArray());


        $pcr->update([
            'no_registro' => $this->pcrEdit['no_registro'],
            'fecha' => $this->pcrEdit['fecha'],
            'analisis_id' => $this->pcrEdit['analisis'],
            'resultado' => $this->pcrEdit['resultado'],
            'agarosa' => $this->pcrEdit['agarosa'],
            'voltaje' => $this->pcrEdit['voltaje'],
            'tiempo' => $this->pcrEdit['tiempo'],
            'sanitizo' => $this->pcrEdit['sanitizo'],
            'tiempouv' => $this->pcrEdit['tiempouv'],
            'version' => $pcr->version+1,
        ]);
        $pcr->especies()->sync($this->pcrEdit['selectedTagsEspecie']);
        $pcr->equipos()->sync($this->pcrEdit['selectedTagsEquipo']);

        $this->update_new = false;

        session()->flash('up_msg', 'PCR actualizado correctamente');
        $this->reset(['pcrEdit']);
        $this->reset(['selectedTagsEspecie']);
        $this->reset(['selectedTagsEquipo']);
    }


    public function cancel_update()
    {
        $this->update_new = false;
    }



    // ----------------------------------------------------------------Validar
    public $validar_vitacora = false;
    public $pcrValId;
    public $pcrVal = [
        'no_registro' => '',
    ];

    public function alert_validar()
    {
        $this->validar_vitacora = true;
        $pcr = pcr::find($this->especiesPcrId);
        $this->pcrVal = [
            'no_registro' => $pcr->no_registro,
        ];
    }

    public function validar()
    {

        $pcr = pcr::find($this->especiesPcrId);
        $pcr->update([
            'validacion' => 'Validada',
        ]);

        $this->validar_vitacora = false;
        $this->view_view = false;
        $this->reset(['pcrVal']);
        session()->flash('up_msg', 'PCR validado correctamente');
    }

    public function cancel_validar()
    {
        $this->validar_vitacora = false;
    }

    // ----------------------------------------------------------------Vercion

    public $vercion_pcr=false;
    public $pcrVercionId;

    public function version($id){
        $this->vercion_pcr=true;
        $this->pcrVercionId=$id;
    }

    public function cerrar_vercion(){
        $this->vercion_pcr=false;
    }

    //---------------Lazy-------------------------------
    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }

    public function render()
    {
        $pcrs = pcr::where('validacion','LIKE','%'.$this->estate.'%')->where('no_registro','LIKE','%' . $this->search . '%')->where('fecha','LIKE','%' . $this->date . '%')->orderByDesc('id')->paginate($this->datos);
        return view('livewire.pcrs.tabla', compact('pcrs'));
    }
}
