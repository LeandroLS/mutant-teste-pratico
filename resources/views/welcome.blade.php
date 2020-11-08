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
                <li></li>
            </ol>
        </fieldset>
    </body>
</html>
