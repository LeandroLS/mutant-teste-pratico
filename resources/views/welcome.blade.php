<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Teste Mutant</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
    </head>
    <body>
        <div id="UIConsumoAPI">
            <form action="{{ route('funcionarios.store') }}" method="post">
                <fieldset>
                    <legend>Adicionar Funcionário</legend>
                    <label for="">Nome</label> <br>
                    <input name="nome" type="text">  <br>
                    <label for="">E-mail</label>  <br>
                    <input name="email" type="email">  <br>
                    <label for="">Data Admissao</label>  <br>
                    <input name="data_admissao" type="date">  <br>
                    <label for="">Sexo</label>  <br>
                    <select name="sexo" id="">  <br>
                        <option value="">Selecione</option>
                        <option value="Feminino">Feminino</option>
                        <option value="Masculino">Masculino</option>
                    </select> <br>
                    <button>Adicionar</button>
                </fieldset>
            </form>
              <fieldset>
                <legend>Lista de funcionários</legend>
                <ol>
                    <li v-for='funcionario in funcionarios'> Nome: @{{funcionario.nome}} Email: @{{funcionario.email}} Admissao: @{{funcionario.data_admissao}} Sexo: @{{funcionario.sexo}} <button @click="destroy(funcionario.id)">Excluir</button><hr></li>
                   
                </ol>
            </fieldset>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script>
        let vue = new Vue({
            el: '#UIConsumoAPI',
            data: {
                funcionarios: []
            },
            methods: {
                destroy(id){
                    fetch(`/api/funcionarios/${id}`, {
                        method: 'DELETE',
                        body: { id : id }
                    })
                    .then((response) => {
                        //se a requisição der certo, refaz a lista de funcionários chamando a funcção index()
                        response.json().then(this.index());
                    });
                },
                index(){
                    fetch("{{route('funcionarios.index')}}")
                    .then((response) => {
                        response.json().then(data => this.funcionarios = data);
                    });
                }
            },
            created(){
                this.index();
            }
        });
    </script>
</html>
