<?php
require_once 'conexao.php';
session_start();

if (isset($_SESSION['ID']))  {

      $medicoAlter 	    =  mb_convert_case($_GET['nomeAlter'], MB_CASE_TITLE, "UTF-8");
      $iddoc            =  $_GET['id'];
      $crmAlter         =  $_GET['crmAlter'];
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

      $newQuery = "UPDATE doutor SET crm = '$crmAlter', nome = '$medicoAlter', genero = '$sexoAlter', nascimento = '$idadeAlter', email = '$emailAlter', telefone = '$celularAlter' WHERE iddoc = '$iddoc'";


      $newQuery1 = "UPDATE endereco_doc SET UF = '$estadoAlter', cidade = '$cidadeAlter', CEP ='$cepAlter', rua = '$ruaAlter', bairro = '$bairroAlter', numero = '$numeroAlter', complemento = '$complementoAlter' WHERE  iddoc = '$iddoc'";


    	if ($connect->query($newQuery)){
    				echo"<script language='javascript' type='text/javascript'>alert('Dados modificados');window.location.href='editar_medicos.php'</script>";
    	}
    	else{
    				echo " dados Erro: ". mysqli_error($connect);
    	}

    	if ($connect->query($newQuery1)){
    				echo"<script language='javascript' type='text/javascript'>alert('Dados modificados');window.location.href='editar_medicos.php'</script>";
    	}
    	else{
    			  echo "endereço Erro : ". mysqli_error($connect);
    	}
    	mysqli_close($connect);
    }
      elseif (isset($_SESSION['ID_MED'])) {
   header('location:medico.php');
}
else{
  header('location:index.php');
  }
 ?>
}
