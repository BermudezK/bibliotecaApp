@if (auth()->check())

<table class="table table-hover" id="isbnTable" name="">
    @if ($errors->has('isbn'))
    <label class="text-danger" for="description">Debe Cargar al menos un Isbn en la lista</label>
    @endif
    <thead>
        <tr class="text-center">
            <th scope="col">ISBN</th>
            @if (count($isbn)>0)
            <th scope="col">Acciones</th>
            @endif
        </tr>
    </thead>
    <tbody id="isbnTable-tBody">
        @if (count($isbn)>0)
        @foreach ($isbn as $isbnItem)
        <tr>
            <td>
                <input type="text" class="form-control" name="isbn[]" value="{{$isbnItem->isbn }}" readonly>
            </td>
            <td class="text-center">
                @include('borrow._buttonAction',[$libro, $isbnItem])
            </td>
        </tr>
        @endforeach

        @endif
    </tbody>
</table>
@if (auth()->user()->hasRoles(['admin']))
<input class="btn btn-outline-success rounded-pill {{ $show }}" type="button" value="agregar" id="addrow"
    onclick="addRow()">
@endif
@endif