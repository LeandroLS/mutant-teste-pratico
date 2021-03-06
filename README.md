# mutant-teste-pratico
Teste processo seletivo Mutant. Vaga PHP.

## Iniciando API  

#### Subindo API
1. ```cd caminho/para/mutant-teste-pratico```
2. ```composer install```
3. ```criar arquivo .env (já tem um .env.example pra se basear)```
4. ```php artisan key:generate```
5. ```php artisan serve```

#### Estabelecendo Conexão com Banco de Dados MySql  

##### Opção 1  
Configure a conexão com o banco de dados customizada do seu jeito atráves do arquivo .env do projeto.  
Existe um .env.example para você se basear.

##### Opção 2  
Se você não configurar a conexão com o banco de dados via .env, você deve criar uma nova conexão de banco de dados MySql com esses parâmetros:  
- host: 127.0.0.1
- porta: 3306
- nome banco: mutant-teste-pratico
- usuario: root
- senha: 123456

#### Criando tabelas e semeando banco com dados de teste
1. ```php artisan migrate```
2. ```php artisan db:seed```
---

#### RESTful API
A RESTful API para o teste é descrita abaixo.

##### Lista de funcionários
Retorna json de todos funcionários
###### URL
    /api/funcionarios
##### Método
    GET
##### Resposta de sucesso:
- Status Code: 200
- Conteúdo:```[{"id":3,"nome":"leandro 5","email":"email@email","data_admissao":"2020-10-10","sexo":"masculino","created_at":"2020-11-07T18:22:04.000000Z","updated_at":"2020-11-07T22:24:27.000000Z"}, ...]```
---
##### Lista funcionário
Retorna json de um funcionario
###### URL
    /api/funcionarios/{id}
##### Parâmetros de URL
    id=integer
##### Método
    GET
##### Resposta de sucesso:
- Status Code: 200
- Conteúdo:```{"id":3,"nome":"leandro 5","email":"email@email","data_admissao":"2020-10-10","sexo":"masculino","created_at":"2020-11-07T18:22:04.000000Z","updated_at":"2020-11-07T22:24:27.000000Z"}```

##### Resposta de erro:
- Status Code: 404
- Conteúdo: ```Funcionário não encontrado.```
---
##### Cria funcionário
Cria um novo funcionário 
###### URL
    /api/funcionarios
##### Método
    POST
##### Resposta de sucesso:
- Status Code: 201
- Conteúdo: ```Funcionário salvo```

##### Resposta de erro:
- Status Code: 400
- Conteúdo: ```Não foi possível criar o funcionário.```
---
##### Atualiza funcionário
Atualiza dados de um funcionário
###### URL
    /api/funcionarios/{id}
##### Parâmetros de URL
    id=integer
##### Método
    PUT
##### Resposta de sucesso:
- Status Code: 201
- Conteúdo: ```Funcionário atualizado.```

##### Resposta de erro:
- Status Code: 400
- Conteúdo: ```Não foi possível atualizar o funcionário.```
---
##### Deleta funcionário
Remove um funcionário
###### URL
    /api/funcionarios/{id}
##### Parâmetros de URL
    id=integer
##### Método
    DELETE
##### Resposta de sucesso:
- Status Code: 200
- Conteúdo: ```Funcionário excluído.```

##### Resposta de erro:
- Status Code: 404
- Conteúdo: ```Funcionário não encontrado.```
---
#### Executando testes
1. ```cd caminho/para/mutant-teste-pratico```
2. ```.\vendor\bin\phpunit```