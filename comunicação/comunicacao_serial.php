<?php
require("php_serial.class.php");
require("func_sql.php");

function ConnectSerial(){
	$serial = new phpSerial();

	//$serial->deviceSet("/dev/ttyACM0");
	$serial->deviceSet("COM4");
	//$serial->deviceSet("/dev/ttyS2");

	$serial->confBaudRate(9600);     //Taxa de transmissao
	$serial->confParity("none");     //Paridade
	$serial->confCharacterLength(8); //Comprimento

	$serial->confStopBits(1);        //Bits de paragem
	$serial->confFlowControl("none");//Controle

	//$serial->deviceSet("/dev/ttyS2");
	//Abrindo a conexao
	//$serial->deviceOpen("r");
	$serial->deviceOpen();


	//Tempo para comunicar e o arduino estar pronto
	sleep(2);

	//Enviar 
	$serial->sendMessage("t");

	// Tempo de espera para recever dados da Serial
	sleep(1);

	//$serial->flush();

	global $ler_serial;
	$ler_serial = $serial->readPort();


	//Fechando a conexao
	$serial->deviceClose();
}



// Expressao Regular para checar se eh 0.00, 00.0 ou 000.00
$padrao = "/^[0-9]{1,3}.[0-9][0-9]$/";


function CheckDadosCom(){
	// Para usar a variavel $ler_serial do comunicacao_serial.php tem que dar um
	// global $ler_serial aqui se nao, n�o funciona dentro da function do PHP
	global $ler_serial, $padrao;

	ConnectSerial();
	echo "lerserial:".$ler_serial." ";
	// Aqui criei um variavel leitor que receber $ler_serial mas com o trim, porque
	// algumas requisi��es a temperatura estava vindo com espa�os e com isso n�o passou na
	// express�o regular.
	$leitor = (trim($ler_serial,"\n"));
	$leitor = (trim($leitor));

//echo ("$leitor");
//	if (preg_match($padrao,$leitor)){
		print("-".$leitor."-");
		$temp_atual = (int) $leitor;
		$dados = explode("|",$leitor);
		
		//$temp_atual = trim(preg_replace("/[^0-9]/", "", $leitor));
		
		
		//VerificarTemperaturas($temp_atual);
		
		$dia=date("Y-m-d");
		$hora=date("H:i:s");
		#GravarSQL($temp_atual,$dia,$hora);
		$conexao = mysqli_connect("localhost", "root", "","estufa");
		$query = mysqli_query($conexao, "INSERT INTO leituras (estufa_id, data_hora, umidade, temperatura) VALUES (1, '$dia', '$dados[0]', '$dados[1]')");
	//	echo "INSERT INTO temperatura (etstufa_id, temperatura, umidade, data_hora) VALUES ( 1, '$dia', '$hora', '$temp_atual')";
//	}
}

?>
