<?php

namespace App\Livewire\Administrador\Registros;

use App\Models\empleado;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy()]
class Empledos extends Component
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
    public $nombre = '',$razon_cambio='';
    public $tipeForm; // 1 = Crear, 2 = Editar
    public $nom_ante='',$version;

    public function newRegister(){
        //redirigir
        return redirect()->route('admin.empleados.create');
    }
    public function editRegister($id)
    {
        //redirigir a editar
        return redirect()->route('admin.empleados.edit', $id);
    }

    //&================================================================Estatus

    public $statusModal = false;
    public $statusId;
    public $estatusModal;

    public function statusRegister($id)
    {
        // Optimización: Usar una única consulta para asignar directamente el estado
        $this->statusId = $id;
        $this->estatusModal = empleado::where('id', $id)->value('estatus');
        $this->statusModal = true;
    }

    public function statusUpdate()
    {
        // Optimización: Usar el método `update()` para evitar cargar completamente el modelo
        empleado::where('id', $this->statusId)->update([
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
        $collection = empleado::query();

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
            $collection->where('nombre', 'like', '%' . $this->search . '%')->orWhere('no_empleado', 'like', '%' . $this->search . '%');
        }
        return view('livewire.administrador.registros.empledos',[
            'collection' => $collection->orderBy('created_at', 'desc')->paginate($this->pageView, pageName: 'collections'),
        ]);
    }
}
