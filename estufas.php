<?php
require_once 'classes/Leituras.class.php';
require_once 'classes/cad.Estufa.class.php';
$estufa = new Estufa();
$lista = $estufa->listar();
$dados = null;

if (isset($_GET['estufa'])) {
    $leit = new Leituras();
    $dados = $leit->buscarUltimaLinha($_GET['estufa']);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Estufa Inteligente</title>
  <link rel="stylesheet" href="css/index.css">

  <style>
    /* CONTAINER GERAL */
    .dados-e-alertas {
        display: flex;
        gap: 25px;
        margin-top: 25px;
        width: 100%;
    }

    /* CARD DE DADOS (70%) */
    .dados-container {
        padding: 20px;
        background: #ffffff;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        width: 70%;
        margin-left: 40px;
    }

    .dados-item {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid #e2e2e2;
        font-size: 18px;
    }
    .dados-item:last-child { border-bottom: none; }

    .dados-label { font-weight: bold; color: #2d4c37; }
    .dados-valor { color: #333; }

    .atualizado {
        margin-top: 12px;
        text-align: right;
        color: #666;
        font-size: 15px;
        margin-left: 40px;
    }

    .sem-dados {
        margin-top: 30px;
        padding: 20px;
        background: #f3f3f3;
        border-radius: 10px;
        font-size: 18px;
        text-align: center;
        color: #444;
        max-width: 500px;
        margin-left: 40px;
    }
    margin-left: 40px;

    /* CARD DE ALERTAS (30%) */
    .alertas-container {
        width: 30%;
        padding: 20px;
        background: #ffffff;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        height: fit-content;
    }

    .alerta-titulo {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 12px;
        color: #2d4c37;
    }

    .alerta-item {
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: bold;
        color: white;
    }

    .alerta-verde { background: #38a169; }
    .alerta-amarelo { background: #d6a719; }
    .alerta-vermelho { background: #d9534f; }

    /* ESPAÇO EXTRA ESTILIZADO */
    .alerta-extra {
        margin-top: 20px;
        background: #f4f4f4;
        border-radius: 10px;
        padding: 15px;
        height: 100px;
        color: #777;
        font-size: 15px;
        text-align: center;
        border: 1px dashed #ccc;
    }

    .logo {
    color: #ffffffff;      /* cor do texto */
    text-decoration: none; /* remove o sublinhado */
}

.logo strong {
    color: #ffffffff;   /* mantém destaque se quiser */
}

header a.logo {
    text-decoration: none;
    color: inherit;   /* usa a mesma cor do header */
}

  </style>

</head>
<body>
  <header>
    <div class="logo">Estufa <strong>Inteligente</strong></div>
    </a>
    <nav>
      <a href="index.php" class="ativo">Página Inicial</a>
      <a href="paghistorico.php">Histórico</a>
    </nav>
  </header>

  <section class="banner">
    <img src="img/estufa.png" alt="Estufa">
  </section>

  <main>
    <div class="estufas-container">
      <div class="estufas-lista">
        <a href="form_cad_estufa.html" class="nova-estufa">
          <div class="circulo">+</div>
          <span>Nova Estufa</span>
        </a>
        <br>

        <?php foreach ($lista as $e): ?>
          <a href="estufas.php?estufa=<?= $e['id'] ?>" class="nova-estufa">
            <div class="circulo">🌿</div>
            <span><?= htmlspecialchars($e['nome']) ?></span>
          </a>
        <?php endforeach; ?>
      </div>

      <!-- =========================== -->
      <!-- SE AINDA NÃO SELECIONOU -->
      <!-- =========================== -->
      <?php if (!$dados || !is_array($dados)): ?>

          <div class="sem-dados">
              Selecione uma estufa ao lado.<br>
              Os dados mais recentes aparecerão aqui.
          </div>

      <?php else: ?>

      <div class="dados-e-alertas">

        <!-- =========================== -->
        <!-- CARD PRINCIPAL DE DADOS (70%) -->
        <!-- =========================== -->
        <div class="dados-container">

            <div class="dados-item">
                <span class="dados-label">🌡️ Temperatura</span>
                <span class="dados-valor"><?= $dados['temperatura'] ?> °C</span>
            </div>

            <div class="dados-item">
                <span class="dados-label">💧 Umidade do Ar</span>
                <span class="dados-valor"><?= $dados['umidade_ar'] ?> %</span>
            </div>

            <div class="dados-item">
                <span class="dados-label">🌱 Umidade do Solo</span>
                <span class="dados-valor"><?= $dados['umidade_solo'] ?> %</span>
            </div>

            <div class="dados-item">
                <span class="dados-label">🪣 Nível da Água</span>
                <span class="dados-valor"><?= $dados['nivel_agua'] ?> %</span>
            </div>

            <div class="atualizado">
                Atualizado em: <?= $dados['data_hora'] ?>
            </div>

        </div>

        <!-- =========================== -->
        <!-- CARD DE ALERTAS (30%) -->
        <!-- =========================== -->
        <div class="alertas-container">
            <div class="alerta-titulo">⚠ Alertas da Estufa</div>

            <!-- LÓGICA DE ALERTAS -->
            <?php
                // Temperatura
                if ($dados['temperatura'] > 32) {
                    echo '<div class="alerta-item alerta-vermelho">🔥 Temperatura muito alta</div>';
                } else if ($dados['temperatura'] < 10) {
                    echo '<div class="alerta-item alerta-amarelo">❄ Temperatura muito baixa</div>';
                } else {
                    echo '<div class="alerta-item alerta-verde">✔ Temperatura estável</div>';
                }

                // Umidade do ar
                if ($dados['umidade_ar'] < 40) {
                    echo '<div class="alerta-item alerta-amarelo">💧 Umidade do ar baixa</div>';
                } else {
                    echo '<div class="alerta-item alerta-verde">✔ Umidade do ar adequada</div>';
                }

                // Umidade do solo
                if ($dados['umidade_solo'] < 35) {
                    echo '<div class="alerta-item alerta-amarelo">🌱 Solo ressecado</div>';
                } else {
                    echo '<div class="alerta-item alerta-verde">✔ Solo em boas condições</div>';
                }

                // Nível da água
                if ($dados['nivel_agua'] < 25) {
                    echo '<div class="alerta-item alerta-vermelho">🪣 Nível de água crítico</div>';
                } else if ($dados['nivel_agua'] < 50) {
                    echo '<div class="alerta-item alerta-amarelo">🪣 Nível de água baixo</div>';
                } else {
                    echo '<div class="alerta-item alerta-verde">✔ Reservatório adequado</div>';
                }
            ?>

            <!-- ÁREA EXTRA -->
            <div class="alerta-extra">
                Espaço reservado para observações.
            </div>

        </div>

      </div>

      <?php endif; ?>

    </div>
  </main>
</body>
</html>
