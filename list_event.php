<?php
//Chamando a conexão
include 'conexaoEv.php';
//Montando uma query
$query_events = "SELECT * FROM events";
//Passando o resultado da query para outra variavel
$resultado_events = $conn->prepare($query_events);
//exutando os resultados da variavel
$resultado_events->execute();
//declarando um array
$eventos = [];
//Lendo todos os resultado do BD
while($row_events = $resultado_events->fetch(PDO::FETCH_ASSOC)){
    //Passando as informações especificas do BD para variaveis
    $id = $row_events['id'];
    $title = $row_events['title'];
    $color = $row_events['color'];
    $start = $row_events['start'];
    $end = $row_events['end'];
    //Criando um novo array e colocando as informações dentro dele
    $eventos[] = [
        'id' => $id,
        'title' => $title,
        'color' => $color,
        'start' => $start,
        'end' => $end,
    ];
}
//retornado para o calendar.php usando o JSON
echo json_encode($eventos);
