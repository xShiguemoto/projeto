<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubTasks;


class SubTasksController extends Controller
{

    public function index(Request $request)
    {
        
        return SubTasks::orderBy('id', 'desc')->get();
    }

    public function create(Request $request)
    {
        $callback['status'] = 'error';
        $callback['msg'] = 'Algo ocorreu... Tente novamente em breve ou entre em contato com o suporte.';

        $create = SubTasks::create($request->all());

        if($create){
            $callback['status'] = 'success';
            $callback['msg'] = 'A subtarefa foi criada com sucesso!';
        }

        return response()->json($callback);

    }

    public function update(Request $request, $id)
    {

        $callback['status'] = 'error';
        $callback['msg'] = 'Algo ocorreu... Tente novamente em breve ou entre em contato com o suporte.';

        $update = SubTasks::findOrFail($id);
        
        if($update){
            $update->fill($request->all());
            $update->save();

            $callback['status'] = 'success';
            $callback['msg'] = 'A subtarefa foi editada com sucesso!';
        }
        

        return response()->json($callback);
    }

    public function destroy($id)
    {
        $callback['status'] = 'error';
        $callback['msg'] = 'Algo ocorreu... Tente novamente em breve ou entre em contato com o suporte.';

        $destroy = SubTasks::findOrFail($id);

        if($destroy){
            $destroy->delete();
            
            $callback['status'] = 'success';
            $callback['msg'] = 'A tarefa foi deletada com sucesso!';
        }
        
        return response()->json($callback);
    }
}
