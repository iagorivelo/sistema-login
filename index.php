<?php
  require_once 'classes/usuarios.php';
  $user = new Usuario;
?>

<!DOCTYPE html>
<html lang="pt_BR">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <link rel="stylesheet" href="./public/css/style.css">
  </head>

  <body>
    <div id="container">
      <h1>Login</h1>
      <form method="POST">
        <input type="email" name="email" placeholder="Usuário">
        <input type="password" name="senha" placeholder="Senha">
        <input type="submit" value="ACESSAR">
        <a href="cadastrar.php"><strong>Ainda não é inscrito?</strong>Cadastre-se!</a>
      </form>
    </div>

    <?php
      if(isset($_POST['email']))
      {
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);

        if(!empty($email) && !empty($senha))
        {
          $user->conectar('sistema_login_tb', 'localhost', 'root', '');

          if($user->msgErro == '')
          {
            if($user->logar($email, $senha))
            {
              header("location: logado_sistema/sistema.php");
            }
            else
            {
              ?>

              <div class="msg-erro">
                <strong>Email e/ou Senha incorretos!</strong>
              </div>

              <?php
            }
          }
          else
          {
            ?>

            <div class="msg-erro">
              <?php echo 'Erro: ' . $user->msgErro; ?>
            </div>

            <?php
          }
        }
        else
        {
          ?>

          <div class="msg-erro">
            <strong>Preencha todos os Campos!</strong>
          </div>

          <?php
        }
      }
    

    ?>

  </body>
</html>