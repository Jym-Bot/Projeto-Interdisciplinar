<?php 
session_start();
require_once 'conexao.php';

//Condicional para deletar usuarios
if(isset($_POST['btn-deletar'])):
    
    //Recebendo id á ser deletado 
    $id = mysqli_real_escape_string($conexao, trim($_POST['id']));
    
    //Montando query para deletar
    $sql = "DELETE FROM cliente WHERE idcliente = '$id'";

    //Deletando ou não usuario retornar para o painel
    if(mysqli_query($conexao, $sql)):
        header('Location: painel.php');
    else:
        header('Location: painel.php');
    endif;
endif;

?>