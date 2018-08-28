<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Categorias
        <small>Panel de Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar Categorias</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria"><i class="fa fa-plus"></i> Agregar Categoria</button>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped table-hover dt-responsive tablas">
            <thead>
              <tr>
                <th style="width: 10px;">#</th>
                <th>Categoria</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>

             <?php 

             $item = null;

             $valor = null;

             $categorias = CategoriasController::mostrarCategoriaController($item, $valor);

             $t = 1;

             foreach ($categorias as $key => $value) {

              echo '<tr>
                <td>' . $t . '</td>
                <td>' . $value['nombre_categoria'] . '</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning btnEditarCategoria" idCategoria="' . $value['id_categoria'] . '" data-toggle="modal" data-target="#modalEditarCategoria"><i class="fa fa-pencil" title="Editar"></i></button>
                    <button class="btn btn-danger btnEliminarCategorias" idCategoria="' . $value['id_categoria'] . '"><i class="fa fa-close" title="Eliminar"></i></button>
                  </div>
                </td>
              </tr>';

              $t++;

             }

             ?>
              
            </tbody>

          </table>
        </div>
        <!-- /.box-body -->
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!--==============================================
      MODAL AGREGAR CATEGORIA
    ===============================================-->

    <!-- Modal-->
    <div class="modal fade" id="modalAgregarCategoria" role="dialog">
      <div class="modal-dialog">
      <!-- Modal Content-->
      <div class="modal-content">

        <form role="form" method="post">

        <!--=======================================
             CABEZA DEL MODAL
        ========================================-->

        <div class="modal-header" style="background: #3c8dbc; color: white;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Categoria</h4>
        </div>

        <!--=======================================
              CUERPO DEL MODAL
        ========================================-->

        <div class="modal-body">
          <div class="box-body">
            <!--ENTRADA PARA EL NOMBRE-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-tags"></i></span><input type="text" class="form-control input-lg" id="nuevaCategoria" name="nuevaCategoria" placeholder="Ingresar Categoria" required>
              </div>
            </div>
          </div>
        </div>
        <!--=======================================
            PIE DEL MODAL
        ========================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Categoria</button>
        </div>

        <?php 

        $crearCategoria = new CategoriasController();
        $crearCategoria->agregarCategoriaController();
        ?>

      </form>
      </div>
    </div>
  </div>

  <!--==============================================
      MODAL EDITAR CATEGORIA
    ===============================================-->

    <!-- Modal-->
    <div class="modal fade" id="modalEditarCategoria" role="dialog">
      <div class="modal-dialog">
      <!-- Modal Content-->
      <div class="modal-content">

        <form role="form" method="post">

        <!--=======================================
             CABEZA DEL MODAL
        ========================================-->

        <div class="modal-header" style="background: #3c8dbc; color: white;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Categoria</h4>
        </div>

        <!--=======================================
              CUERPO DEL MODAL
        ========================================-->

        <div class="modal-body">
          <div class="box-body">
            <!--ENTRADA PARA EL NOMBRE-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-tags"></i></span><input type="text" class="form-control input-lg" id="editarCategoria" name="editarCategoria" required>
                <input type="hidden" id="idCategoria" name="idCategoria">
              </div>
            </div>
          </div>
        </div>
        <!--=======================================
            PIE DEL MODAL
        ========================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Modificar Categoria</button>
        </div>

        <?php 

        $editarCategoria = new CategoriasController();
        $editarCategoria->editarCategoriaController();
        ?>
      </form>
      </div>
    </div>
  </div>

  <?php 

  $eliminarCategoria = new CategoriasController();
  $eliminarCategoria->eliminarCategoriaController();

  ?>