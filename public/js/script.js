$('.edit').on('click', function () {
    $(this).parent().children('.save').removeAttr('hidden')
    $(this).hide()


    let input_row = $(this).parent().parent().children('td').children('input')
    let end = input_row[0].value.length
    input_row.each(function () {
        $(this).removeAttr('readonly')
        $(this).addClass('form-control')
        $(this).removeClass('no-input')
    })

    input_row[0].setSelectionRange(end, end)
    input_row[0].focus()

})

$('.delete').on('click', function () {
    let id = $(this).parent().parent().children('th')[0].innerText

    document.getElementById('task_name_delete').innerHTML = $(this).parent().parent().children('td').children('input')[0].value
    $('#delete-confirm-modal').modal('show')

    $('#delete-confirm').on('click', function () {
        axios.post(rootUrl + '/destroy/' + id).then((res) => {
            window.location.href = '/'
        })
    })

})

$('.new').on('click', function () {
    $('#new_task_input').removeAttr('hidden')
})

$(function () {
    $('cost').maskMoney({
        decimal: ',', thousands: ',', precision: 2
    });
})

$(function () {
    $("#tbody").sortable({
        items: 'tr', // realiza o sort em todos os tr menos no primeiro
        cursor: 'pointer',
        tolerance: "pointer",
        axis: 'y',
        dropOnEmpty: false,
        containment: "parent",
        start: function (e, ui) {
            ui.item.addClass("selected");
        },
        stop: function (e, ui) {
            ui.item.removeClass("selected");
            let map = []
            $(this).find("tr").each(function (index) {
                let id = $(this).children('th')[0].innerText
                console.log(id)
                map[index] = {
                    id: id, order: index
                }
            });
            axios.post('http://127.0.0.1:8000/update_order',map).then()
        },
    });
});
