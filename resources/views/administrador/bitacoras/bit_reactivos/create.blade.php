@extends('paneles.personal')
@section('titulo')
    Nueva Bitácora de reactivo
@endsection

@section('content')
    @livewire('administrador.bitacoras.reactivos.create')

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