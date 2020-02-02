<?php
session_start();

$id_rh = $_SESSION['ID'];

require_once 'conexao.php';
if (isset($_SESSION['ID']) == False){
      header('location:index.php');
}

if($_POST){
  $primeiroNome = $_POST['primeiroNome'];
  $ultimoNome = $_POST['ultimoNome'];
  $email = $_POST['email'];
  $senha = $_POST['senha'];
  $senhaConf = $_POST['senhaConf'];



    $verisql = "SELECT Clinica FROM rh  WHERE rh_id = '$id_rh' ";
    $veriresultado = $connect->query($verisql);

    $valor = $veriresultado->fetch_assoc();
    $clinica = $valor['Clinica'];


    $insertUserRh = "INSERT INTO userrh (primeiro, ultimo, email, senha, clinica_ID, rh_id) VALUES ('$primeiroNome', '$ultimoNome', '$email', '$senha', '$clinica', '$id_rh')";


    if (mysqli_query($connect,$insertUserRh)) {
      $updateRH = "UPDATE rh SET troca_Senha = '1' WHERE rh_id = $id_rh";

      if (mysqli_query($connect,$updateRH)) {
        $_SESSION['ID'] = $id_rh;
        header('Location: dashboard.php');
      	mysqli_close($connect);
      }
    }

 }

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Alterar Senha</title>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

  <link href="css/sb-admin-2.min.css" rel="stylesheet">


</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">

        <div class="row">
          <img style="width: 15rem; margin-top: 40px; margin-left: 50px;" src="img/undraw_personal_info_0okl.svg">
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Sua primeira vez?</h1>
              </div>
              <form class="user" method="post">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="primeiroNome" placeholder="Primeiro nome">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="ultimoNome" placeholder="Último nome">
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user"name="email" placeholder="Email">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" name="senha" placeholder="Senha">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" name="senhaConf" placeholder="Confirme a senha" onblur="validarSenha('senha','senha1')">
                  </div>
                </div>
            </div>
          </div>

          <input class="btn btn-primary form-control form-control-user" type="submit" value="Acessar" style="height:40px;"></input>
        </div>
      </div>
    </div>
                  </form>


  </div>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>


  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
