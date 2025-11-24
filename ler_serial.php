<?php
$port = fopen('COM4', 'r+b');
sleep(1);
$leitura =  fgets($port);
fclose($port);

$dia=date("Y-m-d");
		$hora=date("H:i:s");
		#GravarSQL($temp_atual,$dia,$hora);
		$conexao = mysqli_connect("localhost", "root", "","estufa");
		$query = mysqli_query($conexao, "INSERT INTO leituras (estufa_id, data_hora, umidade, temperatura) VALUES (1, '$dia', '$dados[0]', '$dados[1]')");
?>
