@extends('layouts.app')
@section('content')
    <div class="conteiner">
        <div class="row">
            <div class="col-10 offset-1">
                
                <form method="POST" action="{{ route('libro.update', $libro)}}">
                    @csrf @method('PATCH')
                    @include('libro._bookForm', [
                        'btnText'=>'Editar Libro',
                        'show'=>'',
                        'edit'=>true
                    ])
                </form>
            </div>
        </div>
    </div>
@endsection