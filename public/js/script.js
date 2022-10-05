$('.edit').on('click', function () {
    $(this).parent().children('.save').removeAttr('hidden')
    $(this).hide()


    const input_row = $(this).parent().parent().children('td').children('input')
    const end = input_row[0].value.length
    input_row.each(function () {
        $(this).removeAttr('readonly')
        $(this).addClass('form-control')
        $(this).removeClass('no-input')
    })

    input_row[0].setSelectionRange(end, end)
    input_row[0].focus()

})

$('.delete').on('click', function () {
    const id = $(this).parent().parent().children('th')[0].innerText
    axios.post(rootUrl + '/destroy/' + id).then((res) => {
        window.location.href = '/'
    })
})

$('.new').on('click', function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/", type: 'get', success: () => {
            $(this).hide()
            const tbody = document.getElementById('tbody')
            const tr = tbody.children[tbody.length - 1]
            let new_input_field = document.createElement('tr')
            new_input_field.setAttribute('id', 'new_input_field')
            tbody.insertBefore(new_input_field, tr)

            $('#new_input_field').html(
                "<form id='new_task_form' action='/store' method='post'>"
                + "<th scope='row'></th>"
                + "<td><input name='name' type='text' class='no-outline form-control'></td>"
                + "<td><input name='cost' type='number' class='no-outline form-control'></td>"
                + "<td><input name='deadline' type='date' class='no-outline form-control'></td>"
                + "<td><button type='submit' onclick='sub()' class='save btn btn-light py-0 px-0 position-relative' data-title='Salvar'>"
                + "<svg xmlns='http://www.w3.org/2000/svg' width='25' height='25' viewBox='0 0 24 24' fill='none'"
                + " stroke='green' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'"
                + " class='feather feather-save'>"
                + "<path d='M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z'></path>"
                + "<polyline points='17 21 17 13 7 13 7 21'></polyline><polyline points='7 3 7 8 15 8'></polyline>"
                + "</svg></button></td></form>")

        },

    })

})
sub=()=>{
    $('#new_task_form').submit()
}
