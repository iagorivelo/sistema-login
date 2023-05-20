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
      <h1>Cadastrar</h1>
      <form method="POST">
        <input type="text" name="nome" placeholder="Nome Completo" maxlength="30">
        <input type="email" name="email" placeholder="E-mail" maxlength="40">
        <input type="text" name="telefone" placeholder="Telefone" maxlength="30">
        <input type="password" name="senha" placeholder="Senha" maxlength="15">
        <input type="password" name="confirmar_senha" placeholder="Confirmar Senha" maxlength="15">
        <input type="submit" value="CADASTRAR">
      </form>
    </div>

    <?php

      if(isset($_POST['nome']))
      {
        $nome            = addslashes($_POST['nome']);
        $telefone        = addslashes($_POST['telefone']);
        $email           = addslashes($_POST['email']);
        $senha           = addslashes($_POST['senha']);
        $confirmar_senha = addslashes($_POST['confirmar_senha']);

        // VERIFICAR SE OS DADOS NÃO ESTÃO VAZIOS
        // E CONECTAR AO BANCO DE DADOS
        if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmar_senha))
        {
          $user->conectar('sistema_login_tb', 'localhost', 'root', '');

          if($user->msgErro == "") 
          { 
            if($senha == $confirmar_senha)
            {
              if($user->cadastrar($nome, $email, $telefone, $senha))
              {
                ?>
                <div id="msg-sucesso">
                  <strong>Cadastrado com Sucesso!</strong> Faça o Login para Acessar!
                </div>
                <?php
              }
              else
              {
                ?>
                
                <div class="msg-erro">
                  <strong>Email já Cadastrado!</strong>
                </div>

                <?php
              }
            }
            else
            {
              ?>

              <div class="msg-erro">
                Senha e Confirmar Senha não correspondem. <strong>Preencha-os corretamente!</strong>
              </div>

              <?php
            }
          }
          else {
            ?>

            <div class="msg-erro">
              <?php echo "Erro: " . $user->msgErro; ?>
            </div>
            
            <?php
          }
        }else{
          ?>

          <div class="msg-erro">
            <strong>Preencha todos os campos!</strong>
          </div>

          <?php
        }
      }
    ?>

  </body>
</html>