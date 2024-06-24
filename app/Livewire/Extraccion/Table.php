<?php

namespace App\Livewire\Extraccion;

use App\Models\analises;
use App\Models\equipos;
use App\Models\extraccion;
use App\Models\metodos;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy()]
class Table extends Component
{

    //---------------paginacion-------------------------------
    use WithPagination;
    //---------------Filtros----------------------------------
    public $search = '';
    public $datos = 10;
    public $validacion = '';
    public $date = '';

    //----------------------------------------------------------------Mostrar datos
    public $analises, $metodos, $equipos;

    public function mount()
    {
        $this->analises = analises::all();
        $this->metodos = metodos::all();
        $this->equipos = equipos::all();
    }

    //---------------Nuevo Regsitros----------------------------------------------------------------------

    public $nuevo_registro = false;
    public $no_registro, $fecha, $analisis, $metodo, $conc_ng_ul, $d260_280, $d260_230,$catidad;
    public $selectEquipos = [];

    public function new()
    {
        $this->nuevo_registro = true;
    }

    public function crear_registro()
    {
        $this->validate([
            'no_registro' => 'required|min:5|integer',
            'fecha' => 'required',
            'analisis' => 'required',
            'metodo' => 'required',
            'conc_ng_ul' => 'required|numeric',
            'd260_280' => 'required|numeric',
            'd260_230' => 'required|numeric',
            'selectEquipos' => 'required',
            //'catidad' => 'required|numeric|between:1,20',
        ], [
            'no_registro.integer' => 'El No. de Registro debe ser un numero',
            'no_registro.min' => 'El No. de Registro debe tener minimo 5 caracteres',
            'conc_ng_ul.numeric' => 'La Concentracion de NG/UL debe ser un numero',
            'd260_280.numeric' => 'El Dato 260/280 debe ser un numero',
            'd260_230.numeric' => 'El Dato 260/230 debe ser un numero',
            'analisis.required' => 'El Analisis es requerido',
            'metodo.required' => 'El Metodo es requerido',
            'conc_ng_ul.required' => 'La Concentracion de NG/UL es requerida',
            'd260_280.required' => 'El Dato 260/280 es requerido',
            'd260_230.required' => 'El Dato 260/230 es requerido',
            'selectEquipos.required' => 'Seleccione almenos un equipo',
            /*'catidad.required' => 'La catidad de existencia es requerida',
            'catidad.integer' => 'Este campo deve contener numeros enteros',
            'catidad.between' => 'La catidad de existencia debe estar entre 1 y 20',*/
        ]);

        $extraccion = extraccion::create([
            'no_registro' => $this->no_registro,
            'fecha' => $this->fecha,
            'analisis_id' => $this->analisis,
            'metodo_id' => $this->metodo,
            'conc_ng_ul' => $this->conc_ng_ul,
            'dato260_280' => $this->d260_280,
            'dato260_230' => $this->d260_230,
            'user_id' => auth()->user()->id,
        ]);
        $extraccion->equipos()->attach($this->selectEquipos);
        $this->nuevo_registro = false;
        session()->flash('message', 'Registro Creado Correctamente');
        $this->reset(['no_registro', 'fecha', 'analisis', 'metodo', 'conc_ng_ul', 'd260_280', 'd260_230', 'selectEquipos']);
    }

    public function cancelar_registro()
    {
        $this->nuevo_registro = false;
        $this->reset(['no_registro', 'fecha', 'analisis', 'metodo', 'conc_ng_ul', 'd260_280', 'd260_230', 'selectEquipos']);
    }

    //---------------Editar Regsitros----------------------------------------------------------------------
    public $editar_registro = false;
    public $extraccionIdEdit;
    public $extraEdit = [
        'no_registro' => '',
        'fecha' => '',
        'analisis' => '',
        'metodo' => '',
        'conc_ng_ul' => '',
        'd260_280' => '',
        'd260_230' => '',
        'selectEquipos' => [],
    ];

    public function editar($id)
    {
        $this->editar_registro = true;
        $this->extraccionIdEdit = $id;
        $extraccion = extraccion::find($id);
        $this->extraEdit = [
            'no_registro' => $extraccion->no_registro,
            'fecha' => $extraccion->fecha,
            'analisis' => $extraccion->analisis_id,
            'metodo' => $extraccion->metodo_id,
            'conc_ng_ul' => $extraccion->conc_ng_ul,
            'd260_280' => $extraccion->dato260_280,
            'd260_230' => $extraccion->dato260_230,
            'selectEquipos' => $extraccion->equipos->pluck('id')->toArray(),
        ];
    }

    public function update_registro()
    {
        $this->validate([
            'extraEdit.no_registro' => 'required|min:5|integer',
            'extraEdit.fecha' => 'required',
            'extraEdit.analisis' => 'required',
            'extraEdit.metodo' => 'required',
            'extraEdit.conc_ng_ul' => 'required|numeric',
            'extraEdit.d260_280' => 'required|numeric',
            'extraEdit.d260_230' => 'required|numeric',
            'extraEdit.selectEquipos' => 'required',
        ], [
            'extraEdit.no_registro.required' => 'El campo no_registro es obligatorio',
            'extraEdit.no_registro.integer' => 'El campo no_registro debe ser un numero entero',
            'extraEdit.no_registro.min' => 'El campo no_registro debe tener al menos 5 caracteres',
            'extraEdit.fecha.required' => 'El campo fecha es obligatorio',
            'extraEdit.analisis.required' => 'El campo analisis es obligatorio',
            'extraEdit.metodo.required' => 'El campo metodo es obligatorio',
            'extraEdit.conc_ng_ul.required' => 'El campo conc_ng_ul es obligatorio',
            'extraEdit.conc_ng_ul.numeric' => 'El campo conc_ng_ul debe ser un numero',
            'extraEdit.d260_280.required' => 'El campo d260_280 es obligatorio',
            'extraEdit.d260_280.numeric' => 'El campo d260_280 debe ser un numero',
            'extraEdit.d260_230.required' => 'El campo d260_230 es obligatorio',
            'extraEdit.d260_230.numeric' => 'El campo d260_230 debe ser un numero',
            'extraEdit.selectEquipos.required' => 'El campo selectEquipos es obligatorio',
        ]);

        $extraccion = extraccion::find($this->extraccionIdEdit);
        $extraccion->update([
            'no_registro' => $this->extraEdit['no_registro'],
            'fecha' => $this->extraEdit['fecha'],
            'analisis_id' => $this->extraEdit['analisis'],
            'metodo_id' => $this->extraEdit['metodo'],
            'conc_ng_ul' => $this->extraEdit['conc_ng_ul'],
            'dato260_280' => $this->extraEdit['d260_280'],
            'dato260_230' => $this->extraEdit['d260_230'],
            'user_id' => auth()->user()->id,
        ]);

        $extraccion->equipos()->sync($this->extraEdit['selectEquipos']);

        $this->editar_registro = false;
        session()->flash('up_msg', 'Registro actualizado correctamente');
        $this->reset(['extraEdit']);
    }

    public function cancelar_actualizar()
    {
        $this->editar_registro = false;
        $this->reset(['extraEdit']);
    }

    //---------------Ver Regsitros----------------------------------------------------------------------

    public $ver_registro = false;
    public $extraccionIdVer;
    public $extraVer = [
        'no_registro' => '',
        'fecha' => '',
        'analisis' => '',
        'metodo' => '',
        'conc_ng_ul' => '',
        'd260_280' => '',
        'd260_230' => '',
        'selectEquipos' => [],
    ];
    public function view($id)
    {
        $this->ver_registro = true;
        $this->extraccionIdVer = $id;
        $extraccion = extraccion::find($id);
        $this->extraVer = [
            'no_registro' => $extraccion->no_registro,
            'fecha' => $extraccion->fecha,
            'analisis' => $extraccion->analisis->nombre,
            'metodo' => $extraccion->metodo->nombre,
            'conc_ng_ul' => $extraccion->conc_ng_ul,
            'd260_280' => $extraccion->dato260_280,
            'd260_230' => $extraccion->dato260_230,
            'selectEquipos' => $extraccion->equipos->pluck('nombre')->toArray(),
        ];
    }

    public function cancelar_ver()
    {
        $this->ver_registro = false;
        $this->reset(['extraVer']);
    }

    //---------------Validar Regsitros----------------------------------------------------------------------

    public function validar_registro()
    {
        $extraccion = extraccion::find($this->extraccionIdVer);
        $extraccion->update([
            'validacion' => 'Validado',
        ]);
        $this->ver_registro = false;
        session()->flash('up_msg', 'Registro validado correctamente');
        $this->reset(['extraVer']);
    }


    //---------------Versiones--------------------------------------------------------------------------------

    public $versiones = false;
    public $extraccionIdVercion;

    public function version($id)
    {
        $this->versiones = true;
        $this->extraccionIdVercion = $id;
    }

    public function close_version()
    {
        $this->versiones = false;
    }

    //---------------Lazy ---------------------------------------------------------------------------------
    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }
    //---------------Render--------------------------------------------------------------------------------
    public function render()
    {
        $extracciones = extraccion::where('no_registro', 'LIKE', '%' . $this->search . "%")->where('fecha', 'LIKE', '%' . $this->date . '%')->where('validacion', 'LIKE', '%' . $this->validacion . '%')->paginate($this->datos);
        return view('livewire.extraccion.table', compact('extracciones'));
    }
}
