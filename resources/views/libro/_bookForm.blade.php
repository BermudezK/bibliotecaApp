<div class="form-row">
    <div class="col mb-3">
        <label for="title">Titulo</label>
        <input type="text" class="form-control" placeholder="Ingrese el titulo del libro..." name="title"
            value="{{old('Titulo', $libro->title)}}">
            @if ($errors->has('title'))
             <label class="text-danger" for="title">Debe completar el campo Titulo</label>
            @endif
    </div>
</div>
<div class="form-row">
    <div class="col mb-3">
        <label for="description">Descripcion</label>
        <textarea type="text" class="form-control" rows="10" placeholder="Ingrese una descripcion breve del libro"
            name="description">{{old('Descripcion...', $libro->description)}}</textarea>
            @if ($errors->has('title'))
            <label class="text-danger" for="description">Debe completar el campo Descripcion</label>
           @endif
    </div>
</div>

@include('isbn._createForm',[
'show'=>$show
])

<div class="text-center">
    <button class="btn btn-primary rounded-pill mb-3">{{$btnText}}</button>
</div>