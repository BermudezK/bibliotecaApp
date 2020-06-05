@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-2 mt-3">
            <form method="POST" action="{{ route('borrow.store')}}">
                @csrf
                <div class="text-center">
                    <h1>Datos del Libro a Solicitar

                        <button class="btn btn-info rounded-pill d-in ">Solicitar Libro</button>
                    </h1>
                </div>
                <hr>
                <div class="card-body">
                    <h1 class="card-title">{{$libro->title}}</h1>
                    <h5 class="card-subtitle mb-2 text-muted">
                        <input type="hidden" name="isbn" value="{{$isbn->id}}">
                        <input type="hidden" name="user" value="{{auth()->user()->id}}">
                        <input type="hidden" name="libro" value="{{$libro->id}}">

                        <span class="badge badge-pill badge-danger text-white" title="cantidad disponible">
                            Isbn {{$isbn->isbn}}
                        </span>
                    </h5>
                    <p class="card-text lead">
                        {{$libro->description}}
                    </p>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection