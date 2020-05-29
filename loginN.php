<?php
session_start();
include_once 'head.php';
?>

<body>

    <?php
    //Testar se a busca no BD foi bem sucedida
    if (isset($_SESSION['nao_autenticado'])) :
    ?>

        <div class="notification is-danger">
            <p>ERRO: Usuário ou senha inválidos.</p>
        </div>

    <?php
    endif;
    unset($_SESSION['nao_autenticado']);
    ?>
    
    <div class="text-center border border-light p-5">
        <form action="vloginN.php" method="POST">
            <h1> Login Nutricionista </h1>
            <br>
            <div class="field">
                <div class="control">
                    <h1 class="text-left text-justify">Usuário</h1>
                    <input name="usuario" name="text" class="form-control mb-4" placeholder="Usuário" autofocus="">
                </div>
            </div>

            <div class="field">
                <div class="control">
                    <h1 class="text-left text-justify">Senha</h1>
                    <input name="senha" class="form-control mb-4" type="password" placeholder="Senha">
                </div>
            </div>
            <button type="submit" class= "btn btn-info btn-block my-4">Entrar</button>
            <p class="h4 mb-4">Não Possui um cadastro?</p>
        </form>
        <a href="cadastroN.php">Clique aqui para Cadastrar-se!</a>
    </div>
</body>
<?php
include_once 'footer.php';
?>