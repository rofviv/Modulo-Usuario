<?php include('view/complement/head.php'); ?>
<?php
  $bitacora = new Bitacora();
  $sucesos = $bitacora->listar();
?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include('view/complement/nav.php'); ?>

  <?php include('view/complement/sidebar.php'); ?>

  <div class="content-wrapper">

    <section class="content-header">
      <h1>
        Bitacora
        <small>Sucesos del sistema</small>
      </h1>
    </section>

    <section class="content container-fluid">
      <div class="panel-bitacora">
        <div class="box-body table-responsive">
            <table class="table table-hover" id="_tbl_bitacora">
              <tr>
                <th style="width:40%">Suceso</th>
                <th style="width:15%">Fecha</th>
                <th style="width:15%">Hora</th>
                <th style="width:30%">Usuario</th>
              </tr>

              <?php foreach ($sucesos as $s): ?>
                <tr>
                  <td><?php echo $s['suceso']; ?></td>
                  <td><?php echo $s['fecha']; ?></td>
                  <td><?php echo $s['hora']; ?></td>
                  <td><?php echo $s['nombre']; ?></td>
                </tr>
              <?php endforeach; ?>

            </table>
          </div>
        </div>
    </section>

  </div>

  <?php include('view/complement/footer.php'); ?>

</div>

</body>
</html>
