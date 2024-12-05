<?php

namespace App\Livewire\Administrador\Bitacoras;

use App\Models\bit_reactivos;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy()]
class Reactivos extends Component
{
    //&================================================================Paginacion
    use WithPagination;
    //&================================================================Filtros
    public $estatus;
    public $search;
    public $pageView = 10;

    //&================================================================Submit
    
    public function newRegister(){
        return redirect()->route('admin.bit_reactivos.create');
    }


    //&================================================================Estatus
    public $statusModal = false;
    public $statusId;
    public $estatusModal;

    public function statusRegister($id)
    {
        // Optimización: Usar una única consulta para asignar directamente el estado
        $this->statusId = $id;
        $this->estatusModal = bit_reactivos::where('id', $id)->value('estatus');
        $this->statusModal = true;
    }

    public function statusUpdate()
    {
        // Optimización: Usar el método `update()` para evitar cargar completamente el modelo
        bit_reactivos::where('id', $this->statusId)->update([
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

    //&================================================================= Lazy Load
    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }
    //&================================================================Render
    public function render()
    {
        $collection = bit_reactivos::query();

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

        return view('livewire.administrador.bitacoras.reactivos', [
            'collection' => $collection->orderBy('created_at', 'desc')->paginate($this->pageView, pageName: 'collections'),
        ]);
    }
}
