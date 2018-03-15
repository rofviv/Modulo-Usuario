var privilegios = new Array();
function registrarUsuario() {
  var nombre = $('#nombre_reg').val();
  var usuario = $('#usuario_reg').val();
  var clave = $('#clave_reg').val();
  var clave2 = $('#clave2_reg').val();

  if ($.trim(nombre).length > 0 && $.trim(usuario).length > 0 && $.trim(clave).length > 0 && $.trim(clave2).length > 0) {
    if (clave == clave2) {
      if (privilegios.length <= 0) {
        result = '<div class="alert alert-dismissible alert-danger">';
    		result += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
    		result += '<strong>ERROR: </strong>Tienes que colocar al menos un privilegio';
        result += '</div>';
        $('#_AJAX_REG_').html(result);
      } else {
        registrarUsuario_ajax(nombre, usuario, clave);
      }
    } else {
      result = '<div class="alert alert-dismissible alert-danger">';
  		result += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
  		result += '<strong>ERROR: </strong>Las contraseñas no coinciden';
      result += '</div>';
      $('#_AJAX_REG_').html(result);
    }
  } else {
    result = '<div class="alert alert-dismissible alert-danger">';
		result += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
		result += '<strong>ERROR: </strong>Todos los campos con * deben estar llenos.';
    result += '</div>';
    $('#_AJAX_REG_').html(result);
  }
}

function registrarUsuario_ajax(nombre, usuario, clave) {
  $.ajax({
    url:"?view=registrar&tipo=usuario",
    method:"POST",
    data:{n:nombre, u:usuario, p:clave, priv:JSON.stringify(privilegios)},
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
    		result += '<strong>COMPLETADO: </strong>Se ha registrado el usuario correctamente.';
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
  $('#nombre_reg').val('');
  $('#usuario_reg').val('');
  $('#clave_reg').val('');
  $('#clave2_reg').val('');
  privilegios.splice(0, privilegios.length);
  $('#_div_privilegios').html('No se ha seleccionado un grupo.');
}

function eliminarAlerta() {
  $('#_AJAX_REG_').html('');
}

function fun_register(e) {
  if (e.keyCode == 13) {
    registrarUsuario();
  }
}

function cargarPrivilegios(id) {
  $.ajax({
    url:"?view=privilegios&tipo=obtener&id=" + id,
    contentType:'application/json; charset=utf-8',
    method:"GET",
    data:"",
    cache:"false",
    dataType: 'json',
    beforeSend:function() {
      $('#_div_privilegios').html('');
      privilegios.splice(0, privilegios.length);
    },
    success:function(data) {
      if (data != '0') {
        for (var i = 0; i < data.length; i++) {
          element = '<div class="checkbox"><label>';
          element += '<input type="checkbox" onclick="agregarPrivilegio('+ data[i]['id'] +')" > ' + data[i]['opcion'];
          element += '</label></div>';
          $('#_div_privilegios').append(element);
        }
      } else {
        $('#_div_privilegios').html('Este grupo no tiene asignado ni un privilegio, editalo <a href="?view=privilegios">Aqui</a>');
      }
    },
    complete:function() {
      $('#registrar_btn').removeAttr('disabled');
    }
  });
}

function agregarPrivilegio(id) {
  privilegios.push(id);
}
