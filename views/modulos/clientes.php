<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Clientes
        <small>Panel de Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar Clientes</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCliente"><i class="fa fa-plus"></i> Agregar Clientes</button>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped table-hover dt-responsive tablas" width="100%">
            <thead>
              <tr>
                <th style="width: 10px;">#</th>
                <th>Nombre</th>
                <th>Numero Documento</th>
                <th>Email</th>
                <th>Telefono</th>
                <th>Direccion</th>
                <th>Fecha de Nacimiento</th>
                <th>Total de Compras</th>
                <th>Ultima Compra</th>
                <th>Ingreso al Sistema</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>

              <?php 

              $item = null;

              $valor = null;

              $mostrarClientes = ClientesController::mostrarClientesController($item, $valor);

              $t = 1;

              foreach($mostrarClientes as $key => $value) {

                echo '<tr>
                <td>' . $t . '</td>
                <td>' . $value['nombre_cliente'] . '</td>
                <td>' . $value['documento'] . '</td>
                <td>' . $value['email'] . '</td>
                <td>' . $value['telefono'] . '</td>
                <td>' . $value['direccion'] . '</td>
                <td>' . $value['fecha_nacimiento'] . '</td>
                <td>' . $value['total_compras'] . '</td>
                <td>' . $value['ultima_compra'] . '</td>
                <td>' . $value['fecha_registro'] . '</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning btnEditarClientes" data-toggle="modal" data-target="#modalEditarCliente" idCliente="' . $value['id_cliente'] . '"><i class="fa fa-pencil" title="Editar"></i></button>
                    <button class="btn btn-danger btnEliminarClientes" idCliente="' . $value['id_cliente'] . '"><i class="fa fa-close" title="Eliminar"></i></button>
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
      MODAL AGREGAR CLIENTE
    ===============================================-->

    <!-- Modal-->
    <div class="modal fade" id="modalAgregarCliente" role="dialog">
      <div class="modal-dialog">
      <!-- Modal Content-->
      <div class="modal-content">

        <form role="form" method="post">

        <!--=======================================
             CABEZA DEL MODAL
        ========================================-->

        <div class="modal-header" style="background: #3c8dbc; color: white;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Clientes</h4>
        </div>

        <!--=======================================
              CUERPO DEL MODAL
        ========================================-->

        <div class="modal-body">
          <div class="box-body">
            <!--ENTRADA PARA EL NOMBRE-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span><input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar Nombre" required>
              </div>
            </div>
             <!--ENTRADA PARA EL DOCUMENTO-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-address-card"></i></span><input type="text" class="form-control input-lg" name="nuevoDni" placeholder="Ingresar Numero Documento" required>
              </div>
            </div>
             <!--ENTRADA PARA EL EMAIL-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span><input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar Correo Electronico" required>
              </div>
            </div>
             <!--ENTRADA PARA EL TELEFONO-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span><input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar Numero Telefono" data-inputmask="'mask':'(999) 999-999'" data-mask required>
              </div>
            </div>
              <!--ENTRADA PARA LA DIRECCION-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span><input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar Direccion" required>
              </div>
            </div>
              <!--ENTRADA PARA LA FECHA DE NACIMIENTO-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control input-lg" name="nuevaFechaNacimiento" placeholder="Ingresar Fecha Nacimiento" data-inputmask="'alias':'yyyy/mm/dd'" data-mask required>
              </div>
            </div>
          </div>
        </div>
        <!--=======================================
            PIE DEL MODAL
        ========================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Cliente</button>
        </div>

        <?php 

        $crearCliente = new ClientesController();
        $crearCliente->agregarClientesController();
        ?>
      </form>
      </div>
    </div>
  </div>

  <!--==============================================
      MODAL EDITAR CLIENTE
    ===============================================-->

    <!-- Modal-->
    <div class="modal fade" id="modalEditarCliente" role="dialog">
      <div class="modal-dialog">
      <!-- Modal Content-->
      <div class="modal-content">

        <form role="form" method="post">

        <!--=======================================
             CABEZA DEL MODAL
        ========================================-->

        <div class="modal-header" style="background: #3c8dbc; color: white;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modificar Clientes</h4>
        </div>

        <!--=======================================
              CUERPO DEL MODAL
        ========================================-->

        <div class="modal-body">
          <div class="box-body">
            <!--ENTRADA PARA EL NOMBRE-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span><input type="text" class="form-control input-lg" id="editarCliente" name="editarCliente" required>
                <input type="hidden" name="idCliente" id="idCliente">
              </div>
            </div>
             <!--ENTRADA PARA EL DOCUMENTO-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-address-card"></i></span><input type="text" class="form-control input-lg" name="editarDni" id="editarDni" required>
              </div>
            </div>
             <!--ENTRADA PARA EL EMAIL-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span><input type="email" class="form-control input-lg" id="editarEmail" name="editarEmail" required>
              </div>
            </div>
             <!--ENTRADA PARA EL TELEFONO-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span><input type="text" class="form-control input-lg" name="editarTelefono" id="editarTelefono" data-inputmask="'mask':'(999) 999-999'" data-mask required>
              </div>
            </div>
              <!--ENTRADA PARA LA DIRECCION-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span><input type="text" class="form-control input-lg" name="editarDireccion" id="editarDireccion" required>
              </div>
            </div>
              <!--ENTRADA PARA LA FECHA DE NACIMIENTO-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control input-lg" name="editarFechaNacimiento" id="editarFechaNacimiento" data-inputmask="'alias':'yyyy/mm/dd'" data-mask required>
              </div>
            </div>
          </div>
        </div>
        <!--=======================================
            PIE DEL MODAL
        ========================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Modificar Cliente</button>
        </div>

        <?php 

        $editarCliente = new ClientesController();
        $editarCliente->editarClienteController();

        
        ?>
      </form>
      </div>
    </div>
  </div>

  <?php 

  $eliminarCliente = new ClientesController();
  $eliminarCliente->eliminarClientesController();
  ?>