<?php

namespace App\Livewire\Especies;

use App\Models\especies;
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
     public $nombre;
 
     Public function new(){
         $this->create_new=true;
     }
 
     public function create(){
         $this->validate([
             'nombre' =>'required|min:3|max:30|unique:especies',
         ],[
             'nombre.required' => 'El nombre del analsisi es requerido',
             'nombre.min' => 'El nombre debe tener minimo 3 caracteres',
             'nombre.max' => 'El nombre debe tener maximo 30 caracteres',
             'nombre.unique' => 'Este especie ya a sido registrado',
         ]);
 
         especies::create([
             'nombre' => $this->nombre,
             'user_id' => auth()->user()->id,
         ]);
         
         $this->create_new=false;
         $this->reset(['nombre']);
         session()->flash('add_msg', 'Especie agregado correctamente');
     }
 
     public function cancel_new(){
         $this->create_new=false;
     }
 
     //---------------Verciones----------------------------------
     public $version_view=false;
     public $VersionEspecieId;
     
 
     public function vercion($versionId){
         $this->version_view=true;
         $this->VersionEspecieId = $versionId;
 
         
 
     }
 
     //---------------Actualizar--------------------------------
     public $update_new=false;
     public $especieIdEdit;
     public $especieEdit=[
         'nombre' => ''
     ];
 
     public function edit($especieId){
         $this->update_new=true;
         $this->especieIdEdit = $especieId;
         $especie = especies::find($especieId);
         $this->especieEdit = [
             'nombre' => $especie->nombre
         ];
     }
 
     public function update(){
         //Validaciones
         $this->validate([
             'especieEdit.nombre' =>'required|min:3|max:30|unique:especies,nombre,'.$this->especieIdEdit,
         ],[
             'especieEdit.nombre.required' => 'El nombre del analsisi es requerido',
             'especieEdit.nombre.min' => 'El nombre debe tener minimo 3 caracteres',
             'especieEdit.nombre.max' => 'El nombre debe tener maximo 30 caracteres',
             'especieEdit.nombre.unique' => 'especie existente',
         ]);
 
         //Actualizar
         especies::find($this->especieIdEdit)->update([
             'nombre' => $this->especieEdit['nombre']
         ]);
 
         $this->update_new=false;
         $this->reset(['especieEdit']);
 
         //Mensaje
         session()->flash('up_msg', 'especie actualizado correctamente');
 
     }
     public function cancel_update(){
         $this->update_new=false;
     }
 
     //---------------Lazy-------------------------------
     public function placeholder()
     {
        return view('livewire.placeholders.skeleton');
     }

    public function render()
    {
        $especies = especies::where('nombre','LIKE','%' . $this->search . '%')->paginate($this->datos);
        return view('livewire.especies.table',compact('especies'));
    }
}
