<?php
require_once("../Classes/Database.class.php");
require_once("../Classes/Aula.class.php");

$db = new Database();
$conn = $db->getConnection();


if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];
    $stmt = $conn->prepare("DELETE FROM aula WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: listagem_aula.html");
    exit;
}


if (isset($_POST['salvar'])) {
    $id = $_POST['id'];
    $instrutor = $_POST['instrutor'];
    $aluno = $_POST['aluno'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];
    $veiculo = $_POST['veiculo'];

    $arquivo = '';
    if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] == 0) {
        $arquivo = basename($_FILES['arquivo']['name']);
        $destino = "../uploads/aulas/" . $arquivo;
        move_uploaded_file($_FILES['arquivo']['tmp_name'], $destino);
    }

    if ($id == '') {
        $stmt = $conn->prepare("INSERT INTO aula (instrutor, aluno, data, hora, veiculo, arquivo) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$instrutor, $aluno, $data, $hora, $veiculo, $arquivo]);
    } else {
        $stmt = $conn->prepare("UPDATE aula SET instrutor=?, aluno=?, data=?, hora=?, veiculo=?, arquivo=? WHERE id=?");
        $stmt->execute([$instrutor, $aluno, $data, $hora, $veiculo, $arquivo, $id]);
    }

    header("Location: listagem_aula.html");
    exit;
}
?>
