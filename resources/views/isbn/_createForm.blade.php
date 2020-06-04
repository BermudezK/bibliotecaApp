<table class="table table-hover" id="isbnTable" name="">
    <thead>
        <tr>
            <th scope="col">ISBN</th>
        </tr>
    </thead>
    <tbody id="isbnTable-tBody">
        @if (count($isbn)>0)
        @foreach ($isbn as $item)
        <tr>
            <td>
                <input type="text" class="form-control" name="isbn[]" value="{{$item->isbn }}" readonly>
            </td>
        </tr>
        @endforeach

        @endif
    </tbody>
</table>

<input type="button" value="agregar" id="addrow" onclick="addRow()">