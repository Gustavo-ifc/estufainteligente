<?php

require_once 'classes/leituras.class.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dados = $_POST;

    $leitura = new Leituras($null, $dados['estufa_id'], $dados['temperatura'], $dados['umidade_ar'], $dados['umidade_solo'], $dados['nivel_agua']);

    $conn = new mysqli("localhost", "root", "", "estufa");

    $leitura->salvar($conn);

    echo json_encode(["status" => "ok"]);
    exit;
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $leitura = new Leituras();

    $estufa = isset($_GET['estufa_id']) ? $_GET['estufa_id'] : 1;

    $dados = $leitura->listarTodasPorEstufa($estufa);

    header('Content-Type: application/json');
    echo json_encode($dados);
    exit;
}