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
    public $nivelUsuario='1';
    public $search='';

    //---------------Abrir tabla----------------------------------

    public $open_users = false;

    public function user()
    {
        $this->open_users = true;
    }

    //---------------Create----------------------------------
    public $create_users=false;
    public $name,$email,$password;
    public $password_confirmation;

    public function create_user(){
        $this->create_users=true;
    }

    public function create(){
        
        $this->validate([
            'name' =>'required',
            'email' =>'required|email|unique:users',
            'password' =>'required|min:8|confirmed',
        ],[
            'name.required' => 'El nombre es requerido',
            'email.required' => 'El email es requerido',
            'email.email' => 'El email no es valido',
            'email.unique' => 'Este email ya esta registrado',
            'password.required' => 'La contraseña es requerida',
            'password.min' => 'La contraseña debe tener minimo 8 caracteres',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'password_confirmation.required' => 'La confirmacion de la contraseña es requerida',
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' =>  bcrypt($this->password)
        ]);

        $this->create_users=false;
        $this->reset(['name','email','password','password_confirmation']);
        session()->flash('msg', 'Usuario creado correctamente');
    }

    public function cancel_new(){
        $this->create_users=false;
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

    public function cancel_edit(){
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

    //---------------Recuperar  Contraseña--------------------------------

    public $recover_user=false;
    public $userPassId;
    public $userPass = [
        'password' => '',
        'password_confirmation' => '',
    ];

    public function update_password(){
        $this->recover_user=true;
        $this->userPassId = $this->userEditId;
    }

    public function recover_pass(){
        $this->validate([
            'userPass.password' =>'required|min:8|confirmed',
        ],[
            'userPass.password.required' => 'La contraseña es requerida',
            'userPass.password.min' => 'La contraseña debe tener minimo 8 caracteres',
            'userPass.password.confirmed' => 'Las contraseñas no coinciden',
            'userPass.password_confirmation.required' => 'La confirmacion de la contraseña es requerida',
        ]);
        User::find($this->userPassId)->update([
            'password' =>  bcrypt($this->userPass['password']),
        ]);

        $this->recover_user=false;
        $this->edit_user=false;
        $this->reset(['userPass']);

        //Mensaje
        session()->flash('up_msg', 'Contraseña actualizada correctamente');

    }

    public function cancel_recover(){
        $this->recover_user=false;
    }

    //---------------Activar Usuario-------------------------------

    public $active_new=false;
    public $userActiveId;
    public $userActive = [
        'name' => '',
    ];

    public function activeUser($id){
        $this->active_new=true;
        $this->userActiveId = $id;
        $user = User::find($id);
        $this->userActive = [
            'name' => $user->name,
        ];
    }

    public function up_user(){

        User::find($this->userActiveId)->update([
            'nivel' => 1,
        ]);

        $this->active_new=false;
        $this->reset(['userActive']);

        //Mensaje
        session()->flash('up_msg', 'El usuario a sido activado correctamente');
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

        $usuarios = User::where('nivel', $this->nivelUsuario)->where(function ($query) {$query->where('email', 'LIKE', '%' . $this->search . '%')->orWhere('name', 'LIKE', '%' . $this->search . '%');})->paginate($this->datos);     
        return view('livewire.config.usuarios', compact('usuarios'));
    }
}
