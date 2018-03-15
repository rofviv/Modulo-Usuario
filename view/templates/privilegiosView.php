<?php include('view/complement/head.php'); ?>
<?php
  $grupo_usuario = new Privilegio();
  $grupos = $grupo_usuario->grupos();
?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include('view/complement/nav.php'); ?>

  <?php include('view/complement/sidebar.php'); ?>
  <?php include('view/public/editarMenu_modal.html'); ?>

  <div class="content-wrapper">

    <section class="content-header">
      <h1>
        Privilegios
        <small>Crear grupos y privilegios</small>
      </h1>
    </section>

    <section class="content container-fluid">

      <div class="row">
        <div class="col-md-5 panel-privilegio">
          <div class="form-group">
            <label>Selecciona un modulo</label>
            <select class="form-control" id="modulo-select">
              <option value="-1">Seleccionar</option>
              <?php foreach ($grupos as $g): ?>
                <option value="<?php echo $g['id']; ?>"><?php echo $g['grupo']; ?></option>
              <?php endforeach; ?>
            </select>
            <div class="" id="_div_privilegios"></div>
            <br>
            <table class="table table-striped" id="_tbl_privilegios"></table>
          </div>
        </div>

        <div class="col-md-5 panel-privilegio">
          <div class="form-group">
            <label>Nuevo Privilegio</label>
            <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Grupo</h3>
            </div>
            <div class="form-horizontal" role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Opcion</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="opcion_reg" placeholder="Opcion">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Enlace</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="enlace_reg" placeholder="Enlace">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Icono</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="icono_reg" placeholder="Icono">
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <button type="button" class="btn btn-info btn-block" onclick="nuevoPrivilegio()">Registrar Privilegio</button>
              </div>
              <div id="_DIV_REG_PRI">

              </div>
            </div>
          </div>
          </div>
        </div>
      </div>

    </section>

  </div>

  <?php include('view/complement/footer.php'); ?>

</div>
<script type="text/javascript" src="includes/js/ajax/registrarPrivilegios.js"></script>
</body>
</html>
