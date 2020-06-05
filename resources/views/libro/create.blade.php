@extends('layouts.app')
@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-10 offset-1">
            <h1 class="text-center">Agregar un Libro</h1>
            <br>
            <form method="POST" action="{{ route('libro.store')}}">
                @csrf
                @include('libro._bookForm', ['btnText'=>'Cargar Libro','show'=>''])
            </form>
        </div>
    </div>
</div>
@endsection