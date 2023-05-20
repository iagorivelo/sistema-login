<?php

class Usuario
{
  private $pdo;
  public  $msgErro = "";

  public function conectar($nome, $host, $usuario, $senha)
  {
    global $pdo;

    // CONECTAR AO BANCO DE DADOS
    try {
      $pdo = new PDO("mysql:dbname=" . $nome . ";host=" . $host, $usuario, $senha);

    } catch (PDOException $e) {
      $msgEroo = $e->getMessage();
    }
  }

  public function cadastrar($nome, $email, $telefone, $senha)
  {
    global $pdo;

    // VERIFICAR SE O USUÁRIO JÁ EXISTE
    $sql = $pdo->prepare("SELECT ID FROM usuarios WHERE email = :e");
    $sql->bindValue(":e", $email);
    $sql->execute();

      if($sql->rowCount() > 0)
      {
        return false;
      }
      else
      {
        // CASO O USUÁRIO NÃO EXISTA, CADASTRE-O
        $sql = $pdo->prepare("INSERT INTO usuarios (nome, telefone, email, senha) VALUES (:n, :t, :e, :s)");
        $sql->bindValue(":n", $nome);
        $sql->bindValue(":t", $telefone);
        $sql->bindValue(":e", $email);
        $sql->bindValue(":s", md5($senha));
        $sql->execute();

          return true;
      }
  }

  public function logar($email, $senha)
  {
    global $pdo;

    // VERIFICAR SE EMAIL E SENHA FORAM CADASTRADOS
    $sql = $pdo->prepare("SELECT ID FROM usuarios WHERE email = :e AND senha = :s");
    $sql->bindValue(":e", $email);
    $sql->bindValue(":s", md5($senha));
    $sql->execute();

      if($sql->rowCount() > 0)
      {
        // SE RETORNAR MAIOR QUE 0, EXISTE UM CADASTRO
        // E LOGA NO SISTEMA
        $dados = $sql->fetch();

        session_start();
        $_SESSION['id_usuario'] = $dados['ID'];
        return true; // LOGOU NO SISTEMA
      }
      else{
        return false; // NÃO CONSEGUIU LOGAR NO SISTEMA
      }
  }
}
