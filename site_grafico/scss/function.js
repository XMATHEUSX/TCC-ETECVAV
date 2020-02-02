  var d = document;
function processar(idTabela)
{
var newRow = d.createElement('tr');
newRow.insertCell(0).innerHTML = d.getElementsByName('item')[0].value;
newRow.insertCell(1).innerHTML = d.getElementsByName('descricao')[0].value;
newRow.insertCell(2).innerHTML = d.getElementsByName('qtd')[0].value;
newRow.insertCell(3).innerHTML = d.getElementsByName('unidade')[0].value;
newRow.insertCell(4).innerHTML = d.getElementsByName('valor')[0].value;
newRow.insertCell(5).innerHTML = d.getElementsByName('result')[0].value;
$('#item').val('');
$('#descricao').val('');
$('#qtd').val('');
$('#unidade').val('');
$('#valor').val('');
$('#result').val('');
d.getElementById(idTabela).appendChild(newRow);
return false;
}

//mask

$("#celular").mask("(00)");


//calcular valor final

function calcular(){
  var valor1 = parseFloat(document.getElementById('valor').value, 10);
  var valor2 = parseFloat(document.getElementById('qtd').value, 10);
  document.getElementById('result').value = valor1 * valor2;

}
