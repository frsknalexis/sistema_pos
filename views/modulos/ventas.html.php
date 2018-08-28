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
                <th>Neto</th>
                <th>Total</th>
                <th>Fecha de Venta</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>10000</td>
                <td>Juan Villegas</td>
                <td>Julio Gomez</td>
                <td>Efectivo</td>
                <td>S/. 10000.00</td>
                <td>S/. 11900.00</td>
                <td>2017-12-11 12:05:32</td>
               
                <td>
                  <div class="btn-group">
                    <button class="btn btn-info"><i class="fa fa-print" title="Imprimir"></i></button>
                    <button class="btn btn-danger"><i class="fa fa-close" title="Eliminar"></i></button>
                  </div>
                </td>
              </tr>
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