<?php
//Conexão simples com o BD
//Especificando o BD
define('HOST', '127.0.0.1');
define('USUARIO', 'root');
define('SENHA', '');
define('DB', 'projetof');

//Montando a conexão
$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Não foi possivel estabelecer uma conexão');
?>