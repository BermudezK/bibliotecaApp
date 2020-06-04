<div class="form-row">
    <div class="col mb-3">
        <label for="validationTitle">Titulo</label>
    <input type="text" class="form-control" id="validationTitle" placeholder="Ingrese el titulo del libro..." name="title" value="{{old('Titulo', $libro->title)}}">
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col mb-3">
        <label for="validationTitle">Descripcion</label>
        <textarea type="text" class="form-control" rows="10" id="validationDescription" placeholder="Ingrese una descripcion breve del libro" name="description"
            required>{{old('Descripcion...', $libro->description)}}</textarea>
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-6 mb-3">
        <label for="validationTitle">Cantidad</label>
        <input type="text" class="form-control" id="validationTitle" placeholder="Ingrese la cantidad de libros..." name="count" required value="{{old('Cantidad...', $libro->count)}}">
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
</div>
<div class="text-center">
    <button class="btn btn-outline-primary rounded-pill mb-3">{{$btnText}}</button>
</div>