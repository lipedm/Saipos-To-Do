# Instalação / Configuração


1. Utilizar PHP 7.2.x ou mais recente.

2. Usar o .sql localizado na pasta database como script para criar o banco de dados utilizado na plataforma.
    O banco utilizado foi MySQL.

3. A config de acesso ao banco de dados esta na pasta controllers/conexao.php.
e esta definido desta forma:

DEFINE('HOST', '127.0.0.1');

DEFINE('USUARIO', 'root');

DEFINE('SENHA', '');

DEFINE('DB', 'saipos');

4. Caso haja necessidade, altere estes dados no arquivo conexao.php

# Recursos

  
A lista de Tarefas **Pendentes** e **Finalizadas** está localizada na nav_bar no canto superior esquerdo.

Foi utilizado alguns plugins js e frameworks neste projeto como:

* SweetAlert2

* Datatables

* jQuery ui

* Bootstrap
