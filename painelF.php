<?php
include_once 'conexao.php';
include_once 'verificapag.php';
include_once 'headloginF.php';
?>
<!-- TABELA HTML -->
<div class="row" id="content">
  <div class="col s12 m6 push-m3" id="tabelaUsuarios">
    <h3 class="light"> Clientes </h3>
    <table class="striped">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Email</th>
          <th>Usuário</th>
          <th>Data de cadastro</th>
          <th>Editar</th>
          <th>Deletar</th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <?php
          //Query para fazer Busca no BD de clientes
          $sql = "SELECT * FROM cliente";

          //Armazenando resultado da busca em uma variavel
          $resultado = mysqli_query($conexao, $sql);

          //Iniciando um laço de repetição para exibir todos os usuarios do BD
          while ($dados = mysqli_fetch_array($resultado)) :
          ?>
            <td><?php echo $dados['nome']; ?></td>
            <td><?php echo $dados['email']; ?></td>
            <td><?php echo $dados['usuario']; ?></td>
            <td><?php echo $dados['data_cadastro']; ?></td>
            <td><a href="editar.php?idcliente=<?php echo $dados['idcliente']; ?>" nome="btn-editar" class="btn-floating oragen"><i class="fas fa-pencil-alt"></i></a></td>

            <td><a href="" nome="btn-deletar" class="btn-floating oragen"><i class="fas fa-trash-alt"></i></a></td>

        </tr>

      <?php
          //Fim do laço
          endwhile;
      ?>

      </tbody>
    </table>
    <br>
    <a href="cadastroC.php" class="btn">Adicionar Cliente</a>
  </div>
</div>

<?php
include_once 'footer.php';

// ======================== CSS =====================
?>
<style>
body, html{
    width: 100%;
    height: 100%;
    background: #f1f3f8;
}

div#content{
    width: 1024px;
    margin: 0 auto;
    position: relative;
}

header{
    padding: 30px 0;
    height: 37px;
    text-align: center;
    color: #333;
    text-transform: uppercase;
    font-family: MuseoSans;
    font-size: 22px;
    letter-spacing: 3px;
    background: #fff;
    border-bottom: 1px solid #ccc;
}

header div#user{
    float: left;
    position: absolute;
}

header div#user span{
    letter-spacing: 0;
    font-size: 16px;
    padding-top: 10px;
    display: block;
}

header span.logo{
    padding-top: 7px;
    display: block;
}

header div#logout{
    position: absolute;
    right: 0;
    top: 0;
}

header div#logout button{
    font-family: MuseoSans;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #333;
    padding: 10px 18px;
    background: #fff;
    border: 0;
    border-radius: 2px;
    cursor: pointer;
    border: 1px solid #d8d8d8;
    box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
}

div#tabelaUsuarios{
    margin-top: 50px;
    width: 100%;
    background: #fff;
    border-radius: 5px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
}

div#tabelaUsuarios span.title{
    font-family: MuseoSans;
    font-size: 18px;
    padding: 20px 10px;
    display: block;
    color: #d29f4e;
}

div#tabelaUsuarios table{
    width: 100%;
    font-family: FuturaPT;
    border-top: 1px solid #d8d8d8;
    border-collapse: collapse;
}

div#tabelaUsuarios table thead td{
    font-size: 14px;
    text-transform: uppercase;
    padding: 10px;
    text-align: center;
    border-bottom: 1px solid #d8d8d8;
    color: #6c6c6c;
}

div#tabelaUsuarios table thead td:first-child{
    text-align: left;
}

div#tabelaUsuarios table thead td:nth-child(even){
    border-left: 1px solid #d8d8d8;
    border-right: 1px solid #d8d8d8;
}

div#tabelaUsuarios table tbody tr{
    transition: .3s;
    cursor: pointer;
}

div#tabelaUsuarios table tbody tr:hover{
    background: #f8f8f8;
}

div#tabelaUsuarios table tbody tr:nth-child(even){
    background-color: #ececec;
}

div#tabelaUsuarios table tbody td{
    padding: 10px;
    color: #333;
    text-align: center;
}

div#tabelaUsuarios table tbody td:first-child{
    text-align: left;
}

div#tabelaUsuarios table tbody td button{
    font-family: MuseoSans;
    font-size: 12px;
    text-transform: uppercase;
    color: #333;
    padding: 10px 18px;
    background: #fff;
    border: 0;
    border-radius: 2px;
    cursor: pointer;
    border: 1px solid #fff;
    transition: .3s;
}

div#tabelaUsuarios table tbody tr:nth-child(even) td button{
    background: #ececec;
    border: 1px solid #ececec;
}

div#tabelaUsuarios table tbody tr:hover td button{
    box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
    border: 1px solid #d8d8d8;
    background: #fff;
}
</style>