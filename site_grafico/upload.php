<?php
session_start();
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

    $id_ = $_SESSION['ID'];
    $img_result ="UPDATE userrh SET img = '$FileDestination' WHERE rh_id = $id_";
    $query = mysqli_query( $connect, $img_result);

}else{
    $ret["status"] = "error";
    $ret["name"] = $file['name'];
}

echo json_encode($ret, JSON_PRETTY_PRINT);
?>
