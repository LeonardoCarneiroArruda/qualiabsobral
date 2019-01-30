<?php

require_once("../vendor/autoload.php");
use \Classes\Resposta;

$respostas = new Resposta();
$resposta1 = $respostas->retornaDadosGraficoQuestao01();
$resposta2 = $respostas->retornaDadosGraficoQuestao02();
// requisição da classe PHPlot
require_once ("../phplot-6.2.0/phplot.php");
  
// Array com dados de Ano x Índice de fecundidade Brasileira 1940-2000
// Valores por década
$data = array(
			array(),
			array(),
			array(),
			array()
			);
for ($i = 0; $i < count($resposta1); $i++) {
	array_push($data[$i], array($resposta1["idcandidato"]), $resposta1["resposta"]);
}
$data2 = array(
             
             
             );     
var_dump($data);exit;
# Cria um novo objeto do tipo PHPlot com 500px de largura x 350px de altura                 
$plot = new PHPlot(500 , 350);     
  
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