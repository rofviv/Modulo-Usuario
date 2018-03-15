
function registrarModulo() {
  var modulo = $('#modulo_reg').val();

  if ($.trim(modulo).length > 0) {
    registrarModulo_ajax(modulo);
  } else {
    result = '<div class="alert alert-dismissible alert-danger">';
		result += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
		result += '<strong>ERROR: </strong>Todos los campos con * deben estar llenos.';
    result += '</div>';
    $('#_AJAX_REG_').html(result);
  }
}

function registrarModulo_ajax(modulo) {
  $.ajax({
    url:"?view=registrar&tipo=modulo",
    method:"GET",
    data:{m:modulo},
    cache:"false",
    beforeSend:function() {
      result = '<div class="alert alert-dismissible alert-warning">';
  		result += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
  		result += '<strong>PROCESANDO: </strong>Se esta procesando el registro.';
      result += '</div>';
      $('#_AJAX_REG_').html(result);
    },
    success:function(data) {
      if (data == '1') {
        result = '<div class="alert alert-dismissible alert-success">';
    		result += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
    		result += '<strong>COMPLETADO: </strong>Se ha registrado el modulo correctamente.';
        result += '</div>';
        $('#_AJAX_REG_').html(result);
      } else {
        result = '<div class="alert alert-dismissible alert-danger">';
    		result += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
    		result += '<strong>ERROR: </strong>Ha ocurrido un error inesperado.<br />';
        result += '</div>' + data;
        $('#_AJAX_REG_').html(result);
      }
    },
    complete:function() {
      limpiarCampos();
    }
  });
}

function limpiarCampos() {
  $('#modulo_reg').val('');
}

function eliminarAlerta() {
  $('#_AJAX_REG_').html('');
}

function fun_register(e) {
  if (e.keyCode == 13) {
    registrarModulo();
  }
}
