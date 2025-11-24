<?php

require_once 'classes/leituras.class.php';

$conn = new mysqli("localhost", "root", "", "estufa");
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
$estufas = $conn->query("SELECT * FROM estufa");

$leituras = [];
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $estufa = isset($_GET['estufa_id']) ? $_GET['estufa_id'] : 1;

  $leitura = new Leituras();

  $leituras = $leitura->listarTodasPorEstufa($estufa);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Histórico | Estufa Inteligente</title>
  <link rel="stylesheet" href="css/historico.css">
</head>
<body>

  <div class="sidebar">
    <h2>Estufas</h2>
    <div class="estufa-list">
      <?php while($e = $estufas->fetch_assoc()): ?>
        <button onclick="selecionarEstufa(<?= $e['id'] ?>)" id="estufa-<?= $e['id'] ?>">
          <?= htmlspecialchars($e['nome']) ?>
        </button>
      <?php endwhile; ?>
    </div>
  </div>

    <div class="main">
    <div class="voltar">
        <a href="index.php" class="btn-voltar">⬅ Voltar</a>
    </div>
    <br>
    <h1 id="titulo">Selecione uma estufa</h1>
    <table>
      <thead>
        <tr>
          <th>Data e Hora</th>
          <th>Temperatura (°C)</th>
          <th>Umidade (%)</th>
          <th>Nível de Água (%)</th>
        </tr>
      </thead>
      <tbody id="tabela-historico">
        <?php foreach ($leituras as $leitura): ?>
          <tr>
            <td><?= $leitura['data_hora'] ?></td>
            <td><?= $leitura['temperatura'] ?></td>
            <td><?= $leitura['umidade_ar'] ?></td>
            <td><?= $leitura['nivel_agua'] ?></td>
          </tr>
        <?php endforeach; ?>
        <!-- Dados serão inseridos via JavaScript -->
      </tbody>
    </table>
  </div>

  <script>
    let estufaSelecionada = null;
    let intervaloAtual = null;

    async function selecionarEstufa(id) {
        estufaSelecionada = id;
        document.getElementById('titulo').innerText = "Histórico da Estufa #" + id;

        document.querySelectorAll('.estufa-list button').forEach(btn => btn.classList.remove('selected'));
        document.getElementById('estufa-' + id).classList.add('selected');

        if (intervaloAtual) {
            clearInterval(intervaloAtual);
        }

        atualizarHistorico();

        intervaloAtual = setInterval(atualizarHistorico, 1000);
    }

    async function atualizarHistorico() {
      if (!estufaSelecionada) return;

      const url = window.location.origin + '/leitura.php?estufa_id=' + estufaSelecionada;

      try {
          let resposta = await fetch(url);
          let dados = await resposta.json();

          mostrarHistorico(dados);
      } 
      catch (erro) {
          console.error("Erro ao buscar leituras:", erro);
      }
    }

    async function salvarNoBanco() {

      function random(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
      }
      const form = new FormData();
      form.append("estufa_id", 1);
      form.append("temperatura", random(18, 25));
      form.append("umidade_ar", random(30, 70));
      form.append("umidade_solo", random(20, 40));
      form.append("nivel_agua", random(1, 100));

      let resposta = await fetch(window.location.origin + "/leitura.php", {
          method: "POST",
          body: form
      });

      let data = await resposta.json();
      console.log(data);
    }

    function mostrarHistorico(dados) {
      const tbody = document.getElementById('tabela-historico');
      tbody.innerHTML = '';

      dados.forEach(item => {
          const linha = `
              <tr>
                  <td>${item.data_hora}</td>
                  <td>${item.temperatura}</td>
                  <td>${item.umidade_ar}</td>
                  <td>${item.nivel_agua}</td>
              </tr>
          `;
          tbody.innerHTML += linha;
      });
    }

    setInterval(salvarNoBanco, 1000);
  </script>
</body>
</html>
