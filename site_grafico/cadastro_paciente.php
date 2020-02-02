<?php
session_start();
if (isset($_SESSION['ID'])) {
  echo "
<!DOCTYPE html>
<html lang=\"pt-br\">

<head>

  <meta charset=\"utf-8\">
  <meta http-equiv=\"Content-Language\" content=\"pt-br\">
  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
  <meta name=\"description\" content=\"\">
  <meta name=\"author\" content=\"\">

  <title>Cadastro Paciente</title>

  <!-- Custom fonts for this template-->
  <link rel=\"stylesheet\" href=\"https://use.fontawesome.com/releases/v5.7.0/css/all.css\" integrity=\"sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ\" crossorigin=\"anonymous\">
  <link href=\"https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i\" rel=\"stylesheet\">

  <!-- Custom styles for this template-->
  <link href=\"css/sb-admin-2.min.css\" rel=\"stylesheet\">

</head>

<script type=\"text/javascript\" >

function limpa_formulário_cep() {
        //Limpa valores do formulário de cep.
        document.getElementById('rua').value=(\"\");
        document.getElementById('bairro').value=(\"\");
        document.getElementById('cidade').value=(\"\");
        document.getElementById('estado').value=(\"\");
      }

function meu_callback(conteudo) {
    if (!(\"erro\" in conteudo)) {
        //Atualiza os campos com os valores.
        document.getElementById('rua').value=(conteudo.logradouro);
        document.getElementById('bairro').value=(conteudo.bairro);
        document.getElementById('cidade').value=(conteudo.localidade);
        document.getElementById('estado').value=(conteudo.uf);
    } //end if.
    else {
        //CEP não Encontrado.
        limpa_formulário_cep();
        alert(\"CEP não encontrado.\");
    }
}

function pesquisacep(valor) {

    //Nova variável \"cep\" somente com dígitos.
    var cep = valor.replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != \"\") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if(validacep.test(cep)) {

            //Preenche os campos com \"...\" enquanto consulta webservice.
            document.getElementById('estado').value=\"...\";
            document.getElementById('cidade').value=\"...\";
            document.getElementById('bairro').value=\"...\";
            document.getElementById('rua').value=\"...\";

            //Cria um elemento javascript.
            var script = document.createElement('script');

            //Sincroniza com o callback.
            script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

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
        <!-- Nested Row within Card Body -->
        <div class=\"row\">
          <div class=\"col-lg-101\">
            <div class=\"p-5\">
              <div class=\"text-center\">
                <h1 class=\"h4 text-gray-900 mb-4\" style=\"font-size: 2.1rem;line-height: 0.8;font-weight: 900;letter-spacing: 0.118em;font-style: normal;\">Cadastro de Paciente</h1>
              </div>
              <form class=\"user\" method=\"POST\" action=\"cadastrando_paciente.php\">
                <div class=\"form-group row\">
                  <div class=\"col-sm-6 mb-3 mb-sm-0\">
                    <input type=\"text\" class=\"form-control form-control-user\" id=\"nome\" name=\"nome\" placeholder=\"Nome\" required>
                  </div>
                  <div class=\"col-sm-6\">
                    <input type=\"text\" class=\"form-control form-control-user\" id=\"def\" name=\"def\" placeholder=\"Diagnóstico\" required>
                  </div>
                </div>
                <div class=\"form-group row\">
                  <div class=\"col-sm-6 mb-3 mb-sm-0\">
                    <input type=\"email\" class=\"form-control form-control-user\" id=\"email\" name=\"email\" placeholder=\"Endereço de email\" required>
                  </div>
                  <div class=\"col-sm-6\">
                     <input type=\"text\" class=\"form-control form-control-user\" id=\"username\" name=\"username\" placeholder=\"username\"  required>
                  </div>
                </div>
                <div class=\"form-group row\">
                  <div class=\"col-sm-6\">
                    <input type=\"date\" class=\"form-control form-control-user\" id=\"data\" name=\"data\" required>
                  </div>
                  <div class=\"col-sm-6\">
                     <input type=\"text\" class=\"form-control form-control-user\" id=\"celular\" name=\"celular\" placeholder=\"Celular\"  required>
                  </div>

                </div>
                Gênero
                 <div class=\"col-sm-5\">

                    <input type=\"radio\" name=\"sexo\" id =\"sexo\"  value=\"Masculino\" required> Masculino<br>

                    <input type=\"radio\" name=\"sexo\" id = \"sexo\" value=\"Feminino\" required> Feminino

                  </div>
                <div class=\"text-center\">
                <h5 class=\"h4 text-gray-900 mb-4\" style =\"font-size: 1.2rem;line-height: 1.3;letter-spacing: 0.05em;font-weight: 700;font-style: normal;\">Endereço</h5>
              </div>
                <div class=\"form-group row\">
                  <div class=\"col-sm-6 mb-3 mb-sm-0\">
                    <input type=\"text\" class=\"form-control form-control-user\" id=\"estado\" name=\"estado\" placeholder=\"Estado\" required>
                  </div>
                  <div class=\"col-sm-6\">
                    <input type=\"text\" class=\"form-control form-control-user\" id=\"cidade\" name=\"cidade\" placeholder=\"Cidade\" required>
                  </div>
                </div>
                <div class=\"form-group row\">
                  <div class=\"col-sm-6 mb-3 mb-sm-0\">
                    <input type=\"text\" class=\"form-control form-control-user\" id=\"bairro\" name=\"bairro\" placeholder=\"Bairro\" required>
                  </div>
                  <div class=\"col-sm-6\">
                    <input type=\"text\" class=\"form-control form-control-user\" id=\"rua\" name=\"rua\" placeholder=\"Rua\" required>
                  </div>
                </div>
                <div class=\"form-group row\">
                  <div class=\"col-sm-6\">
                    <input type=\"text\" class=\"form-control form-control-user\" id=\"numero\" name=\"numero\" placeholder=\"Número\" required>
                  </div>
                  <div class=\"col-sm-6\">
                    <input type=\"text\" class=\"form-control form-control-user\" id=\"Complemento\" name=\"complemento\" placeholder=\"Complemento\" required>
                  </div>
                </div>
                <div class=\"form-group row\" >
                  <div class=\"col-sm-6\" style=\"padding-left: 25%; max-width:75%; flex : auto\">
                    <input type=\"search\" class=\"form-control form-control-user\" id=\"cep\" name=\"cep\" placeholder=\"Cep\" maxlength=\"9\" onblur=\"pesquisacep(this.value);\" required>
                  </div>
                </div>

                <input type=\"submit\" class=\"btn btn-primary btn-user btn-block\" value=\"Cadastrar\" id=\"cadastrarp\" name=\"cadastrarp\">
                <a href =\"dashboard.php\">
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

  <!-- Bootstrap core JavaScript-->
  <script src=\"vendor/jquery/jquery.min.js\"></script>
  <script src=\"vendor/bootstrap/js/bootstrap.bundle.min.js\"></script>

  <!-- Core plugin JavaScript-->
  <!-- <script src=\"vendor/jquery-easing/jquery.easing.min.js\"></script> -->

  <!-- Custom scripts for all pages-->
  <script src=\"js/sb-admin-2.min.js\"></script>

</body>

</html>";
}
    else{
header('location:index.php');
}
?>
