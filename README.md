# Desafio FINXI - LINHA DIRETA
## API Rest com Laravel e Interface de Usuário integrada

API Rest usando Laravel com authenticação usando Laravel Passport

Luiz Carlos Belem `<belemlc@gmail.com>`
<small>(21) 97300-8600</small>

### Instalação
    Usando o Docker
        3) docker-compose up -d --build
        5) Para acompanhar evolução do container levantando [docker logs app -f]
        6) Porta Api 8000
        7) Porta Mysql 3308

    Usando o Laravel Development Server
        1) Renomear .env.example para .env
        2) Denifir as configurações do banco de dados
        3) Rodar os comandos na raiz do projeto baixado
            - php composer install / composer install
            - php artisan key:generate --force
            - php artisan migrate
            - php artisan passport:install
            - php artisan db:seed
            - npm install && npm run dev 
            - php artisan serve
        4) Porta da Api 8000
###

### Notas sobreo uso do Postman
    - Usando a versão 2.1 como solicitada
    - Nome do arquivo <Finxi.postman_collection.json> na raiz do projeto
    - Foi definido uma variável global chamada de TOKEN que armazena o token gerado pelo login
    - A varável TOKEN global está definida em todas as chamada que usam token
    - Para definir um novo TOKEN
        - Botão de engrenagem ⚙️ que fica no canto superior direito
        - Na janela aberta, clique em Globals
        - Em TOKEN, mude para o novo valor os campos <INITIAL VALUE> e <CURRENT VALUE>
    - Nas chamadas (url) que contiver {id} trocar pelo id que será testado  


### Notas sobre o processo de instalação
    - O Docker irá baixar as imagens para uso
    - Instalar as depêndencias de cada serviço de acordo com o que está escrido em cada Dcokerfile
    - O Docker irá subir a aplicaçcão executando as migrations, seeders e instalando o passport
    - Depois configurar o container do Nginx para rodar a aplicação
    - Ao rodar o docker-compose, ele irá executar Dockerize que faz a escrita do arquivo .env usando as definições de enviroment escrita no docker-compose.yml

### Usando a API

    API ENDPOINT
        - http://localhost:8000/api
#### 
    USUÁRIO PRE CADASTRADO
        - Administrador
            - login: admin@finxi.com
            - password: admin123
        - Anunciante
            - login: anunciante@finxi.com
            - password: admin123
###
    REGISTRAR NOVO USUÁRIO
        - [POST] http://localhost:8000/api/register
        - CAMPOS
            - name
            - email
            - password
            - role_id [1 = Administrador e 2 = Anunciante]
###        
    LOGIN PARA GERAR TOKEN
        - [POST] http://localhost:8000/api/login
        - CAMPOS
            - email
            - password
        - RETORNO
            - token
###            
    INFORMAÇÕES DO USUARIO
        - [GET] http://localhost:8000/api/user
        - HEADER
            - Authorization: BEARER {token}
            - Accept: application/json
        - RETORNO
            - data { userdata }
###            
    CRIAR PEÇA/ANUNCIO
        - [POST] http://localhost:8000/api/pecas
        - HEADER
            - Authorization: BEARER {token}
            - Accept: application/json
        - JSON COM TODOS OS CAMPOS, MODELO NO JSON DO POSTMAN
###            
    LISTAR PECAS/ANUNCIOS
        - [GET] http://localhost:8000/api/pecas
        - HEADER
            - Authorization: BEARER {token}
            - Accept: application/json
###    
    EDITAR PECA/ANUNCIO
        - [PUT] http://localhost:8000/api/pecas/id
        - HEADER
            - Authorization: BEARER {token}
            - Accept: application/json
        - JSON COM O CAMPO A SER EDITADO
###            
    DELETAR PECA/ANUNCIO
        - [DELETE] http://localhost:8000/api/pecas/id
        - HEADER
            - Authorization: BEARER {token}
            - Accept: application/json
        

### Interface do usuário
    1) Acessar http://localhost:8000
    2) Será redirecionado para tela de login
    3) Ambos os usuários conseguem acessar a tela
    4) O usuário com papel de Administrador visualiza todos as peça/anuncio
    5) Usuário com papel Anunciante visualiza apenas suas peças/anuncios
    6) No último campo STATUS, a imagem é carregada de acordo com o status
### Nota
    Na documentação fala sobre o usuário com o papel de administrador acessar a interface
    do usuário, não diz sobre o anunciante acessar, deixe ambos acessarem por questão de tempo e
    e para fins de entendimento da aplicação.  

## Testes Unitários

    Foram criado dois testes unitários usando um usuário com o papel de anunciante já pré cadastrado no sistema
    Existem duas situações de teste:
    1 - Listar todas as peças/anuncios de um usuário
    2 - Cria um anuncio usando o usuário com o papel de anunciante
    
    para executar o teste, será necessário rodar o seguinte comando abaixo
    > docker exec -it app vendor/bin/phpunit tests/Feature/PecaTest.php
