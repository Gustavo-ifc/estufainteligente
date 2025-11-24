<?php
/*

Copyright (C) 2014  Cleiton Bueno

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA


*/
// $data no formato 2012-12-12
function ConsultaTemp($data){
	# 20-01-2013 - Cleiton Bueno
	# Declarando $temp_array como array e tornando a variavel global
	$temp_array = array();

	global $temp_array;

	$sql = "SELECT data,hora,temperatura FROM temperatura where data='$data'";
	$conecta = mysqli_connect("localhost", "tempuino", "root", "") or print (mysqli_error());
	mysqli_select_db("tempuino", $conecta) or print(mysqli_error());
	
	// Abre o BD na Database e executa a consulta
	$retorno = mysqli_query( $sql, $conecta );

	if (! $retorno) {
		die('Nao pode consultar os valores: ' . mysqli_error());
	}

	return $retorno;

}



// Funcao para gravar no Banco de dados com INSERT
function GravarSQL($temp,$data,$hora){

	$sql = "INSERT INTO temperatura (data, hora, temperatura) VALUES ( '$data', '$hora', $temp)";

	$conecta = mysqli_connect("localhost", "tempuino", "root","") or print (mysqli_error());
	mysqli_select_db("tempuino", $conecta) or print(mysqli_error());

	// Abre o BD na Database arduino e executa a gravacao na tabela
	$retorno = mysqli_query( $sql, $conecta );

	if(! $retorno)
	{
		die('Nao pode inserir os dados: ' . mysqli_error());
	}
	mysqli_close($conecta);
}



?>
