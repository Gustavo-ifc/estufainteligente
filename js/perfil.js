function carregarFotoPerfil() {
  const img = document.getElementById("fotoPerfil");
  const fotoSalva = localStorage.getItem("fotoPerfil");

  if (fotoSalva && img) {
    img.src = fotoSalva;
  }
}
