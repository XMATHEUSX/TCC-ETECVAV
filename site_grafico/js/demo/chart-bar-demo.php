<?php 
header('Content-Type: text/html; charset=utf-8');
    session_start();
    include_once("conexao.php");

$jan = "SELECT count(Data) as Janeiro FROM sessao WHERE STR_TO_DATE(Data,'%Y-%m-%d') BETWEEN '2019-01-01' AND '2019-01-31'";
$resultado_duracao = $connect->query($jan);
$row_duracao = mysqli_fetch_row($resultado_duracao);
$Janeiro = $row_duracao[0];


$jan = "SELECT count(Data) as Fevereiro FROM sessao WHERE STR_TO_DATE(Data,'%Y-%m-%d') BETWEEN '2019-02-01' AND '2019-02-31'"; 
$resultado_duracao = $connect->query($jan);
$row_duracao = mysqli_fetch_row($resultado_duracao);
$Fevereiro = $row_duracao[0];

$jan = "SELECT count(Data) as Marco FROM sessao WHERE STR_TO_DATE(Data,'%Y-%m-%d') BETWEEN '2019-03-01' AND '2019-03-31'";
$resultado_duracao = $connect->query($jan);
$row_duracao = mysqli_fetch_row($resultado_duracao);
$Marco = $row_duracao[0];


$jan = "SELECT count(Data) as Abril FROM sessao WHERE STR_TO_DATE(Data,'%Y-%m-%d') BETWEEN '2019-04-01' AND '2019-04-31'"; 
$resultado_duracao = $connect->query($jan);
$row_duracao = mysqli_fetch_row($resultado_duracao);
$Abril= $row_duracao[0];


$jan = "SELECT count(Data) as Maio FROM sessao WHERE STR_TO_DATE(Data,'%Y-%m-%d') BETWEEN '2019-05-01' AND '2019-05-31'"; 
$resultado_duracao = $connect->query($jan);
$row_duracao = mysqli_fetch_row($resultado_duracao);
$Maio = $row_duracao[0];

$jan = "SELECT count(Data) as Junho FROM sessao WHERE STR_TO_DATE(Data,'%Y-%m-%d') BETWEEN '2019-06-01' AND '2019-06-31'";
$resultado_duracao = $connect->query($jan);
$row_duracao = mysqli_fetch_row($resultado_duracao);
$Junho = $row_duracao[0];



$jan = "SELECT count(Data) as Julho FROM sessao WHERE STR_TO_DATE(Data,'%Y-%m-%d') BETWEEN '2019-07-01' AND '2019-07-31'";
$resultado_duracao = $connect->query($jan);
$row_duracao = mysqli_fetch_row($resultado_duracao);
$Julho = $row_duracao[0];


$jan = "SELECT count(Data) as Agosto FROM sessao WHERE STR_TO_DATE(Data,'%Y-%m-%d') BETWEEN '2019-08-01' AND '2019-08-31'";
$resultado_duracao = $connect->query($jan);
$row_duracao = mysqli_fetch_row($resultado_duracao);
$Agosto = $row_duracao[0];


$jan = "SELECT count(Data) as Setembro FROM sessao WHERE STR_TO_DATE(Data,'%Y-%m-%d') BETWEEN '2019-09-01' AND '2019-09-31'";
$resultado_duracao = $connect->query($jan);
$row_duracao = mysqli_fetch_row($resultado_duracao);
$Setembro = $row_duracao[0];


$jan = "SELECT count(Data) as Outubro FROM sessao WHERE STR_TO_DATE(Data,'%Y-%m-%d') BETWEEN '2019-10-01' AND '2019-10-31'";
$resultado_duracao = $connect->query($jan);
$row_duracao = mysqli_fetch_row($resultado_duracao);
$Outubro = $row_duracao[0];


$jan = "SELECT count(Data) as Novembro FROM sessao WHERE STR_TO_DATE(Data,'%Y-%m-%d') BETWEEN '2019-11-01' AND '2019-11-31'";
$resultado_duracao = $connect->query($jan);
$row_duracao = mysqli_fetch_row($resultado_duracao);
$Novembro = $row_duracao[0];

$jan = "SELECT count(Data) as Dezembro FROM sessao WHERE STR_TO_DATE(Data,'%Y-%m-%d') BETWEEN '2019-12-01' AND '2019-12-31'";
$resultado_duracao = $connect->query($jan);
$row_duracao = mysqli_fetch_row($resultado_duracao);
$Dezembro = $row_duracao[0];

echo "
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,\"Segoe UI\",Roboto,\"Helvetica Neue\",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}

// Bar Chart Example
var ctx = document.getElementById(\"myBarChart\");
var myBarChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: [\"Janeiro\", \"Fevereiro\", \"Março\", \"Abril\", \"Maio\", \"Junho\", \"Julho\",\"Agosto\",\"Setembro\",\"Outrubro\",\"Novembro\",\"Dezembro\"],
    datasets: [{
      label: \"Revenue\",
      backgroundColor: \"#4e73df\",
      hoverBackgroundColor: \"#2e59d9\",
      borderColor: \"#4e73df\",
      data: [".$Janeiro.",".$Fevereiro.",".$Marco.",".$Abril.",".$Maio.",".$Junho.",".$Julho.",".$Agosto.",".$Setembro.",".$Outubro.",".$Novembro.",".$Dezembro."],
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 12
        },
        maxBarThickness: 25,
      }],
      yAxes: [{
        ticks: {
          min: 0,
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return '' + number_format(value);
          }
        },
        gridLines: {
          color: \"rgb(234, 236, 244)\",
          zeroLineColor: \"rgb(234, 236, 244)\",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      backgroundColor: \"rgb(255,255,255)\",
      bodyFontColor: \"#858796\",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
            return 'Sessões ' + number_format(tooltipItem.yLabel);
        }
      }
    },
  }
});";
?>