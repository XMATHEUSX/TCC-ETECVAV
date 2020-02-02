<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta http-equiv="Content-Language" content="pt-br">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <title>Foto</title>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link rel="stylesheet"  href="style.css"/>
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
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


      .area-upload{
  box-shadow: 0 5px 20px rgba(0,0,0,.2);
  margin: 20px auto;
  padding: 20px;
  box-sizing: border-box;

  width: 100%;
  max-width: 700px;
  position: relative;
}

.area-upload label.label-upload{
  border: 2px dashed #0d8acd;
  min-height: 200px;
  text-align: center;
  width: 100%;

  display: flex;
  justify-content: center;
  flex-direction: column;
  color: #0d8acd;
  position: relative;

  -webkit-transition: .3s all;
  -moz-transition: .3s all;
  -o-transition: .3s all;
  transition: .3s all;
}

.area-upload label.label-upload.highlight{
  background-color: #fffdaa;
}

.area-upload label.label-upload *{
  pointer-events: none;
}
  </style>
</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">

        <div class="row">
          <div class="col-lg-101">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4" style="font-size: 2.1rem;line-height: 0.3;font-weight: 900;letter-spacing: 0.118em;font-style: normal;">Foto</h1>
              </div>

              <div class="text-center">

                  <div class="area-upload">
                        <label for="upload-file" class="label-upload">
                          <i class="fas fa-image fa-7x"></i>
                          <div class="texto">Clique ou arraste o arquivo</div>
                        </label>
                        <input type="file" accept="image/jpg,image/png" id="upload-file"/>
                        <div class="lista-uploads"></div>
                   </div>


                   <a href="dashboard.php">
                      <br>
                      <input type="button" class="btn btn-primary btn-user btn-block" value="Voltar">
                  </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
    <script src="script.js"></script>
</body>

</html>
