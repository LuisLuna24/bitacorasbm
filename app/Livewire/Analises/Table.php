<?php

namespace App\Livewire\Analises;

use App\Models\analises;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy]
class Table extends Component
{
    //^========================================================================Paginacion
    use WithPagination;

    //^========================================================================Filtros

    public $search = '';
    public $datos=10;

    //^========================================================================Nuevo Registro
    //&================================Variables
    public $create_new=false;
    public $nombre;

    //&================================Abrir modal crear
    Public function new(){
        $this->create_new=true;
    }

    //&================================Crear Registro
    public function create(){
        //?===========================================Validaciones
        $this->validate([
            'nombre' =>'required|min:3|max:30|unique:analises',
        ],[
            'nombre.required' => 'El nombre del analsisi es requerido',
            'nombre.min' => 'El nombre del analisis debe tener minimo 3 caracteres',
            'nombre.max' => 'El nombre del analisis debe tener maximo 30 caracteres',
            'nombre.unique' => 'Este analisis ya a sido registrado',
        ]);

        //?===========================================Agregar Regsitro
        analises::create([
            'nombre' => $this->nombre,
            'user_id' => auth()->user()->id,
        ]);
        
        //?===========================================Cerrar modal
        $this->create_new=false;
        //?===========================================Reseteo de campos
        $this->reset(['nombre']);
        //*===========================================Mensaje
        session()->flash('add_msg', 'Analisis agregado correctamente');
    }
    
    //&================================Cerrar Modal Crear

    public function cancel_new(){
        $this->create_new=false;
    }

    //^========================================================================Versiones
    //&================================Variables
    public $version_view=false;
    public $VersionAnalisId;
    
    //&================================Abrir modal versiones
    public function vercion($versionId){
        $this->version_view=true;
        $this->VersionAnalisId = $versionId;
    }

    //&================================Abrir modal Edicion
    public $update_new=false;

    //&================================Variables
    public $analisisIdEdit;
    public $analisisEdit=[
        'nombre' => ''
    ];

    //&================================Editar Registro
    public function edit($analisisId){
        $this->update_new=true;
        $this->analisisIdEdit = $analisisId;
        $analisis = analises::find($analisisId);
        $this->analisisEdit = [
            'nombre' => $analisis->nombre
        ];
    }

    public function update(){
        //Validaciones
        $this->validate([
            'analisisEdit.nombre' =>'required|min:3|max:30|unique:analises,nombre,'.$this->analisisIdEdit,
        ],[
            'analisisEdit.nombre.required' => 'El nombre del analsisi es requerido',
            'analisisEdit.nombre.min' => 'El nombre del analisis debe tener minimo 3 caracteres',
            'analisisEdit.nombre.max' => 'El nombre del analisis debe tener maximo 30 caracteres',
            'analisisEdit.nombre.unique' => 'Analisis existente',
        ]);

        //Actualizar
        analises::find($this->analisisIdEdit)->update([
            'nombre' => $this->analisisEdit['nombre']
        ]);

        $this->update_new=false;
        $this->reset(['analisisEdit']);

        //Mensaje
        session()->flash('up_msg', 'Analisis actualizado correctamente');

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
        $analises = analises::where('nombre','LIKE','%' . $this->search . '%')->paginate($this->datos);
        return view('livewire.analises.table', compact('analises'));
    }
}
