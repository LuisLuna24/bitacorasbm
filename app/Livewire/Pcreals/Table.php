<?php

namespace App\Livewire\Pcreals;

use App\Models\analises;
use App\Models\equipos;
use App\Models\especies;
use App\Models\pcreal;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy()]
class Table extends Component
{

    use WithPagination;

    //----------------------------------------------------------------filtros
    public $datos = 10;
    public $estate = '';
    public $search = '';
    public $date = '';

    //----------------------------------------------------------------Mostrar datos
    public $analises, $especies, $equipos;

    public function mount()
    {
        $this->analises = analises::all();
        $this->especies = especies::all();
        $this->equipos = equipos::all();
    }

    //----------------------------------------------------------------Create
    public $create_new = false;
    public $no_registro, $cantidad, $analisis, $fecha, $resultado='Negativo', $sanitizo = 0, $tiempouv = 0, $observaciones;
    public $selectedTagsEspecie = [];
    public $selectedTagsEquipo = [];

    public function new()
    {
        $this->create_new = true;
    }
    public function create()
    {
        $this->validate([
            'no_registro' => 'required|min:5|integer',
            'analisis' => 'required',
            'fecha' => 'required',
            'cantidad' => 'required|numeric',
        ], [
            'no_registro.required' => 'El No. de registro es obligatorio',
            'no_registro.min' => 'El No. de registro debe tener al menos 5 caracteres',
            'no_registro.max' => 'El No. de registro debe tener como maximo 6 caracteres',
            'no_registro.integer' => 'El No. de registro debe ser un numero entero',
            'analisis.required' => 'Seleccione un analisis',
            'fecha.required' => 'Inserte fecha',
            'selectedTagsEspecie.required' => 'Seleccione una especie',
            'selectedTagsEquipo.required' => 'Seleccione un equipo',
            'cantidad.required' => 'Ingrese la cantidad',
            'cantidad.numeric' => 'La cantidad debe ser un numero',

        ]);
        for ($i = 0; $i < $this->cantidad; $i++) {
            $pcreal = pcreal::create([
                'no_registro' => $this->no_registro . '-' . $i + 1,
                'analisis_id' => $this->analisis,
                'fecha' => $this->fecha,
                'resultado' => $this->resultado,
                'sanitizo' => $this->sanitizo,
                'tiempouv' => $this->tiempouv,
                'observaciones' => $this->observaciones,
                'user_id' => auth()->user()->id,
            ]);
            $pcreal->especies()->attach($this->selectedTagsEspecie);
            $pcreal->equipos()->attach($this->selectedTagsEquipo);
        }
        $this->create_new = false;
        $this->reset(['no_registro', 'selectedTagsEspecie', 'selectedTagsEquipo', 'cantidad', 'analisis', 'fecha', 'resultado', 'sanitizo', 'tiempouv', 'observaciones']);
        session()->flash('message', 'Registro creado con exito');
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
    public $VerPcreal = [
        'no_registro' => '',
        'analisis' => '',
        'fecha' => '',
        'resultado' => '',
        'sanitizo' => '',
        'tiempouv' => '',
        'observaciones' => '',
    ];


    public function view($id)
    {
        $this->view_view = true;
        $this->especiesPcrId = $id;
        $pcreal = pcreal::find($id);
        $this->VerPcreal = [
            'no_registro' => $pcreal->no_registro,
            'analisis' => $pcreal->analisis->nombre,
            'fecha' => $pcreal->fecha,
            'resultado' => $pcreal->resultado,
            'sanitizo' => $pcreal->sanitizo,
            'tiempouv' => $pcreal->tiempouv,
            'observaciones' => $pcreal->observaciones,
        ];
        $this->sanitizado = $pcreal->sanitizo;
        $this->tiempouvs = $pcreal->tiempouv;
    }
    public function cerrar_view()
    {
        $this->view_view = false;
    }

    // ----------------------------------------------------------------update

    public $update_new = false;
    public $pcrealIdEdit;
    public $sanitizo_up=false,$tiempouv_up=false;
    public $pcrealEdit = [
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

    public function edit($id)
    {
        $this->update_new = true;
        $this->pcrealIdEdit = $id;
        $pcreal = pcreal::find($id);
        $this->pcrealEdit = [
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
        $this->sanitizo_up = $pcreal->sanitizo;
        $this->tiempouv_up = $pcreal->tiempouv;
    }

    public function update()
    {
        $this->validate([
            'pcrealEdit.no_registro' => 'required|min:5',
            'pcrealEdit.analisis' => 'required',
            'pcrealEdit.fecha' => 'required',
        ], [
            'pcrealEdit.no_registro.required' => 'El No. de registro es obligatorio',
            'pcrealEdit.no_registro.min' => 'El No. de registro debe tener al menos 5 caracteres',
            'pcrealEdit.no_registro.max' => 'El No. de registro debe tener como maximo 6 caracteres',
            'pcrealEdit.analisis.required' => 'Seleccione un analisis',
            'pcrealEdit.fecha.required' => 'Inserte fecha',
            'pcrealEdit.selectedTagsEspecie.required' => 'Seleccione una especie',
            'pcrealEdit.selectedTagsEquipo.required' => 'Seleccione un equipo',
        ]);
        $pcreal = pcreal::find($this->pcrealIdEdit);
        $pcreal->update([
            'no_registro' => $this->pcrealEdit['no_registro'],
            'analisis_id' => $this->pcrealEdit['analisis'],
            'fecha' => $this->pcrealEdit['fecha'],
            'resultado' => $this->pcrealEdit['resultado'],
            'sanitizo' => $this->pcrealEdit['sanitizo'],
            'tiempouv' => $this->pcrealEdit['tiempouv'],
            'observaciones' => $this->pcrealEdit['observaciones'],
        ]);
        $pcreal->especies()->sync($this->pcrealEdit['selectedTagsEspecie']);
        $pcreal->equipos()->sync($this->pcrealEdit['selectedTagsEquipo']);
        $this->update_new = false;
        $this->reset(['pcrealEdit']);
        session()->flash('message', 'Registro actualizado con exito');
    }

    public function cancel_update(){
        $this->update_new = false;
        $this->reset(['pcrealEdit']);
    }


    // ----------------------------------------------------------------Vercion

    public $vercion_pcr = false;
    public $pcrealVercionId;

    public function version($id)
    {
        $this->vercion_pcr = true;
        $this->pcrealVercionId = $id;
    }

    // ----------------------------------------------------------------Validar

    public $validar_vitacora = false;
    public $pcrealVal = [
        'no_registro' => '',
    ];

    public function alert_validar(){
        $this->validar_vitacora = true;
        $pcreal = pcreal::find($this->especiesPcrId);
        $this->pcrealVal = [
            'no_registro' => $pcreal->no_registro,
        ];
    }

    public function validar(){
        $pcreal = pcreal::find($this->especiesPcrId);
        $pcreal->update([
            'validacion' => 'Validado',
        ]);
        $this->validar_vitacora = false;
        $this->view_view = false;
        $this->reset(['pcrealVal']);
        session()->flash('message', 'Registro validado con exito');
    }


    //---------------Lazy-------------------------------
    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }

    public function render()
    {
        $pcreals = pcreal::where('validacion', 'LIKE', '%' . $this->estate . '%')->where('no_registro', 'LIKE', '%' . $this->search . '%')->where('fecha', 'LIKE', '%' . $this->date . '%')->orderBy('id', 'desc')->paginate($this->datos);
        return view('livewire.pcreals.table', compact('pcreals'));
    }
}
