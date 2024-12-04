<?php

namespace App\Livewire\Administrador\Catalogos;

use App\Models\analises;
use Livewire\Component;
use Livewire\WithPagination;

class Analisis extends Component
{
    //&================================================================Paginacion
    use WithPagination;

    //&================================================================Filtros
    public $search = '';
    public $pageView = 10;
    public $estatus;


    public $modal=false;
    public $nombre;
    public function newRegister(){
        $this->modal = true;
    }

    public function closeModal(){
        $this->modal = false;
        $this->reset(['nombre']);
    }

    public function render()
    {
        $collection = analises::query();

        if ($this->estatus) {
            $collection->where('estatus', $this->estatus);
        }

        // Filtro por nombre
        if ($this->search) {
            $collection->where('nombre', 'like', '%' . $this->search . '%');
        }

        return view('livewire.administrador.catalogos.analisis', [
            'collection' => $collection->orderBy('created_at', 'desc')->paginate($this->pageView),
        ]);
    }
}
