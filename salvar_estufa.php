<?php
require_once 'classes/cad.Estufa.class.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $estufa = new Estufa();

    $estufa->setNome($_POST['nome']);
    $estufa->setVariedade($_POST['variedade']);
    $estufa->setResponsavel($_POST['responsavel']);
    $estufa->setLatitude($_POST['latitude']);
    $estufa->setLongitude($_POST['longitude']);

    $estufa->inserir();
    header('Location: index.php');
    exit;
}
?>
