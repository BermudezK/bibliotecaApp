function addRow() {
    $("#isbnTable tbody").append(

        `
        <tr> 
            <td>
                <input type="text" class="form-control" name="isbn[]"/>
            </td>
            <td>
                <button type="button" class="btn btn-danger" onclick="rowDelete(this)">x</button>
            </td>
            
        </tr>
        `
    );
}

function rowDelete(ctl) {
    $(ctl).parents("tr").remove();
}