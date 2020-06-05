@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1>
                {{ auth()->user()->name}}
            </h1>

        </div>
    </div>




    <div class="row">
        <div class="col-8 offset-2">
            <table class="table table-hover">
                <thead class=" text-center">
                    <tr>
                        <th>Isbn</th>
                        <th>Titulo</th>
                        @if (auth()->user()->hasRoles(['admin']))

                        <th>Usuario</th>
                        <th>Acciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($borrows as $borrow )
                    <tr class="text-center">
                        <td>
                            {{ $borrow->isbn}}
                        </td>
                        <td>
                            {{ $borrow->title}}
                        </td>
                        @if (auth()->user()->hasRoles(['admin']))
                        <td>{{$borrow->name}}</td>
                        <td>
                            @include('borrow._buttonDestroy')
                        </td>
                        @endif

                    </tr>

                    @empty
                    <tr>
                        <td colspan="3">
                            No hay prestamos pendientes
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{$borrows->links() }}

        </div>
    </div>
</div>

@endsection