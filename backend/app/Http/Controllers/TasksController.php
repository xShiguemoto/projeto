<?php

namespace App\Http\Controllers;

use App\Models\SubTasks;
use Illuminate\Http\Request;
use App\Models\Tasks;


class TasksController extends Controller
{

    public function index($user)
    {
        $task = Tasks::where('id_usuario', $user)->orderBy('id', 'desc')->get();

        return response()->json($task);
    }

    public function view(Request $request, $id, $token)
    {
    
        $task = Tasks::where([
            ['id', $id],
            ['token_tarefa', $token]
        ])->first();

        if($task){
            return $task;
        }else{
            return response()->json('error');
        }

    }
    
    public function create(Request $request)
    {
        $callback['status'] = 'error';
        $callback['msg'] = 'Algo ocorreu... Tente novamente em breve ou entre em contato com o suporte.';
    
        function token(){
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            do {
                $token = '';
                for ($i = 0; $i < 8; $i++) {
                    $token .= $characters[rand(0, strlen($characters) - 1)];
                }
                
                $checkToken = Tasks::where("token_tarefa", $token)->first();
            } while ($checkToken);

            return $token;
        }

        $create = Tasks::create([
            'id_usuario' => $request->input('id_usuario'),
            'token_tarefa' => token(),
            'titulo' => $request->input('titulo'),
            'descricao' => $request->input('descricao'),
            'data_vencimento' => $request->input('data_vencimento')
        ]);

        if($create){
            $callback['status'] = 'success';
            $callback['msg'] = 'A tarefa foi criada com sucesso!';
        }

        return response()->json($callback);
    }

    public function update(Request $request, $id)
    {
        $callback['status'] = 'error';
        $callback['msg'] = 'Algo ocorreu... Tente novamente em breve ou entre em contato com o suporte.';

        $update = Tasks::findOrFail($id);

        if($update){
            $update->fill($request->all());
            $update->save();

            $callback['status'] = 'success';
            $callback['msg'] = 'A tarefa foi editada com sucesso!';
        }

        return response()->json($callback);
    }

    public function destroy($id)
    {
        $callback['status'] = 'error';
        $callback['msg'] = 'Algo ocorreu... Tente novamente em breve ou entre em contato com o suporte.';

        $destroy = Tasks::findOrFail($id);

        if($destroy){

            $subdestroy = SubTasks::where("id_tarefa", $id);

            if($subdestroy){
                $subdestroy->delete();
            }

            $destroy->delete();

            $callback['status'] = 'success';
            $callback['msg'] = 'A tarefa foi deletada com sucesso!';
        }

        return response()->json($callback);
    }

    public function filter(Request $request, $type)
    {
        $callback['status'] = 'error';
        $dataAtual = date('Y-m-d');
        
        if($type == 1){
            $filter = Tasks::where("data_vencimento", "=", $dataAtual)->get();
        }else if($type == 2){
            $filter = Tasks::where("data_vencimento", "<", $dataAtual)->get();
        }else{
            $filter = Tasks::orderBy('id', 'desc')->get();
        }
 
        if(!$filter->isEmpty()){
            $callback['filter'] = $filter;
            $callback['status'] = 'success';
        }else{
            $callback['msg'] = "Não existe nenhuma tarefa foi encontra.";
        }
        
        return response()->json($callback);
    }
}