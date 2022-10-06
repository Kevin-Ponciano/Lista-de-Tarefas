<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::all()->sortBy('order');


        return view('index', ['tasks' => $tasks]);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validate_name = Task::where([['name',$data['name']]])->get();
        $validate_name2 = Task::where([['name','']])->get();
        if ($validate_name==$validate_name2){
            $data['cost'] = $this->regex_number($data['cost']);
            $last_order_number = Task::orderByDesc('order')->first()['order'];


            if (Task::first() == null) {
                $data += ['order' => 0];
            } else {
                $data += ['order' => $last_order_number + 1];
            }


            $task = Task::create($data);

            return redirect('/')->with('success', 'Tarefa Criada com sucesso');
        }else{
            return redirect('/')->with('task', 'Tarefa '.$data['name'].' Ja Existe');
        }

    }

    public function update(Request $request, Task $task)
    {
        $data = $request->all();
        $validate_name = Task::where([['name',$data['name']]])->get();
        $validate_name2 = Task::where([['name','']])->get();

        if($validate_name==$validate_name2){
            $data['cost'] = $this->regex_number($data['cost']);

            $task->update($data);

            return redirect('/')->with('success', 'Tarefa Atualizada com Sucesso');
        }elseif ($validate_name[0]['id']==$task['id']){
            $data['cost'] = $this->regex_number($data['cost']);

            $task->update($data);
            return redirect('/')->with('success', 'Tarefa Atualizada com Sucesso');
        }else{
            return redirect('/')->with('task', 'Tarefa '.$data['name'].' Ja Existe');
        }


    }

    public function update_order(Request $request, Task $task)
    {
        $maps = $request->all();
//
        foreach ($maps as $map){
            if($map['id']!=null){
                $task = Task::find($map['id']);
                $task->order = $map['order'];
                $task->update();
            }
        }

    }

    public function destroy($id)
    {
        $data = Task::find($id)->delete();

        session()->flash('success', 'Tarefa Apagada com Sucesso');
    }

    public function regex_number($number)
    {
        $new_number = preg_replace('/[^0-9.,]/i', '', $number);
        $new_number = preg_replace('/,/i', '.', $new_number);

        if($new_number==''){
            return 0;
        }else{
            return $new_number;
        }
    }
}
