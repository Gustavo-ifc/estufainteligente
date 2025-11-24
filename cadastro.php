<?php
// Verifica se há erros e mostra alerta
if(isset($_GET['erro'])){
    if($_GET['erro'] == 'senhas'){
        echo '<script>alert("As senhas não coincidem!");</script>';
    } elseif($_GET['erro'] == 'existe'){
        echo '<script>alert("Nome ou email já cadastrado!");</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastro</title>
  <link rel="stylesheet" href="css/cadastro.css">
</head>
<body>
  <div class="container">
    <h2 class="titulo">Cadastro</h2>
    <p class="subtitulo">Crie sua conta</p>

    <form action="processa_cadastro.php" method="POST">
      <label for="nome">Nome:</label>
      <input type="text" name="nome" id="nome" placeholder="Digite seu nome..." required>

      <label for="email">Email:</label>
      <input type="email" name="email" id="email" placeholder="Digite seu email..." required>

      <label for="numero">Número:</label>
      <input type="text" name="numero" id="numero" placeholder="Digite seu número..." required>

      <label for="senha">Senha:</label>
      <input type="password" name="senha" id="senha" placeholder="Digite sua senha..." required>

      <label for="confirma_senha">Confirme a senha:</label>
      <input type="password" name="confirma_senha" id="confirma_senha" placeholder="Confirme sua senha..." required>

      <button type="submit">Cadastrar</button>
    </form>

    <p class="link">
      Já tem uma conta? <a href="login.php">Faça login</a>
    </p>
  </div>
</body>
</html>
