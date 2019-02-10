<?php if(!class_exists('Rain\Tpl')){exit;}?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Relatório de pontuação por questão
      </h1>
      <h2>
        PERGUNTAS 
      </h2>
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
                    <th>Pergunta</th>
                    <th style="width: 220px">Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($perguntas) && ( is_array($perguntas) || $perguntas instanceof Traversable ) && sizeof($perguntas) ) foreach( $perguntas as $key1 => $value1 ){ $counter1++; ?>
                  <tr>
                    <td><?php echo htmlspecialchars( $value1["idpergunta"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo formatText($value1["descricao"]); ?></td>
                    <td> <a href="/qualiabsobral/perguntas/<?php echo htmlspecialchars( $value1["idpergunta"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Ver Relatório </a></td>
                   
                   
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