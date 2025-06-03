<?php
require_once("../Classes/Database.class.php");

$db = new Database();
$conn = $db->getConnection();

$stmt = $conn->query("SELECT * FROM aula");
while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $linha['arquivo'] = $linha['arquivo'] ? "<a href='../uploads/aulas/{$linha['arquivo']}' download>Download</a>" : "-";
    include("itens_listagem_aulas.html");
}
?>
