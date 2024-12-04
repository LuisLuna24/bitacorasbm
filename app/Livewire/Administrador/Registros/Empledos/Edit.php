<?php

namespace App\Livewire\Administrador\Registros\Empledos;

use App\Models\empleado;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class Edit extends Component
{
    public $nombre_usuario, $contraseña, $correo, $contraseña_confirmation;
    public $nombre, $ap_materno, $ap_paterno, $no_empleado;
    public $idUser;

    #[Reactive]
    public $id;

    public function mount()
    {
        $empleado = empleado::find($this->id);
        $this->nombre_usuario = $empleado->usuario->name;
        $this->correo = $empleado->usuario->email;
        $this->nombre = $empleado->nombre;
        $this->ap_materno = $empleado->ap_materno;
        $this->ap_paterno = $empleado->ap_paterno;
        $this->no_empleado = $empleado->no_empleado;
        $this->idUser = $empleado->usuario->id;
    }

    public function editUser()
    {
        $this->validate([
            'nombre_usuario' => 'required|string|max:50',
            'correo' => 'required|email|unique:users,email,' . $this->idUser . ',id',
        ]);

        DB::beginTransaction();
        try {
            $usuario = User::find($this->idUser);
            $usuario->name = $this->nombre_usuario;
            $usuario->email = $this->correo;
            $usuario->save();
            DB::commit();
            session()->flash('blue', 'El empleado se ha actualizado correctamente.');
            $this->mount();

        } catch (\Exception $e) {
            DB::rollBack();
            abort(500);
            //dd($e);
        }
    }

    public function resetPassword(){
        $this->validate([
            'contraseña' => 'required|min:8|confirmed',
        ]);

        DB::beginTransaction();
        try {
            $usuario = User::find($this->idUser);
            $usuario->password =  bcrypt($this->contraseña);
            $usuario->save();
            DB::commit();
            session()->flash('blue', 'La contraseña del empleado se ha actualizado correctamente.');
            $this->mount();
            $this->reset(['contraseña','contraseña_confirmation']);

        } catch (\Exception $e) {
            DB::rollBack();
            abort(500);
            //dd($e);
        }
    }

    public function editEmpleado(){
        $this->validate([
            'nombre' =>'required|string|max:50',
            'ap_materno' =>'required|string|max:50',
            'ap_paterno' =>'required|string|max:50',
            'no_empleado' =>'required|integer|unique:empleados,no_empleado,'. $this->id,
        ]);

        DB::beginTransaction();
        try{
            $empleado = empleado::find($this->id);
            $empleado->nombre = $this->nombre;
            $empleado->ap_materno = $this->ap_materno;
            $empleado->ap_paterno = $this->ap_paterno;
            $empleado->no_empleado = $this->no_empleado;
            $empleado->save();
            DB::commit();
            session()->flash('blue', 'El empleado se ha actualizado correctamente.');
            $this->mount();
        }catch(\Exception $e){
            DB::rollBack();
            abort(500);
            //dd($e);
        }
    }


    public function render()
    {
        return view('livewire.administrador.registros.empledos.edit');
    }
}
