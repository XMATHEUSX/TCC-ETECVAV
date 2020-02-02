<?php
	$servidor = "localhost";
	$usuario = "root";
	$senha = "";
	$dbname = "clinica";

	//Criar a conexao
	$connect = mysqli_connect($servidor, $usuario, $senha, $dbname);
	//verificar conexao
	if($connect->connect_error){
		die('Conexão falhou :'.$connect->connect_error);
	}else {
		//echo "Conectado com Sucesso"
	}

?>
