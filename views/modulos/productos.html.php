<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Productos
        <small>Panel de Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar Productos</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto"><i class="fa fa-plus"></i> Agregar Producto</button>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped table-hover dt-responsive tablas">
            <thead>
              <tr>
                <th style="width: 10px;">#</th>
                <th>Imagen</th>
                <th>Codigo Producto</th>
                <th>Descripcion</th>
                <th>Categoria</th>
                <th>Stock</th>
                <th>Precio Compra</th>
                <th>Precio Venta</th>
                <th>Agregado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td><img src="views/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                <td>0001</td>
                <td>Liquido de Freno</td>
                <td>Lubricante</td>
                <td>20</td>
                <td>S/. 5.00</td>
                <td>S/. 10.00</td>
                <td>2018-31-03 12:05:32</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning"><i class="fa fa-pencil" title="Editar"></i></button>
                    <button class="btn btn-danger"><i class="fa fa-close" title="Eliminar"></i></button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>1</td>
                <td><img src="views/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                <td>0001</td>
                <td>Liquido de Freno</td>
                <td>Lubricante</td>
                <td>20</td>
                <td>S/. 5.00</td>
                <td>S/. 10.00</td>
                <td>2018-31-03 12:05:32</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning"><i class="fa fa-pencil" title="Editar"></i></button>
                    <button class="btn btn-danger"><i class="fa fa-close" title="Eliminar"></i></button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>1</td>
                <td><img src="views/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                <td>0001</td>
                <td>Liquido de Freno</td>
                <td>Lubricante</td>
                <td>20</td>
                <td>S/. 5.00</td>
                <td>S/. 10.00</td>
                <td>2018-31-03 12:05:32</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning"><i class="fa fa-pencil" title="Editar"></i></button>
                    <button class="btn btn-danger"><i class="fa fa-close" title="Eliminar"></i></button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>1</td>
                <td><img src="views/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                <td>0001</td>
                <td>Liquido de Freno</td>
                <td>Lubricante</td>
                <td>20</td>
                <td>S/. 5.00</td>
                <td>S/. 10.00</td>
                <td>2018-31-03 12:05:32</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning"><i class="fa fa-pencil" title="Editar"></i></button>
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

  <!--==============================================
      MODAL AGREGAR PRODUCTO
    ===============================================-->

    <!-- Modal-->
    <div class="modal fade" id="modalAgregarProducto" role="dialog">
      <div class="modal-dialog">
      <!-- Modal Content-->
      <div class="modal-content">

        <form role="form" method="post" enctype="multipart/form-data">

        <!--=======================================
             CABEZA DEL MODAL
        ========================================-->

        <div class="modal-header" style="background: #3c8dbc; color: white;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Producto</h4>
        </div>

        <!--=======================================
              CUERPO DEL MODAL
        ========================================-->

        <div class="modal-body">
          <div class="box-body">
            <!--ENTRADA PARA EL CODIGO-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-code"></i>
                </span><input type="text" class="form-control input-lg" name="nuevoCodigo" placeholder="Ingresar Codigo" required>
              </div>
            </div>
            <!--ENTRADA PARA LA DESCRIPCION-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar Descripcion" required>
              </div>
            </div>
            <!--ENTRADA PARA SELECCIONAR LA CATEGORIA-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                <select class="form-control input-lg" name="nuevaCategoria">
                  <option value="">--- Seleccione Categoria ---</option>
                  <option value="Autopartes">Autopartes</option>
                  <option value="Lubricado">Lubricado</option>
                  <option value="Equipo de Herramientas">Equipo de Herramientas</option>
                </select>
              </div>
            </div>
            <!--ENTRADA PARA EL STOCK-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-check"></i></span>
                <input type="number" class="form-control input-lg" name="nuevoStock" min="0" placeholder="Stock">
              </div>
            </div>
            <!--ENTRADA PARA EL PRECIO DE COMPRA-->
            <div class="form-group row">
              <div class="col-xs-6">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                <input type="number" class="form-control input-lg" name="nuevoPrecioCompra" min="0" placeholder="Precio Compra">
              </div>
              </div>
           
            <!--ENTRADA PARA EL PRECIO DE VENTA-->
            <div class="col-xs-6">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                <input type="number" class="form-control input-lg" name="nuevoPrecioVenta" min="0" placeholder="Precio Venta">
              </div>
              <br>
              <!--CHECKBOX PARA PORCENTAJE-->
              <div class="col-xs-6">
                <div class="form-group">
                  <label><input type="checkbox" class="minimal porcentaje" name="" checked>Utilizar Porcentaje</label>
                </div>
              </div>
              <!--ENTRADA PARA PORCENTAJE-->
              <div class="col-xs-6" style="padding: 0">
                <div class="input-group">
                  <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>
                  <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                </div>
              </div>
              </div>
            </div>
            <!--ENTRADA PARA SUBIR LA FOTO-->
            <div class="form-group">
              <div class="panel">SUBIR IMAGEN</div>
              <input type="file" id="nuevaImagen" name="nuevaImagen">
              <p class="help-block">Peso Maximo de la Imagen 200MB</p>
              <img src="views/img/productos/default/anonymous.png" class="img-thumbnail" width="100px">
            </div>
          </div>
        </div>
        <!--=======================================
            PIE DEL MODAL
        ========================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Producto</button>
        </div>
      </form>
      </div>
    </div>
  </div>