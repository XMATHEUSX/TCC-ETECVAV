<?php
    header('Content-Type: text/html; charset=utf-8');
    session_start();
    require_once 'conexao.php';
if (isset($_SESSION['ID'])) {

    $loop=1;
    $vart[]=0;
    $coc=0;
echo "
<!DOCTYPE html>
<html lang=\"pt-br\" charset = \"utf-8\">
<head>
  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
  <meta name=\"description\" content=\"\">
  <meta name=\"author\" content=\"\">
  <title>Dados médicos</title>
  <!-- Custom fonts for this template -->
  <link rel=\"stylesheet\" href=\"https://use.fontawesome.com/releases/v5.7.0/css/all.css\" integrity=\"sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ\" crossorigin=\"anonymous\">
  <link href=\"https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i\" rel=\"stylesheet\">
  <!-- Custom styles for this template -->
  <link href=\"css/sb-admin-2.min.css\" rel=\"stylesheet\">
  <!-- Custom styles for this page -->
  <link href=\"vendor/datatables/dataTables.bootstrap4.min.css\" rel=\"stylesheet\">
</head>
<body id=\"page-top\">
  <!-- Page Wrapper -->
  <div id=\"wrapper\">
    <!-- Sidebar -->
    <ul class=\"navbar-nav bg-gradient-primary sidebar sidebar-dark accordion\" id=\"accordionSidebar\">
      <!-- Sidebar - Brand -->
      <a class=\"sidebar-brand d-flex align-items-center justify-content-center\" href=\"dashboard.php\">
        <div class=\"sidebar-brand-icon rotate-n-15\">
        <i class=\"fas fa-user-edit\"></i>
        </div>
        <div class=\"sidebar-brand-text mx-3\">Clínica</div>
      </a>
      <!-- Divider -->
      <hr class=\"sidebar-divider my-0\">
      <!-- Nav Item - Dashboard -->
      <li class=\"nav-item active\">
        <a class=\"nav-link\" href=\"dashboard.php\">
          <span>Painel de administração</span></a>
      </li>
      <!-- Divider -->
      <hr class=\"sidebar-divider\">
      <!-- Nav Item - Pages Collapse Menu -->
      <li class=\"nav-item\">
        <a class=\"nav-link collapsed\" href=\"#\" data-toggle=\"collapse\" data-target=\"#collapseTwo\" aria-expanded=\"true\" aria-controls=\"collapseTwo\">
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
          <h1 class=\"h3 mb-2 text-gray-800\">Médicos</h1>
          <!-- DataTales Example -->
          <div class=\"card shadow mb-4\">
            <div class=\"card-header py-3\">
              <h6 class=\"m-0 font-weight-bold text-primary\">Dados dos médicos</h6>

            </div>
            <div class=\"card-body\">
              <div class=\"table-responsive\">
                <table class=\"table table-bordered\" id=\"dataTable\" width=\"100%\" cellspacing=\"0\">
                  <thead>
                    <tr>
                      <th>CRM</th>
                      <th>Nome</th>
                      <th>Gênero</th>
                      <th>Data de nascimeto</th>
                      <th>Email</th>
                      <th>Telefone</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>";

                  $query2 ="SELECT * FROM doutor ORDER BY iddoc DESC LIMIT 1"; // PEGA O ULTIMO ID DA TABELA
                  $novo = $connect->query($query2);
                  $novoo = mysqli_fetch_row($novo);
                  $idd = ($novoo[0]);
                  do {
                  $result_usuario = "SELECT iddoc, crm, nome, genero, nascimento, email, telefone FROM doutor WHERE iddoc = $loop LIMIT 1";
                  		$resultado_usuario = $connect->query($result_usuario);
                  		if($resultado_usuario){
                  			$row_usuario = mysqli_fetch_assoc($resultado_usuario);
                  					$id = $row_usuario['iddoc'];
                  					$crm = $row_usuario['crm'];
                  					$nome = $row_usuario['nome'];
                  					$genero = $row_usuario['genero'];
                            $idade = $row_usuario['nascimento'];
                            $email = $row_usuario['email'];
                            $telefone = $row_usuario['telefone'];
                  					$vart[$loop] = $id;
                  				}
                  				if ($id!="") {
                              echo "
                              <tr>
                                 <td>".$crm."</td>
                                 <td>".mb_convert_case($nome, MB_CASE_TITLE, "UTF-8").


                                 "<td>".$genero."</td>
                                 <td>".$idade."</td>
                                 <td>".$email."</td>
                                 <td>".$telefone."</td>

                                 <td>
                                     <a class = \"btn btn-success btn-circle\" href = \"alterar_dados_medicos.php?idMedico=$id\">
                                      <i class=\"fas fa-user-edit\"></i>
                                     </a>
                                 </td>

                                 <td>
                                     <a class = \"btn btn-danger btn-circle\" href = \"apagar.php?idMedico=$id\">
                                        <i class=\"fas fa-trash-alt\"></i>
                                     </a>
                                 </td>

                                 </tr>";
                            }
                  		 		$vart[$id]=$id;
                  					$loop++;
                  					$id++;
                  		}
                  	while($id<=$idd);
echo "
                  </tbody>
                </table>
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
else{
header('location:index.php');
}
?>
