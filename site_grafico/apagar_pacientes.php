<?php
$id = $_GET['idPaciente'];
require_once 'conexao.php';
session_start();

if (isset($_SESSION['ID']))  {


$apagarEnderecoM = "SELECT nome FROM paciente WHERE idpac = '$id' ";

$apagarEnderecoM = "DELETE FROM endereco_pac WHERE idpac = '$id' ";
$apagarDoutor= "DELETE FROM paciente WHERE idpac = '$id' ";

if ($connect->query($apagarEnderecoM)) {

          if ($connect->query($apagarDoutor)) {
            echo"<script language='javascript' type='text/javascript'>alert('Os dados foram apagados');window.location.href='editar_pacientes.php'</script>";
          }
}
}
 elseif (isset($_SESSION['ID_MED'])) {
   header('location:medico.php');
}
else{
  header('location:index.php');
  }

 ?>
                                      <!-- <input class = \"btn btn-success btn-circle\" type='submit' name='idMedico'</input> -->
