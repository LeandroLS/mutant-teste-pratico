<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Funcionario;
class FuncionarioTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_lista_um_funcionario()
    {
        $funcionario = Funcionario::factory()->create();
        $this->get(route('funcionarios.show', ['id' => $funcionario->id]))
        ->assertStatus(200)
        ->assertJsonStructure([ 'nome', 'email', 'data_admissao', 'sexo' ]);
    }

    public function test_lista_todos_funcionarios()
    {
        $this->get(route('funcionarios.index'))
        ->assertStatus(200)
        ->assertJsonStructure(['*' => [ 'nome', 'email', 'data_admissao', 'sexo' ]]);
    }

    public function test_remove_funcionario()
    {
        $funcionario = Funcionario::factory()->create();
        $this->delete(route('funcionarios.destroy', ['id' => $funcionario->id]))
        ->assertStatus(200)
        ->assertExactJson(['Funcionário excluído.']);
    }

    public function test_cria_funcionario()
    {
        $this->postJson(route('funcionarios.store'),
        [
            'nome' => 'leandro',
            'email' => 'llimas@outlook.com',
            'data_admissao' => '2020-10-10',
            'sexo' => 'masculino',
        ])
        ->assertStatus(201)
        ->assertExactJson(['Funcionário salvo']);
    }

    public function test_atualiza_funcionario(){
        $funcionario = Funcionario::factory()->create();
        $this->putJson(route('funcionarios.update', ['id' => $funcionario->id]),
        [
            'nome' => 'leandro 2',
            'email' => 'llimas@outlook.com 2',
            'data_admissao' => '2020-10-11',
            'sexo' => 'Masculino',
        ])
        ->assertStatus(200)
        ->assertExactJson(['Funcionário atualizado.']);
    }
}
