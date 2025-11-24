<?php
session_start();
require_once 'classes/conexao.php';

if(isset($_POST['nome'], $_POST['senha'])){
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

    $stmt = $pdo->prepare("SELECT * FROM cadastro WHERE nome = :nome");
    $stmt->execute(['nome' => $nome]);
    $usuario = $stmt->fetch();

    if($usuario && password_verify($senha, $usuario['senha'])){
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['nome_usuario'] = $usuario['nome'];
        header("Location: index.php");
        exit;
    } else {
        echo "<script>alert('Usuário ou senha incorretos!');window.location='login.php';</script>";
    }
} else {
    echo "<script>alert('Preencha todos os campos!');window.location='login.php';</script>";
}
?>
