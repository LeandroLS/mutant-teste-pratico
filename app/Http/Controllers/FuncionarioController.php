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
            return response()->json('Funcionário não encontrado.', 404);
        } else {
            return $funcionario;
        }
    }

    public function store(Request $request){
        try {
            Funcionario::create($request->all());
            return response()->json("Funcionário salvo", 201);
        } catch (\Throwable $th) {
            return response()->json('Não foi possível criar o funcionário.', 400);
        }
    }

    public function update(Request $request, $id){
        try {
            $funcionario = Funcionario::find($id);
            $funcionario->update($request->all());
            return response()->json('Funcionário atualizado.', 200);
        } catch (\Throwable $th) {
             return response()->json('Não foi possível atualizar o funcionário.', 400);
        }
    }

    public function destroy($id){
        $funcionario = Funcionario::find($id);
        if(!$funcionario){
            return response()->json('Funcionário não encontrado.', 404);
        } else {
            $funcionario->delete();
            return response()->json('Funcionário excluído.', 200);
        }
    }
}
