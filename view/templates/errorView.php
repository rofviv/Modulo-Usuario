<?php include('view/complement/head.php'); ?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include('view/complement/nav.php');
  include('view/complement/sidebar.php'); ?>

  <div class="content-wrapper">

    <section class="content-header">
      <h1>
        Error
        <small>Página no encontrada</small>
      </h1>
    </section>

    <section class="content container-fluid">

      <div class="error-page">
        <h2 class="headline text-yellow"> 404</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow"></i> Oops! Página no encontrada.</h3>

          <p>
            No hemos encontrado la página solicitada.
            Puedes volver al menú principal <a href="?view=principal">Aquí</a>.
          </p>
        </div>
      </div>

    </section>

  </div>

  <?php include('view/complement/footer.php'); ?>

</div>

</body>
</html>
