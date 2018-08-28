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
          <table class="table table-bordered table-striped table-hover dt-responsive tablas" width="100%">
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

              <?php

                $item = null;
                $valor = null;
                $usuarios = UsuariosController::mostrarUsuarioController($item, $valor);

                $t = 1;

                foreach ($usuarios as $key => $value) {
                      echo '<tr>
                <td>' . $t . '</td>
                <td>' . $value['nombre'] .'</td>
                <td>' . $value['usuario'] . '</td>';

                if($value['foto'] == "") {

                  echo '<td><img src="views/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>';
                }
                else {

                  echo '<td><img src="' . $value['foto'] . '" class="img-thumbnail" width="40px"></td>';
                }
                
                echo '<td>' . $value['perfil'] . '</td>';

                if($value['estado'] != 0) {

                  echo '<td><button class="btn btn-success btn-xs btnActivar" estadoUsuario="0" idUsuario="' . $value['id_usuario'] . '">Activado</button></td>';

                }
                else {

                  echo '<td><button class="btn btn-danger btn-xs btnActivar" estadoUsuario="1" idUsuario="' . $value['id_usuario'] .'">Desactivado</button></td>';
                }

                echo '<td>' . $value['ultimo_login'] . '</td>
                <td><div class="btn-group">
                <button class="btn btn-warning btnEditUsuarios" idUsuario="' . $value['id_usuario'] . '" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil" title="Editar"></i></button>
                <button class="btn btn-danger btnEliminarUsuarios" idUsuario="' . $value['id_usuario'] . '" fotoUsuario="' . $value['foto'] . '" Usuario="' . $value['usuario'] . '"><i class="fa fa-close" title="Eliminar"></i></button>
                </div></td>
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
                <input type="text" class="form-control input-lg" id="nuevoUsuario" name="nuevoUsuario" placeholder="Ingresar Usuario" required>
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
              <input type="file" name="nuevaFoto" class="form-control nuevaFoto">
              <p class="help-block">Peso Maximo de la Foto 2MB</p>
              <img src="views/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
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

        <?php 

        $crearUsuario = new UsuariosController();
        $crearUsuario->agregarUsuarioController();
        ?>
      </form>
      </div>
    </div>
  </div>

    <!--==============================================
      MODAL EDITAR USUARIO
    ===============================================-->

    <!-- Modal-->
    <div class="modal fade" id="modalEditarUsuario" role="dialog">
      <div class="modal-dialog">
      <!-- Modal Content-->
      <div class="modal-content">

        <form role="form" method="post" enctype="multipart/form-data">

        <!--=======================================
             CABEZA DEL MODAL
        ========================================-->

        <div class="modal-header" style="background: #3c8dbc; color: white;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Usuario</h4>
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
                </span><input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required>
              </div>
            </div>
            <!--ENTRADA PARA EL USUARIO-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" value="" readonly>
              </div>
            </div>
            <!--ENTRADA PARA LA CONTRASEÑA-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control input-lg" name="editarPassword" placeholder="Escriba el Nuevo Password">
                <input type="hidden" id="passwordActual" name="passwordActual">
              </div>
            </div>
            <!--ENTRADA PARA SELECCIONAR SU PERFIL-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="editarPerfil">
                  <option value="" id="editarPerfil"></option>
                  <option value="Administrador">Administrador</option>
                  <option value="Almacenero">Almacenero</option>
                  <option value="Vendedor">Vendedor</option>
                </select>
              </div>
            </div>
            <!--ENTRADA PARA SUBIR LA FOTO-->
            <div class="form-group">
              <div class="panel">SUBIR FOTO</div>
              <input type="file" name="editarFoto" class="form-control nuevaFoto">
              <p class="help-block">Peso Maximo de la Foto 2MB</p>
              <img src="views/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
              <input type="hidden" name="fotoActual" id="fotoActual">
            </div>
          </div>
        </div>
        <!--=======================================
            PIE DEL MODAL
        ========================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Modificar Usuario</button>
        </div>

        <?php 

        $editarUsuario = new UsuariosController();
        $editarUsuario->editarUsuarioController();

        ?>

      </form>
      </div>
    </div>
  </div>

<?php 

$eliminarUsuario = new UsuariosController();
$eliminarUsuario->eliminarUsuarioController();

?>

