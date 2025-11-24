<?php
// Criar a pasta uploads se não existir
if (!is_dir("uploads")) {
    mkdir("uploads", 0777, true);
}

$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$senha = $_POST['senha'] ?? '';
$endereco = $_POST['endereco'] ?? '';
$cidade = $_POST['cidade'] ?? '';
$cep = $_POST['cep'] ?? '';

// --- UPLOAD DA FOTO ---
if (!empty($_FILES['foto']['name'])) {

    $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));

    // Verifica se é imagem
    $permitidos = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($ext, $permitidos)) {

        $novo_nome = "perfil." . $ext; // sempre substitui a antiga
        $destino = "uploads/" . $novo_nome;

        move_uploaded_file($_FILES['foto']['tmp_name'], $destino);

        // Troca a foto padrão
        $foto_final = $destino;

    } else {
        $foto_final = "uploads/perfil.jpg"; // caso dê erro
    }

} else {
    // Se o usuário não enviar imagem, mantém a atual
    $foto_final = "uploads/perfil.jpg";
}

// Aqui você pode salvar os dados no banco depois
// (se quiser, preparo isso também)

// Redireciona de volta
header("Location: editar_perfil.php");
exit;
?>
