@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-10 offset-1">


            <div class="card">
                <div class="card-header text-lg-right">
                    @include('partials._buttons', [
                    'show' => 'd-none',
                    'edit'=>'',
                    'delete'=>''
                    ])
                </div>
                <div class="card-body">
                    <h1 class="card-title">{{$libro->title}}</h1>
                    <h5 class="card-subtitle mb-2 text-muted">
                        <span class="badge badge-pill badge-info text-white" title="cantidad disponible">Disponibles
                            {{$libro->count}}</span>
                    </h5>
                    <p class="card-text lead">
                        {{$libro->description}}
                    </p>
                    @include('isbn._createForm',['show'=>'d-none','edit'=>false])

                </div>
            </div>
        </div>
    </div>
</div>
@endsection