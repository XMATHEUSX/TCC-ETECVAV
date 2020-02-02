<?php
//
require_once 'conexao.php';
 $n_sessao = $_GET['num'];
 $arrumar = "UPDATE dados SET time = replace( time, ',', '.' ) where id_sessao = ".$n_sessao." ";
    $nada = $connect->query($arrumar);
    $sql = "SELECT DISTINCT * FROM `dados` WHERE id_sessao = ".$n_sessao." ORDER by time DESC ";
    $query = $connect->query($sql);
    
    $sessao= "SELECT * FROM `sessao` WHERE id_sessao = ".$n_sessao."  ";
    //$Ultima_sessao= "SELECT DISTINCT * FROM sessao WHERE idpac = $id_paciente ORDER BY id_sessao desc  ";
    $resultado_sessao = $connect->query($sessao);
    //$resultado_ultima_sessao = mysqli_query($conn, $Ultima_sessao);
    $row_usuario = mysqli_fetch_assoc($resultado_sessao);
    $data_sessao = $row_usuario['Data'];
    $duracao = $row_usuario['duracao'];
    $pontuacao = $row_usuario['pontuacao'];
    $jogo = $row_usuario['jogo'];


ob_start();

?>

<html >
<meta charset="utf-8"/>
<head>
  <title>Mobile ChartRangeFilter</title>
  <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.min.css" />
  <link rel="stylesheet" href="jQRangeSlider-5.1.1/css/classic-min.css" />
  <style>#filter_mobile {display:none}</style>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js" defer async></script>

  <script src="//www.google.com/jsapi"></script>

  <script type="text/javascript">
  var data = [<?php

      while($result=mysqli_fetch_array($query)){?>
       [<?php echo ($result['time']);?>, <?php echo $result['coin'];?>],
    <?php
        }?>];
  var is_mobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent);

  google.load('visualization', '1.0', {'packages':['corechart', 'controls']});
  google.setOnLoadCallback(apiLoaded);
  var controLWrapper;
  function apiLoaded()
  {
   var dataTable = new google.visualization.DataTable();
    dataTable.addColumn('number', "Moedas Coletadas Por Período de Tempo");
    dataTable.addColumn('number', "Sessão " +<?php echo $n_sessao; ?>);
    dataTable.addRows(data);

    controlWrapper = new google.visualization.ControlWrapper({
      controlType: 'ChartRangeFilter',
      containerId: 'filter',
      options: {
        filterColumnIndex: 0,
        height: 75,
        ui: {
          chartType: 'LineChart',
          chartOptions: {
            chartArea: {
              width: '50%',
              height: '35%'
            },
            hAxis: {
              baselineColor: 'none'
            }
          },
          // 1 day in milliseconds = 24 * 60 * 60 * 1000 = 86,400,000
          minRangeSize: 86400000
        }
      }
    });

    var chartWrapper = new google.visualization.ChartWrapper({
      chartType: 'LineChart',
      containerId: 'chart',
      options: {
        width: '90%',
        height: 300,
        chartArea: {
          width: '85%'
        },
        legend: 'bottom',
        hAxis: {
          maxTextLines: 15,
          minTextSpacing: 100, 
          title: 'Período de Tempo'
        },
        vAxis: {
          minValue: 2,
          title: 'Moedas'
        },
        animation:{
          duration: 500,
          easing: 'out',
        },
        title: 'Moedas Coletador Por Período de Tempo'
      }
    });

    var dashboard = new google.visualization.Dashboard(document.getElementById('dashboard'));
    dashboard
      .bind(controlWrapper, chartWrapper)
      .draw(dataTable);
  }
</script>
</head>
<body>
  <body>
<div id="dashboard">
  <div id="chart" ></div>
  <div id="filter" ></div>
<div style="width:190px; margin-top:-23%;position:absolute;">
                 <div style="width:190px; margin-top:0%; position:absolute;">
                      <?php
                      echo "
                      <br>
                      <br>
                      <b>Data da sessão</b>: ".$data_sessao."
                      <br><br>
                      <b>Duração</b>: ".$duracao." Minuto(s)
                      <br><br>
                      <b>Pontuação</b>: ".$pontuacao."
                      <br><br>
                      <b>Jogo</b>: ".$jogo."";
                      ?>

                </div>

                </div>
  <!--<div id="filter_title">Date Filter</div>-->
  
  <!--<div id="filter_mobile"></div>>-->
</div>
</body>
</html>

<?php
$html = ob_get_contents();
ob_end_clean();

file_put_contents('grafico_novo_zoom.html', $html);
session_start();
if (isset($_SESSION['ID_MED'])) {
   
header('Location:grafico_novo_zoom.html');}
else{
  header('Location:index.php');
}    ?>