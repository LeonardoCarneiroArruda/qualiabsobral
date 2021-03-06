<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Lista de Candidatos
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="/admin/users">Usuários</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-9">
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
                    <th>Responsável</th>
                    <th>Média Final</th>
                    <th style="width: 180px">Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($candidatos) && ( is_array($candidatos) || $candidatos instanceof Traversable ) && sizeof($candidatos) ) foreach( $candidatos as $key1 => $value1 ){ $counter1++; ?>
                  <tr>
                    <td><?php echo htmlspecialchars( $value1["idcandidato"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["csf"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["responsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo formatFloat($value1["0"]); ?></td>
                    <td>
                      <a href="/qualiabsobral/detalhes/<?php echo htmlspecialchars( $value1["idcandidato"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-default btn-xs"><i class="fa fa-search"></i> Respostas Detalhadas</a>
                      <!--<a href="/qualiabsobral/candidatos/<?php echo htmlspecialchars( $value1["idcandidato"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>Editar </a>
                      <a href="/qualiabsobral/candidatos/<?php echo htmlspecialchars( $value1["idcandidato"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete" onclick="return confirm('Deseja realmente excluir este registro?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Excluir</a> -->
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
  	</div>
     <div class="col-md-3">
      <div class="panel-group">
          <div class="panel panel-warning">
            <div class="panel-heading" style="font-size: 40px"> Média Geral de Sobral: <?php echo formatFloat($media_sobral); ?></div>
          </div>
      </div>
    </div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->