$('.edit').on('click', function () {
    $(this).parent().children('.save').removeAttr('hidden')
    $(this).hide()

    let input_row = $(this).parent().parent().children('td').children('input')
    input_row.each(function () {
        $(this).removeAttr('readonly')
        $(this).addClass('form-control')
        $(this).removeClass('no-input')
    })

    let end = input_row[0].value.length // O ponteiro vai para o final da palavra ao editar
    input_row[0].setSelectionRange(end, end)
    input_row[0].focus()

})

$('.delete').on('click', function () {
    // Recupera o id da coluna identificador de tarefa
    let id = $(this).parent().parent().children('th')[0].innerText

    // Mostra o nome da Tarefa no modal de confirmação
    document.getElementById('task_name_for_delete').innerHTML = $(this).parent().parent().children('td').children('input')[0].value

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

// Função de ordenação utilizando o Jquery UI
$(function  () {
    $("#tbody").sortable({
        items: 'tr',
        cursor: 'pointer',
        tolerance: "pointer",
        axis: 'y',
        dropOnEmpty: false,
        containment: "parent",
        start: function (e, ui) {
            ui.item.addClass('table-secondary');
        },
        stop: function (e, ui) {
            let new_ordination = []

            ui.item.removeClass('table-secondary');

            $(this).find("tr").each(function (index) {
                let id = $(this).children('th')[0].innerText

                new_ordination[index] = {
                    id: id, order: index
                }
            });
            axios.post(rootUrl + '/update_order',new_ordination).then()
        },
    });
});

