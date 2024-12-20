<?php

namespace App\Livewire\Administrador\Inventarios;

use App\Models\equipos as ModelsEquipos;
use App\Models\version_equipos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy()]
class Equipos extends Component
{
    //&================================================================Paginacion
    use WithPagination;

    //&================================================================Filtros
    public $search = '';
    public $pageView = 10;
    public $estatus;

    public function resetSerch(){
        $this->search = '';
        $this->resetPage();
    }

    //&================================================================Crear
    public $modal = false;
    public $idRegister = null;
    public $nombre = '', $descripcion = '', $razon_cambio = '', $no_inventario = '';
    public $tipeForm; // 1 = Crear, 2 = Editar
    public $nom_ante = '', $des_ante = '', $no_inventario_anterior, $version;

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
        $equipos = ModelsEquipos::findOrFail($id);

        $this->no_inventario = $equipos->no_inventario;
        $this->nombre = $equipos->nombre;
        $this->descripcion = $equipos->descripcion;



        $this->tipeForm = 2;
        $this->modal = true;
        $this->nom_ante = $equipos->nombre;
        $this->version = $equipos->version + 1;
        $this->des_ante = $equipos->descripcion;
        $this->no_inventario_anterior = $equipos->no_inventario;
    }

    /**
     * Envía el formulario para crear o actualizar un registro.
     */
    public function submitForm()
    {
        DB::beginTransaction();
        try {
            $this->validate([
                'nombre' => 'required|max:100|unique:equipos,nombre' . ($this->tipeForm === 2 ? ',' . $this->idRegister . ',id' : ''),
                'descripcion' => 'required|max:250|',
                'no_inventario' => 'required',
            ]);

            if ($this->tipeForm === 1) {
                ModelsEquipos::create(['nombre' => $this->nombre, 'descripcion' => $this->descripcion, 'no_inventario' => $this->no_inventario]);
                session()->flash('green', 'Agregada correctamente');
            } elseif ($this->tipeForm === 2) {
                $this->validate(['razon_cambio' => 'required|max:250']);
                ModelsEquipos::findOrFail($this->idRegister)->update(['nombre' => $this->nombre, 'descripcion' => $this->descripcion, 'version' => $this->version]);
                version_equipos::create([
                    'no_inventario' => $this->no_inventario,
                    'no_inventario_anterior' => $this->no_inventario_anterior,
                    'nombre' => $this->nombre,
                    'nombre_anterior' => $this->nom_ante,
                    'descripcion' => $this->descripcion,
                    'descripcion_anterior' => $this->des_ante,
                    'id_equipo' => $this->idRegister,
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
        $this->descripcion = '';
        $this->razon_cambio = '';
        $this->no_inventario = '';
        $this->nom_ante = '';
        $this->des_ante = '';
        $this->no_inventario_anterior = '';
        $this->tipeForm = null;
        $this->nom_ante = '';
        $this->razon_cambio = '';
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
        $this->estatusModal = ModelsEquipos::where('id', $id)->value('estatus');
        $this->statusModal = true;
    }

    public function statusUpdate()
    {
        // Optimización: Usar el método `update()` para evitar cargar completamente el modelo
        ModelsEquipos::where('id', $this->statusId)->update([
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

    public $vercionModal = false;
    public $idVersion = '';
    public function vercionRegister($id)
    {
        $this->idVersion = $id;
        $this->vercionModal = true;
        $this->resetPage(pageName: 'versiones-page');
    }
    public function closeVersionModal()
    {
        $this->vercionModal = false;
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
        $collection = ModelsEquipos::query();

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

        $verciones = version_equipos::query();

        return view('livewire.administrador.inventarios.equipos', [
            'collection' => $collection->orderBy('created_at', 'desc')->paginate($this->pageView, pageName: 'collections'),
            'versiones' => $verciones->where('id_equipo', $this->idVersion)->orderBy('created_at', 'desc')->paginate(5, ['*'], 'versiones-page'),
        ]);
    }
}
