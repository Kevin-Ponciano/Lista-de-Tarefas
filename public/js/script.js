$('.edit').on('click', function () {
    const input_row = $(this).parent().parent().children('td').children('input')
    const end = input_row[0].value.length
    input_row.each(function () {
        $(this).removeAttr('readonly')
        $(this).addClass('form-control')
        $(this).removeClass('no-input')
    })

    input_row[0].setSelectionRange(end, end)
    input_row[0].focus()


    $(this).next().on('click', () => {
        sendData('/store')
    })

    const form = $(this).parent().parent().children('form')

    console.log(form[0].name.value)


    sendData = (url) => {
        const formData = new FormData(form[0])

        // Axios envia informações via url
        axios.post(rootUrl + url, formData).then(// Se der certo, o modal será fechado e a informação enviada
            (res) => {
                console.log('POST ENVIADO')
            }).catch(// Caso um erro for encontrado será imprimido no console
            error => {
                if (error.response) {
                    console.log(error.response.data)
                }
            })
    }

})



// document.getElementById('btnRemove').addEventListener('click', () => {
//     sendData('/store')
// })



