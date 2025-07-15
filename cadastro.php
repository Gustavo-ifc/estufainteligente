//<!DOCTYPE html>
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

    <form action="login.php" method="POST">
      <label for="nome">Nome:</label>
      <input type="text" id="nome" placeholder="Digite seu nome..." required>

      <label for="numero">Número</label>
      <input type="text" id="numero" placeholder="Digite seu número..." required>

      <label for="senha">Senha:</label>
      <input type="password" id="senha" placeholder="Digite sua senha..." required>

      <button type="submit">Cadastrar</button>
    </form>

    <p class="link">
      Já tem uma conta? <a href="login.php">Faça login</a>
    </p>
  </div>
</body>
</html>
