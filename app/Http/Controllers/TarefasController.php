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
        $validate_name_null = Tarefa::where([['nome_da_tarefa','']])->get();

        if ($validate_name==$validate_name_null){
            $data['custo'] = $this->regex_number($data['custo']);

            if (Tarefa::first() == null) {
                $data += ['ordem_de_apresentacao' => 0];
            } else {
                $last_order_number = Tarefa::orderByDesc('ordem_de_apresentacao')->first()['ordem_de_apresentacao'];
                $data += ['ordem_de_apresentacao' => $last_order_number + 1];
            }


            $task = Tarefa::create($data);

            return redirect('/')->with('success', 'Tarefa Criada com sucesso');
        }else{
            return redirect('/')->with('error', 'Tarefa '.$data['nome_da_tarefa'].' Ja Existe');
        }

    }

    public function update(Request $request, Tarefa $task)
    {
        $data = $request->all();

        $validate_name = Tarefa::where([['nome_da_tarefa',$data['nome_da_tarefa']]])->get();
        $validate_name_null = Tarefa::where([['nome_da_tarefa','']])->get();

        if($validate_name==$validate_name_null){
            $data['custo'] = $this->regex_number($data['custo']);

            $task->update($data);

            return redirect('/')->with('success', 'Tarefa Atualizada com Sucesso');
        }elseif ($validate_name[0]['id']==$task['id']){
            $data['custo'] = $this->regex_number($data['custo']);

            $task->update($data);

            return redirect('/')->with('success', 'Tarefa Atualizada com Sucesso');
        }else{
            return redirect('/')->with('error', 'Tarefa '.$data['nome_da_tarefa'].' Ja Existe');
        }


    }

    public function update_order(Request $request, Tarefa $task)
    {
        $new_ordinances = $request->all();

        // Altera o campo "ordem de apresentacao" com números aleatórios
        // para evitar que um número se repita ao alterar a ordem
        foreach (Tarefa::all() as $task){
            $task['ordem_de_apresentacao'] = rand(1,10)*rand(-100,-1);
            $task->update();
        }

        foreach ($new_ordinances as $new_ordination){
            if($new_ordination['id']!=null){
                $task = Tarefa::find($new_ordination['id']);
                $task->ordem_de_apresentacao = $new_ordination['order'];
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
        // aplicação de regex para evitar que o usuário envie ao banco letras
        // e virgula como separador de decimal no campo "Custo"
        $new_number = preg_replace('/[^0-9.,]/i', '', $number);
        $new_number = preg_replace('/,/i', '.', $new_number);

        if($new_number==''){
            return 0;
        }else{
            return $new_number;
        }
    }
}
