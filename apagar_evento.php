<?php
session_start();
include_once 'conexaoEv.php';

//Pegando o id atraves do GET na URL
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

//Verificando se o ID existe
if(!empty($id)){
    //Se não tiver vazio começa a montar a query 
    $query_event = "DELETE FROM events WHERE id=:id";
    $delete_event = $conn->prepare($query_event);
    
    //bindParam para referenciar os dados
    $delete_event->bindParam("id", $id);

    //Antes de simplesmente excluir, irá testar se realmente excluiu
    if($delete_event->execute()){
        //Mensagem de sucesso
        $_SESSION['msg'] = '<div class="alert-success" role="alert">O evento foi apagado com sucesso!</div>';
        header("Location: calendar.php");
    }else{
        //Mensagem de erro
        $_SESSION['msg'] = '<div class="alert-danger" role="alert">Erro o evento não foi apagado com sucesso!</div>';
        header("Location: calendar.php");
    }

}else{
    //Caso o ID esteja vazio: Mensagem de erro.
    $_SESSION['msg'] = '<div class="alert-danger" role="alert">Erro o evento não foi apagado com sucesso!</div>';
    header("Location: calendar.php");
}