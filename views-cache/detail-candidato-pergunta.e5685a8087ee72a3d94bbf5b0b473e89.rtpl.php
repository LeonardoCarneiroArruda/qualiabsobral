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
                    <?php $counter2=-1;  if( isset($respostas) && ( is_array($respostas) || $respostas instanceof Traversable ) && sizeof($respostas) ) foreach( $respostas as $key2 => $value2 ){ $counter2++; ?>
                    <td><?php echo htmlspecialchars( $value2["resposta"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <?php } ?>
                  </tr>
                  
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
    </div>
  </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->