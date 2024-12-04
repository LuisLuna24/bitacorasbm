<?php

namespace App\Livewire\Administrador\Inventarios;

use App\Models\reactivos as ModelsReactivos;
use App\Models\version_reactivos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy()]
class Reactivos extends Component
{
    //&================================================================Paginacion
    use WithPagination;

    //&================================================================Filtros
    public $search = '';
    public $pageView = 10;
    public $estatus;

    public function resetSerch()
    {
        $this->search = '';
        $this->resetPage();
    }

    //&================================================================Crear
    public $modal = false;
    public $idRegister = null;
    public $nombre, $descripcion, $razon_cambio, $lote,$stock,$caducidad;
    public $tipeForm; // 1 = Crear, 2 = Editar
    public $nom_ante, $des_ante, $lote_anterior,$stock_anterior,$caducidad_anterior, $version;

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
        $analisis = ModelsReactivos::findOrFail($id);

        $this->nombre = $analisis->nombre;
        $this->descripcion = $analisis->descripcion;
        $this->lote = $analisis->lote;
        $this->stock = $analisis->stock;
        $this->caducidad = $analisis->caducidad;

        $this->tipeForm = 2;
        $this->modal = true;
        $this->nom_ante = $analisis->nombre;
        $this->version = $analisis->version + 1;
        $this->des_ante = $analisis->descripcion;
        $this->lote_anterior = $analisis->lote;
        $this->stock_anterior = $analisis->stock;
        $this->caducidad_anterior = $analisis->caducidad;
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
                'lote' => 'required',
                'caducidad' => 'required|date',
                'stock' => 'required|integer',
            ]);

            if ($this->tipeForm === 1) {
                ModelsReactivos::create([
                    'lote' => $this->lote,
                    'nombre' => $this->nombre,
                    'stock' => $this->stock,
                    'caducidad' => $this->caducidad,
                    'descripcion' => $this->descripcion,
                ]);
                session()->flash('green', 'Agregada correctamente');
            } elseif ($this->tipeForm === 2) {
                $this->validate(['razon_cambio' => 'required|max:250']);
                ModelsReactivos::findOrFail($this->idRegister)->update([
                    'nombre' => $this->nombre, 
                    'descripcion' => $this->descripcion, 
                    'version' => $this->version,
                    'lote' => $this->lote,
                    'caducidad' => $this->caducidad,
                    'stock' => $this->stock,
                ]);
                version_reactivos::create([
                    'id_reactivo' => $this->idRegister,
                    'lote' => $this->lote,
                    'lote_anterior' => $this->lote_anterior,
                    'nombre' => $this->nombre,
                    'nombre_anterior' => $this->nom_ante,
                    'descripcion' => $this->des_ante,
                    'descripcion_anterior' => $this->descripcion,
                    'caducidad' => $this->caducidad,
                    'caducidad_anterior' => $this->caducidad_anterior,
                    'stock' => $this->stock,
                    'stock_anterior' => $this->stock_anterior,
                    'razon_cambio' => $this->razon_cambio,
                    'id_usuario' => Auth::id(),
                ]);
                session()->flash('blue', 'Editado correctamente');
            }

            $this->modal = false;
            $this->resetForm();

            DB::commit();
        } catch (\Exception $e) {
            //abort(500);
            dd($e);
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
        $this->lote = '';
        $this->caducidad = '';
        $this->stock = '';
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
        $this->estatusModal = ModelsReactivos::where('id', $id)->value('estatus');
        $this->statusModal = true;
    }

    public function statusUpdate()
    {
        // Optimización: Usar el método `update()` para evitar cargar completamente el modelo
        ModelsReactivos::where('id', $this->statusId)->update([
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
        $collection = ModelsReactivos::query();

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

        $verciones = version_reactivos::query();

        return view('livewire.administrador.inventarios.reactivos', [
            'collection' => $collection->orderBy('created_at', 'desc')->paginate($this->pageView, pageName: 'collections'),
            'versiones' => $verciones->where('id_reactivo', $this->idVersion)->orderBy('created_at', 'desc')->paginate(5, ['*'], 'versiones-page'),
        ]);
    }
}
