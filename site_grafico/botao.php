<?php
    header('Content-Type: text/html; charset=utf-8');
    session_start();
    include_once("conexao.php");
    $id_paciente = $_GET['id_paciente'];
    if (isset($_SESSION['ID_MED']))  {
    //OBTEM AS SESSOES
    $sessao= "SELECT DISTINCT * FROM sessao WHERE idpac = $id_paciente ORDER BY id_sessao desc  ";
    $Ultima_sessao= "SELECT DISTINCT * FROM sessao WHERE idpac = $id_paciente ORDER BY id_sessao desc  ";
    $resultado_sessao = $connect->query($sessao);
    $resultado_ultima_sessao = $connect->query($Ultima_sessao);
    $row_usuario = mysqli_fetch_assoc($resultado_sessao);
    $data_sessao = $row_usuario['Data'];
    $duracao = $row_usuario['duracao'];
    $pontuacao = $row_usuario['pontuacao'];
    $jogo = $row_usuario['jogo'];
    $n_sessao = mysqli_fetch_row($resultado_ultima_sessao);
    $arr[] = $n_sessao[0];
    while ($n_sessao = mysqli_fetch_row($resultado_ultima_sessao))
        {
              $arr[] = $n_sessao[0];
            }
    mysqli_free_result($resultado_ultima_sessao);
    //$query = "SELECT * FROM `sessao` WHERE  id_sessao = $arr[0] ";
    $query = "SELECT * FROM `paciente` WHERE idpac = $id_paciente ";
    $resultado_usuario = $connect->query($query);
    $row_usuario = mysqli_fetch_assoc($resultado_usuario);
    $id = $row_usuario['idpac'];
    //$crm = $row_usuario['crm'];
    $nome = $row_usuario['nome'];
    $genero = $row_usuario['genero'];
    $data = $row_usuario['idade'];
    $email = $row_usuario['tipo_deficiencia'];

    list($ano, $mes, $dia) = explode('-', $data);
    // Descobre que dia é hoje e retorna a unix timestamp
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    // Descobre a unix timestamp da data de nascimento do fulano
    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    // Depois apenas fazemos o cálculo já citado :)
    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
//print_r($arr);
echo "
<!DOCTYPE html>
<html lang=\"pt-br\" charset = \"utf-8\">
<head>
  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
  <meta name=\"description\" content=\"\">
  <meta name=\"author\" content=\"\">
  <title>Dados medico</title>
  <!-- Custom fonts for this template -->
  <link rel=\"stylesheet\" href=\"https://use.fontawesome.com/releases/v5.7.0/css/all.css\" integrity=\"sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ\" crossorigin=\"anonymous\">
  <link href=\"https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i\" rel=\"stylesheet\">
  <!-- Custom styles for this template -->
  <link href=\"css/sb-admin-2.min.css\" rel=\"stylesheet\">
  <link href=\"css/btn.css\" rel=\"stylesheet\">
  <!-- Custom styles for this page -->
  <link href=\"vendor/datatables/dataTables.bootstrap4.min.css\" rel=\"stylesheet\">
<script type=\"text/javascript\">
 function alignModal(){
        var modalDialog = $(this).find(\".modal-dialog\");

        // Applying the top margin on modal dialog to align it vertically center
        modalDialog.css(\"margin-top\", Math.max(0, ($(window).height() - modalDialog.height()) / 2));
    }
    // Align modal when it is displayed
    $(\".modal\").on(\"shown.bs.modal\", alignModal);

    // Align modal when user resize the window
    $(window).on(\"resize\", function(){
        $(\".modal:visible\").each(alignModal);
        });
         function myFunction() {
  var coffee = document.forms[0];
  var txt = \"\";
  var i;
  for (i = 0; i < coffee.length; i++) {
    if (coffee[i].checked) {
      txt = txt + coffee[i].value + \" \";
    }
  }
  document.getElementById(\"order\").value = txt;
}
;
</script>
<script>
var form = document.querySelector(\"form\");
var log = document.querySelector(\"#log\");

form.addEventListener(\"submit\", function(event) {
  var data = new FormData(form);
  var output = \"\";
  for (const entry of data) {
    output = output + entry[0] + \"=\" + entry[1] + \"\r\";
  };
  log.innerText = output;
  event.preventDefault();
}, false);
</script>
<script>
}
</script>
<script type=\"text/javascript\">

function Reload () {

  var coffee = document.forms[0];
  var txt = \"\";
  var i;
  for (i = 0; i < coffee.length; i++) {
    if (coffee[i].checked) {
      txt = txt + coffee[i].value + \" \";
      document.getElementById('iframe1').src = \"gerador_de_grafico.php?num=\"+txt;
      document.getElementById('order').placeholder = txt;
    }
  }
}
;
</script>

</head>

<body id=\"page-top\">
  <!-- Page Wrapper -->
  <div id=\"wrapper\">
    <!-- Sidebar -->
    <ul class=\"navbar-nav bg-gradient-primary sidebar sidebar-dark accordion\" id=\"accordionSidebar\">
      <!-- Sidebar - Brand -->
      <a class=\"sidebar-brand d-flex align-items-center justify-content-center\" href=\"medico.php\">
        <div class=\"sidebar-brand-icon rotate-n-15\">
        <i class=\"fas fa-user-md\"></i>
        </div>
        <div class=\"sidebar-brand-text mx-3\">Clínica</div>
      </a>
      <!-- Divider -->
      <hr class=\"sidebar-divider my-0\">

      <!-- Divider -->
      <hr class=\"sidebar-divider\">
      <!-- Sidebar Toggler (Sidebar) -->
      <div class=\"text-center d-none d-md-inline\">
        <button class=\"rounded-circle border-0\" id=\"sidebarToggle\"></button>
      </div>
    </ul>
    <!-- End of Sidebar -->
    <!-- Content Wrapper -->
    <div id=\"content-wrapper\" class=\"d-flex flex-column\">
      <!-- Main Content -->
      <div id=\"content\">
        <!-- Topbar -->
        <nav class=\"navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow\">
          <!-- Sidebar Toggle (Topbar) -->
          <button id=\"sidebarToggleTop\" class=\"btn btn-link d-md-none rounded-circle mr-3\">
            <i class=\"fa fa-bars\"></i>
          </button>
          <!-- Topbar Navbar -->
          <ul class=\"navbar-nav ml-auto\">
            <!-- Nav Item - User Information -->
            <li class=\"nav-item dropdown no-arrow\">
              <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"userDropdown\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">";
                $id_ = $_SESSION['ID_MED']['usuario'];
                          $img = "SELECT  nome,img FROM Doutor WHERE iddoc = $id_";
                          $query_img = $connect->query($img);
                          $img_user =$query_img->fetch_assoc();
                          $imagem = $img_user['img'];
                          $nome_med = $img_user['nome'];
                          $_SESSION['test'] = $imagem;
                          echo "
                <span class=\"mr-2 d-none d-lg-inline text-gray-600 small\">".$nome_med."</span>
                <img class=\"img-profile rounded-circle\" src=\"$imagem\">
                </a>
                <!-- Dropdown - User Information -->
                <div class=\"dropdown-menu dropdown-menu-right shadow animated--grow-in\" aria-labelledby=\"userDropdown\">
                  <a class=\"dropdown-item\" href=\"uploadimg_med.php\">
                    <i class=\"fas fa-cogs fa-sm fa-fw mr-2 text-gray-400\"></i>
                    Trocar imagem
                  </a>
                  <div class=\"dropdown-divider\"></div>
                  <a class=\"dropdown-item\" href=\"#\" data-toggle=\"modal\" data-target=\"#logoutModal\">
                    <i class=\"fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400\"></i>
                    Sair
                  </a>
                </div>
              </li>

            </ul>

          </nav>
        <!-- End of Topbar -->
        <!-- Begin Page Content -->
        <div class=\"container-fluid\">
          <!-- Page Heading -->
          <h1 class=\"h3 mb-2 text-gray-800\">".$nome."<pre id=\"log\">
</pre></p></h1>


          <div class=\"card border-left-primary shadow h-100 py-2\">
            <div class=\"card-body\">
              <div class=\"row no-gutters align-items-center\">
                <div class=\"col mr-2\">
                  <div class=\"text-xs font-weight-bold text-primary text-uppercase mb-1\">foto De ".$nome."</div>
                  <div class=\"h5 mb-0 font-weight-bold text-gray-800\"  style=\"width:1000px;height:480px;\">

                        <div style=\"display: block;\" >

                              <div style=\"margin-top:0px;  display: block; width:100%; bottom:0px;\">";
                             if ($id == 1) {
                                echo "
                                    <img  src=\"img/xavier.jpg\" style=\"; width:300px;height:300px;margin-top=0px; margin-right:20px; position:absolute;\">";
                                             }
                                elseif ($id == 2) {
                                  echo "
                                  <img  src=\"img/joao.jpg\"   style=\"; width:300px;height:300px;margin-top=0px; margin-right:20px; position:absolute;\">";}
                                elseif ($id == 4) {
                                  echo "
                                  <img  src=\"img/pako.jpg\"   style=\"; width:300px;height:300px;margin-top=0px; margin-right:20px; position:absolute;\">";}
                                  elseif ($id == 5) {
                                  echo "
                                  <img  src=\"img/franchesco.jpeg\"   style=\"; width:300px;height:310px;margin-top=0px; margin-right:20px; position:absolute;\">";}
                                else{
                                  echo "<img  src=\"img/unknow.png\"   style=\"; width:300px;height:300px;margin-top=0px; margin-right:20px; position:absolute;\">";
                                }

                                echo "


                                <div style=\"width: 770px; height: 500px; margin-top:-50px; margin-left:315px; position:absolute;\"><iframe id=\"iframe1\" width=\"100%\" height=\"100%\" frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\" ></iframe></div>

                                <div style=\" margin-top: 350px; margin-left:60%; position:absolute;\">

                        <a href=\"#myModal\" class=\"btn btn-lg btn-primary\" data-toggle=\"modal\">Alterar sessão</a>
                          <div class=\"modal fade\" id=\"myModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
                            <div class=\"modal-dialog\">
                              <div class=\"modal-content\">
                                <div class=\"modal-header\">
                                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">×</span></button>
                                    <h4 class=\"modal-title\" id=\"myModalLabel\">Sessões</h4>
                                 </div>
                                <div class=\"modal-body\">
                                  <form action=\"/botao.php\">";
                                  foreach ($arr as $value):
                                   echo "
  <input type=\"radio\" name=\"coffee\"  id=\"radio".$value."\"  value=\"".$value."\" /> ".$value."<br>

  <br>


                                  ";
                                 endforeach;
                              echo "
</form>

                                </div>
                                <div class=\"modal-footer\">
                                  <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Fechar</button>
                                  <button onclick=\"Reload()\" type=\"button\" class=\"btn btn-primary\" value=\"Reload\" data-dismiss=\"modal\">Selecionar</button>
                                  </form>
                                </div>

                              </div>

                            </div>

                          </div>

                          </div>
</div>

                              </div>
                        <div style=\"width:300px; padding-top:23%;position:relative;\">
                 <div style=\"width:300px; margin-top:15%; position:relative;\">
                      <br>
                      <br>
                      <b>Nome</b>: ".$nome."
                      <br><br>
                      <b>Idade</b>: ".$idade."
                      <br><br>
                      <b>Genêro</b>: ".$genero."
                      <br><br>
                      <b>Diagnóstico</b>: ".$email."

                </div>

                </div>
                    </div>


              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->
      <!-- Footer -->
      <footer class=\"sticky-footer bg-white\">
        <div class=\"container my-auto\">
          <div class=\"copyright text-center my-auto\">
              <!--Copyright &copy; Your Website 2019-->
          </div>
        </div>
      </footer>
      <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->
  <!-- Scroll to Top Button-->
  <a class=\"scroll-to-top rounded\" href=\"#page-top\">
    <i class=\"fas fa-angle-up\"></i>

  </a>
  <!-- Logout Modal-->
  <div class=\"modal fade\" id=\"logoutModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">
    <div class=\"modal-dialog\" role=\"document\">
      <div class=\"modal-content\">
        <div class=\"modal-header\">
          <h5 class=\"modal-title\" id=\"exampleModalLabel\">Deseja sair?</h5>
          <button class=\"close\" type=\"button\" data-dismiss=\"modal\" aria-label=\"Close\">
            <span aria-hidden=\"true\">×</span>
          </button>
        </div>
        <div class=\"modal-footer\">
          <button class=\"btn btn-secondary\" type=\"button\" data-dismiss=\"modal\">Cancelar</button>
          <a class=\"btn btn-primary\" href=\"sair.php\">Sair</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src=\"vendor/jquery/jquery.min.js\"></script>
  <script src=\"vendor/bootstrap/js/bootstrap.bundle.min.js\"></script>
  <!-- Core plugin JavaScript-->
  <script src=\"vendor/jquery-easing/jquery.easing.min.js\"></script>
  <!-- Custom scripts for all pages-->
  <script src=\"js/sb-admin-2.min.js\"></script>
  <!-- Page level plugins -->
  <script src=\"vendor/datatables/jquery.dataTables.min.js\"></script>
  <script src=\"vendor/datatables/dataTables.bootstrap4.min.js\"></script>
  <!-- Page level custom scripts -->
  <script src=\"js/demo/datatables-demo.js\"></script>

</body>
</html>";
}
elseif (isset($_SESSION['ID'])) {
   header('location:dashboard.php');
}
else{
  header('location:index.php');
  }
?>
