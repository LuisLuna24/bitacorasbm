<?php

namespace App\Livewire\Equipos;

use App\Models\equipos;
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

    //---------------Create----------------------------------
    public $create_new=false;
    public $inventario,$nombre,$descripcion;

    Public function new(){
        $this->create_new=true;
    }

    public function create(){
        $this->validate([

            'inventario' =>'required|min:3|max:30|unique:equipos',
            'nombre' =>'required|min:3|max:30|',
        ],[
            'inventario.required' => 'El inventario es requerido',
            'inventario.min' => 'El inventario debe tener minimo 3 caracteres',
            'inventario.max' => 'El inventario debe tener maximo 30 caracteres',
            'inventario.unique' => 'Este numero de inventario pertenece a otro equipo',
            'nombre.required' => 'El nombre del analsisi es requerido',
            'nombre.min' => 'El nombre debe tener minimo 3 caracteres',
            'nombre.max' => 'El nombre debe tener maximo 30 caracteres',

        ]);

        equipos::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'inventario' => $this->inventario,
            'user_id' => auth()->user()->id,
        ]);
        
        $this->create_new=false;
        $this->reset(['nombre','descripcion','inventario']);
        session()->flash('add_msg', 'Equipo agregado correctamente');
    }

    public function cancel_new(){
        $this->create_new=false;
    }

    //---------------Verciones----------------------------------
    public $version_view=false;
    public $VersionEquipoId;
    

    public function vercion($versionId){
        $this->version_view=true;
        $this->VersionEquipoId = $versionId;

        

    }

    //---------------Actualizar--------------------------------
    public $update_new=false;
    public $equipoIdEdit;
    public $equipoEdit=[
        'nombre' => ''
    ];

    public function edit($equipoId){
        $this->update_new=true;
        $this->equipoIdEdit = $equipoId;
        $equipo = equipos::find($equipoId);
        $this->equipoEdit = [
            'nombre' => $equipo->nombre,
            'inventario' => $equipo->inventario,
            'descripcion' => $equipo->descripcion
        ];
    }

    public function update(){
        //Validaciones
        $this->validate([
            'equipoEdit.inventario' =>'required|min:3|max:30|unique:equipos,inventario,'.$this->equipoIdEdit,
            'equipoEdit.nombre' =>'required|min:3|max:30|'
        ],[
            'equipoEdit.inventario.required' => 'El nombre del analsisi es requerido',
            'equipoEdit.inventario.min' => 'El nombre debe tener minimo 3 caracteres',
            'equipoEdit.inventario.max' => 'El nombre debe tener maximo 30 caracteres',
            'equipoEdit.inventario.unique' => 'Este numero de inventario pertenece a otro equipo',
            'equipoEdit.nombre.required' => 'El nombre del analsisi es requerido',
            'equipoEdit.nombre.min' => 'El nombre debe tener minimo 3 caracteres',
            'equipoEdit.nombre.max' => 'El nombre debe tener maximo 30 caracteres',

        ]);

        //Actualizar
        equipos::find($this->equipoIdEdit)->update([
            'nombre' => $this->equipoEdit['nombre']
        ]);

        $this->update_new=false;
        $this->reset(['equipoEdit']);

        //Mensaje
        session()->flash('up_msg', 'equipo actualizado correctamente');

    }
    public function cancel_update(){
        $this->update_new=false;
    }

    //---------------Lazy-------------------------------
    public function placeholder()
    {
       return view('livewire.placeholders.skeleton');
    }

    //---------------Render-------------------------------
    public function render()
    {
        $equipos = equipos::where('nombre','LIKE','%' . $this->search . '%')->paginate($this->datos);
        return view('livewire.equipos.table',compact('equipos'));
    }
}
