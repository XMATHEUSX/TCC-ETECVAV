<?php

session_start();
if (isset($_SESSION['ID_MED']))  {
require_once 'conexao.php';

ini_set('upload_max_filesize', '2M');
header('Content-Type: application/json');
$file = $_FILES['file'];

$ret = [];

$FileNameNew = uniqid('', true).".".$file['name'];
$FileDestination = 'upload/perfil/'.$FileNameNew;

if(move_uploaded_file($file['tmp_name'],'upload/perfil/'.$FileNameNew)){
    $ret["status"] = "success";
    $ret["path"] = 'upload/perfil/'. $file['name'];
    $ret["name"] = $file['name'];

    $id_ = $_SESSION['ID_MED']['usuario'];
    $img_result ="UPDATE doutor SET img = '$FileDestination' WHERE iddoc = $id_";
    $query = mysqli_query( $connect, $img_result);

}else{
    $ret["status"] = "error";
    $ret["name"] = $file['name'];
}

echo json_encode($ret, JSON_PRETTY_PRINT);
}
elseif (isset($_SESSION['ID_MED'])) {
   header('location:medico.php');
}
else{
  header('location:index.php');
  }
?>
