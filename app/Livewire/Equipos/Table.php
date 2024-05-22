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
    public $estate='Activo';

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
            'inventario.required' => 'El numero de inventario es requerido',
            'inventario.min' => 'El numero de inventario debe tener minimo 3 caracteres',
            'inventario.max' => 'El numero de inventario debe tener maximo 30 caracteres',
            'inventario.unique' => 'Este numero de inventario pertenece a otro equipo',
            'nombre.required' => 'El nombre del equipo es requerido',
            'nombre.min' => 'El nombre del equipo debe tener minimo 3 caracteres',
            'nombre.max' => 'El nombre del equipo debe tener maximo 30 caracteres',

        ]);

        equipos::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'inventario' => 'GISENA-'.$this->inventario,
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
            'equipoEdit.inventario.required' => 'El numero de inventario es requerido',
            'equipoEdit.inventario.min' => 'El numero de inventario debe tener minimo 3 caracteres',
            'equipoEdit.inventario.max' => 'El numero de inventario debe tener maximo 30 caracteres',
            'equipoEdit.inventario.unique' => 'Este numero de inventario pertenece a otro equipo',
            'equipoEdit.nombre.required' => 'El nombre del equipo es requerido',
            'equipoEdit.nombre.min' => 'El nombre del equipo debe tener minimo 3 caracteres',
            'equipoEdit.nombre.max' => 'El nombre del equipo debe tener maximo 30 caracteres',

        ]);

        //Actualizar
        equipos::find($this->equipoIdEdit)->update([
            'nombre' => $this->equipoEdit['nombre'],
            'descripcion' => $this->equipoEdit['descripcion'],
            'inventario' => $this->equipoEdit['inventario']
        ]);

        $this->update_new=false;
        $this->reset(['equipoEdit']);

        //Mensaje
        session()->flash('up_msg', 'Equipo actualizado correctamente');

    }
    public function cancel_update(){
        $this->update_new=false;
    }
    //---------------Eliminar--------------------------------
    public $down_new=false;
    public $equipoIdDown;
    public $equipoDown=[
        'nombre' => '',
        'inventario' => ''
    ];

    public function down($equipoId){
        $this->down_new=true;
        $this->equipoIdDown = $equipoId;
        $equipo = equipos::find($equipoId);
        $this->equipoDown = [
            'nombre' => $equipo->nombre,
            'inventario' => $equipo->inventario,
        ];
    }

    public function down_reg(){
        //Cambiar estado a rearacion
        equipos::find($this->equipoIdDown)->update([
            'estado' => 'Baja'
        ]);

        $this->down_new=false;
        $this->reset(['equipoDown']);

        //Mensaje
        session()->flash('down_msg', 'El equipo a sido dado de baja correctamente');
    }

    public function down_rep(){
        //Cambiar estado a rearacion
        equipos::find($this->equipoIdDown)->update([
            'estado' => 'Reparacion'
        ]);

        $this->down_new=false;
        $this->reset(['equipoDown']);

        //Mensaje
        session()->flash('down_msg', 'El estado del equipo cambio correctamente');
    }

    public function cancel_down(){
        $this->down_new=false;
    }

    //---------------activar--------------------------------
    public $active_new=false;
    public $equipoIdActive;
    public $equipoActive=[
        'nombre' => '',
        'inventario' => ''
    ];

    public function active($equipoId){
        $this->active_new=true;
        $this->equipoIdActive = $equipoId;
        $equipo = equipos::find($equipoId);
        $this->equipoActive = [
            'nombre' => $equipo->nombre,
            'inventario' => $equipo->inventario,
        ];
    }

    public function active_reg(){
        //Cambiar estado a rearacion
        equipos::find($this->equipoIdActive)->update([
            'estado' => 'Activo'
        ]);

        $this->active_new=false;
        $this->reset(['equipoActive']);

        //Mensaje
        session()->flash('up_msg', 'Equipo activado correctamente');
    }

    public function cancel_active(){
        $this->active_new=false;
    }

    


    
    //---------------Lazy-------------------------------
    public function placeholder()
    {
       return view('livewire.placeholders.skeleton');
    }

    //---------------Render-------------------------------
    public function render()
    {
        $equipos = equipos::where('nombre','LIKE','%' . $this->search . '%')->where('estado','=',$this->estate) ->paginate($this->datos);
        return view('livewire.equipos.table',compact('equipos'));
    }
}
