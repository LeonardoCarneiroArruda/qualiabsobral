<?php
# PHPlot Exemplo: Torta / texto-dados-único
require_once ("../phplot-6.2.0/phplot.php");

require_once("../vendor/autoload.php");
use \Classes\Resposta;
$respostas = new Resposta();

# Os rótulos de dados não são usados ​​diretamente pelo PHPlot. Eles estão aqui para o nosso
# referência, e copiamos para a legenda abaixo.

$data = array(
      array("Alto da Brasilia (".$respostas->retornaDadosGraficoQuestao02(4) . " Equipes)", $respostas->retornaDadosGraficoQuestao01(4)),
      array("Caic (".$respostas->retornaDadosGraficoQuestao02(6) . " Equipes)", $respostas->retornaDadosGraficoQuestao01(6)),
      array("Campo dos Velhos (".$respostas->retornaDadosGraficoQuestao02(7) . " Equipes)", $respostas->retornaDadosGraficoQuestao01(7)),
      array("Centro (".$respostas->retornaDadosGraficoQuestao02(8) . " Equipes)", $respostas->retornaDadosGraficoQuestao01(8)),
      array("Coelce (".$respostas->retornaDadosGraficoQuestao02(9) . " Equipes)", $respostas->retornaDadosGraficoQuestao01(9)), 
      array("Cohab II (".$respostas->retornaDadosGraficoQuestao02(10) . " Equipes)", $respostas->retornaDadosGraficoQuestao01(10)),
      array("Parque St Antonio (".$respostas->retornaDadosGraficoQuestao02(12) . " Equipes)", $respostas->retornaDadosGraficoQuestao01(12)),
      array("Dom Expedito (".$respostas->retornaDadosGraficoQuestao02(14) . " Equipes)", $respostas->retornaDadosGraficoQuestao01(14)),
      array("Estacao (".$respostas->retornaDadosGraficoQuestao02(15) . " Equipes)", $respostas->retornaDadosGraficoQuestao01(15)),
      array("Expectativa (".$respostas->retornaDadosGraficoQuestao02(16) . " Equipes)", $respostas->retornaDadosGraficoQuestao01(16)),
      array("Junco (".$respostas->retornaDadosGraficoQuestao02(17) . " Equipes)", $respostas->retornaDadosGraficoQuestao01(17)),
            array("Novo Recanto (".$respostas->retornaDadosGraficoQuestao02(18) . " Equipes)", $respostas->retornaDadosGraficoQuestao01(18)), 
      array("Pe. Palhano (".$respostas->retornaDadosGraficoQuestao02(19) . " Equipes)", $respostas->retornaDadosGraficoQuestao01(19)),
      array("Pedrinhas (".$respostas->retornaDadosGraficoQuestao02(20) . " Equipes)", $respostas->retornaDadosGraficoQuestao01(20)),     
      array("Sinha Saboia (".$respostas->retornaDadosGraficoQuestao02(21) . " Equipes)", $respostas->retornaDadosGraficoQuestao01(21)),
      array("Sumare (".$respostas->retornaDadosGraficoQuestao02(22) . " Equipes)", $respostas->retornaDadosGraficoQuestao01(22)),   
      array("Tamarindo (".$respostas->retornaDadosGraficoQuestao02(23) . " Equipes)", $respostas->retornaDadosGraficoQuestao01(23)),     
      array("Terrenos Novos I (".$respostas->retornaDadosGraficoQuestao02(24) . " Equipes)", $respostas->retornaDadosGraficoQuestao01(24)),
      array("Terrenos Novos II (".$respostas->retornaDadosGraficoQuestao02(25) . " Equipes)", $respostas->retornaDadosGraficoQuestao01(25)),
             );     


$plot = new PHPlot(800,600);
$plot->SetImageBorderType ('plain');

$plot->SetPlotType('pie');
$plot->SetDataType('text-data-single');
$plot->SetDataValues($data);

# Defina cores diferentes o suficiente;
$plot->SetDataColors(array('red', 'green', 'blue', 'yellow', 'cyan',
                        'magenta', 'brown', 'lavender', 'pink',
                        'gray', 'orange','red','green','blue','yellow','cyan','magenta','brown'));

# Título do enredo principal:
$plot->SetTitle("World Gold Production, 1990 \ n (1000s de Onças Troy)");

# Construa uma legenda a partir do nosso array de dados.
# Cada chamada para SetLegend faz uma linha como "label: value".
foreach ($data as $row)
  $plot->SetLegend(implode(':', $row));
# Coloque a legenda no canto superior esquerdo:
$plot->SetLegendPixels(5, 5);

$plot->DrawGraph();