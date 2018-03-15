function goLogin() {
  var user = $('#user_login').val();
  var pass = $('#pass_login').val();

  if ($.trim(user).length > 0 && $.trim(pass).length > 0) {
    login_ajax(user, pass);
  } else {
    result = '<div class="alert alert-dismissible alert-danger">';
    result += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
    result += '<strong>ERROR: </strong>Todos los campos deben estar llenos.';
    result += '</div>';
    $('#_AJAX_LOGIN').html(result);
  }
}

function login_ajax(user, pass) {
  $.ajax({
    url:"?view=login&mode=iniciar",
    method:"POST",
    data:{u:user, p:pass},
    cache:"false",
    beforeSend:function() {
      result = '<div class="alert alert-dismissible alert-info">';
      result += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
      result += '<strong>Procesando: </strong>Estamos procesando tu solicitud.';
      result += '</div>';
      $('#_AJAX_LOGIN').html(result);
    },
    success:function(data) {
      if (data=='1') {
        $(location).attr('href', '?view=principal');
      } else {
        result = '<div class="alert alert-dismissible alert-warning">';
        result += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
        result += '<strong>Atención: </strong>El usuario o contraseña son incorrectos.';
        result += '</div>';
        $('#_AJAX_LOGIN').html(result);
      }
    },
    error:function() {
      result = '<div class="alert alert-dismissible alert-danger">';
      result += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
      result += '<strong>Error: </strong>Ha ocurrido un error inesperado.';
      result += '</div>';
      $('#_AJAX_LOGIN').html(result);
    }
  });
}

function fun_login(e) {
  if (e.keyCode == 13) {
    goLogin();
  }
}
