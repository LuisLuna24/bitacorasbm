@extends('paneles.personal')
@section('titulo')
    Editar Empleado
@endsection

@section('content')
    @livewire('administrador.registros.empledos.edit',[
        'id' => $id
    ])

    <script src="{{ asset('js/mayusculas.js') }}"></script>

    <style>
        /* Para Chrome, Safari, Edge, Opera */
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Para Firefox */
        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
@endsection