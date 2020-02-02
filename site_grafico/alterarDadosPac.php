<?php
require_once 'conexao.php';
session_start();

if (isset($_SESSION['ID']))  {

      $pacAlter 	    =  mb_convert_case($_GET['nomeAlter'], MB_CASE_TITLE, "UTF-8");
      $idpac            =  $_GET['id'];
      $defAlter         =  $_GET['defAlter'];
      $emailAlter  	    =  $_GET['emailAlter'];
      $celularAlter	    =  $_GET['celularAlter'];
      $idadeAlter  	    =  $_GET['dataAlter'];
      $sexoAlter   	    =  $_GET['sexoAlter'];

      $estadoAlter 	    =  $_GET['estadoAlter'];
      $cidadeAlter    	=  $_GET['cidadeAlter'];
      $bairroAlter	    =  $_GET['bairroAlter'];
      $ruaAlter  	      =  $_GET['ruaAlter'];
      $numeroAlter	    =  $_GET['numeroAlter'];
      $complementoAlter	=   mb_convert_case($_GET['complementoAlter'], MB_CASE_TITLE, "UTF-8");
      $cepAlter      		=  $_GET['cepAlter'];

      $newQuery = "UPDATE paciente SET tipo_deficiencia = '$defAlter', nome = '$pacAlter', genero = '$sexoAlter', idade = '$idadeAlter', email = '$emailAlter', telefone = '$celularAlter' WHERE idpac = '$idpac'";


      $newQuery1 = "UPDATE endereco_pac SET UF = '$estadoAlter', cidade = '$cidadeAlter', CEP ='$cepAlter', rua = '$ruaAlter', bairro = '$bairroAlter', numero = '$numeroAlter', complemento = '$complementoAlter' WHERE  iddoc = '$idpac'";



    	if ($connect->query($newQuery)){
    				echo"<script language='javascript' type='text/javascript'>alert('Dados modificados');window.location.href='editar_pacientes.php'</script>";
    	}
    	else{
    				echo " dados Erro: ". mysqli_error($connect);
    	}

    	if ($connect->query($newQuery1)){
    				echo"<script language='javascript' type='text/javascript'>alert('Dados modificados');window.location.href='editar_pacientes.php'</script>";
    	}
    	else{
    			  echo "endereço Erro : ". mysqli_error($connect);
    	}
    	mysqli_close($connect);
    }
         
 ?>
