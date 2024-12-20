<?php

namespace App\Livewire\Administrador\Bitacoras;

use App\Models\pcr as ModelsPcr;
use App\Models\pcr_especies;
use App\Models\pcr_validacions;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Pcr extends Component
{
    //&================================================================Paginacion
    use WithPagination;
    //&================================================================Filtros
    public $estatus;
    public $search;
    public $pageView = 10;

    //&================================================================Submit

    public function newRegister()
    {
        return redirect()->route('admin.pcr.create');
    }


    //&================================================================Estatus
    public $statusModal = false;
    public $statusId;
    public $estatusModal;

    public function statusRegister($id)
    {
        // Optimización: Usar una única consulta para asignar directamente el estado
        $this->statusId = $id;
        $this->estatusModal = ModelsPcr::where('id', $id)->value('estado');
        $this->statusModal = true;
    }

    public function statusUpdate()
    {
        // Optimización: Usar el método `update()` para evitar cargar completamente el modelo
        ModelsPcr::where('id', $this->statusId)->update([
            'estado' => $this->estatusModal == '1' ? '0' : '1'
        ]);

        // Sincronizar el estado actualizado con la variable local
        $this->estatusModal = $this->estatusModal == '1' ? '0' : '1';
        $this->statusModal = false;
        session()->flash('blue', 'Estatus actualizado correctamente');
    }

    public function closeStatusModal()
    {
        $this->statusModal = false;
    }

    //&================================================================= Validacion
    public $validateModal = false;
    public $idValidate;
    public $validacion = '', $observaciones;

    public function validateRegister($id)
    {
        $this->idValidate = $id;
        $this->validateModal = true;
        $validacion = pcr_validacions::where('id_pcr', $id)->first();
        if ($validacion) {
            $this->validacion = $validacion->validacion;
            $this->observaciones = $validacion->observaciones;
        }
    }

    public function validateSubmit()
    {
        $this->validate([
            'validacion' => 'required',
            'observaciones' => 'max:250',
        ]);

        DB::beginTransaction();

        try {
            $record = pcr_validacions::updateOrCreate(
                ['id_pcr' => $this->idValidate],
                [
                    'validacion' => $this->validacion,
                    'observaciones' => $this->observaciones,
                ]
            );

            $color = $record->wasRecentlyCreated ? 'green' : 'blue';
            $message = $record->wasRecentlyCreated
                ? 'Validación registrada correctamente'
                : 'Validación actualizada correctamente';

            DB::commit();

            $this->validateModal = false;
            session()->flash($color, $message);
        } catch (\Exception $e) {
            DB::rollBack();
            //dd($e->getMessage());
            abort(500);
        }
    }

    //&=================================================================Muetras

    public $especiesModal = false;
    public $idEspecie;

    public function especiesRegister($id){
        $this->idEspecie = $id;
        $this->especiesModal = true;
    }

    public function closeEspeciesModal(){
        $this->especiesModal = false;
        $this->idEspecie = '';
    }

    //&================================================================Editar
    public function editRegister($id)
    {
        return redirect()->route('admin.pcr.edit', $id);
    }

    //&================================================================= Lazy Load
    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }
    //&================================================================Render
    public function render()
    {
        $especies = pcr_especies::query();

        if($this->idEspecie != ''){
            $especies->where('id_pcr', $this->idEspecie);
        }

        $collection = ModelsPcr::query();

        if ($this->estatus) {
            switch ($this->estatus) {
                case '1':
                    $collection->where('estatus', '1');
                    break;
                case '2':
                    $collection->where('estatus', '0');
                    break;
            }
        }

        // Filtro por nombre
        if ($this->search) {
            $collection->where('no_registro', 'like', '%' . $this->search . '%');
        }
        return view('livewire.administrador.bitacoras.pcr', [
            'collection' => $collection->orderBy('created_at', 'desc')->paginate($this->pageView, pageName: 'collections-page'),
            'especies' => $especies->paginate(10, pageName: 'especies-page'),
        ]);
    }
}
