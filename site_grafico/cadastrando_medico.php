<?php
require_once 'conexao.php';
session_start();
if (isset($_SESSION['ID'])) {

$medico  	  	=  mb_convert_case($_POST['nome'], MB_CASE_TITLE, "UTF-8");
$crm	          =  $_POST['crm'];
$email     		=  $_POST['email'];
$celular    	=  $_POST['celular'];
$idade       	=  $_POST['data'];
$sexo       	=  $_POST['sexo'];

$estado     	=  $_POST['estado'];
$cidade     	=  $_POST['cidade'];
$bairro     	=  $_POST['bairro'];
$rua    		  =  $_POST['rua'];
$numero     	=  $_POST['numero'];
$complemento 	=   mb_convert_case($_POST['complemento'], MB_CASE_TITLE, "UTF-8");
$cep       		=  $_POST['cep'];

$celularQuery1 = "SELECT iddoc FROM doutor WHERE telefone = '$celular'";


$iddocVerify   = "SELECT iddoc FROM doutor WHERE email = '$email'";

function generatePassword($qtyCaraceters = 8)
{
        //Letras minúsculas embaralhadas
        $smallLetters = str_shuffle('abcdefghijklmnopqrstuvwxyz');

        //Letras maiúsculas embaralhadas
        $capitalLetters = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ');

        //Números aleatórios
        $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
        $numbers .= 1234567890;

        //Caracteres Especiais
        $specialCharacters = str_shuffle('!@#$%*-');

        //Junta tudo
        $characters = $capitalLetters.$smallLetters.$numbers.$specialCharacters;

        //Embaralha e pega apenas a quantidade de caracteres informada no parâmetro
        $password = substr(str_shuffle($characters), 0, $qtyCaraceters);

        //Retorna a senha
        return $password;
}

if (mysqli_num_rows($connect->query($iddocVerify))) {
	echo"<script language='javascript' type='text/javascript'>alert('Email já está cadastrado');window.location.href='cadastro_medico.php'</script>";
}
if (mysqli_num_rows($connect->query($celularQuery1))) {
	echo"<script language='javascript' type='text/javascript'>alert('Celular já está cadastrado');window.location.href='cadastro_medico.php'</script>";
}
else{
      $generatePass = generatePassword();

  	$dadosMedico = "INSERT INTO doutor (email, nome, telefone, crm, genero, nascimento,password) VALUES ('$email', '$medico', '$celular', '$crm', '$sexo', '$idade','$generatePass')";
    $connect->query($dadosMedico);

  	//if (mysqli_query($conn,$dadosMedico)){
  		//		echo"<script language='javascript' type='text/javascript'>alert('não endereço');window.location.href='cadastro_medico.php'</script>";
  //	}
  //	else{
  	//			echo " dados Erro: ".$dadosMedico."<br>" . mysqli_error($conn);
  	//}

		$iddocQuery   = "SELECT iddoc FROM doutor WHERE email = '$email'";

		$selectZ = $connect->query($iddocQuery);


		$arrayE = mysqli_fetch_array($selectZ);
		$iddoc = $arrayE['iddoc'];

		$enderecoMedico = "INSERT INTO endereco_doc (UF, cidade, CEP, bairro, complemento, numero, rua, iddoc) VALUES ('$estado', '$cidade', '$cep', '$bairro', '$complemento', '$numero','$rua', '$iddoc')";

  	if ($connect->query($enderecoMedico)){
  				echo"<script language='javascript' type='text/javascript'>alert('Cadastro realizado com sucesso ');window.location.href='cadastro_medico.php'</script>";
  	}
  	else{
         echo"<script language='javascript' type='text/javascript'>alert($iddocQuery);window.location.href='cadastro_medico.php'</script";
  			 //echo "endereço Erro : ".print_r($selectZ)."<br>" . mysqli_error($conn);
  	}
  	mysqli_close($connect);
}
}else{
header('location:index.php');
}
?>
