<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use function Psy\debug;

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
        $task = Task::create($request);
    }

    public function show(Task $task)
    {
    }

    public function edit(Task $task)
    {
        dd('test');
    }

    public function update(Request $request, Task $task)
    {
    }

    public function destroy(Task $task)
    {
        debug('deletado');
    }
}
