<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Editar Perfil</title>
<link rel="stylesheet" href="css/perfil.css">
</head>

<body>

<header>
  <a href="index.php" class="logo">Estufa <strong>Inteligente</strong></a>
  <nav>
    <a href="index.php">Voltar</a>
  </nav>
</header>

<div class="perfil-container">

  <h2>Editar Perfil</h2>

  <form action="index.php" method="POST" enctype="multipart/form-data">

    <div class="foto-wrapper" onclick="document.getElementById('foto').click()">
    <img src="uploads/perfil.jpg" id="preview" alt="Foto do Perfil"
         onerror="this.src='img/perfil_padrao.png'">
    <input type="file" id="foto" name="foto" accept="image/*" onchange="previewImage(event)">
</div>


    <label>Nome:</label>
    <input type="text" name="nome" placeholder="Digite seu nome">

    <label>Email:</label>
    <input type="email" name="email" placeholder="Digite seu email">

    <label>Telefone:</label>
    <input type="text" name="telefone" placeholder="(00) 00000-0000">

    <label>Senha:</label>
    <input type="password" name="senha" placeholder="Digite sua senha">

    <label>Endereço:</label>
    <input type="text" name="endereco" placeholder="Digite seu endereço">

    <label>Cidade:</label>
    <input type="text" name="cidade" placeholder="Digite sua cidade">

    <label>CEP:</label>
    <input type="text" name="cep" placeholder="00000-000">

    <button type="submit" class="btn-salvar">Salvar</button>
  </form>

</div>

<script>
function previewImage(event){
  const reader = new FileReader();
  reader.onload = () => document.getElementById('preview').src = reader.result;
  reader.readAsDataURL(event.target.files[0]);
}
</script>

</body>
</html>
