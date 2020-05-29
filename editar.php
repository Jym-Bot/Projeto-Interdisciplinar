<?php
include_once 'headlogin.php';
include_once 'verificapag.php';
include_once 'conexao.php';

//Recebendo ID pela URL
if (isset($_GET['idcliente'])) :
    //Se for true irá armazenar o id em uma variavel
    $id = mysqli_escape_string($conexao, $_GET['idcliente']);

    //Montando um query para buscar o ID
    $sql = "SELECT * FROM cliente WHERE idcliente = '$id'";

    //Armazenando em uma variavel o resultado da busca
    $resultado = mysqli_query($conexao, $sql);

    //E armazenando em um array
    $dados = mysqli_fetch_array($resultado);
endif;
?>

<body>
    <div class="text-center border border-light p-5">
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $dados['idcliente']; ?>">
            <h1> Editar Cadastro </h1>
            <br>
            <div class="field">
                <div class="control">
                    <h1 class="text-left text-justify">Usuário</h1>
                    <input name="usuario" type="text" class="form-control mb-4" placeholder="Usuário" autofocus maxlength="100" value="<?php echo $dados['usuario'];?>">
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <h1 class="text-left text-justify">Nome</h1>
                    <input name="nome" type="text" class="form-control mb-4" placeholder="Nome" autofocus maxlength="100" value="<?php echo $dados['nome']; ?>">
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <h1 class="text-left text-justify">Email</h1>
                    <input name="email" type="text" class="form-control mb-4" placeholder="Email" maxlength="100" value="<?php echo $dados['email']; ?>">
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <h1 class="text-left text-justify">CPF</h1>
                    <input name="cpf" type="text" class="form-control mb-4" placeholder="CPF" maxlength="11" value="<?php echo $dados['cpf']; ?>">
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <h1 class="text-left text-justify">RG</h1>
                    <input name="rg" type="text" class="form-control mb-4" placeholder="RG" maxlength="11" value="<?php echo $dados['rg']; ?>">
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <h1 class="text-left text-justify">Sexo</h1>
                    <input name="sexo" type="text" class="form-control mb-4" placeholder="Sexo" maxlength="1" value="<?php echo $dados['sexo']; ?>">
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <h1 class="text-left text-justify">Data de Nascimento</h1>
                    <input name="data_nasc" type="text" class="form-control mb-4" placeholder="Data de Nascimento" maxlength="8" value="<?php echo $dados['data_nasc']; ?>">
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <h1 class="text-left text-justify">Endereço</h1>
                    <input name="endereco" type="text" class="form-control mb-4" placeholder="Endereço" maxlength="255" value="<?php echo $dados['endereco']; ?>">
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <h1 class="text-left text-justify">Telefone</h1>
                    <input name="telefone" type="text" class="form-control mb-4" placeholder="Telefone" maxlength="45" value="<?php echo $dados['telefone']; ?>">
                </div>
            </div>
            <button name="btn-editar" type="submit" class="btn btn-info btn-block my-4">Atualizar</button>
        </form>
    </div>
</body>
<?php
include 'footer.php';
?>