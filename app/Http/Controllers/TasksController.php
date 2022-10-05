<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('index',['tasks' => $tasks]);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {

        $data = $request->all();
        $task = Task::create($data);

        return redirect('/')->with('status', 'Tarefa Criada com sucesso');
    }


    public function show(Task $task)
    {
    }

    public function edit(Task $task)
    {
    }

    public function update(Request $request, Task $task)
    {
        $data = $request->all();
        debug($data);
        $task->update($data);
        debug($task);

        return redirect('/')->with('status', 'Tarefa Atualizada com Sucesso');
    }

    public function destroy($id)
    {
        $data = Task::find($id)->delete();

        session()->flash('status', 'Tarefa Apagada com Sucesso');
    }
}
