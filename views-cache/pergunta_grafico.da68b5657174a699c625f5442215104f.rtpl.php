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
           
           <img src="../graficos/grafico<?php echo htmlspecialchars( $pergunta["idpergunta"], ENT_COMPAT, 'UTF-8', FALSE ); ?>.php" alt="" title="" />

         </fieldset>

        <div class="col-md-11"> 
         <h4><?php echo retornaRodapeGrafico($pergunta["idpergunta"]); ?></h4>
        </div>

      <!-- Your Page Content Here -->

    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->