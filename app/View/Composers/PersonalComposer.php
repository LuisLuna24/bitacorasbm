<?php

namespace App\View\Composers;

use App\Models\rutas;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PersonalComposer
{

    public $rutas, $flujos;

    public $titulo;

    public function __construct()
    {
        switch (Auth::user()->tipo_usuario_id) {

            case 1:
                $this->rutas = rutas::where('estatus', 1)->where('tipo_usuario', 1)->orderBy('nombre', 'asc')->get();
                break;

            case 2:
                $this->rutas = rutas::where('estatus', 1)->where('tipo_usuario', 3)->orderBy('nombre', 'asc')->get();
                break;

        }
    }



    public function compose(View $view): void
    {
        $view->with('rutas', $this->rutas);
    }
}
