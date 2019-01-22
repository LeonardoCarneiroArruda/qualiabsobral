<?php
# PHPlot Exemplo: Torta / texto-dados-único
require_once ("../phplot-6.2.0/phplot.php");

# Os rótulos de dados não são usados ​​diretamente pelo PHPlot. Eles estão aqui para o nosso
# referência, e copiamos para a legenda abaixo.
$data = array (
  array ('oftalmo', 7849),
  array ('Otorrino', 299),
  array ('ortopedia', 5447),
  array ('gastro', 944),
  array ('cardio', 541),
  array ('neuro', 3215),
  array ('psiquiatria', 791),
  array ('geriatria', 19454),
  array ('fisio', 311),
  array ('Estados Unidos', 9458),
  array ('USSR', 9710),
);

$plot = new PHPlot(800,600);
$plot->SetImageBorderType ('plain');

$plot->SetPlotType('pie');
$plot->SetDataType('text-data-single');
$plot->SetDataValues($data);

# Defina cores diferentes o suficiente;
$plot->SetDataColors(array('red', 'green', 'blue', 'yellow', 'cyan',
                        'magenta', 'brown', 'lavender', 'pink',
                        'gray', 'orange'));

# Título do enredo principal:
$plot->SetTitle("World Gold Production, 1990 \ n (1000s de Onças Troy)");

# Construa uma legenda a partir do nosso array de dados.
# Cada chamada para SetLegend faz uma linha como "label: value".
foreach ($data as $row)
  $plot->SetLegend(implode(':', $row));
# Coloque a legenda no canto superior esquerdo:
$plot->SetLegendPixels(5, 5);

$plot->DrawGraph();