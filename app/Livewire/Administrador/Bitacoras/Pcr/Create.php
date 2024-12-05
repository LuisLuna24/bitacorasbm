<?php

namespace App\Livewire\Administrador\Bitacoras\Pcr;

use App\Models\analises;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Locked;
use Livewire\Component;

#[Lazy()]
class Create extends Component
{
    //&=================================================================Bariables
    //^=================================Step 1: Datos de bitacora
    public $analises = [];
    public $analisis = '', $sanitizo = '', $tiempouv = '', $no_rtegistro, $agaroza, $tiempo, $voltaje;



    //&=================================================================Steps
    #[Locked]
    public $totalSteps;
    public $currentStep;
    public $porsentaje;

    public $titles = [
        '1' => 'Datos de la bitacora',
        '2' => 'Muestras',
        '3' => 'Equipos',
        '4' => 'Resumen',
    ];

    public function mount()
    {
        $this->totalSteps = 4;
        $this->currentStep = 1;
        $this->updated_porsentaje();

        //^=================================Step 1: Datos de bitacora
        $this->analises = analises::where('estatus', 1)->get();
    }


    public function updated_porsentaje()
    {

        $this->porsentaje =  $this->currentStep * 100 / $this->totalSteps;
    }

    public function validateData()
    {
        switch ($this->currentStep) {

            case 1:

                break;

            case 2:

                break;

            case 3:

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


            DB::commit();

            $this->reset();

            $this->currentStep = 1;

            $this->totalSteps = 3;

            session()->flash('green', '.');
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
    //&=================================================================Render
    public function render()
    {
        return view('livewire.administrador.bitacoras.pcr.create');
    }
}
