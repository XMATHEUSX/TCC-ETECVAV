<?php
session_start();
if (isset($_SESSION['ID'])) {
  require_once 'conexao.php';
$id =  $_GET['idMedico'];

$result_endereco = "SELECT  cep, complemento, numero FROM endereco_doc WHERE iddoc = $id LIMIT 1";
    $resultado_cep = $connect->query($result_endereco);
    if($resultado_cep){
          $row_cep = mysqli_fetch_assoc($resultado_cep);
          $cep = $row_cep['cep'];
          $complemento = $row_cep['complemento'];
          $numero = $row_cep['numero'];
    }


$result_usuario = "SELECT  crm, nome, genero, nascimento, email, telefone FROM doutor WHERE iddoc = $id LIMIT 1";
    $resultado_usuario = $connect->query($result_usuario);
    if($resultado_usuario){
          $row_usuario = mysqli_fetch_assoc($resultado_usuario);
          $crm = $row_usuario['crm'];
          $nome = $row_usuario['nome'];
          $genero = $row_usuario['genero'];
          $idade = $row_usuario['nascimento'];
          $email = $row_usuario['email'];
          $telefone = $row_usuario['telefone'];
    }
$iddoc = $id;
echo"
      <!DOCTYPE html>
      <html lang=\"pt-br\">
      <head>
        <meta charset=\"utf-8\">
        <meta http-equiv=\"Content-Language\" content=\"pt-br\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
        <meta name=\"description\" content=\"\">
        <meta name=\"author\" content=\"\">
      	<script type=\"text/javascript\" src=\"function.js\"></script>
        <title>Alterar Médico</title>
        <link rel=\"stylesheet\" href=\"https://use.fontawesome.com/releases/v5.7.0/css/all.css\" integrity=\"sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ\" crossorigin=\"anonymous\">
        <link href=\"https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i\" rel=\"stylesheet\">
        <link href=\"css/sb-admin-2.min.css\" rel=\"stylesheet\">
      </head>
      <script type=\"text/javascript\" >
      function limpa_formulário_cep() {
              //Limpa valores do formulário de cep.
              document.getElementById('ruaAlter').value=(\"\");
              document.getElementById('bairroAltero').value=(\"\");
              document.getElementById('cidadeAlter').value=(\"\");
              document.getElementById('estadoAlter').value=(\"\");
            }
      function meu_callback(conteudo) {
          if (!(\"erro\" in conteudo)) {
              //Atualiza os campos com os valores.
              document.getElementById('ruaAlter').value=(conteudo.logradouro);
              document.getElementById('bairroAlter').value=(conteudo.bairro);
              document.getElementById('cidadeAlter').value=(conteudo.localidade);
              document.getElementById('estadoAlter').value=(conteudo.uf);
          } //end if.
          else {
              //CEP não Encontrado.
              limpa_formulário_cep();
              alert(\"CEP não encontrado.\");
          }
      }
      function pesquisacep(valor) {
          //Nova variável \"cep\" somente com dígitos.
          var cepAlter = valor.replace(/\D/g, '');
          //Verifica se campo cep possui valor informado.
          if (cepAlter != \"\") {
              //Expressão regular para validar o CEP.
              var validacep = /^[0-9]{8}$/;
              //Valida o formato do CEP.
              if(validacep.test(cepAlter)) {
                  //Preenche os campos com \"...\" enquanto consulta webservice.
                  document.getElementById('estadoAlter').value=\"...\";
                  document.getElementById('cidadeAlter').value=\"...\";
                  document.getElementById('bairroAlter').value=\"...\";
                  document.getElementById('ruaAlter').value=\"...\";
                  //Cria um elemento javascript.
                  var script = document.createElement('script');
                  //Sincroniza com o callback.
                  script.src = 'https://viacep.com.br/ws/'+ cepAlter + '/json/?callback=meu_callback';
                  //Insere script no documento e carrega o conteúdo.
                  document.body.appendChild(script);
              } //end if.
              else {
                  //cep é inválido.
                  limpa_formulário_cep();
                  alert(\"Formato de CEP inválido.\");
              }
          } //end if.
          else {
              //cep sem valor, limpa formulário.
              limpa_formulário_cep();
          }
      };
      </script>
      <body class=\"bg-gradient-primary\">
        <div class=\"container\">
          <div class=\"card o-hidden border-0 shadow-lg my-5\">
            <div class=\"card-body p-0\">
              <div class=\"row\">
                <div class=\"col-lg-101\">
                  <div class=\"p-5\">
                    <div class=\"text-center\">
                      <h1 class=\"h4 text-gray-900 mb-4\" style=\"font-size: 2.1rem;line-height: 0.8;font-weight: 900;letter-spacing: 0.118em;font-style: normal;\">Alterar dados  $nome</h1>
                    </div>
                    <form class=\"user\" method=\"GET\" action=\"alterarDadosMedicos.php?\">
                        <input type=\"hidden\" class=\"form-control form-control-user\" id=\"id\" name=\"id\" placeholder=\"Nome\" value =\"$iddoc\" required>
                      <!--Dados pessoais-->
                      <div class=\"form-group row\">
                        <div class=\"col-sm-6 mb-3 mb-sm-0\">
                          <input type=\"text\" class=\"form-control form-control-user\" id=\"nomeAlter\" name=\"nomeAlter\" placeholder=\"Nome\" value =\"$nome\" required>
                        </div>
                        <div class=\"col-sm-6\">
                          <input type=\"text\" class=\"form-control form-control-user\" id=\"crmAlter\" name=\"crmAlter\" placeholder=\"CRM\" value = \"$crm\"required>
                        </div>
                      </div>
                      <div class=\"form-group row\">
                        <div class=\"col-sm-6 mb-3 mb-sm-0\">
                          <input type=\"email\" class=\"form-control form-control-user\" id=\"emailAlter\" name=\"emailAlter\" placeholder=\"Endereço de email\" value = \"$email\" required>
                        </div>
                        <div class=\"col-sm-6\">
                           <input type=\"text\" class=\"form-control form-control-user\" id=\"celularAlter\" name=\"celularAlter\" placeholder=\"Celular\"  value = \"$telefone\"required>
                        </div>
                      </div>
                      <div class=\"form-group row\">
                        <div class=\"col-sm-6\">
                          <input type=\"date\" class=\"form-control form-control-user\" id=\"dataAlter\" name=\"dataAlter\" placeholder=\"nascimento\"  value = \"$idade\"required>
                        </div>";

                        if ($genero == "Masculino") {
                          echo"<div class=\"col-sm-6\">
                              <input type=\"radio\" name=\"sexoAlter\" id =\"sexoAlter\" value= \"Masculino\" checked>Masculino
                              <input type=\"radio\" name=\"sexoAlter\" id = \"sexoAlter\" value= \"Feminino\"> Feminino
                          </div>";
                        }
                        else {
                          echo"<div class=\"col-sm-6\">
                              <input type=\"radio\" name=\"sexoAlter\" id =\"sexoAlter\" value= \"Masculino\">Masculino
                              <input type=\"radio\" name=\"sexoAlter\" id = \"sexoAlter\" value= \"Feminino\" checked> Feminino
                          </div>";
                        }



                      echo "
                      </div>
                      <!--Endereço -->
                      <div class=\"text-center\">
                      <h5 class=\"h4 text-gray-900 mb-4\" style =\"font-size: 1.2rem;line-height: 1.3;letter-spacing: 0.05em;font-weight: 700;font-style: normal;\">Endereço</h5>
                      </div>
                      <div class=\"form-group row\">
                        <div class=\"col-sm-6 mb-3 mb-sm-0\">
                          <input type=\"text\" class=\"form-control form-control-user\" id=\"estadoAlter\" name=\"estadoAlter\" placeholder=\"Estado\" required>
                        </div>
                        <div class=\"col-sm-6\">
                          <input type=\"text\" class=\"form-control form-control-user\" id=\"cidadeAlter\" name=\"cidadeAlter\" placeholder=\"Cidade\" required>
                        </div>
                      </div>
                      <div class=\"form-group row\">
                        <div class=\"col-sm-6 mb-3 mb-sm-0\">
                          <input type=\"text\" class=\"form-control form-control-user\" id=\"bairroAlter\" name=\"bairroAlter\" placeholder=\"Bairro\" required>
                        </div>
                        <div class=\"col-sm-6\">
                          <input type=\"text\" class=\"form-control form-control-user\" id=\"ruaAlter\" name=\"ruaAlter\" placeholder=\"Rua\" required>
                        </div>
                      </div>
                      <div class=\"form-group row\">
                        <div class=\"col-sm-6\">
                          <input type=\"text\" class=\"form-control form-control-user\" id=\"numeroAlter\" name=\"numeroAlter\" placeholder=\"Número\" value = \"$numero\" required>
                        </div>
                        <div class=\"col-sm-6\">
                          <input type=\"text\" class=\"form-control form-control-user\" id=\"complementoAlter\" name=\"complementoAlter\" placeholder=\"Complemento\" value = \"$complemento\"required>
                        </div>
                      </div>
                      <div class=\"form-group row\">
                        <div class=\"col-sm-6\" style=\"padding-left: 25%; max-width:75%; flex : auto\">
                          <input type=\"search\" class=\"form-control form-control-user\" id=\"cepAlter\" name=\"cepAlter\" placeholder=\"Cep\" maxlength=\"9\" onblur=\"pesquisacep(this.value);\" value = \"$cep\" >
                        </div>
                      </div>
                      <input type=\"submit\" class=\"btn btn-primary btn-user btn-block\" value=\"Alterar\" id=\"cadastrard\" name=\"cadastrard\">
                      <a href =\"editar_medicos.php\">
                        <br>
                        <input type=\"button\" class=\"btn btn-primary btn-user btn-block\" value=\"Voltar\">
                      </a>
                    </form>
                    <hr>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- <script src=\"vendor/jquery/jquery.min.js\"></script>
        <script src=\"vendor/bootstrap/js/bootstrap.bundle.min.js\"></script> -->
        <!-- <script src=\"vendor/jquery-easing/jquery.easing.min.js\"></script> -->
        <!-- <script src=\"js/sb-admin-2.min.js\"></script> -->
      </body>
      </html>";
    }
    else{
header('location:index.php');
}
?>
