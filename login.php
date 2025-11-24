<?php
session_start();
if(isset($_SESSION['usuario_id'])){
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="css/login.css">
</head>
<body class="fundo-verde">
  <div class="container borda-azul">
    <h1 class="titulo-verde">Login</h1>
    <p class="subtitulo">Bem-vindo de volta!</p>

    <form action="processa_login.php" method="POST">
      <label>Nome:</label>
      <input type="text" name="nome" placeholder="Digite seu nome" required>

      <label>Senha:</label>
      <input type="password" name="senha" placeholder="Digite sua senha..." required>

      <button type="submit" class="btn-verde">Entrar</button>
    </form>

    <p class="alternar">
      Ainda não tem uma conta? <a href="cadastro.php">Cadastre-se</a>
    </p>
  </div>
</body>
</html>
