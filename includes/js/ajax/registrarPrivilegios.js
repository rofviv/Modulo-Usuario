$("#modulo-select").change(function() {
  var id_m = $("#modulo-select").val();
  cargarPrivilegios(id_m);
});

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
      $('#_tbl_privilegios').html('');
      $('#_div_privilegios').html('');
    },
    success:function(data) {
      if (data != '0') {
        for (var i = 0; i < data.length; i++) {
          $('#_tbl_privilegios').append('<tr><th>Opcion</th><th>Icono</th><th>Acciones</th></tr>');
          $('#_tbl_privilegios').append('<tr><td>' + data[i]['opcion'] + '</td><td><i class="' + data[i]['icon'] + '" aria-hidden="true"></i></td><td><a class="btn btn-success" href="#edit_p" data-toggle="modal" data-target="#edit_p" onclick="llenarCampos(' + data[i]['id'] + ')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><button type="button" class="btn btn-danger" onclick="eliminarPrivilegio(' + data[i]['id'] + ', ' + id + ')"><i class="fa fa-times" aria-hidden="true"></i></button></td></tr>');
        }
      } else {
        $('#_div_privilegios').html('Este grupo no tiene asignado ni un privilegio');
      }
    },
    complete:function() {
      $('#registrar_btn').removeAttr('disabled');
    }
  });
}

function llenarCampos(id) {
  $.ajax({
    url:"?view=privilegios&tipo=detalle&id=" + id,
    contentType:'application/json; charset=utf-8',
    method:"GET",
    data:"",
    cache:"false",
    dataType: 'json',
    beforeSend:function() {
    },
    success:function(data) {
      $('#_ID_PRIVILEGIO').html(data[0]['id']);
      $('#opcion_p').val(data[0]['opcion']);
      $('#icon_p').val(data[0]['icon']);
      $('#enlace_p').val(data[0]['enlace']);
      $('#icono').addClass(data[0]['icon']);
    },
    complete:function() {
    }
  });
}

function eliminarPrivilegio(id_p, id_g) {
  if (confirm('¿Estas seguro de enviar este formulario?')){
      eliminarPrivilegioConfirm(id_p, id_g);
   }
}

function eliminarPrivilegioConfirm(id_p, id_g) {
  $.ajax({
    url:"?view=privilegios&tipo=eliminar&id=" + id_p,
    contentType:'application/json; charset=utf-8',
    method:"GET",
    data:"",
    cache:"false",
    dataType: 'json',
    beforeSend:function() {
      $('#_tbl_privilegios').html('');
      $('#_div_privilegios').html('');
    },
    success:function(data) {
      if (data == '1') {
        cargarPrivilegios(id_g);
        $('#_div_privilegios').html('Eliminado Correctamente');
      } else {
        $('#_div_privilegios').html('No se pudo eliminar');
      }
    },
    complete:function() {

    }
  });
}

function guardarCambiosPrivilegios() {
  var id = $('#_ID_PRIVILEGIO').html();
  var opcion = $('#opcion_p').val();
  var icon = $('#icon_p').val();
  var enlace = $('#enlace_p').val();
  $.ajax({
    url:"?view=privilegios&tipo=actualizar",
    method:"GET",
    data:{id:id, o:opcion, i:icon, e:enlace},
    cache:"false",
    beforeSend:function() {
      result = '<div class="alert alert-dismissible alert-warning">';
  		result += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
  		result += '<strong>PROCESANDO: </strong>Se esta procesando la Actualización.';
      result += '</div>';
      $('#_AJAX_EDIT_').html(result);
    },
    success:function(data) {
      if (data == '1') {
        result = '<div class="alert alert-dismissible alert-success">';
    		result += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
    		result += '<strong>COMPLETADO: </strong>Se ha actualizado correctamente.';
        result += '</div>';
        $('#_AJAX_EDIT_').html(result);
      } else {
        result = '<div class="alert alert-dismissible alert-danger">';
    		result += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
    		result += '<strong>ERROR: </strong>Ha ocurrido un error inesperado.<br />';
        result += '</div>' + data;
        $('#_AJAX_EDIT_').html(result);
      }
    },
    complete:function() {
    }
  });
}

function nuevoPrivilegio() {
  var m = $('#modulo-select').val();
  var op = $('#opcion_reg').val();
  var en = $('#enlace_reg').val();
  var ic = $('#icono_reg').val();
  if (m != '-1') {
    nuevoPrivilegio_ajax(m, op, en, ic);
  } else {
    result = '<div class="alert alert-dismissible alert-warning">';
    result += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
    result += '<strong>ERROR: </strong>Debe seleccionar un grupo.<br />';
    result += '</div>';
    $('#_DIV_REG_PRI').html(result);
  }
}

function nuevoPrivilegio_ajax(id_g, opcion, enlace, icono) {
  $.ajax({
    url:"?view=registrar&tipo=privilegio",
    method:"GET",
    data:{id_g:id_g, o:opcion, e:enlace, i:icono},
    cache:"false",
    beforeSend:function() {
      result = '<div class="alert alert-dismissible alert-warning">';
  		result += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
  		result += '<strong>PROCESANDO: </strong>Se esta procesando el registro.';
      result += '</div>';
      $('#_DIV_REG_PRI').html(result);
    },
    success:function(data) {
      if (data == '1') {
        result = '<div class="alert alert-dismissible alert-success">';
    		result += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
    		result += '<strong>COMPLETADO: </strong>Se ha registrado el usuario correctamente.';
        result += '</div>';
        $('#_DIV_REG_PRI').html(result);
      } else {
        result = '<div class="alert alert-dismissible alert-danger">';
    		result += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
    		result += '<strong>ERROR: </strong>Ha ocurrido un error inesperado.<br />';
        result += '</div>' + data;
        $('#_DIV_REG_PRI').html(result);
      }
    },
    complete:function() {
      $('#opcion_reg').val('');
      $('#enlace_reg').val('');
      $('#icono_reg').val('');
      cargarPrivilegios(id_g);
    }
  });
}
