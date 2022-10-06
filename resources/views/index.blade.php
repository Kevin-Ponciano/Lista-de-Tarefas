<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Tarefas</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--JQUERY-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--JQUERY UI-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">

    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="{{asset('css/bootstrap/bootstrap.css')}}">
    <!--Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>

    <!--Style CSS-->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>

<body>

<div class="d-flex align-items-center justify-content-center p-3">
    <h2>LISTA DE TAREFAS</h2>
</div>
<div class="center">
    <div class="table-responsive border border-2 border-light rounded-3 shadow-lg">
        <table id="table" class="table table-light mb-0 px-4">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Custo (R$)</th>
                <th scope="col">Data Limite</th>
                <th scope="col"></th>

            </tr>
            </thead>
            <tbody id="tbody">
            @if (session('success'))
                <div class="alert alert-success d-flex align-items-center justify-content-center">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('task'))
                <div class="alert alert-danger align-content-center d-flex align-items-center justify-content-center">
                    {{ session('task') }}
                </div>
            @endif
            @foreach($tasks as $task)
                <tr @if($task->cost >= 1000) class="table-danger" @endif>
                    <form action="/update/{{$task->id}}" method='post'>
                        {!! csrf_field() !!}
                        <th scope="row">{{$task->id}}</th>
                        <td>

                            <input name="name" type="text" class="no-outline no-input"
                                   value="{{$task->name}}" required readonly>
                        </td>
                        <td>
                            <input name="cost" type="text" class="no-outline no-input"
                                   value="{{$task->cost}}" required readonly>
                        </td>
                        <td>
                            <input name="deadline" type="date" class="no-outline no-input"
                                   value="{{$task->deadline}}" required readonly>
                        </td>

                        <td class="table-light">
                            <button type="submit" class="save btn btn-light py-0 px-0 position-relative"
                                    data-title="Salvar"
                                    hidden>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                     class="feather feather-save">
                                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                    <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                    <polyline points="7 3 7 8 15 8"></polyline>
                                </svg>
                            </button>

                            <button type="button" class="edit btn btn-light py-0 px-0 position-relative"
                                    data-title="Editar">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="blue" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                     class="feather feather-edit">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                            </button>

                            <button type="button" class="delete btn btn-light py-0 px-0 position-relative"
                                    data-title="Excluir">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                     class="feather feather-x-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="15" y1="9" x2="9" y2="15"></line>
                                    <line x1="9" y1="9" x2="15" y2="15"></line>
                                </svg>
                            </button>
                        </td>
                    </form>
                </tr>
            @endforeach
            <tr id="new_task_input" hidden>
                <form action="/store" method='post'>
                    {!! csrf_field() !!}
                    <th scope="row"></th>
                    <td>
                        <input name="name" type="text" class="no-outline form-control" required>
                    </td>
                    <td>
                        <input name="cost" type="text" class="no-outline form-control" required>
                    </td>
                    <td>
                        <input name="deadline" type="date" class="no-outline form-control" required>
                    </td>

                    <td>
                        <button class="save btn btn-light py-0 px-0 position-relative" data-title="Salvar">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-save">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                <polyline points="7 3 7 8 15 8"></polyline>
                            </svg>
                        </button>
                </form>
            </tr>
            </tbody>
        </table>

    </div>
    <br>
    <div class="d-flex align-items-center justify-content-center">
        <button type="button" class="new btn btn-success rounded p-2">
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

    <div class="modal fade py-5" id="delete-confirm-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header py-1">
                    <b>Confirmação de Exclusão</b>
                </div>
                <div class="modal-body">
                    <p>Deseja excluir a tarefa <b id="task_name_delete"></b>?</p>
                </div>
                <div class="modal-footer py-1">
                    <button id="delete-confirm" type="button" class="btn btn-danger">Excluir</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
                </div>
            </div>
        </div>
    </div>


</div>
<!--Axios-->
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<!--JS-->
<script type="text/javascript">
    const rootUrl = {!! json_encode(url('/')) !!}
</script>
<script src="{{asset('js/script.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"
</script>

</body>
</html>
