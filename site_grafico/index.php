<?php
require_once 'conexao.php';

session_start();

if (isset($_SESSION['ID']))  {
    header('location:dashboard.php');
}
elseif (isset($_SESSION['ID_MED'])) {
   header('location:medico.php');
}

$erros = array();

if($_POST){
  $clinica = $_POST['clinica'];
  $usuario = $_POST['username'];
  $senha = $_POST['senha'];
  $tipo = $_POST['tipo'];

  if ($tipo == "RH") {

    $sqlClinica = "SELECT Clinica FROM rh WHERE Clinica = '$clinica'";
    $resultadoClinica = $connect->query($sqlClinica);

    if ($resultadoClinica-> num_rows >= 1) {

      $sqlClinicaT = "SELECT troca_Senha FROM rh WHERE Clinica = '$clinica'";
      $resultadoClinicaT = $connect->query($sqlClinicaT);

      if ($resultadoClinicaT-> num_rows >= 1) {

        $newSenha = $resultadoClinicaT->fetch_assoc();
        $troca_Senha = $newSenha['troca_Senha'];

        if ($troca_Senha == 1) {

          $sql = "SELECT * FROM userrh  WHERE email = '$usuario'";
          $resultado = $connect->query($sql);


          if ($resultado-> num_rows >= 1) {
            $senha = $senha;
            //existe
            $verisql = "SELECT * FROM userrh  WHERE email = '$usuario' AND senha = '$senha'";
            $veriresultado = $connect->query($verisql);

              if ($veriresultado-> num_rows >= 1) {
                $valor = $veriresultado->fetch_assoc();
                $user_id = $valor['rh_id'];
                //setando sessão
                $_SESSION['ID'] = $user_id;
                header('Location: dashboard.php');
              }
              else {
                $erros[] ="Usuário e/ou Senha incorreto";
              }
          }else {
            $erros[] = "Usuário e/ou Senha incorreto";
          }

        }
        else{
          $verisqla = "SELECT * FROM rh  WHERE username = '$usuario' AND senha = '$senha'";
          $veriresultadoa = $connect->query($verisqla);


          $valora = $veriresultadoa->fetch_assoc();
          $user_id = $valora['rh_id'];

          $_SESSION['ID'] = $user_id;
          header('Location: register.php');
        }
      }
    }
  }

  elseif ($tipo == "Doutor") {
    $sql = "SELECT * FROM doutor WHERE iddoc = '$usuario'";
    $resultado = $connect->query($sql);

    if ($resultado-> num_rows == 1) {
      $senha = $senha;
      //existe
      $verisql = "SELECT * FROM doutor WHERE iddoc = '$usuario' AND password = '$senha'";
      $veriresultado = $connect->query($verisql);

      if ($veriresultado-> num_rows == 1) {
        $valor = $veriresultado->fetch_assoc();
        $user_id = $valor['iddoc'];
        //setando sessão
        $_SESSION['ID_MED'] = array('usuario' => $user_id);
        header('Location: medico.php');
      }
      else {
        $erros[] ="Usuário e/ou Senha incorreto";
      }
    }else {
      $erros[] = "Usuário e/ou Senha incorreto";
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
    <link rel="stylesheet" type="text/css" href="css/sb-admin-2.min.css">

    <title>Login</title>
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        select {
            -webkit-appearance: none;
            -moz-appearance: none;
            text-indent: 1px;
            text-overflow: '';
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

        select {
            -moz-appearance: textfield;
        }
    </style>
</head>

<body class="bg-gradient-primary">
    <form action="index.php" method="POST">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block"><img style="width: 15rem; margin-top: 40px; margin-left: 50px;" src="img/undraw_Login_v483.svg"></div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Seja Bem-vindo</h1></div>
                                        <!-- <form class="user"> -->
                                            <input class="form-control form-control-user" type="number" placeholder="Clínica..." name="clinica" required/>
                                            <br>
                                            <select class="form-control form-control-user" name="tipo" required>
                                                <option value="RH">RH</option>
                                                <option value="Doutor">Médico</option>
                                            </select>
                                            <br>
                                            <div class="form-group">
                                                <input type="text" name="username" class="form-control form-control-user" id="username" placeholder="Digite o seu usuário" required/>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="senha" class="form-control form-control-user" id="senha" placeholder="Senha" required>
                                            </div>
                                            <?php  if ($erros) {foreach ($erros as $key => $value) {  echo $value;}}?>
                                                <input class="btn btn-primary form-control form-control-user" type="submit" value="Acessar" style="height: 40px;"/>
                                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</body>

</html>
