<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Usuarios
        <small>Panel de Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar Usuarios</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario"><i class="fa fa-plus"></i> Agregar Usuario</button>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped table-hover dt-responsive tablas">
            <thead>
              <tr>
                <th style="width: 10px;">#</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Foto</th>
                <th>Perfil</th>
                <th>Estado</th>
                <th>Ultimo Login</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Alexis Manuel</td>
                <td>admin</td>
                <th><img src="views/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></th>
                <td>Administrador</td>
                <td><button class="btn btn-success btn-xs">Activado</button></td>
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
      MODAL AGREGAR USUARIO
    ===============================================-->

    <!-- Modal-->
    <div class="modal fade" id="modalAgregarUsuario" role="dialog">
      <div class="modal-dialog">
      <!-- Modal Content-->
      <div class="modal-content">

        <form role="form" method="post" enctype="multipart/form-data">

        <!--=======================================
             CABEZA DEL MODAL
        ========================================-->

        <div class="modal-header" style="background: #3c8dbc; color: white;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Usuario</h4>
        </div>

        <!--=======================================
              CUERPO DEL MODAL
        ========================================-->

        <div class="modal-body">
          <div class="box-body">
            <!--ENTRADA PARA EL NOMBRE-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i>
                </span><input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar Nombre" required>
              </div>
            </div>
            <!--ENTRADA PARA EL USUARIO-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Ingresar Usuario" required>
              </div>
            </div>
            <!--ENTRADA PARA LA CONTRASEÑA-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Ingresar Password" required>
              </div>
            </div>
            <!--ENTRADA PARA SELECCIONAR SU PERFIL-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="nuevoPerfil">
                  <option value="">--- Seleccione Perfil ---</option>
                  <option value="Administrador">Administrador</option>
                  <option value="Almacenero">Almacenero</option>
                  <option value="Vendedor">Vendedor</option>
                </select>
              </div>
            </div>
            <!--ENTRADA PARA SUBIR LA FOTO-->
            <div class="form-group">
              <div class="panel">SUBIR FOTO</div>
              <input type="file" id="nuevaFoto" name="nuevaFoto">
              <p class="help-block">Peso Maximo de la Foto 200MB</p>
              <img src="views/img/usuarios/default/anonymous.png" class="img-thumbnail" width="100px">
            </div>
          </div>
        </div>
        <!--=======================================
            PIE DEL MODAL
        ========================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Usuarios</button>
        </div>
      </form>
      </div>
    </div>
  </div>