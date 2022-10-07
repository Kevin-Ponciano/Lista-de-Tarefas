<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;

class TarefasController extends Controller
{
    public function index()
    {
        $tasks = Tarefa::all()->sortBy('ordem_de_apresentacao');


        return view('index', ['tasks' => $tasks]);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validate_name = Tarefa::where([['nome_da_tarefa',$data['nome_da_tarefa']]])->get();
        $validate_name2 = Tarefa::where([['nome_da_tarefa','']])->get();
        if ($validate_name==$validate_name2){
            $data['custo'] = $this->regex_number($data['ordem_de_apresentacao']);
            $last_order_number = Tarefa::orderByDesc('ordem_de_apresentacao')->first()['ordem_de_apresentacao'];


            if (Tarefa::first() == null) {
                $data += ['ordem_de_apresentacao' => 0];
            } else {
                $data += ['ordem_de_apresentacao' => $last_order_number + 1];
            }


            $task = Tarefa::create($data);

            return redirect('/')->with('success', 'Tarefa Criada com sucesso');
        }else{
            return redirect('/')->with('task', 'Tarefa '.$data['nome_da_tarefa'].' Ja Existe');
        }

    }

    public function update(Request $request, Tarefa $task)
    {
        $data = $request->all();
        $validate_name = Tarefa::where([['nome_da_tarefa',$data['nome_da_tarefa']]])->get();
        $validate_name2 = Tarefa::where([['nome_da_tarefa','']])->get();

        if($validate_name==$validate_name2){
            $data['custo'] = $this->regex_number($data['custo']);

            $task->update($data);

            return redirect('/')->with('success', 'Tarefa Atualizada com Sucesso');
        }elseif ($validate_name[0]['identificador_da_tarefa']==$task['identificador_da_tarefa']){
            $data['custo'] = $this->regex_number($data['custo']);

            $task->update($data);
            return redirect('/')->with('success', 'Tarefa Atualizada com Sucesso');
        }else{
            return redirect('/')->with('task', 'Tarefa '.$data['nome_da_tarefa'].' Ja Existe');
        }


    }

    public function update_order(Request $request, Tarefa $task)
    {
        $maps = $request->all();
//
        foreach ($maps as $map){
            if($map['id']!=null){
                $task = Tarefa::find($map['id']);
                $task->ordem_de_apresentacao = $map['ordem_de_apresentacao'];
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
