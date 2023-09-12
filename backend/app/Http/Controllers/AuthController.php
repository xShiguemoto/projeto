<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Members;

class AuthController extends Controller
{

    public function auth(Request $request)
    {
        $callback['status'] = 'error';
        $callback['msg'] = 'Algo ocorreu... Tente novamente em breve ou entre em contato com o suporte.';

        $callback['authenticated'] = false;

        $auth = Members::where("email", $request->input('email'))->first();

        if(!$auth){
            $callback['msg'] = 'Seu acesso é invalido.';
        }else{

            if (password_verify($request->input('password'), $auth->passwrd)) {
                $callback['status'] = 'success';
                $callback['msg'] = 'Seu acesso foi autorizado.';
                $callback['authenticated'] = true;
                $callback['user'] = $auth->id;
            } else {
                $callback['msg'] = 'Seu acesso é inválido.';
            }
        }

        return response()->json($callback);
    }

    public function create(Request $request)
    {
        $callback['status'] = 'error';
        $callback['msg'] = 'Algo ocorreu... Tente novamente em breve ou entre em contato com o suporte.';

        $password = password_hash($request->input("password"), PASSWORD_DEFAULT);

        $createCheck = Members::where("email", $request->input('email'))->first();
        
        if($createCheck){
            $callback['msg'] = 'E-mail já cadastrado.';
        }else{
            if(strlen($request->input("password")) < 8){
                $callback['msg'] = 'Sua senha é muito curta. Coloque uma senha com 8 ou mais caracteres.';
            }else{
                $create = Members::create([
                    'nome' => $request->input('username'),
                    'email' => $request->input('email'),
                    'passwrd' => $password,
                ]);

                if($create){
                    $callback['status'] = 'success';
                    $callback['msg'] = 'A conta foi criada com sucesso!';
                }
            }
        }

        return response()->json($callback);
    }

}
