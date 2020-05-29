<?php
session_start();
//incluindo a conexão com o BD especifica do calendario
include_once 'conexaoEv.php';

//Recebendo todos os dados do formulario como uma string
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//Convertendo Data Inicial da aplicação para o banco de dados
$data_start = str_replace('/', '-', $dados['start']);
$data_start_conv = date("Y-m-d H:i:s", strtotime($data_start));

//Convertendo Data Final da aplicação para o banco de dados
$data_end = str_replace('/', '-', $dados['end']);
$data_end_conv = date("Y-m-d H:i:s", strtotime($data_end));

//Preparando uma query para enviar os dados para o BD
$query_event = "INSERT INTO events (title, color, start, end) VALUES (:title, :color, :start, :end)";
$insert_event = $conn->prepare($query_event);

//Inserindo no BD os dados
$insert_event->bindParam(':title', $dados['title']);
$insert_event->bindParam(':color', $dados['color']);

//As datas não são inseridas como acima, pq se não daria erro no banco pelo fato de os dados estarem entrando em "formato BR"
//Portando está sendo puxado direto da conversão na linha 9 e 13
$insert_event->bindParam(':start', $data_start_conv);
$insert_event->bindParam(':end', $data_end_conv);

//retorna sit(Situação) com uma msg de cadastramento realizado com sucesso ou Erro ao cadastrar
if($insert_event->execute()){
    $retorna = ['sit' => true, 'msg' => '<div class="alert-success" role="alert">Evento Cadastrado com sucesso!</div>'];
    $_SESSION['msg'] = '<div class="alert-success" role="alert">Evento Cadastrado com sucesso !</div>';
}else{
    $retorna = ['sit' => false, 'msg' => '<div class="alert-danger" role="alert">Erro: Evento não foi cadastrado com sucesso!</div>'];
}

//Devolvendo os dados para o código JS na calendar.php
header('Content-Type: application/json');
echo json_encode($retorna);
