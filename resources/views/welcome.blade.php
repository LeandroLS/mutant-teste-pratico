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
            <fieldset id="avisoMsg" v-show="avisoMsg">
                <legend>Aviso!</legend>
                <h3> @{{ avisoMsg }}</h3>
            </fieldset>
            <form @submit.prevent="store()" method="post" style="width:50%; float:left">
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
            <form @submit.prevent="update(formEdit.id)" style="width:50%; float:right" method="post" id="editForm">
                <fieldset  >
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
            </form>
            <fieldset>
                <legend>Lista de funcionários</legend>
                <ol>
                    <li v-for='funcionario in funcionarios'> Nome: @{{funcionario.nome}} Email: @{{funcionario.email}} Admissao: @{{funcionario.data_admissao}} Sexo: @{{funcionario.sexo}} 
                        <button @click="destroy(funcionario.id)">Excluir</button> 
                        <button type="button" @click="show(funcionario.id);">Editar</button>
                        <hr>
                    </li>
                </ol>
            </fieldset>
           
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script>
        let formObj = {
            id: null,
            nome: '',
            data_admissao: '',
            sexo: '',
            email: ''
        };
        let vue = new Vue({
            el: '#UIConsumoAPI',
            data: {
                funcionarios: [],
                avisoMsg: null,
                formAdd: formObj,
                formEdit: formObj
            },
            methods: {
                toggleAvisoFieldSet(message){
                    this.avisoMsg = message;
                    setTimeout(() => {
                        this.avisoMsg = false;
                    }, 4000);
                },
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
                        this.toggleAvisoFieldSet('Funcionário criado');
                    });
                },
                destroy(id){
                    fetch(`/api/funcionarios/${id}`, {
                        method: 'DELETE',
                    })
                    .then((response) => {
                        //se a requisição der certo, refaz a lista de funcionários chamando a funcção index()
                        response.json().then(this.index());
                        this.toggleAvisoFieldSet('Funcionário excluído');
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
                },
                update(id){
                    fetch(`/api/funcionarios/${id}`, {
                        method: 'PUT',
                        headers: new Headers({'Content-Type': 'application/json'}),
                        body: JSON.stringify({ 
                            nome : this.formEdit.nome,
                            data_admissao : this.formEdit.data_admissao,
                            sexo : this.formEdit.sexo,
                            email : this.formEdit.email,
                        })
                    })
                    .then((response) => {
                        //se a requisição der certo, refaz a lista de funcionários chamando a funcção index()
                        response.json().then(this.index());
                        this.toggleAvisoFieldSet('Funcionário atualizado');
                    });
                }
            },
            created(){
                this.index();
            }
        });
    </script>
</html>
