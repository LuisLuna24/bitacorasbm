<?php

namespace App\Livewire\Metodos;

use App\Models\metodos;
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
            'nombre' =>'required|min:3|max:30|unique:metodos',
        ],[
            'nombre.required' => 'El nombre del metodo es requerido',
            'nombre.min' => 'El nombre del metodo debe tener minimo 3 caracteres',
            'nombre.max' => 'El nombre del metodo debe tener maximo 30 caracteres',
            'nombre.unique' => 'Este metodo ya a sido registrado',
        ]);

        metodos::create([
            'nombre' => $this->nombre,
            'user_id' => auth()->user()->id,
        ]);
        
        $this->create_new=false;
        $this->reset(['nombre']);
        session()->flash('add_msg', 'Metodo agregado correctamente');
    }

    public function cancel_new(){
        $this->create_new=false;
    }

    //---------------Verciones----------------------------------
    public $version_view=false;
    public $VersionMetodoId;
    

    public function vercion($versionId){
        $this->version_view=true;
        $this->VersionMetodoId = $versionId;

        

    }

    //---------------Actualizar--------------------------------
    public $update_new=false;
    public $metodoIdEdit;
    public $metodoEdit=[
        'nombre' => ''
    ];

    public function edit($metodoId){
        $this->update_new=true;
        $this->metodoIdEdit = $metodoId;
        $metodo = metodos::find($metodoId);
        $this->metodoEdit = [
            'nombre' => $metodo->nombre
        ];
    }

    public function update(){
        //Validaciones
        $this->validate([
            'metodoEdit.nombre' =>'required|min:3|max:30|unique:metodos,nombre,'.$this->metodoIdEdit,
        ],[
            'metodoEdit.nombre.required' => 'El nombre del metodo es requerido',
            'metodoEdit.nombre.min' => 'El nombre del metodo debe tener minimo 3 caracteres',
            'metodoEdit.nombre.max' => 'El nombre del metodo debe tener maximo 30 caracteres',
            'metodoEdit.nombre.unique' => 'Este metodo ya a sido registrado',
        ]);

        //Actualizar
        metodos::find($this->metodoIdEdit)->update([
            'nombre' => $this->metodoEdit['nombre']
        ]);

        $this->update_new=false;
        $this->reset(['metodoEdit']);

        //Mensaje
        session()->flash('up_msg', 'Metodo actualizado correctamente');

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
        $metodos = metodos::where('nombre','LIKE','%' . $this->search . '%')->paginate($this->datos);
        return view('livewire.metodos.table',compact('metodos'));
    }
}
