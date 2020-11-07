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

    public function store(Request $request){
        try {
            Funcionario::create($request->all());
            return response('Funcionário salvo.', 201);
        } catch (\Throwable $th) {
            return response('Não foi possível salvar o funcionário.', 400);
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
            return response('Funcionário excluído.', 200);
        }
    }
}
