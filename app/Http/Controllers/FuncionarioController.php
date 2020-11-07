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
        // return $funcionario = Funcionario::find($id);
    }

    public function update(){
        
    }

    public function destroy(){

    }
}
