<?php
//Destruindo a sessão do usuario para ele se desconectar
session_start();
session_destroy();
header('Location: index.php');
exit();
//E não conseguir voltar para pg X atraves da URL
?>
