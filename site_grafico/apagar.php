<?php
$id = $_GET['idMedico'];
 require_once 'conexao.php';
 session_start();

if (isset($_SESSION['ID']))  {

$apagarEnderecoM = "SELECT nome FROM doutor WHERE iddoc = '$id' ";

$apagarEnderecoM = "DELETE FROM endereco_doc WHERE iddoc = '$id' ";
$apagarDoutor= "DELETE FROM doutor WHERE iddoc = '$id' ";

if ($connect->query($apagarEnderecoM)) {

          if ($connect->query($apagarDoutor)) {
            echo"<script language='javascript' type='text/javascript'>alert('Os dados foram apagados');window.location.href='editar_medicos.php'</script>";
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
