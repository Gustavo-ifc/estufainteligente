<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Perfil do Usuário</title>
  <link rel="stylesheet" href="css/perfil.css">
</head>
<body>
  <div class="card">
    <h2>Alterar Foto de Perfil</h2>
    <img id="preview" src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="Foto de Perfil" />
    <br>
    <input type="file" id="fileInput" accept="image/*" />
    <br>
    <button onclick="salvarFoto()">Salvar</button>
  </div>

  <script>
    const input = document.getElementById("fileInput");
    const preview = document.getElementById("preview");

    input.addEventListener("change", function () {
      const file = input.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          preview.src = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    });

    function salvarFoto() {
      localStorage.setItem("fotoPerfil", preview.src);
      alert("Foto de perfil salva!");
      window.location.href = "index.html";
    }
  </script>
</body>
</html>
