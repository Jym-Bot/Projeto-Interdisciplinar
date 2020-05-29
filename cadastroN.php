<?php
session_start();
include_once 'head.php';
?>

<body>
    
    <!--//////////Configurando Mensagens//////////-->
    
    <?php
    //Inicio PHP1 (Mensagem de ok)
    if ($_SESSION['status_cadastro']) :
    ?>

        <div class="notification is-success">
            <p>Cadastro efetuado!</p>
            <p>Faça login informando o seu Usuário e Senha <a href="loginN.php">aqui</a></p>
        </div>

    <?php
    endif;
    unset($_SESSION['status_cadastro']);
    //Fim PHP1
    ?>

    <?php
    //Incio PHP2 (Mensagem de Erro)
    if ($_SESSION['usuario_existe']) :
    ?>

        <div class="notification is-info">
            <p>O Usuário escolhido já existe. Informe outro e tente novamente.</p>
        </div>

    <?php
    //Fim PHP2 (Mensagem de Erro)
    endif;
    unset($_SESSION['usuario_existe']);
    ?>

    <!--////////// HTML PADRÃO //////////-->

    <div class="text-center border border-light p-5">
        <form action="cadastrarN.php" method="POST">
            <h1>--Cadastro Nutricionista--</h1>
            <br>
            <div class="field">
                <div class="control">
                    <h1 class="text-left text-justify">Usuário</h1>
                    <input name="usuario" type="text" class="form-control mb-4" placeholder="Usuário" autofocus maxlength="100">
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <h1 class="text-left text-justify">Nome</h1>
                    <input name="nome" type="text" class="form-control mb-4" placeholder="Nome" autofocus maxlength="100">
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <h1 class="text-left text-justify">Email</h1>
                    <input name="email" type="text" class="form-control mb-4" placeholder="Email" maxlength="100">
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <h1 class="text-left text-justify">CPF</h1>
                    <input name="cpf" type="text" class="form-control mb-4" placeholder="CPF" maxlength="11">
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <h1 class="text-left text-justify">CRN</h1>
                    <input name="crn" type="text" class="form-control mb-4" placeholder="CRN" maxlength="6">
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <h1 class="text-left text-justify">RG</h1>
                    <input name="rg" type="text" class="form-control mb-4" placeholder="RG" maxlength="11">
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <h1 class="text-left text-justify">Sexo</h1>
                    <input name="sexo" style="text-transform: uppercase;" type="text" class="form-control mb-4" placeholder="Sexo" maxlength="1">
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <h1 class="text-left text-justify">Data de Nascimento</h1>
                    <input name="data_nasc" type="text" class="form-control mb-4" placeholder="Data de Nascimento" maxlength="8">
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <h1 class="text-left text-justify">Endereço</h1>
                    <input name="endereco" type="text" class="form-control mb-4" placeholder="Endereço" maxlength="255">
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <h1 class="text-left text-justify">Telefone</h1>
                    <input name="telefone" type="text" class="form-control mb-4" placeholder="Telefone" maxlength="45">
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <h1 class="text-left text-justify">Senha</h1>
                    <input name="senha" class="form-control mb-4" type="password" placeholder="Senha" maxlength="45">
                </div>
            </div>
            <button type="submit" class="btn btn-info btn-block my-4">Cadastrar</button>
            <p class="h4 mb-4">Já Possui um cadastro?</p>
        </form>
        <a href="loginN.php">Realizar Login</a>
    </div>
</body>
<?php
include_once 'footer.php';
?>