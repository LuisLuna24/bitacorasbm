<?php

namespace App\Livewire\Reactivos;

use App\Models\reactivos;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy]
class Table extends Component
{

    //---------------paginacion-------------------------------
    use WithPagination;

    //---------------Filtros----------------------------------
    public $search = '';
    public $datos=10;
    public $estate='Existencia';

    //---------------Create----------------------------------
    public $create_new=false;
    public $nombre,$lote,$descripcion,$existencia,$fecha_caducidad;

    Public function new(){
        $this->create_new=true;
    }

    public function create(){
        $this->validate([
            'nombre' =>'required|min:3|max:30|',
            'lote' =>'required|min:3|max:30|',
            'existencia' =>'required|integer',
            'fecha_caducidad' =>'required|date',
        ],[
            'lote.required' => 'El nombre del equipo es requerido',
            'nombre.min' => 'El nombre debe tener minimo 3 caracteres',
            'nombre.max' => 'El nombre debe tener maximo 30 caracteres',
            'lote.required' => 'El lote del equipo es requerido',
            'lote.min' => 'El lote del equipo debe tener minimo 3 caracteres',
            'lote.max' => 'El lote del equipo debe tener maximo 30 caracteres',
            'existencia.required' => 'La catidad de existencia es requerida',
            'existencia.integer' => 'Este campo deve contener numeros enteros',
            'fecha_caducidad.required' => 'La fecha de caducidad es requerida',
            'fecha_caducidad.date' => 'La fecha de caducidad debe ser una fecha valida',
        ]);
        reactivos::create([
            'nombre' => $this->nombre,
            'lote' => $this->lote,
            'description' => $this->descripcion,
            'existencia' => $this->existencia,
            'fecha_caducidad' => $this->fecha_caducidad,
            'user_id' => auth()->user()->id,
        ]);

        $this->create_new=false;
        $this->reset(['nombre','lote','descripcion','existencia']);
        session()->flash('add_msg', 'Reactivo agregado correctamente');
    }

    public function cancel_new(){
        $this->create_new=false;
    }

    //---------------Actualizar--------------------------------
    public $update_new=false;
    public $reactivoIdEdit;
    public $reactivoEdit=[
        'nombre' => '',
        'lote' => '',
        'descripcion' => '',
        'existencia' => '',
        'fecha_caducidad' => '',
    ];

    public function edit($reactivoId){
        $this->update_new=true;
        $this->reactivoIdEdit = $reactivoId;
        $equipo = reactivos::find($reactivoId);
        $this->reactivoEdit = [
            'nombre' => $equipo->nombre,
            'lote' => $equipo->lote,
            'descripcion' => $equipo->description,
            'existencia' => $equipo->existencia,
            'fecha_caducidad' => $equipo->fecha_caducidad,
        ];
    }

    public function update(){
        //Validaciones
        $this->validate([
            'reactivoEdit.nombre' =>'required|min:3|max:30|',
            'reactivoEdit.lote' =>'required|min:3|max:30|',
            'reactivoEdit.descripcion' =>'required|min:3|max:30',
            'reactivoEdit.existencia' =>'required|integer',
            'reactivoEdit.fecha_caducidad' =>'required|date',
        ],[
            'reactivoEdit.nombre.required' => 'El nombre de relactivo es requerido',
            'reactivoEdit.nombre.min' => 'El nombre de reactivo debe tener minimo 3 caracteres',
            'reactivoEdit.nombre.max' => 'El nombre de reactivo debe tener maximo 30 caracteres',
            'reactivoEdit.lote.required' => 'El lote del reactivo es requerido',
            'reactivoEdit.lote.min' => 'El lote del reactivo debe tener minimo 3 caracteres',
            'reactivoEdit.lote.max' => 'El lote del reactivo debe tener maximo 30 caracteres',
            'reactivoEdit.descripcion.required' => 'La descripcion del reactivo es requerida',
            'reactivoEdit.descripcion.min' => 'La descripcion del reactivo debe tener minimo 3 caracteres',
            'reactivoEdit.descripcion.max' => 'La descripcion del reactivo debe tener maximo 30 caracteres',
            'reactivoEdit.existencia.required' => 'La existencia del reactivo es requerida',
            'reactivoEdit.existencia.integer' => 'Este campo deve contener numeros enteros',
            'reactivoEdit.fecha_caducidad.required' => 'La fecha de caducidad es requerida',
            'reactivoEdit.fecha_caducidad.date' => 'La fecha de caducidad debe ser una fecha valida',
        ]);

        //Actualizar
        reactivos::find($this->reactivoIdEdit)->update([
            'nombre' => $this->reactivoEdit['nombre'],
            'lote' => $this->reactivoEdit['lote'],
            'description' => $this->reactivoEdit['descripcion'],
            'existencia' => $this->reactivoEdit['existencia'],
            'fecha_caducidad' => $this->reactivoEdit['fecha_caducidad'],
        ]);

        $this->update_new=false;
        $this->reset(['reactivoEdit']);

        //Mensaje
        session()->flash('up_msg', 'Equipo actualizado correctamente');

    }
    public function cancel_update(){
        $this->update_new=false;
    }

     //---------------Verciones----------------------------------
     public $version_view=false;
     public $VersionReactivoId;
     
 
     public function vercion($versionId){
         $this->version_view=true;
         $this->VersionReactivoId = $versionId;
     }

    //---------------Lazy-------------------------------
    public function placeholder()
    {
       return view('livewire.placeholders.skeleton');
    }
    //---------------render----------------------------------

    public function render()
    {
        $reactivos = reactivos::where('nombre','LIKE','%' . $this->search . '%')->where('estado','=',$this->estate) ->paginate($this->datos);
        return view('livewire.reactivos.table',compact('reactivos'));
    }
}
