$('.edit').on('click', function () {
    $(this).next().removeAttr('hidden')
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


    // $(this).next().on('click', () => {
    //     sendData('/store')
    // })
    const form = $(this).parent().parent().children('form')
    const formData = new FormData(form[0])

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
     $(this).next().on('click',()=>{
       $.ajax({
           url: "/store",
           type: 'post',
           dataType: 'json',
           data: formData,
           processData: false,
           contentType: false,
           success: (res)=>{
               document.getElementById('l').innerText = 'sucesso'
               console.log(res)
           },

       })
     })



    sendData = (url) => {
        const formData = new FormData(form[0])

        // Axios envia informações via url
        axios.post(rootUrl + url, formData).then(// Se der certo, o modal será fechado e a informação enviada
            (res) => {
                console.log('POST ENVIADO')
                console.log(res.data)
                location.reload()
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



