@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-10 offset-1">
        <div class="text-center">

            <h1>Libros de nuestro catalogo</h1>
        </div>

        @if (auth()->check())
        @if (auth()->user()->hasRoles(['admin']))
        <div class="text-right">

            <a class="btn btn-outline-primary rounded-pill m-3 pl-2" title="Agregar Libro"
                href="{{ route('libro.create') }}">
                <svg class="bi bi-plus" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M8 3.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5H4a.5.5 0 0 1 0-1h3.5V4a.5.5 0 0 1 .5-.5z" />
                    <path fill-rule="evenodd" d="M7.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0V8z" />
                </svg>
                Agregar Libro
            </a>
        </div>
        @endif
        @endif
    </div>
</div>

<div class="row">
    <div class="col-8 offset-2">
        <table class="table table-hover">
            <thead class=" text-center">
                <tr>
                    <th>Titulo</th>
                    <th>cantidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($libros as $libro )

                <tr class="text-center">
                    <td>
                        {{ $libro->title}}
                    </td>
                    <td>
                        {{ $libro->count}}
                    </td>

                    <td>
                        @include('partials._buttons', [
                        'show' => '',
                        'edit'=>'',
                        'delete'=>''
                        ])
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$libros->links()}}

    </div>
</div>

@endsection