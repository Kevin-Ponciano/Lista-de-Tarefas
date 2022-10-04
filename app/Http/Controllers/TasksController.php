<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function create()
    {
    }

    public function store(Request $request)
    {

        $request = $request->all();
        debug($request);
        $task = Task::create($request);

        $task = Task::all();
//        return response()->json($task);
        return route('index',['task' => $task]);
    }


    public function show(Task $task)
    {
    }

    public function edit(Task $task)
    {
    }

    public function update(Request $request, Task $task)
    {
    }

    public function destroy(Task $task)
    {
        debug('deletado');
    }
}
