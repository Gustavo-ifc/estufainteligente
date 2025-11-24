<?php
session_start();
require_once 'classes/conexao.php';

if(isset($_POST['nome'], $_POST['email'], $_POST['numero'], $_POST['senha'], $_POST['confirma_senha'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $numero = $_POST['numero'];
    $senha = $_POST['senha'];
    $confirma_senha = $_POST['confirma_senha'];

    // Verifica se as senhas conferem
    if($senha !== $confirma_senha){
        header("Location: cadastro.php?erro=senhas");
        exit;
    }

    // Verifica se o nome ou email já existe
    $stmt = $pdo->prepare("SELECT * FROM cadastro WHERE nome = :nome OR email = :email");
    $stmt->execute(['nome' => $nome, 'email' => $email]);
    if($stmt->rowCount() > 0){
        header("Location: cadastro.php?erro=existe");
        exit;
    }

    // Hash da senha
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // Insere no banco
    $stmt = $pdo->prepare("INSERT INTO cadastro (nome, email, numero, senha) VALUES (:nome, :email, :numero, :senha)");
    $stmt->execute([
        'nome' => $nome,
        'email' => $email,
        'numero' => $numero,
        'senha' => $senhaHash
    ]);

    // Redireciona para login
    header("Location: login.php");
    exit;
} else {
    echo "Preencha todos os campos!";
}
?>
