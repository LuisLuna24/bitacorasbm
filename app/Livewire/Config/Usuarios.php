<?php

namespace App\Livewire\Config;

use App\Models\User;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy()]
class Usuarios extends Component
{
    //---------------paginacion-------------------------------
    use WithPagination;

    //---------------Filtros----------------------------------
    public $datos = 10;

    public $open_users = false;

    public function user()
    {
        $this->open_users = true;
    }

    //---------------Edit Users--------------------------------
    public $edit_user=false;
    public $userEditId;
    public $userEdit = [
        'name' => '',
        'email' => '',
        'nivel' => '',
    ];

    public function editUser($id){
        $this->edit_user=true;
        $this->userEditId = $id;
        $user = User::find($id);
        $this->userEdit = [
            'name' => $user->name,
            'email' => $user->email,
            'nivel' => $user->nivel,
        ];
    }

    public function updateUser(){
        User::find($this->userEditId)->update([
            'name' => $this->userEdit['name'],
            'email' => $this->userEdit['email'],
            'nivel' => $this->userEdit['nivel'],
        ]);

        $this->edit_user=false;
        $this->reset(['userEdit']);
        session()->flash('up_msg', 'Usuario actualizado correctamente');
    }

    public function cancel_user(){
        $this->edit_user=false;
    }


    //---------------Delete Users--------------------------------
    public $delete_user=false;
    public $userDleteId;
    public $userDelete = [
        'name' => '',
    ];

    public function deleteUser($id){
        $this->delete_user=true;
        $this->userDleteId = $id;
        $user = User::find($id);
        $this->userDelete = [
            'name' => $user->name,
        ];
    }

    public function down_user(){
        
        User::find($this->userDleteId)->update([
            'nivel' => 0,
        ]);

        $this->delete_user=false;
        $this->reset(['userDelete']);

        //Mensaje
        session()->flash('down_msg', 'El equipo a sido dado de baja correctamente');
    }




    //---------------Lazy-------------------------------
    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }

    //---------------Render-------------------------------
    public function render()
    {
        $usuarios = User::where('nivel', '=', '1')->paginate($this->datos);
        return view('livewire.config.usuarios', compact('usuarios'));
    }
}
