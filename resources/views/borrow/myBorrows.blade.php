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
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($borrows as $borrow )
                    <tr class="text-center">
                        <td></td>
                        <td>
                            {{ $borrow->isbn}}
                        </td>
                        <td>
                            {{ $borrow->title}}
                        </td>

                        <td>
                            @include('borrow._buttonDestroy')
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$borrows->links() }}

        </div>
    </div>
</div>

@endsection