## Instalação da Api

Siga os passos abaixo para a instalção correta da Api. O modelo atualmente permite tanto a instalçao de forma nativa no 
host, ou seja, sem usar qualquer containers ou virtualizadores EX:(Docker e Vagrant), como também permite a instalação 
usando o Docker ([mais informações sobre os Pré-requisitos](prerequisitos.md)).
Vamos tentar simplificar os dois metodos de instalação.

#### Usando o nosso queridinho Docker:
```
# clone o repositorio
$ git clone <link> <filepath>

# Entre no repositório criado e execute o comando para subir o container:
$ cd <filepath>
$ docker-compose up -d (windows) | sudo docker-compose up -d (linux) 
# Caso haja alguma falha de portas nessa etapa, certifique de alterar as mesmas no arquivo docker-compose.yml

#Execute os seguintes comandos para instalar as dependencias, configurar o .env e executar as migrations e seeders.
$ docker exec -it api-testepratico-dario bash -c 'composer install'
$ docker exec -it api-testepratico-dario bash -c 'cp .env.example .env'
$ docker exec -it api-testepratico-dario bash -c 'php artisan migrate'
$ docker exec -it api-testepratico-dario bash -c 'php artisan db:seed'
$ docker exec -it api-testepratico-dario bash -c 'chmod 777 -R storage/logs'

# Verifique se esta tudo ok http://localhost:9010/ Se tudo estiver ok, deverá aparecer a tela padrão do laravel.
- http://localhost:9010/

#Rode os testes unitários
$ docker exec -it api-testepratico-dario bash -c 'vendor/bin/phpunit'
```

#### Instalação no proprio host:

````
# clone o repositorio
$ git clone <link> <filepath>

# Entre no repositório criado:
$ cd <filepath>

# Execute os seguintes comandos para instalar as dependencias, configurar o .env e executar as migrations e seeders.
# Instale as dependencias
$ composer install

# Crie o arquivo .env e configure o banco de dados (mysql), sugiro você duplicar o .env.example e nomear para .env

# Execute a migração das tabelas.
$ php artisan migrate

# Execute as seeders para popular o banco com os dados necessários.
$ php artisan db:seed

# Execute o servidor do laravel.
- http://localhost:8000/

# Rode os testes unitários na raiz do projeto
$ vendor/bin/phpunit
````
