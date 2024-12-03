@extends('paneles.personal')
@section('titulo')
    Principal
@endsection

@section('content')
    <div class="font-semibold text-lg text-black dark:text-gray-200 leading-tight  text-end mb-3">
        <h2>¡Hola, {{ Auth::user()->name }}!</h2>
    </div>
@endsection
