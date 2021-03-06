<?php if(!class_exists('Rain\Tpl')){exit;}?>  <style>
    .botao-grafico {
      padding: 40px;
      font-size: 80px;
      margin-bottom: 10px;
    }
  </style>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Lista de questões que possuem gráficos para visualizar <br>
        <small>
          Selecione uma questão para visualizar seu gráfico<br>
          
        </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
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
                    <th>Pergunta</th>
                    <th style="width: 180px"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($perguntas) && ( is_array($perguntas) || $perguntas instanceof Traversable ) && sizeof($perguntas) ) foreach( $perguntas as $key1 => $value1 ){ $counter1++; ?>
                  <tr>
                    <td><?php echo formatText($value1["descricao"]); ?></td>
                    <td>
                      <a href="/qualiabsobral/grafico/<?php echo htmlspecialchars( $value1["idpergunta"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-default btn-xs"><i class="fa fa-search"></i> Visualizar Gráfico</a>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
    </div>
  </div>


      <!-- Your Page Content Here -->

    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->