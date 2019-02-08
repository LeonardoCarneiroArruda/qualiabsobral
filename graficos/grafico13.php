<?php

require_once(".." . DIRECTORY_SEPARATOR . "vendor".DIRECTORY_SEPARATOR."autoload.php");
use \Classes\Resposta;

$respostas = new Resposta();
$respostas = $respostas->retornaDadosGraficoQuestoesUmaAlternativa(13);
# PHPlot Exemplo: Torta / texto-dados-único
require_once ("../phplot-6.2.0/phplot.php");

# Os rótulos de dados não são usados ​​diretamente pelo PHPlot. Eles estão aqui para o nosso
# referência, e copiamos para a legenda abaixo.
$data = array (
  array ('Media 0 ', $respostas[0]),
  array ('Media 1 ', $respostas[1]),
  array ('Media 2 ', $respostas[2])
);

$plot = new PHPlot(600, 400);
$plot->SetImageBorderType ('plain');

$plot->SetPlotType('pie');
$plot->SetDataType('text-data-single');
$plot->SetDataValues($data);

# Defina cores diferentes o suficiente;
$plot->SetDataColors(array('red', 'green', 'blue'));

# Título do enredo principal:
$plot->SetTitle("Quantidade de CSF por pontuacao da questao 13");

# Construa uma legenda a partir do nosso array de dados.
# Cada chamada para SetLegend faz uma linha como "label: value".
foreach ($data as $row)
  $plot->SetLegend(implode(':', $row));
# Coloque a legenda no canto superior esquerdo:
$plot->SetLegendPixels(5, 5);

$plot->DrawGraph();