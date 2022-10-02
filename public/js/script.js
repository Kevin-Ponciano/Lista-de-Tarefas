ok = () => {
    const name_task = document.getElementById('name_task')
    const cost_task = document.getElementById('cost_task')
    const deadline_task = document.getElementById('deadline_task')
    const end = name_task.value.length

    cost_task.removeAttribute('readonly')
    name_task.removeAttribute('readonly')
    deadline_task.removeAttribute('readonly')

    name_task.classList.add('form-control')
    name_task.classList.remove('no-input')

    cost_task.classList.add('form-control')
    cost_task.classList.remove('no-input')

    deadline_task.classList.add('form-control')
    deadline_task.classList.remove('no-input')



    name_task.setSelectionRange(end, end);
    name_task.focus();
    console.log('ok')
}

const form = document.querySelector('#task_form')

document.getElementById('btnRemove').addEventListener('click', () => {
    sendData('/store')
})

sendData = (url) => {
    const formData = new FormData(form)

    // Axios envia informações via url
    axios.post(rootUrl + url, formData).then(// Se der certo, o modal será fechado e a informação enviada
        (res) => {
            console.log('Post Enviado')
        }).catch(// Caso um erro for encontrado será imprimido no console
        error => {
            if (error.response) {
                console.log(error.response.data)
            }
        })
}
