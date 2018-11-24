<?php if(!class_exists('Rain\Tpl')){exit;}?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Candidato: <?php echo htmlspecialchars( $candidato["csf"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
        
      </h1>
      <h3>
        Pergunta: <?php echo formatText($perguntas["descricao"]); ?>
      </h3>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

     <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
            
           <!-- <div class="box-header">
              <a href="/ecommerce/admin/users/create" class="btn btn-success">Cadastrar Usuário</a>
            </div> -->

            <div class="box-body no-padding">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Alternativas</th>
                    <th>Peso</th>
                    <th>RESPOSTA</th>
                    <!--<th style="width: 220px">Ações</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($alternativas) && ( is_array($alternativas) || $alternativas instanceof Traversable ) && sizeof($alternativas) ) foreach( $alternativas as $key1 => $value1 ){ $counter1++; ?>

                  <tr>
                    <td><?php echo htmlspecialchars( $value1["codigo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo formatText($value1["descricao"]); ?></td>                   
                    <td><?php echo htmlspecialchars( $value1["peso"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>                    
                    <td><?php echo htmlspecialchars( $value1["0"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  </tr>
                  <?php } ?>
                  
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
    </div>
  </div>
<div class="row">
    <div class="col-md-6">
      <div class="panel-group">
          <div class="panel panel-info">
            <div class="panel-heading">Pontuação Total = <?php echo htmlspecialchars( $pontuacao_total, ENT_COMPAT, 'UTF-8', FALSE ); ?> | Pontuação = <?php echo htmlspecialchars( $pontuacao, ENT_COMPAT, 'UTF-8', FALSE ); ?> | Porcentagem = <?php echo htmlspecialchars( $porcentagem, ENT_COMPAT, 'UTF-8', FALSE ); ?>%</div>
          </div>
          <div class="panel panel-warning">
            <div class="panel-heading"> > 75% (<?php echo return75($pontuacao_total); ?>) = 2</div>
            <div class="panel-heading"> <= 75% (<?php echo return75($pontuacao_total); ?>) e >= 25% (<?php echo return25($pontuacao_total); ?>) = 1</div>
            <div class="panel-heading"> < 25% (<?php echo return25($pontuacao_total); ?>) = 0</div>
          </div>
      </div>
    </div>
</div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->