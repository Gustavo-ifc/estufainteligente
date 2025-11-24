<?php
require_once 'classes/cad.Estufa.class.php';
$estufa = new Estufa();
$lista = $estufa->listar();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Estufa Inteligente</title>
  <link rel="stylesheet" href="css/index.css">
</head>
<body>
  <header>
    <div class="logo">Estufa <strong>Inteligente</strong></div>
    <nav>
      <a href="#" class="ativo">Página Inicial</a>
      <a href="paghistorico.php">Histórico</a>
      <a href="perfil.php">👤</a>
    </nav>
  </header>

  <section class="banner">
    <img src="img/estufa.png" alt="Estufa">
  </section>

  <main>
    <div class="estufas-container">
      <div class="estufas-lista">
        <!-- Botão fixo -->
        <a href="form_cad_estufa.html" class="nova-estufa">
          <div class="circulo">+</div>
          <span>Nova Estufa</span>
        </a>
      <br>
        <!-- Botões das estufas -->
        <?php foreach ($lista as $e): ?>
          <a href="estufas.php?estufa=<?= $e['id'] ?>" class="nova-estufa">
            <div class="circulo">🌿</div>
            <span><?= htmlspecialchars($e['nome']) ?></span>
          </a>
        <?php endforeach; ?>
      </div>

      <!-- Descrição à direita -->
      <div class="descricao">
  <div class="card-descricao">
    <h2>🌱 Bem-vindo à Estufa Inteligente</h2>
    <p>
      A estufa inteligente é um sistema automatizado que controla fatores como temperatura, umidade, luminosidade e irrigação para criar o ambiente ideal ao cultivo de plantas. Utilizando sensores e um microcontrolador, ela toma decisões automaticamente e pode ser monitorada à distância. Essa tecnologia aumenta a produtividade, economiza recursos e facilita o cultivo, sendo ideal para pequenos produtores, hortas urbanas e projetos educacionais.
    </p>
  </div>
</div>
    </div>
  </main>
</body>
</html>
