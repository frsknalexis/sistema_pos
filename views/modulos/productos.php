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
          <table class="table table-bordered table-striped table-hover dt-responsive tablaProductos" width="100%">
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
      

              <?php

              /* 
              
              $item = null;

              $valor = null;

              $productos = ProductosController::mostrarProductosController($item, $valor);

              $t = 1;

              foreach($productos as $key => $value) {

                echo '<tr>
                <td>' . $t . '</td>
                <td><img src="views/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                <td>' . $value['codigo'] . '</td>
                <td>' . $value['descripcion'] . '</td>';

                $item = 'id_categoria';

                $valor = $value['id_categoria'];

                $categoria = CategoriasController::mostrarCategoriaController($item, $valor);

                echo '<td>' . $categoria['nombre_categoria'] . '</td>
                <td>' . $value['stock'] . '</td>
                <td>S/. ' . $value['precio_compra'] . '</td>
                <td>S/. ' . $value['precio_venta'] . '</td>
                <td>' . $value['fecha'] . '</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning"><i class="fa fa-pencil" title="Editar"></i></button>
                    <button class="btn btn-danger"><i class="fa fa-close" title="Eliminar"></i></button>
                  </div>
                </td>
              </tr>';

              $t++;
              }*/

              ?>   
                
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

            <!--ENTRADA PARA SELECCIONAR LA CATEGORIA-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                <select class="form-control input-lg" name="nuevaCategoria" id="nuevaCategoria" required>
                  <option value="">--- Seleccione Categoria ---</option>
                  <?php 

                  $item = null;
                  $valor = null;

                  $categoria = CategoriasController::mostrarCategoriaController($item, $valor);

                  foreach ($categoria as $key => $value) {

                    echo '<option value="' . $value['id_categoria'] . '">' . $value['nombre_categoria'] . '</option>';
                  }

                  ?>
                </select>
              </div>
            </div>

            <!--ENTRADA PARA EL CODIGO-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-code"></i>
                </span><input type="text" class="form-control input-lg" id="nuevoCodigo" name="nuevoCodigo" placeholder="Ingresar Codigo" readonly required>
              </div>
            </div>
            <!--ENTRADA PARA LA DESCRIPCION-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar Descripcion" required>
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
                <input type="number" class="form-control input-lg" id="nuevoPrecioCompra" name="nuevoPrecioCompra" min="0" placeholder="Precio Compra">
              </div>
              </div>
           
            <!--ENTRADA PARA EL PRECIO DE VENTA-->
            <div class="col-xs-6">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                <input type="number" class="form-control input-lg" id="nuevoPrecioVenta" name="nuevoPrecioVenta" min="0" placeholder="Precio Venta">
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
              <input type="file" class="nuevaImagen" name="nuevaImagen">
              <p class="help-block">Peso Maximo de la Imagen 2MB</p>
              <img src="views/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
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

        <?php 

        $agregarProducto = new ProductosController();
        $agregarProducto->agregarProductosController();

        ?>
      </form>
      </div>
    </div>
  </div>


  <!--==============================================
      MODAL EDITAR PRODUCTO
    ===============================================-->

    <!-- Modal-->
    <div class="modal fade" id="modalEditarProducto" role="dialog">
      <div class="modal-dialog">
      <!-- Modal Content-->
      <div class="modal-content">

        <form role="form" method="post" enctype="multipart/form-data">

        <!--=======================================
             CABEZA DEL MODAL
        ========================================-->

        <div class="modal-header" style="background: #3c8dbc; color: white;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Producto</h4>
        </div>

        <!--=======================================
              CUERPO DEL MODAL
        ========================================-->

        <div class="modal-body">
          <div class="box-body">

            <!--ENTRADA PARA SELECCIONAR LA CATEGORIA-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                <select class="form-control input-lg" name="editarCategoria" readonly required>
                  <option value="" id="editarCategoria"></option>
                </select>
              </div>
            </div>

            <!--ENTRADA PARA EL CODIGO-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-code"></i>
                </span><input type="text" class="form-control input-lg" id="editarCodigo" name="editarCodigo" readonly required>
              </div>
            </div>
            <!--ENTRADA PARA LA DESCRIPCION-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                <input type="text" class="form-control input-lg" name="editarDescripcion" id="editarDescripcion" required>
              </div>
            </div>
            
            <!--ENTRADA PARA EL STOCK-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-check"></i></span>
                <input type="number" class="form-control input-lg" name="editarStock" min="0" id="editarStock">
              </div>
            </div>
            <!--ENTRADA PARA EL PRECIO DE COMPRA-->
            <div class="form-group row">
              <div class="col-xs-6">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                <input type="number" class="form-control input-lg" id="editarPrecioCompra" name="editarPrecioCompra" min="0">
              </div>
              </div>
           
            <!--ENTRADA PARA EL PRECIO DE VENTA-->
            <div class="col-xs-6">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                <input type="number" class="form-control input-lg" id="editarPrecioVenta" name="editarPrecioVenta" min="0" readonly required>
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
              <input type="file" class="nuevaImagen" name="editarImagen">
              <p class="help-block">Peso Maximo de la Imagen 2MB</p>
              <img src="views/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
              <input type="hidden" name="imagenActual" id="imagenActual">
            </div>
          </div>
        </div>
        <!--=======================================
            PIE DEL MODAL
        ========================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Modificar Producto</button>
        </div>

        <?php 

        $editarProducto = new ProductosController();
        $editarProducto->editarProductoController();


        ?>
      </form>
      </div>
    </div>
  </div>

  <?php 

  $eliminarProducto = new ProductosController();
  $eliminarProducto->eliminarProductosController();

  ?>