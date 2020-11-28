<?php
DEFINE('HOST', '127.0.0.1');
DEFINE('USUARIO', 'root');
DEFINE('SENHA', '');
DEFINE('DB', 'todo');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die('Não Foi possível conectar');

mysqli_query($conexao, "SET NAMES 'utf8'");
mysqli_query($conexao, 'SET character_set_connection=utf8');
mysqli_query($conexao, 'SET character_set_client=utf8');
mysqli_query($conexao, 'SET character_set_results=utf8');

?>
