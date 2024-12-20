<?php

namespace App\Livewire\Administrador\Bitacoras\Pcr;

use App\Models\analises;
use App\Models\equipos;
use App\Models\especies;
use App\Models\pcr;
use App\Models\pcr_especies;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;


#[Lazy()]
class Edit extends Component
{

    #[Reactive]
    public $idPcr;

    public $noRegistro;

    //&=================================================================Paginate
    use WithPagination;

    //&=================================================================Bariables
    //^=================================Step 1: Datos de bitacora
    public $analises = [];
    public $analisis = '', $sanitizo = '', $tiempouv = '', $no_registro, $agaroza, $tiempo, $voltaje;

    //^=================================Step 2: Datos de muestra

    public $list_sub = [], $listName = [];

    public $especies = [];

    public $especie = '', $resultado = '';

    //^=================================Step 3: Equipos

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

        $data = pcr::find($this->idPcr);

        $this->noRegistro = $this->no_registro = $data->no_registro ?? null;
        $this->analisis = $data->id_analisis ?? null;
        $this->sanitizo = $data->sanitizo ?? null;
        $this->tiempouv = $data->tiempouv ?? null;
        $this->agaroza = $data->agaroza ?? null;
        $this->tiempo = $data->tiempo ?? null;
        $this->voltaje = $data->voltaje ?? null;

        //^=================================Step 2: Datos de muestras

        $this->especies = especies::where('estatus', 1)->get();

        $especiesSelect = pcr_especies::where('id_pcr', $this->idPcr)->get();

        foreach ($especiesSelect as $especie) {
            $this->list_sub[] = [
                'especie' => $especie->id_especie,
                'resultado' => $especie->resultado
            ];
        }

        $listas = collect($this->list_sub);

        $this->listName = $listas->map(function ($item) {
            return [
                'especie_nomb' => especies::find($item['especie'])->nombre ?? 'sin especie',
                'resultado_nomb' => $item['resultado'] == 1 ? "Positivo" : ($item['resultado'] == 2 ? "Negativo" : "Sin especificar")
            ];
        });

        //^=================================Step 3: Datos de equipos

        $this->selectedTagsEquipo = $data->equipos->pluck('id')->toArray();
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
                    'no_registro' => 'required|min:3|max:50|unique:pcrs,no_registro,' . $this->idPcr . ',id',
                    'analisis' => 'required',
                    'sanitizo' => 'required',
                    'tiempouv' => 'required',
                    'agaroza' => 'required|max:50',
                    'tiempo' => 'required|max:50',
                    'voltaje' => 'required|max:50',
                ]);

                break;

            case 2:

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

    //&====================================================================================== Editar

    public function register()
    {

        try {

            $data = pcr::find($this->idPcr);

            $data->no_registro = $this->no_registro;
            $data->id_analisis = $this->analisis;
            $data->sanitizo = $this->sanitizo;
            $data->tiempouv = $this->tiempouv;
            $data->agaroza = $this->agaroza;
            $data->tiempo = $this->tiempo;
            $data->voltaje = $this->voltaje;

            $data->save();

            $data->equipos()->sync($this->selectedTagsEquipo);

            pcr_especies::where('id_pcr', $this->idPcr)->delete();

            foreach ($this->list_sub as $sub) {
                $data->especies()->attach($sub['especie'], ['resultado' => $sub['resultado']]);
            }

            DB::commit();

            $this->totalSteps = 4;

            $this->currentStep = 1;

            session()->flash('blue', 'Registro actualizado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            //dd($e->getMessage());
            abort(500);
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

    public function render()
    {

        $especiesSelect = pcr_especies::where('id_pcr', $this->idPcr)->get();
        $equipos = equipos::where('estatus', 1)->paginate(10, pageName: 'equipos-page');

        return view('livewire.administrador.bitacoras.pcr.edit', [
            'especiesSelect' => $especiesSelect,
            'equipos' => $equipos
        ]);
    }
}
