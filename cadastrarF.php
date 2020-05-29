<?php
session_start();
include_once("conexao.php");

// =========== RECEBENDO DO FORMULARIO =============

//Alocando as informações do formualrio em variaveis atraves do POST
//trim para retirar os espaços da string digitada
$usuario = mysqli_real_escape_string($conexao, trim($_POST['usuario']));
$nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
$cpf = mysqli_real_escape_string($conexao, trim($_POST['cpf']));
$rg = mysqli_real_escape_string($conexao, trim($_POST['rg']));
$sexo = mysqli_real_escape_string($conexao, trim($_POST['sexo']));
$data_nasc = mysqli_real_escape_string($conexao, trim($_POST['data_nasc']));
$email = mysqli_real_escape_string($conexao, trim($_POST['email']));
$endereco = mysqli_real_escape_string($conexao, trim($_POST['endereco']));
$telefone = mysqli_real_escape_string($conexao, trim($_POST['telefone']));
$senha = mysqli_real_escape_string($conexao, trim(md5($_POST['senha'])));

// =========== BUSCANDO NO BANCO =============

//Montando uma query com contagem
$sql = "SELECT count (*) AS total FROM funcionario WHERE usuario = '$usuario'";

//Alocando a query em uma variavel result e passando para row
$result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($result);

//Desvio condicional para pesquisar no banco se o usuario existe
if($row['total'] == 1){
    //Se a pesquisa retornar verdadeira
    $_SESSION['usuario_existe'] = true;
        //Será exibido uma msg de erro de que o usuario já existe
    header('Location: cadastroF.php');
    exit;
}

// =========== INSERINDO NO BANCO =============

//Caso o usuario não exista o cadastramento será realizado normalmente
$sql = "INSERT INTO funcionario (usuario, nome, cpf, rg, sexo, data_nasc, email, endereco, telefone, senha, data_cadastro) VALUES ('$usuario', '$nome', '$cpf', '$rg', '$sexo', '$data_nasc', '$email', '$endereco', '$telefone', '$senha', NOW())";

//Desvio condicional para caso a query sejá executada com sucesso 
if($conexao->query($sql) === TRUE){
    //Msg de sucesso
    $_SESSION['status_cadastro'] = true;
}

//Encerrando conexão com BD
$conexao->close();

//Mandando Usuario para pg de cadastro
header('Location: cadastroF.php');
exit;
?>