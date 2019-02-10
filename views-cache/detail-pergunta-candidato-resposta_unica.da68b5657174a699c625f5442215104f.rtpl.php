<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <br>
    Pergunta: <?php echo formatText($pergunta["descricao"]); ?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="/admin/users">Usuários</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-8">
  		<div class="box box-primary">
            
           <!-- <div class="box-header">
              <a href="/ecommerce/admin/users/create" class="btn btn-success">Cadastrar Usuário</a>
            </div> -->

            <div class="box-body no-padding">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>CSF</th>
                    <th>Resposta</th>
                    <th>Pontuação<th>
                  </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($candidatos) && ( is_array($candidatos) || $candidatos instanceof Traversable ) && sizeof($candidatos) ) foreach( $candidatos as $key1 => $value1 ){ $counter1++; ?>
                  <tr>
                    <td><?php echo htmlspecialchars( $value1["idcandidato"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["csf"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>                   
                    <td><?php echo htmlspecialchars( $value1["1"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["0"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
  	</div>

     <div class="col-md-4">
      <div class="panel-group">
          <div class="panel panel-warning">
            <div class="panel-heading" style="font-size: 60px"> Média: <?php echo htmlspecialchars( $media, ENT_COMPAT, 'UTF-8', FALSE ); ?></div>
          </div>
      </div>

       <div class="panel-group">
            <div class="panel panel-warning">
              <div class="panel-heading" style="font-size: 60px"> Moda: <?php $counter1=-1;  if( isset($moda) && ( is_array($moda) || $moda instanceof Traversable ) && sizeof($moda) ) foreach( $moda as $key1 => $value1 ){ $counter1++; ?> <?php echo htmlspecialchars( $key1, ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php } ?></div>
            </div>
        </div>
      
    </div>

  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->