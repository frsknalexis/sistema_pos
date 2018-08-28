<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Ventas
        <small>Panel de Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar Ventas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <a href="crear-ventas">
          <button class="btn btn-primary" ><i class="fa fa-plus"></i> Agregar Venta</button></a>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped table-hover dt-responsive tabla" width="100%">
            <thead>
              <tr>
                <th style="width: 10px;">#</th>
                <th>Codigo Factura</th>
                <th>Cliente</th>
                <th>Vendedor</th>
                <th>Forma de Pago</th>
                <th>SubTotal</th>
                <th>Total</th>
                <th>Fecha de Venta</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>

              <?php 

              $item = null;

              $valor = null;

              $respuesta = VentasController::mostrarVentasController($item, $valor);

              $t = 1;

              foreach($respuesta as $key => $value) {

                echo '<tr>
                <td>' . $t . '</td>
                <td>' . $value['codigo'] . '</td>';

                $item = "id_cliente";

                $valor = $value['id_cliente'];

                $cliente = ClientesController::mostrarClientesController($item, $valor);

                echo '<td>' . $cliente['nombre_cliente'] . '</td>';

                $itemUsuario = "id_usuario";

                $valorUsuario = $value['id_vendedor'];

                $usuario = UsuariosController::mostrarUsuarioController($itemUsuario, $valorUsuario);

                echo '<td>' . $usuario['nombre'] . '</td>';

                echo '<td>' . $value['metodo_pago'] . '</td>
                <td>S/. ' . number_format($value['subtotal'],2) . '</td>
                <td>S/. ' . number_format($value['total_venta'], 2) . '</td>
                <td>' . $value['fecha_registro'] . '</td>
               
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning btnEditarVentas" idVenta="' . $value['id_venta'] . '"><i class="fa fa-pencil" title="Editar"></i></button>
                    <button class="btn btn-danger btnEliminarVentas" idVenta="' . $value['id_venta'] . '"><i class="fa fa-close" title="Eliminar"></i></button>
                    <button class="btn btn-info"><i class="fa fa-print" title="Imprimir"></i></button>
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
