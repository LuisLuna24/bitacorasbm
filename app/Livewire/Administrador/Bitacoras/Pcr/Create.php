<?php

namespace App\Livewire\Administrador\Bitacoras\Pcr;

use App\Models\analises;
use App\Models\equipos;
use App\Models\especies;
use App\Models\pcr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy()]
class Create extends Component
{
    //&=================================================================Paginate
    use WithPagination;

    //&=================================================================Bariables
    //^=================================Step 1: Datos de bitacora
    public $analises = [];
    public $analisis = '', $sanitizo = '', $tiempouv = '', $no_registro, $agaroza, $tiempo, $voltaje;

    //^=================================Step 2: Datos de muestra

    public $especies = [];

    public $especie = '', $resultado = '';

    //^=================================Step 2: Datos de muestra

    public $selectedTagsEquipo = [];



    //&=================================================================Steps
    #[Locked]
    public $totalSteps;
    public $currentStep;
    public $porsentaje;

    public $titles = [
        '1' => 'Datos de la bitacora',
        '2' => 'Especies',
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

        //^=================================Step 2: Datos de muestras

        $this->especies = especies::where('estatus', 1)->get();

        //^=================================Step 3: Datos de equipos


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
                    'no_registro' => 'required|min:3|max:50|unique:pcrs,no_registro',
                    'analisis' => 'required',
                    'sanitizo' => 'required',
                    'tiempouv' => 'required',
                    'agaroza' => 'required|max:50',
                    'tiempo' => 'required|max:50',
                    'voltaje' => 'required|max:50',
                ]);

                break;

            case 2:

                $this->validate([
                    'list_sub' => "required"
                ], [
                    'list_sub.required' => 'Debe agregar al menos una especie'
                ]);
                break;

            case 3:
                $this->validate([
                    'selectedTagsEquipo' => "required"
                ], [
                    'selectedTagsEquipo.required' => 'Debe agregar al menos un equipo'
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

    //&====================================================================================== Agregar Especie
    public $list_sub = [], $listName = [];
    public function addSubcategory()  //^Agregar subcategorias a un array
    {

        $exist = false;
        foreach ($this->list_sub as $sub) {
            if ($this->especie == $sub['especie']) {
                $exist = true;
            }
        }

        //dd($exist);
        if (!$exist) {
            //agregar regra
            $this->validate([
                'especie' => 'required',
                'resultado' => 'required'
            ]);
            $nuevoRegistro = [
                'especie' => $this->especie,
                'resultado' => $this->resultado
            ];

            $this->list_sub[] = $nuevoRegistro;

            $listas = collect($this->list_sub);

            $this->listName = $listas->map(function ($item) {
                return [
                    'especie_nomb' => especies::find($item['especie'])->nombre ?? 'sin especie',
                    'resultado_nomb' => $item['resultado'] == 1 ? "Positivo" : ($item['resultado'] == 2 ? "Negativo" : "Sin especificar")
                ];
            });

            //dd($this->list_sub);

            $this->reset('especie', 'resultado');
        } else {
            session()->flash('red', 'Esta especie ya fue agregaada');
        }
    }

    public function deteSubcategory($index)  //^Eliminar subcategorias del array
    {
        unset($this->list_sub[$index]);
        unset($this->listName[$index]);
    }

    //&=================================================================Nuevo registro
    public function register()
    {
        DB::beginTransaction();
        try {

            $pcr = pcr::create([
                'id_usuario' => Auth::id(),
                'id_analisis' => $this->analisis,
                'no_registro' => $this->no_registro, // corregido de no_rtegistro a no_registro
                'sanitizo' => $this->sanitizo,
                'tiempouv' => $this->tiempouv,
                'agaroza' => $this->agaroza, // corregido de agaroza a agaroza
                'tiempo' => $this->tiempo,
                'voltaje' => $this->voltaje,
                'version' => 1,
            ]);

            foreach ($this->list_sub as $sub) {
                $pcr->especies()->attach($sub['especie'], ['resultado' => $sub['resultado']]);
            }

            $pcr->equipos()->sync($this->selectedTagsEquipo);

            DB::commit();

            $this->reset();

            $this->currentStep = 1;

            $this->totalSteps = 4;

            session()->flash('green', 'Agregado correctamente.');
        } catch (\Exception $e) {
            DB::rollback();
            abort(500);
            //dd($e->getMessage());
        }
    }

    //&=================================================================Cancelar registro

    public function cancelRegister()
    {
        return redirect()->route('admin.bitacoras.pcr');
    }

    //&=================================================================Lazy Load
    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }

    //&=================================================================Render
    public function render()
    {
        $equipos = equipos::where('estatus', 1)->paginate(10, pageName: 'equipos-page');

        return view('livewire.administrador.bitacoras.pcr.create', compact('equipos'));
    }
}
