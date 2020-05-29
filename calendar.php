<?php
include_once 'headlogin.php';
include_once 'verificapag.php'
?>
<html>

<head>
    <meta charset='utf-8' />
    <link href='css/core/main.min.css' rel='stylesheet' />
    <link href='css/daygrid/main.min.css' rel='stylesheet' />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src='js/core/main.min.js'></script>
    <script src='js/interaction/main.min.js'></script>
    <script src='js/daygrid/main.min.js'></script>
    <script src='js/core/locales/pt-br.js'></script>
    <script>
        //Calendario
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {

                //locale para mudar o idioma do calendario
                locale: 'pt-br',

                //interaction é necessario para captar os cliques
                //daygrid para a palavra no dia do calendario
                plugins: ['interaction', 'dayGrid'],

                //editable para que se possa editar os eventos
                editable: true,

                //eventLimit para impor um número de eventos fixos antes de se abrir uma "pop-up" com os outros eventos
                eventLimit: true,

                //Puxando informações do banco de dados
                events: 'list_event.php',

                //EVENTOS DOS BOTÕES mostrando as informações do banco de dados
                eventClick: function(info) {

                    $('#apagar_evento').attr("href", "apagar_evento.php?id=" + info.event.id);
                    info.jsEvent.preventDefault();
                    //.TEXT para informar e .VAL pra o formulario
                    //inf ID(Não faço a menor ideia de pq não está mostrando)
                    $('#visualizar #id').text(info.event.id);
                    $('#visualizar #id').val(info.event.id);
                    //inf Titulo do evento
                    $('#visualizar #title').text(info.event.title);
                    $('#visualizar #title').val(info.event.title);
                    //inf Inicio do evento
                    $('#visualizar #start').text(info.event.start.toLocaleString());
                    $('#visualizar #start').val(info.event.start.toLocaleString());
                    //inf Fim do evento
                    $('#visualizar #end').text(info.event.end.toLocaleString());
                    $('#visualizar #end').val(info.event.end.toLocaleString());
                    //COR
                    $('#visualizar #color').val(info.event.backgroundColor);
                    //MODAL
                    $('#visualizar').modal('show');
                },
                //selectable permite que as data do calendario sejam clicaveis
                selectable: true,

                //select... mostra a data do campo clicado com uma "pop-up"
                select: function(info) {
                    //toLocaleString para converter as datas a serem exibidas
                    $('#cadEvent #start').val(info.start.toLocaleString());
                    $('#cadEvent #end').val(info.end.toLocaleString());
                    $('#cadEvent').modal('show');
                },

            });

            calendar.render();
        });

        //Mascara para o campo data e hora
        //Função para que o usuario não altere os formato dos dados de Data
        //Para serem convertidos na hora de mostrar e convertidos novamente para serem alocados no banco de dados
        function DataHora(evento, objeto) {
            var keypress = (window.event) ? event.keyCode : evento.which;
            campo = eval(objeto);
            if (campo.value == '00/00/0000 00:00:00') {
                campo.value = "";
            }

            caracteres = '0123456789';
            separacao1 = '/';
            separacao2 = ' ';
            separacao3 = ':';
            conjunto1 = 2;
            conjunto2 = 5;
            conjunto3 = 10;
            conjunto4 = 13;
            conjunto5 = 16;
            if ((caracteres.search(String.fromCharCode(keypress)) != -1) && campo.value.length < (19)) {
                if (campo.value.length == conjunto1)
                    campo.value = campo.value + separacao1;
                else if (campo.value.length == conjunto2)
                    campo.value = campo.value + separacao1;
                else if (campo.value.length == conjunto3)
                    campo.value = campo.value + separacao2;
                else if (campo.value.length == conjunto4)
                    campo.value = campo.value + separacao3;
                else if (campo.value.length == conjunto5)
                    campo.value = campo.value + separacao3;
            } else {
                event.returnValue = false;
            }
        }
        //Mandando os dados para cad_event.php onde serão testados e alocados no BD
        $(document).ready(function() {

            //Recebendo os dados da Formualrio#addevent
            $("#addevent").on("submit", function(event) {

                //Impedir que a "pop-up" seja fechada ao fim da operação
                event.preventDefault();

                //Ajax para o envio dos dados
                $.ajax({

                    //Metodo de como será enviado
                    method: "POST",

                    //Para aonde será enviado
                    url: "cad_event.php",

                    //Formatação da data
                    data: new FormData(this),
                    contentType: false,
                    processData: false,

                    //Retorno com as mensagens de Sucesso ou falha
                    success: function(retorna) {
                        if (retorna['sit']) {
                            //$("#msg-cad").html(retorna['msg']);
                            location.reload();
                        } else {
                            $("#msg-cad").html(retorna['msg']);
                        }
                    }
                })
            });
            //Função para trocar visualizar evento para editar evento
            $('.btn-canc-vis').on("click", function() {
                //slideToggle para esconder e revelar
                $('.visevent').slideToggle();
                $('.formedit').slideToggle();
            });

            //O contrario do de cima(Ocultar o formualrio e mostrar os detalhes)
            $('.btn-canc-edit').on("click", function() {
                //slideToggle para esconder e revelar
                $('.formedit').slideToggle();
                $('.visevent').slideToggle();
            });

            //Recebendo os dados da Formualrio#editevent
            $("#editevent").on("submit", function(event) {

                //Impedir que a "pop-up" seja fechada ao fim da operação
                event.preventDefault();

                //Ajax para o envio dos dados
                $.ajax({

                    //Metodo de como será enviado
                    method: "POST",

                    //Para aonde será enviado
                    url: "edit_event.php",

                    //Formatação da data
                    data: new FormData(this),
                    contentType: false,
                    processData: false,

                    //Retorno com as mensagens de Sucesso ou falha
                    success: function(retorna) {
                        if (retorna['sit']) {
                            //$("#msg-cad").html(retorna['msg']);
                            location.reload();
                        } else {
                            $("#msg-edit").html(retorna['msg']);
                        }
                    }
                })
            });
        });
    </script>
    <!-- CSS DO CALENDARIO-->
    <style>
        body {
            margin: 40px 10px;
            padding: 0;
            font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
            font-size: 14px;
        }

        #calendar {
            max-width: 900px;
            margin: 0 auto;
        }

        .visevent {
            display: block;
        }

        .formedit {
            display: none;
        }
    </style>
</head>

<body>
    <?php
    //Chamando, Exibindo e Retirando a Mensagem
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>
    <div id='calendar'></div>
    <!-- ######## VISUALIZAÇÃO DE EVENTO ######## -->
    <div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalhes do Evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="visevent">
                        <dl class="row">
                            <dt class="col-sm-3">ID do Evento</dt>
                            <dd class="col-sm-9" id="id"></dd>

                            <dt class="col-sm-3">Titulo Evento</dt>
                            <dd class="col-sm-9" id="title"></dd>

                            <dt class="col-sm-3">Inicio Evento</dt>
                            <dd class="col-sm-9" id="start"></dd>

                            <dt class="col-sm-3">Fim Evento</dt>
                            <dd class="col-sm-9" id="end"></dd>
                        </dl>
                        <button class="btn btn-warning btn-canc-vis">Editar</button>
                        <a href="" id="apagar_evento" class="btn btn-danger">Deletar</a>
                    </div>
                    <!-- ######## FORMULARIO DE EDIÇÃO DE EVENTO ######## -->
                    <div class="formedit">
                        <span id="msg-edit"></span>
                        <form id="editevent" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="id">

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Título do Evento</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Título do Evento">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Cor do Evento</label>
                                <div class="col-sm-10">
                                    <select name="color" class="form-control" id="color">
                                        <option value="">Selecione uma cor</option>
                                        <option style="color:#FFD700;" value="#FFD700">Amarelo</option>
                                        <option style="color:#228B22;" value="#228B22">Verde</option>
                                        <option style="color:#8B0000;" value="#8B0000">Vermelho</option>
                                        <option style="color:#A020F0;" value="#A020F0">Roxo</option>
                                        <option style="color:#1C1C1C;" value="#1C1C1C">Preto</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Início do Evento</label>
                                <div class="col-sm-10">
                                    <input type="text" name="start" class="form-control" id="start" onkeypress="DataHora(event, this)">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Fim do Evento</label>
                                <div class="col-sm-10">
                                    <input type="text" name="end" class="form-control" id="end" onkeypress="DataHora(event, this)">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="button" class="btn btn-primary btn-canc-edit">Cancelar</button>
                                    <button type="submit" name="CadaEvent" id="CadaEvent" value="Cadastrar" class="btn btn-warning">Atualizar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- ######## MODAL("POP-UP") ######## -->
    <div class="modal fade" id="cadEvent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastrar um novo evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span id="msg-cad"></span>
                    <!-- ######## FORMULARIO DE CADASTRAMENTO DE EVENTO ######## -->
                    <form id="addevent" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Título do Evento</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" class="form-control" id="title" placeholder="Título do Evento">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Cor do Evento</label>
                            <div class="col-sm-10">
                                <select name="color" class="form-control" id="color">
                                    <option value="">Selecione uma cor</option>
                                    <option style="color:#FFD700;" value="#FFD700">Amarelo</option>
                                    <option style="color:#228B22;" value="#228B22">Verde</option>
                                    <option style="color:#8B0000;" value="#8B0000">Vermelho</option>
                                    <option style="color:#A020F0;" value="#A020F0">Roxo</option>
                                    <option style="color:#1C1C1C;" value="#1C1C1C">Preto</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Início do Evento</label>
                            <div class="col-sm-10">
                                <input type="text" name="start" class="form-control" id="start" onkeypress="DataHora(event, this)">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Fim do Evento</label>
                            <div class="col-sm-10">
                                <input type="text" name="end" class="form-control" id="end" onkeypress="DataHora(event, this)">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" name="CadaEvent" id="CadaEvent" value="Cadastrar" class="btn btn-success">Cadastrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>