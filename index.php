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
      <div class="icone-usuario">👤</div>
    </nav>
  </header>

  <section class="banner">
    <img src="img/estufa.png" alt="Estufa">
  </section>

  <!-- Estufas à esquerda e texto à direita -->
  <main>
    <div class="estufas-container">
      
      <!-- Lista de estufas (lado esquerdo, abaixo da imagem) -->
      <section class="estufas-lista">
        <a href="form_cad_estufa.html" class="nova-estufa">
          <div class="circulo">+</div>
          <span>Nova Estufa</span>
        </a>

        <?php foreach ($lista as $e): ?>
          <a href="estufa.php?id=<?= $e['id'] ?>" class="nova-estufa">
            <div class="circulo">🌿</div>
            <span><?= htmlspecialchars($e['nome']) ?></span>
          </a>
        <?php endforeach; ?>
      </section>

      <!-- Texto Bem-vindo (lado direito) -->
      <section class="descricao">
        <h2><strong>Bem-vindo à Estufa Inteligente</strong></h2>
        <p>
          A estufa inteligente é um sistema automatizado que controla fatores como temperatura, umidade, luminosidade e irrigação para criar o ambiente ideal ao cultivo de plantas. Utilizando sensores e um microcontrolador, ela toma decisões automaticamente e pode ser monitorada à distância. Essa tecnologia aumenta a produtividade, economiza recursos e facilita o cultivo, sendo ideal para pequenos produtores, hortas urbanas e projetos educacionais.
        </p>
      </section>
    </div>

    <!-- Clima abaixo de tudo -->
    <section class="clima">
      <p><strong>Clima</strong></p>
      <img src="https://cdn-icons-png.flaticon.com/512/414/414825.png" alt="Nublado" width="64">
      <p>terça-feira, 15:00</p>
      <p>Nublado</p>
    </section>
  </main>
</body>
</html>
