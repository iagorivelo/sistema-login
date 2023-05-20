<?php
  session_start();
  if(!isset($_SESSION['id_usuario']))
  {
    header("location: index.php");
    exit();
  }
?>

<!DOCTYPE html>
<html lang="pt_BR">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema</title>
    <style>
      body {
        background-color: gray;
      }

      h1 {
        color: white
      }

      #botao {
        background-color: white;
        color: white;
        height: 50px;
        width: 250px;
        font-size: 16pt;
      }

    </style>
  </head>

  <body>
    <h1>SEJA BEM VINDO!!</h1>
    <button id="botao"><a href="sair.php">Sair</a></button>
  </body>
</html>