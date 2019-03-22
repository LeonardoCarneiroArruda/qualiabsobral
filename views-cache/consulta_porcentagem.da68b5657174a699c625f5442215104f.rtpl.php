<?php if(!class_exists('Rain\Tpl')){exit;}?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Consulta de porcentagem das respostas por questão
      </h1>
      <h4>
        Aqui você pode consultar a porcentagem de respostas de cada alternativa por questão, basta inserir o número da questão para consulta
      </h4>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row ">
        <div class="col-xs-3">
          <div class="panel-group">
              <div class="panel panel-default">
                <div class="panel-heading" style="font-size: 20px"> 
                  <form method="post" action="/qualiabsobral/consultaporcentagem">
                    <label>Questão: </label><input type="text" class="form-control" name="questao" required="true">   
                      <button type="submit" class="btn btn-primary btn-block btn-flat">CONSULTAR</button>
                  </form>
                </div>
              </div>
        </div>

        </div>
    </div>
   
   <?php if( $pergunta != null ){ ?>
   <div class="row">
      <div class="col-xs-8">
         <h4>Pergunta: <?php echo formatText($pergunta["descricao"]); ?></h4>
        <div class="box-body no-padding">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Alternativas</th>
                    <th style="width: 90px">Peso</th>
                    <th style="width: 200px">% que marcou SIM</th>
                    <!--<th style="width: 220px">Ações</th> -->
                  </tr>
                </thead>
                <tbody>
                 <?php $counter1=-1;  if( isset($alternativas) && ( is_array($alternativas) || $alternativas instanceof Traversable ) && sizeof($alternativas) ) foreach( $alternativas as $key1 => $value1 ){ $counter1++; ?>
                  <tr>
                    <td></td>
                    <td><?php echo formatText($value1["descricao"]); ?></td>                   
                    <td><?php echo htmlspecialchars( $value1["peso"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>                    
                    <td><?php echo calculoRespostasSim($value1["0"], $totalCandidatos); ?>%</td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
        </div>
     </div>
  </div>
  <?php } ?>
      <!-- Your Page Content Here -->

    </section>
    <!-- /.content -->

   
  </div>
  <!-- /.content-wrapper -->