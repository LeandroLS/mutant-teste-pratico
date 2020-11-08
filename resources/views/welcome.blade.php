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
            <form action="{{ route('funcionarios.store') }}" @submit.prevent="store()" method="post">
                <fieldset>
                    <legend>Adicionar Funcionário</legend>
                    <label for="">Nome</label> <br>
                    <input name="nome" v-model="formAdd.nome" required type="text">  <br>
                    <label for="">E-mail</label>  <br>
                    <input name="email"  v-model="formAdd.email" required type="email">  <br>
                    <label for="">Data Admissao</label>  <br>
                    <input name="data_admissao"required v-model="formAdd.data_admissao" type="date">  <br>
                    <label for="">Sexo</label>  <br>
                    <select name="sexo" v-model="formAdd.sexo" required id="">  <br>
                        <option value="">Selecione</option>
                        <option value="Feminino">Feminino</option>
                        <option value="Masculino">Masculino</option>
                    </select> <br>
                    <button type="submit">Adicionar</button>
                </fieldset>
            </form>
            <fieldset>
                <legend>Lista de funcionários</legend>
                <ol>
                    <li v-for='funcionario in funcionarios'> Nome: @{{funcionario.nome}} Email: @{{funcionario.email}} Admissao: @{{funcionario.data_admissao}} Sexo: @{{funcionario.sexo}} 
                        <button @click="destroy(funcionario.id)">Excluir</button> 
                        <button @click="show(funcionario.id)">Editar</button>
                        <hr>
                    </li>
                </ol>
            </fieldset>
            <fieldset>
                <legend>Editar Funcionário</legend>
                <label for="">Nome</label> <br>
                <input name="nome" v-model="formEdit.nome" required type="text">  <br>
                <label for="">E-mail</label>  <br>
                <input name="email"  v-model="formEdit.email" required type="email">  <br>
                <label for="">Data Admissao</label>  <br>
                <input name="data_admissao"required v-model="formEdit.data_admissao" type="date">  <br>
                <label for="">Sexo</label>  <br>
                <select name="sexo" v-model="formEdit.sexo" required id="">  <br>
                    <option value="">Selecione</option>
                    <option value="Feminino">Feminino</option>
                    <option value="Masculino">Masculino</option>
                </select> <br>
                <button type="submit">Editar</button>
            </fieldset>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script>
        let formObj = {
            nome: '',
            data_admissao: '',
            sexo: '',
            email: ''
        };
        let vue = new Vue({
            el: '#UIConsumoAPI',
            data: {
                funcionarios: [],
                formAdd: formObj,
                formEdit: formObj
            },
            methods: {
                store(){
                    fetch("{{route('funcionarios.store')}}", {
                        method: 'POST',
                        headers: new Headers({'Content-Type': 'application/json'}),
                        body: JSON.stringify({ 
                            nome : this.formAdd.nome,
                            data_admissao : this.formAdd.data_admissao,
                            sexo : this.formAdd.sexo,
                            email : this.formAdd.email,
                        })
                    })
                    .then((response) => {
                        //se a requisição der certo, refaz a lista de funcionários chamando a funcção index()
                        response.json().then(this.index());
                    });
                },
                destroy(id){
                    fetch(`/api/funcionarios/${id}`, {
                        method: 'DELETE',
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
                },
                show(id){
                    fetch(`/api/funcionarios/${id}`, {
                        method: 'GET',
                    })
                    .then((response) => {
                        //se a requisição der certo, refaz a lista de funcionários chamando a funcção index()
                        response.json().then(funcionario => {
                            this.formEdit = funcionario;
                        });
                    });
                }
            },
            created(){
                this.index();
            }
        });
    </script>
</html>
