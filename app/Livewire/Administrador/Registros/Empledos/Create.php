<?php

namespace App\Livewire\Administrador\Registros\Empledos;

use App\Models\empleado;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Create extends Component
{

    #[Locked]
    public $totalSteps;
    public $currentStep;
    public $porsentaje;

    public $nombre_usuario, $contraseña, $correo, $contraseña_confirmation;
    public $nombre, $ap_materno, $ap_paterno, $no_empleado;

    public $titles = [
        '1' => 'Datos de inisio de secion',
        '2' => 'Datos del empleado',
        '3' => 'Resumen',
    ];

    public function mount()
    {
        $this->totalSteps = 3;
        $this->currentStep = 1;
        $this->updated_porsentaje();
    }


    public function updated_porsentaje()
    {

        $this->porsentaje =  $this->currentStep * 100 / $this->totalSteps;
    }

    public function validateData()
    {
        switch ($this->currentStep) {

            case 1:
                $this->validate([
                    'nombre_usuario' => 'required|string|max:255',
                    'correo' => 'required|email|unique:users,email',
                    'contraseña' => 'required|min:8|confirmed',
                ]);
                break;

            case 2:
                $this->validate([
                    'nombre' => 'required|string|max:50',
                    'ap_materno' => 'required|string|max:50',
                    'ap_paterno' => 'required|string|max:50',
                    'no_empleado' => 'required|max:50',
                ]);
                break;
        }
    }

    public function increaseStep()
    {

        $this->validateData();

        $this->currentStep++;

        $this->updated_porsentaje();

        if ($this->currentStep > $this->totalSteps) {
            $this->currentStep = $this->totalSteps;
        }
    }

    public function decreaseStep()
    {

        $this->currentStep--;

        $this->updated_porsentaje();

        if ($this->currentStep < 1) {
            $this->currentStep = 1;
        }
    }

    //&=================================================================Nuevo registro
    public function register()
    {
        DB::beginTransaction();
        try {

            $User = User::create([
                'name' => $this->nombre_usuario,
                'email' => $this->correo,
                'password' => Hash::make($this->contraseña),
                'estatus' => 1,
                'tipo_usuario_id' => 2
            ]);


            $empleado = empleado::create([
                'nombre' => $this->nombre,
                'ap_materno' => $this->ap_materno,
                'ap_paterno' => $this->ap_paterno,
                'no_empleado' => $this->no_empleado,
                'estatus' => 1,
                'id_usuario' => $User->id,
            ]);
            
            DB::commit();

            $this->reset();

            $this->currentStep = 1;

            $this->totalSteps = 3;

            session()->flash('green', 'Empleado creado correctamente.');
        } catch (\Exception $e) {
            DB::rollback();
            // abort(500);
            dd($e->getMessage());
        }
    }

    //&=================================================================Cancelar registro

    public function cancelRegister()
    {
        return redirect()->route('admin.registros.empleados');
    }

    public function render()
    {
        return view('livewire.administrador.registros.empledos.create');
    }
}
