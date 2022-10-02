<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Tarefas</title>
    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="{{asset('css/bootstrap/bootstrap.css')}}">
    <!--Bootstrap Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

</head>
<style>
    body {
        background-color: #f3f4f6;
    }

    .center {
        margin: auto;
        width: 50%;
    }
    .no-input {
        border-top-style: hidden;
        border-right-style: hidden;
        border-left-style: hidden;
        border-bottom-style: groove;
        background-color: transparent;
        border-width: 0;
    }

    .no-outline:focus {
        outline: none;
    }
</style>
<body>
<div class="d-flex align-items-center justify-content-center p-5">
    <h2>LISTA DE TAREFAS</h2>
</div>
<div class="center">
    <div class="table-responsive border border-2 border-light rounded-3 shadow-lg">
        <table class="table table-light mb-0 px-4">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Custo (R$)</th>
                <th scope="col">Data Limite</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">1</th>
                <form id="task_form" action="">
                {!! csrf_field() !!}

                <td>
                    <input id="name_task" name="name" type="text" class="no-outline no-input" value="Kevin" readonly>
                </td>
                <td>
                    <input id="cost_task" name="cost" type="number" class="no-outline no-input" value="0" readonly>
                </td>
                <td>
                    <input id="deadline_task" name="deadline" type="date" class="no-outline no-input" value="2022-01-01" readonly>
                </td>
                </form>
                <td>
                    <button id="btnChange" type="button" class="btn btn-light py-0 px-0" onclick="ok()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="blue" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-edit">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg>
                    </button>
                    <button id="btnRemove" class="btn btn-light py-0 px-0 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-x-circle">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="15" y1="9" x2="9" y2="15"></line>
                            <line x1="9" y1="9" x2="15" y2="15"></line>
                        </svg>
                    </button>
                </td>
            </tr>
{{--            <tr>--}}
{{--                <th scope="row"></th>--}}
{{--                <td></td>--}}
{{--                <td></td>--}}
{{--                <td></td>--}}
{{--                <td>--}}
{{--                    <button class="btn btn-light py-0 px-0 rounded">--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"--}}
{{--                             stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"--}}
{{--                             class="feather feather-plus-circle">--}}
{{--                            <circle cx="12" cy="12" r="10"></circle>--}}
{{--                            <line x1="12" y1="8" x2="12" y2="16"></line>--}}
{{--                            <line x1="8" y1="12" x2="16" y2="12"></line>--}}
{{--                        </svg>--}}
{{--                    </button>--}}
{{--                </td>--}}
{{--            </tr>--}}

            </tbody>
        </table>

    </div>
    <br>
    <div class="d-flex align-items-center justify-content-center">
        <button type="button" class="btn btn-success rounded p-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="feather feather-plus-circle">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="8" x2="12" y2="16"></line>
                <line x1="8" y1="12" x2="16" y2="12"></line>
            </svg>
            Nova Tarefa
        </button>
    </div>

</div>
<!--Axios-->
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<!--Bootstrap JS-->
<scrpt src="{{asset('js/bootstrap/bootstrap.bundle.js')}}"></scrpt>
<!--JS-->
<script type="text/javascript">
    let rootUrl = {!! json_encode(url('/')) !!}
</script>
<script src="{{asset('js/script.js')}}"></script>
</body>
</html>
