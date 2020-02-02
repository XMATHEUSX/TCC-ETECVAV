<?php
 header('Content-Type: text/html; charset=utf-8');
    session_start();
    if (isset($_SESSION['ID']))  {
    include_once("conexao.php");
    //duracao
    $select_duracao ="SELECT SUM(duracao) as duracao FROM sessao";
    $resultado_duracao = $connect->query($select_duracao);
    $row_duracao = mysqli_fetch_row($resultado_duracao);
    $duracao = $row_duracao[0];
    //pontuacao
    $select_pontuacao ="SELECT SUM(pontuacao) as pontuacao FROM sessao";
    $resultado_pontuacao = $connect->query($select_pontuacao);
    $row_pontuacao = mysqli_fetch_row($resultado_pontuacao);
    $pontuacao = $row_pontuacao[0];//MUDAR O NOME DA VARIAVEL PRESUNTO E PÃO
    //
    //p
    $select_jogo ="SELECT COUNT( * ) jogo ,jogo as id FROM sessao GROUP BY jogo DESC ";
    $resultado_jogo = $connect->query($select_jogo);
    $row_jogo = mysqli_fetch_assoc($resultado_jogo);
    $jogo = $row_jogo['id'];
    $qtd = $row_jogo['jogo'];
    //
    echo "
<!DOCTYPE html>
<html lang=\"pt-br\">

<head>

  <meta charset=\"utf-8\">
  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
  <meta name=\"author\" content=\"\">

  <title>Clinica</title>

  <!-- Custom fonts for this template-->
  <link rel=\"stylesheet\" href=\"https://use.fontawesome.com/releases/v5.7.0/css/all.css\" integrity=\"sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ\" crossorigin=\"anonymous\">
  <link href=\"https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i\" rel=\"stylesheet\">

  <!-- Custom styles for this template-->
  <link href=\"css/sb-admin-2.min.css\" rel=\"stylesheet\">

</head>

<body id=\"page-top\">

  <!-- Page Wrapper -->
  <div id=\"wrapper\">

    <!-- Sidebar -->
    <ul class=\"navbar-nav bg-gradient-primary sidebar sidebar-dark accordion\" id=\"accordionSidebar\">

      <!-- Sidebar - Brand -->
      <a class=\"sidebar-brand d-flex align-items-center justify-content-center\" href=\"dashboard.php\">
        <div class=\"sidebar-brand-icon rotate-n-15\">
        <i class=\"fas fa-user-alt\"></i>
        </div>
        <div class=\"sidebar-brand-text mx-3\">Clínica</div>
      </a>

      <!-- Divisão -->
      <hr class=\"sidebar-divider my-0\">

      <!-- Nav Item - Dashboard -->
      <li class=\"nav-item active\">
        <a class=\"nav-link\" href=\"dashboard.php\">
          <span>Painel de administração</span></a>
      </li>

      <!-- Divisão -->
      <hr class=\"sidebar-divider\">


      <!-- Nav Item - Pages Collapse Menu -->
      <li class=\"nav-item\">
        <a class=\"nav-link collapsed\" href=\"#page-top\" data-toggle=\"collapse\" data-target=\"#collapseTwo\" aria-expanded=\"true\" aria-controls=\"collapseTwo\">
          <i class=\"fas fa-user-md\"></i>
          <span>Médicos</span>
        </a>
        <div id=\"collapseTwo\" class=\"collapse\" aria-labelledby=\"headingTwo\" data-parent=\"#accordionSidebar\">
          <div class=\"bg-white py-2 collapse-inner rounded\">
            <a class=\"collapse-item\" href=\"cadastro_medico.php\">Cadastrar</a>
            <a class=\"collapse-item\" href=\"editar_medicos.php\">Editar</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class=\"nav-item\">
        <a class=\"nav-link collapsed\" href=\"#\" data-toggle=\"collapse\" data-target=\"#collapseUtilities\" aria-expanded=\"true\" aria-controls=\"collapseUtilities\">
          <i class=\"fas fa-wheelchair\"></i>
          <span>Paciente</span>
        </a>
        <div id=\"collapseUtilities\" class=\"collapse\" aria-labelledby=\"headingUtilities\" data-parent=\"#accordionSidebar\">
          <div class=\"bg-white py-2 collapse-inner rounded\">
            <a class=\"collapse-item\" href=\"cadastro_paciente.php\">Cadastrar</a>
            <a class=\"collapse-item\" href=\"editar_pacientes.php\">Editar</a>
          </div>
        </div>
      </li>


      <!-- Divisão -->
      <hr class=\"sidebar-divider d-none d-md-block\">

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
               $id_ = $_SESSION['ID'];
              $img = "SELECT primeiro,ultimo,img FROM userrh WHERE rh_id = $id_";
                          $query_img = $connect->query($img);
                          $img_user =$query_img->fetch_assoc();
                          $imagem = $img_user['img'];
                          $nome_first = $img_user['primeiro'];
                          $nome_last = $img_user['ultimo'];
                          $_SESSION['test'] = $imagem;
                          echo "
                <span class=\"mr-2 d-none d-lg-inline text-gray-600 small\">".$nome_first ." ". $nome_last ."</span>


                  <img class=\"img-profile rounded-circle\" src=\"$imagem\">";
                echo "</a>
                <!-- Dropdown - User Information -->
                <div class=\"dropdown-menu dropdown-menu-right shadow animated--grow-in\" aria-labelledby=\"userDropdown\">
                  <a class=\"dropdown-item\" href=\"uploadimg.php\">
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
          <div class=\"d-sm-flex align-items-center justify-content-between mb-4\">
            <h1 class=\"h3 mb-0 text-gray-800\">Painel de administração</h1>
          </div>

          <!-- Content Row -->

          <div class=\"row\">
            
<div class=\"col-xl-3 col-md-6 mb-4\">
              <div class=\"card border-left-primary shadow h-100 py-2\">
                <div class=\"card-body\">
                  <div class=\"row no-gutters align-items-center\">
                    <div class=\"col mr-2\">
                      <div class=\"text-xs font-weight-bold text-primary text-uppercase mb-1\">Duração de todos os jogos somados</div>
                      <div class=\"h5 mb-0 font-weight-bold text-gray-800\">".$duracao." Minutos</div>
                    </div>
                    <div class=\"col-auto\">
                      <i class=\"fas fa-calendar fa-2x text-gray-300\"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
             <div class=\"col-xl-3 col-md-6 mb-4\">
              <div class=\"card border-left-primary shadow h-100 py-2\">
                <div class=\"card-body\">
                  <div class=\"row no-gutters align-items-center\">
                    <div class=\"col mr-2\">
                      <div class=\"text-xs font-weight-bold text-primary text-uppercase mb-1\">Pontuação de todos os jogos somados</div>
                      <div class=\"h5 mb-0 font-weight-bold text-gray-800\">".$pontuacao." Moedas Coletadas</div>
                    </div>
                    <div class=\"col-auto\">
                      <i class=\"fas fa-calendar fa-2x text-gray-300\"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class=\"col-xl-3 col-md-6 mb-4\">
              <div class=\"card border-left-primary shadow h-100 py-2\">
                <div class=\"card-body\">
                  <div class=\"row no-gutters align-items-center\">
                    <div class=\"col mr-2\">
                      <div class=\"text-xs font-weight-bold text-primary text-uppercase mb-1\">

                      <a style=\"\">Jogo Mais Jogado</a></div>
                      <div class=\"h5 mb-0 font-weight-bold text-gray-800\"></div>";
                      if ($jogo == 2) {
                      echo "
                      <div class=\"h5 mb-0 font-weight-bold text-gray-800\">Game Run</div>";
                      }
                    elseif ($jogo == 1) {
                      echo "
                      <div class=\"h5 mb-0 font-weight-bold text-gray-800\">Happy Hill</div>";
                    }
                    echo "
                    </div>
                    <div class=\"col mr-2\">
                    <div class=\"text-xs font-weight-bold text-primary text-uppercase mb-1\">
                        <a style=\"padding-left:0%;\">Quantidade de vezes jogadas</a>
                        </div>
                      
                      <div class=\"h5 mb-0 font-weight-bold text-gray-800\"></div>
                      
                      <div class=\"h5 mb-0 font-weight-bold text-gray-800 style:\"padding-left:100px;\">$qtd</div>
                    
                    </div>
                    <div class=\"col-auto\">";
                     if ($jogo == 2) {
                      echo "
                      <img  src=\"img/bolinha.png\"style=\"; width:75px;height:75px;margin-top=0px; margin-right:15%;\">";
                      }
                    elseif ($jogo == 1) {
                      echo "
                      <img  src=\"img/coelho.png\"style=\"; width:75px;height:75px;margin-top=0px; margin-right:15%;\">";
                    }
                    echo "
                    </div>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
            <!-- Area Chart -->
            <div class=\"col-xl-8 col-lg-7\">
              <div class=\"card shadow mb-4\">
                <!-- Card Header - Dropdown -->
                <div class=\"card shadow mb-4\">
                <div class=\"card-header py-3\">
                  <h6 class=\"m-0 font-weight-bold text-primary\">Sessões por mês</h6>
                </div>
                <div class=\"card-body\">
                  <div class=\"chart-bar\"><div class=\"chartjs-size-monitor\"><div class=\"chartjs-size-monitor-expand\"><div class=\"\"></div></div><div class=\"chartjs-size-monitor-shrink\"><div class=\"\"></div></div></div>
                    <canvas id=\"myBarChart\" style=\"display: block; width: 1037px; height: 320px;\" width=\"1037\" height=\"320\" class=\"chartjs-render-monitor\"></canvas>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Pie Chart 
            <div class=\"col-xl-4 col-lg-5\">
              <div class=\"card shadow mb-4\">
                 Card Body 
                <div class=\"card-body\">
                  <div class=\"chart-pie pt-4 pb-2\">
                    <div class=\"text-center\">
                      <img class=\"img-fluid px-3 px-sm-4 mt-3 mb-4\" style=\"width: 25rem;\" src=\"img/undraw_posting_photo.svg\" alt=\"\">
                    </div>
                  </div>

                </div>
              </div>
            </div>-->
          </div>

          <!-- Content Row -->


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

  <div class=\"modal fade\" id=\"logoutModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">
    <div class=\"modal-dialog\" role=\"document\">
      <div class=\"modal-content\">
        <div class=\"modal-header\">
          <h5 class=\"modal-title\" id=\"exampleModalLabel\">Deseja apagar todos os dados do médico selecionado?</h5>
          <button class=\"close\" type=\"button\" data-dismiss=\"modalApagar\" aria-label=\"Close\">
            <span aria-hidden=\"true\">×</span>
          </button>
        </div>
        <div class=\"modal-footer\">
          <button class=\"btn btn-secondary\" type=\"button\" data-dismiss=\"modalApagar\">Cancelar</button>
          <a class=\"btn btn-primary\" href=\"editar_medicos.php\">Sair</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src=\"vendor/jquery/jquery.min.js\"></script>
  <script src=\"vendor/bootstrap/js/bootstrap.bundle.min.js\"></script>

  <!-- Core plugin JavaScript-->
  <!-- <script src=\"vendor/jquery-easing/jquery.easing.min.js\"></script> -->

  <!-- Custom scripts for all pages-->
  <script src=\"js/sb-admin-2.min.js\"></script>

  <!-- Page level plugins -->
  <script src=\"vendor/chart.js/Chart.min.js\"></script>

  <!-- Page level custom scripts -->
  <script src=\"js/demo/chart-bar-demo.php\"></script>
  <script src=\"js/demo/chart-area-demo.js\"></script>

</body>

</html>
";
}
else{
header('location:index.php');
}
?>
