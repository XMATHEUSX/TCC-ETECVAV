<?php
require_once 'conexao.php';
session_start();
if (isset($_SESSION['ID'])) {
//require_once 'nucleo.php';

$paciente  		=  $_POST['nome'];
$username       =  mb_convert_case($_POST['username'], MB_CASE_TITLE, "UTF-8");
$deficiencia	=  $_POST['def'];
$email     		=  $_POST['email'];
$celular    	=  $_POST['celular'];
$data       	=  $_POST['data'];
$sexo       	=  $_POST['sexo'];
$estado     	=  $_POST['estado'];
$cidade     	=  $_POST['cidade'];
$bairro     	=  $_POST['bairro'];
$rua    		=  $_POST['rua'];
$numero     	=  $_POST['numero'];
$complemento 	=  $_POST['complemento'];
$cep       		=  $_POST['cep'];

$celularQuery = "SELECT idpac FROM paciente WHERE telefone = '$celular'";

// if (mysqli_num_rows(mysqli_query($conn,$query2))) {
// 	echo"<script language='javascript' type='text/javascript'>alert('Email já está cadastrado');window.location.href='cadastro_paciente.php'</script>";
// }
if (mysqli_num_rows($connect->query($celularQuery))) {
	echo"<script language='javascript' type='text/javascript'>alert('Celular já está cadastrado');window.location.href='cadastro_paciente.php'</script>";
}
else{

	$dados_pacinte = "INSERT INTO paciente (email,username, nome, telefone, tipo_deficiencia, genero, idade) VALUES ('$email','$username', '$paciente', '$celular', '$deficiencia', '$sexo', '$data')";

	if ($connect->query($dados_pacinte)){
				echo"<script language='javascript' type='text/javascript'>alert('Cadastro realizado');window.location.href='cadastro_paciente.php'</script>";
	}
	else{
		echo " dados Erro: ".$dados_pacinte."<br>" . mysqli_error($connect);
	}

	$query2 = "SELECT idpac FROM paciente WHERE email = '$email'";
	$select2 = $connect->query($query2);

	$array2 = mysqli_fetch_array($select2);
	$logarray2 = $array2['idpac'];

	$endereço_pacinte = "INSERT INTO endereco_pac (UF, cidade, CEP, bairro, complemento, numero,rua,idpac) VALUES ('$estado', '$cidade', '$cep', '$rua', '$bairro', '$numero','$complemento', '$logarray2')";

	if ($connect->query($endereço_pacinte)){
				echo"<script language='javascript' type='text/javascript'>alert('Cadastro realizado');window.location.href='cadastro_paciente.php'</script>";
	}
	else{
			  echo "endereço Erro : ".$endereço_pacinte."<br>" . mysqli_error($connect);
	}
	mysqli_close($connect);
}
}else{
header('location:index.php');
}
?>
