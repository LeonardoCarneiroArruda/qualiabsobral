<?php

require_once("../vendor/autoload.php");
use \Classes\Resposta;

$respostas = new Resposta();

// requisição da classe PHPlot
require_once ("../phplot-6.2.0/phplot.php");
  
// Array com dados de Ano x Índice de fecundidade Brasileira 1940-2000
// Valores por década

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

# Cria um novo objeto do tipo PHPlot com 500px de largura x 350px de altura                 
$plot = new PHPlot(3100 , 350);     
  
// Organiza Gráfico -----------------------------
//$plot->SetTitle('Taxa de CSF que responderam SIM ou NÃO para a pergunta acima');
# Precisão de uma casa decimal
$plot->SetPrecisionY(1);
# tipo de Gráfico em barras (poderia ser linepoints por exemplo)
$plot->SetPlotType("bars");
# Tipo de dados que preencherão o Gráfico text(label dos anos) e data (valores de porcentagem)
$plot->SetDataType("text-data");
# Adiciona ao gráfico os valores do array
$plot->SetDataValues($data);
// -----------------------------------------------

// Organiza eixo X ------------------------------
# Seta os traços (grid) do eixo X para invisível
$plot->SetXTickPos('none');
# Texto abaixo do eixo X
//$plot->SetXLabel("Fonte: Censo Demográfico 2000, Fecundidade e Mortalidade Infantil, Resultados\n Preliminares da Amostra IBGE, 2002");
# Tamanho da fonte que varia de 1-5
$plot->SetXLabelFontSize(2);
$plot->SetAxisFontSize(2);
// -----------------------------------------------
  
// Organiza eixo Y -------------------------------
# Coloca nos pontos os valores de Y
$plot->SetYDataLabelPos('plotin');
// -----------------------------------------------
  
// Desenha o Gráfico -----------------------------
$plot->DrawGraph();
// -----------------------------------------------
?>