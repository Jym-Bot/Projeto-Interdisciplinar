<?php
//Iniciando uma nova conexão com o bd para usar com o FullCalendar. Para evitar bugs no calendario
//Especificando o BD
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DBNAME', 'projetof');

//Iniciando conexão com o BD
$conn = new PDO('mysql:host=' . HOST . ';dbname='. DBNAME .';', USER , PASS);
?>