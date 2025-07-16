<?php
require_once "classes/cad.Estufa.class.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $variedade = $_POST['variedade'];
    $responsavel = $_POST['responsavel'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $estufa = new Estufa();
    $estufa->cadastrar($nome, $variedade, $responsavel, $latitude, $longitude);

    header("Location: index.php");
    exit;
}
?>
