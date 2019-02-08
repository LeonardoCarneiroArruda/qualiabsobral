<?php

require_once(".." . DIRECTORY_SEPARATOR . "vendor".DIRECTORY_SEPARATOR."autoload.php");
use \Classes\Resposta;

$respostas = new Resposta();
$respostas = $respostas->retornaDadosGraficoQuestao6();

// requisição da classe PHPlot
require_once ("../phplot-6.2.0/phplot.php");
  
// Array com dados de Ano x Índice de fecundidade Brasileira 1940-2000
// Valores por década
$data = array(
             array('Ressonancia Magnetica' , $respostas["Ressonancia Magnetica"]), 
             array('Tomografia Computadorizada' , $respostas["Tomografia Computadorizada"]),
             array('Ultrassonografia', $respostas["Ultrassonografia"]),
             array('Raio X', $respostas["Raio X"]),
             array('Mamografia', $respostas["Mamografia"])
             );     
# Cria um novo objeto do tipo PHPlot com 500px de largura x 350px de altura                 
$plot = new PHPlot(1000 , 350);     
  
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