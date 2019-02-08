<?php if(!class_exists('Rain\Tpl')){exit;}?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     <br> <h1>
        Pergunta: <?php echo formatText($pergunta["descricao"]); ?> <br>

      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        
         <fieldset>
           
           <img src="../graficos/grafico<?php echo htmlspecialchars( $pergunta["idpergunta"], ENT_COMPAT, 'UTF-8', FALSE ); ?>.php" alt="Gráfico 24" title="Gráfico 24" />
           <p style="font-weight: bold;  ">*Todos os números se referem a quantidade de tempo em meses</p> 
         </fieldset>
        
        <div class="col-md-11"> 
         <h4><?php echo retornaRodapeGrafico($pergunta["idpergunta"]); ?></h4>
        </div>
        <br><br>
        <h3>Quantidade de Unidades básicas de saúde que responderam Não aplica/Não encaminha por especialidade</h3> 
        <div class="row">
          <div class="col-md-7">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Especialidade</th>
                      <th>Não aplica/Não encaminha</th>
                      <th>CSF</th>>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $counter1=-1;  if( isset($observacoes) && ( is_array($observacoes) || $observacoes instanceof Traversable ) && sizeof($observacoes) ) foreach( $observacoes as $key1 => $value1 ){ $counter1++; ?>
                    <tr>
                      <td><?php echo htmlspecialchars( $key1, ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php $especialidade = $key1; ?> </td>
                      <td> <?php echo htmlspecialchars( $value1["1"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td> 
                      <td><?php if( $value1["1"] > 0 ){ ?> <?php $counter2=-1;  if( isset($NaoSabeNaoEncaminha) && ( is_array($NaoSabeNaoEncaminha) || $NaoSabeNaoEncaminha instanceof Traversable ) && sizeof($NaoSabeNaoEncaminha) ) foreach( $NaoSabeNaoEncaminha as $key2 => $value2 ){ $counter2++; ?> <?php echo formatText($value2["descricao"]); ?> - <?php echo htmlspecialchars( $value2["csf"], ENT_COMPAT, 'UTF-8', FALSE ); ?> <br> <?php } ?> <?php } ?></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
          </div>
        </div>

      <!-- Your Page Content Here -->

    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->