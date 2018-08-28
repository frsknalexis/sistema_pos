<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Crear Ventas
        <small>Panel de Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Crear Ventas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <!--EL FORMULARIO-->
        <div class="col-lg-5 col-xs-12">
          <div class="box box-success">
            <div class="box-header with-border"></div>
            <form role="form" method="post">
              <div class="box-body">
                <div class="box">
                  <!--ENTRADA DEL VENDEDOR-->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span><input type="text" class="form-control" name="nuevoVendedor" id="nuevoVendedor" value="Usuario Administrador" readonly>
                    </div>
                  </div>
                  <!--ENTRADA PARA EL CODIGO DE LA VENTA-->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-code"></i></span><input type="text" class="form-control" name="nuevaVenta" id="nuevaVenta" value="10002343" readonly>
                    </div>
                  </div>
                  <!--ENTRADA DEL CLIENTE-->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-users"></i></span>
                      <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>
                      <option value="">---Seleccionar Cliente---</option>
                      </select>
                      <span class="input-group-addon"><button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal"><i class="fa fa-plus"></i> Agregar Cliente</button></span>
                    </div>
                  </div>
                  <!--ENTRADA PARA AGREGAR PRODUCTOS-->
                  <div class="form-group row nuevoProducto">
                    <!--DESCRIPCION DEL PRODUCTO-->
                    <div class="col-xs-6" style="padding-right: 0px;">
                      <div class="input-group">
                        <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button></span><input type="text" class="form-control" name="agregarProducto" id="agregarProducto" placeholder="Descripcion del Producto" required>
                      </div>
                    </div>
                    <!--CANTIDAD DEL PRODUCTO-->
                    <div class="col-xs-3">
                      <input type="number" class="form-control" id="nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" placeholder="0" required>
                    </div>
                    <!--PRECIO DEL PRODUCTO-->
                    <div class="col-xs-3" style="padding-left: 0px;">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                        <input type="number" min="1" class="form-control" id="nuevoPrecioProducto" name="nuevoPrecioProducto" placeholder="000000" readonly required>
                      </div>
                    </div>
                  </div>
                  <!--BOTON PARA AGREGAR PRODUCTO-->
                  <button type="button" class="btn btn-primary hidden-lg">Agregar Producto</button>
                  <hr>
                  <div class="row">
                    <!--ENTRADA DE IMPUESTOS Y TOTAL-->
                    <div class="col-xs-8 pull-right">
                      <table class="table">

                        <thead>
                          <tr>
                            <th>Impuesto</th>
                            <th>Total</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td style="width: 50%;">
                              <div class="input-group">
                                <input type="number" class="form-control" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" placeholder="0" required>
                                <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                              </div>
                            </td>
                            <td style="width: 50%">
                              <div class="input-group">
                                <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                <input type="number" min="1" class="form-control" id="nuevoTotalVenta" name="nuevoTotalVenta" placeholder="00000" readonly required>
                              </div>
                            </td>
                          </tr> 
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <hr>
                  <!--METODO DE PAGO-->
                  <div class="form-group row">
                    <div class="col-xs-6">
                      <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-cc-mastercard"></i></span>
                      <select class="form-control" name="nuevoMetodoPago" id="nuevoMetodoPago" required="">
                        <option value="">--Seleccione Metodo de Pago--</option>
                        <option value="efectivo">Efectivo</option>
                        <option value="tarjetaCredito">Tarjeta Credito</option>
                        <option value="tarjetaDebito">Tarjeta Debito</option>
                      </select>
                    </div>
                    </div>
                    <div class="col-xs-6" style="padding-left:0px;">
                      <div class="input-group">
                        <input type="text" class="form-control" id="nuevoCodigoTransaccion" name="nuevoCodigoTransaccion" placeholder="Codigo de Transaccion" required>
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                      </div>
                      
                    </div>
                  </div>
                  <br>
                </div> 
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Guardar Venta</button>
            </div>
           </form> 
          </div>
        </div>
        <!--LA TABLA DE PRODUCTOS-->
        <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
          <div class="box box-warning">
            <div class="box-header with-border"></div>
            <div class="box-body">
              <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                <thead>
                  <tr>
                    <th style="width: 10px;">#</th>
                    <th>Imagen</th>
                    <th>Codigo</th>
                    <th>Descripcion</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td><img src="views/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                    <td>00123</td>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>20</td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Agregar Producto</button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            
          </div>
        </div>
      </div>


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