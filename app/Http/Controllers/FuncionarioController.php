<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
class FuncionarioController extends Controller
{
    public function index(){
        return Funcionario::all();
    }

    public function show($id){
        $funcionario = Funcionario::find($id);
        if(!$funcionario){
            return response('Funcionário não encontrado.', 404);
        } else {
            return $funcionario;
        }
    }

    public function update(){
        
    }

    public function destroy($id){
        $funcionario = Funcionario::find($id);
        if(!$funcionario){
            return response('Funcionário não encontrado.', 404);
        } else {
            $funcionario->delete();
            return response('Funcionário excluído.', 204);
        }
    }
}
