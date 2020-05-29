<?php 
session_start();
require_once 'conexao.php';

// =========== RECEBENDO DADOS =============

if(isset($_POST['btn-editar'])):
    $usuario = mysqli_real_escape_string($conexao, trim($_POST['usuario']));
    $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
    $email = mysqli_real_escape_string($conexao, trim($_POST['email']));
    $cpf = mysqli_real_escape_string($conexao, trim($_POST['cpf']));
    $rg = mysqli_real_escape_string($conexao, trim($_POST['rg']));
    $sexo = mysqli_real_escape_string($conexao, trim($_POST['sexo']));
    $data_nasc = mysqli_real_escape_string($conexao, trim($_POST['data_nasc']));
    $endereco = mysqli_real_escape_string($conexao, trim($_POST['endereco']));
    $telefone = mysqli_real_escape_string($conexao, trim($_POST['telefone']));
    $id = mysqli_real_escape_string($conexao, trim($_POST['id']));
    
    $sql = "UPDATE cliente SET usuario = '$usuario', nome = '$nome', email = '$email', cpf = '$cpf', rg = '$rg', sexo = '$sexo', data_nasc = '$data_nasc', endereco = '$endereco', telefone = '$telefone' WHERE idcliente = '$id'";

    if(mysqli_query($conexao, $sql)):
        header('Location: painel.php');
    else:
        header('Location: painel.php');
    endif;
endif;





?>