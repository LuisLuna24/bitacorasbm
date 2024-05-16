<?php

namespace App\Livewire\Analises;

use App\Models\analises;
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
            'nombre' =>'required|min:3|max:30|unique:analises',
        ],[
            'nombre.required' => 'El nombre del analsisi es requerido',
            'nombre.min' => 'El nombre debe tener minimo 3 caracteres',
            'nombre.max' => 'El nombre debe tener maximo 30 caracteres',
            'nombre.unique' => 'Este analisis ya a sido registrado',
        ]);

        analises::create([
            'nombre' => $this->nombre,
            'user_id' => auth()->user()->id,
        ]);
        
        $this->create_new=false;
        $this->reset(['nombre']);
        session()->flash('add_msg', 'Analisis agregado correctamente');
    }

    public function cancel_new(){
        $this->create_new=false;
    }

    //---------------Verciones----------------------------------
    public $version_view=false;
    public $VersionAnalisId;
    

    public function vercion($versionId){
        $this->version_view=true;
        $this->VersionAnalisId = $versionId;

        

    }

    //---------------Actualizar--------------------------------
    public $update_new=false;
    public $analisisIdEdit;
    public $analisisEdit=[
        'nombre' => ''
    ];

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
            'analisisEdit.nombre.min' => 'El nombre debe tener minimo 3 caracteres',
            'analisisEdit.nombre.max' => 'El nombre debe tener maximo 30 caracteres',
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
