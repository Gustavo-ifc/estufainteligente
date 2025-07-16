<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/tela_dispositivos.css">
  <title>Gerenciador de Dispositivos</title>
</head>
<body>
  <div class="container">
    <div class="painel-esquerda" id="painelDisponiveis">
      <div class="dispositivo" onclick="selecionar(this)" title="Temperatura">🌡️</div>
      <div class="dispositivo" onclick="selecionar(this)" title="Sensor de Umidade">💧</div>
      <div class="dispositivo" onclick="selecionar(this)" title="Nível de Água">🌊</div>
      <div class="dispositivo" onclick="selecionar(this)" title="Sensor de Luz">💡</div>
      <div class="dispositivo" onclick="selecionar(this)" title="Sensor de pH">🧪</div>
      <div class="dispositivo" onclick="selecionar(this)" title="Sensor de CO₂">🌫️</div>
      <div class="dispositivo" onclick="selecionar(this)" title="Sensor de Solo">🪴</div>
      <div class="dispositivo" onclick="selecionar(this)" title="Sensor de Vento">🌬️</div>
    </div>

    <div class="painel-meio">
      <button class="botao" onclick="moverParaDireita()">➡️</button>
      <button class="botao" onclick="moverParaEsquerda()">⬅️</button>

      <div class="botoes-final">
        <div class="botao-final">Salvar</div>
        <div class="botao-final">Cancelar</div>
      </div>
    </div>

    <div class="painel-direita" id="painelAdicionados">
      <div class="titulo-direita">Dispositivos Adicionados</div>
    </div>
  </div>

  <script>
    let selecionado = null;

    function selecionar(el) {
      if (selecionado) selecionado.classList.remove("selecionado");
      if (selecionado === el) {
        selecionado = null;
      } else {
        selecionado = el;
        selecionado.classList.add("selecionado");
      }
    }

    function moverParaDireita() {
      if (selecionado && selecionado.parentNode.id === "painelDisponiveis") {
        document.getElementById("painelAdicionados").appendChild(selecionado);
        selecionado.classList.remove("selecionado");
        selecionado = null;
      }
    }

    function moverParaEsquerda() {
      if (selecionado && selecionado.parentNode.id === "painelAdicionados") {
        document.getElementById("painelDisponiveis").appendChild(selecionado);
        selecionado.classList.remove("selecionado");
        selecionado = null;
      }
    }
  </script>
</body>
</html>
