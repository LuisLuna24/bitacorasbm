<?php

namespace App\Livewire\Administrador\Catalogos;

use App\Models\especies as ModelsEspecies;
use App\Models\version_especies;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy()]
class Especies extends Component
{
    //&================================================================Paginacion
    use WithPagination;

    //&================================================================Filtros
    public $search = '';
    public $pageView = 10;
    public $estatus;


    //&================================================================Crear
    public $modal = false;
    public $idRegister = null;
    public $nombre = '',$razon_cambio='';
    public $tipeForm; // 1 = Crear, 2 = Editar
    public $nom_ante='',$version;

    public function newRegister()
    {
        $this->resetForm();
        $this->tipeForm = 1;
        $this->modal = true;
    }
    public function editRegister($id)
    {
        $this->resetForm();

        $this->idRegister = $id;
        $analisis = ModelsEspecies::findOrFail($id);

        $this->nombre = $analisis->nombre;
        $this->tipeForm = 2;
        $this->modal = true;
        $this->nom_ante=$analisis->nombre;
        $this->version=$analisis->version+1;
    }

    /**
     * Envía el formulario para crear o actualizar un registro.
     */
    public function submitForm()
    {
        DB::beginTransaction();
        try {
            $this->validate([
                'nombre' => 'required|max:50|unique:especies,nombre' . ($this->tipeForm === 2 ? ',' . $this->idRegister . ',id' : ''),
            ]);

            if ($this->tipeForm === 1) {
                ModelsEspecies::create(['nombre' => $this->nombre]);
                session()->flash('green', 'Agregada correctamente');
            } elseif ($this->tipeForm === 2) {
                $this->validate(['razon_cambio'=>'required|max:250']);
                ModelsEspecies::findOrFail($this->idRegister)->update(['nombre' => $this->nombre,'version' => $this->version]);
                version_especies::create([
                    'nombre' => $this->nombre,
                    'nombre_anterior' => $this->nom_ante,
                    'id_especie' => $this->idRegister,
                    'razon_cambio' => $this->razon_cambio,
                    'id_usuario' => Auth::id(),
                ]);
                session()->flash('blue', 'Editado correctamente');
            }

            $this->modal = false;
            $this->resetForm();

            DB::commit();
        } catch (\Exception $e) {
            abort(500);
            //dd($e);
            DB::rollback();
        }
    }

    /**
     * Resetea los valores del formulario.
     */
    private function resetForm()
    {
        $this->idRegister = null;
        $this->nombre = '';
        $this->tipeForm = null;
        $this->nom_ante='';
        $this->razon_cambio='';
    }

    public function closeModal()
    {
        $this->modal = false;
        $this->reset(['nombre']);
    }

    //&================================================================Estatus

    public $statusModal = false;
    public $statusId;
    public $estatusModal;

    public function statusRegister($id)
    {
        // Optimización: Usar una única consulta para asignar directamente el estado
        $this->statusId = $id;
        $this->estatusModal = ModelsEspecies::where('id', $id)->value('estatus');
        $this->statusModal = true;
    }

    public function statusUpdate()
    {
        // Optimización: Usar el método `update()` para evitar cargar completamente el modelo
        ModelsEspecies::where('id', $this->statusId)->update([
            'estatus' => $this->estatusModal == '1' ? '0' : '1'
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

    //&================================================================= Verciones

    public $vercionModal=false;
    public $idVersion='';
    public function vercionRegister($id){
        $this->idVersion=$id;
        $this->vercionModal=true;
        $this->resetPage(pageName: 'versiones-page');
    }
    public function closeVersionModal(){
        $this->vercionModal=false;
        $this->resetPage(pageName: 'versiones-page');
    }

    //&================================================================= Lazy Load
    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }

    //&================================================================Render
    public function render()
    {
        $collection = ModelsEspecies::query();

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
            $collection->where('nombre', 'like', '%' . $this->search . '%');
        }

        $verciones = version_especies::query();

        return view('livewire.administrador.catalogos.especies', [
            'collection' => $collection->orderBy('created_at', 'desc')->paginate($this->pageView, pageName: 'collections'),
            'versiones' => $verciones->where('id_especie', $this->idVersion)->orderBy('created_at', 'desc')->paginate(5, ['*'], 'versiones-page'),
        ]);
    }
}
