<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;

class TarefasController extends Controller
{
    public function index()
    {
        $tarefas = Tarefa::all()->sortBy('order');


        return view('index', ['tasks' => $tarefas]);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validate_name = Tarefa::where([['name',$data['name']]])->get();
        $validate_name2 = Tarefa::where([['name','']])->get();
        if ($validate_name==$validate_name2){
            $data['cost'] = $this->regex_number($data['cost']);
            $last_order_number = Tarefa::orderByDesc('order')->first()['order'];


            if (Tarefa::first() == null) {
                $data += ['order' => 0];
            } else {
                $data += ['order' => $last_order_number + 1];
            }


            $task = Tarefa::create($data);

            return redirect('/')->with('success', 'Tarefa Criada com sucesso');
        }else{
            return redirect('/')->with('task', 'Tarefa '.$data['name'].' Ja Existe');
        }

    }

    public function update(Request $request, Tarefa $task)
    {
        $data = $request->all();
        $validate_name = Tarefa::where([['name',$data['name']]])->get();
        $validate_name2 = Tarefa::where([['name','']])->get();

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

    public function update_order(Request $request, Tarefa $task)
    {
        $maps = $request->all();
//
        foreach ($maps as $map){
            if($map['id']!=null){
                $task = Tarefa::find($map['id']);
                $task->order = $map['order'];
                $task->update();
            }
        }

    }

    public function destroy($id)
    {
        $data = Tarefa::find($id)->delete();

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
