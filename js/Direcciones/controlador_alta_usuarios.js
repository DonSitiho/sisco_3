$(document).ready(function () {
  // Cargar direcciones al iniciar
  $("#tablaUsuarios").DataTable({
    searchDelay: 500,
    processing: true,
    //serverSide: true,
    order: [[0, "asc"]],
    stateSave: true,
    ajax: {
      url: "../../ajax/Direcciones/lista_usuarios.php",
      type: "GET",
      dataSrc: "data",
    },
    columns: [
      {
        data: "nombre",
      },
      {
        data: "apellido_paterno",
      },
      {
        data: "apellido_materno",
      },
      {
        data: "usuario",
      },
      {
        data: "nombre_direccion",
      },
      {
        data: "nombre_subdireccion",
      },
      {
        data: "nombre_depto",
      },
      {
        data: "activo",
        render: function (data) {
          if (data == 1) {
            return '<span class="badge badge-success">Activo</span>';
          } else {
            return '<span class="badge badge-danger">Inactivo</span>';
          }
        },
      },
      {
        data: "acciones",
        orderable: false,
        searchable: false,
      },
    ],
    language: {
      url: "//cdn.datatables.net/plug-ins/1.13.8/i18n/es-ES.json",
    },
    responsive: true,
  });
});

$(document).on("click", ".btn-editar", function () {
  let id = $(this).data("id");

  $.ajax({
    url: "../../ajax/Direcciones/obtener_usuario.php",
    type: "GET",
    dataType: "json",
    data: {
      id: id,
    },
    success: function (response) {
      if (response.success) {
        let data = response.data;

        $("#id").val(data.id_usuario);
        $("#nombres_edit").val(data.nombres);
        $("#app_edit").val(data.apellido_paterno);
        $("#apm_edit").val(data.apellido_materno);
        $("#nick_name_edit").val(data.nombre_usuario);

        // CARGAR SUBDIRECCIONES
        cargarSelectEditar(
          data.id_direccion,
          data.id_subdireccion,
          data.id_dep,
        );

        $('input[name="roles_edit"][value="' + data.rol + '"]').prop(
          "checked",
          true,
        );

        $("#editUsuarioModal").modal("show");
      } else {
        Swal.fire({
          icon: "error",
          title: response.message,
          timer: 1500,
          showConfirmButton: false,
        });
      }
    },
    error: function () {
      Swal.fire({
        icon: "error",
        title: "Error en la petición",
        timer: 1500,
        showConfirmButton: false,
      });
    },
  });
});

$(document).on("click", ".btn-borrar", function () {
  let id = $(this).data("id");
  title = "¿Estás seguro de querer eliminar el usuario?";

  desactivar_activar_usuario(id, title);
});

$(document).on("click", ".btn-activar", function () {
  let id = $(this).data("id");
  title = "¿Estás seguro de querer activar el usuario?";

  desactivar_activar_usuario(id, title);
});

function desactivar_activar_usuario(id_usuario, title) {
  let id = id_usuario;
  let titulo = title;

  Swal.fire({
    title: titulo,
    text: "¡No podrás revertir esto!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#1ba23a",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí, eliminarlo!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "../../ajax/Direcciones/desactivar_usuario.php",
        type: "POST",
        dataType: "json",
        data: {
          id_usuario: id,
        },
        success: function (response) {
          if (response.success) {
            Swal.fire({
              icon: "success",
              text: response.message,
              timer: 1500,
              showConfirmButton: false,
            });

            // Actualizar la tabla DataTable
            $("#tablaUsuarios").DataTable().ajax.reload();
          } else {
            Swal.fire({
              icon: "error",
              title: response.message,
            });
          }
        },
        error: function () {
          Swal.fire({
            icon: "error",
            title: "Error en la petición",
            timer: 1500,
            showConfirmButton: false,
          });
        },
      });
    }
  });
}

$("#add_usuario").submit(function (e) {

	e.preventDefault();

	const camposValidos = Object.keys(INPUTS_MAP).filter(
		id => document.getElementById("#" + id) !== null
	);

	const ok = validarFormulario(camposValidos);
    if (!ok) return;

	let datos = $(this).serialize();
	$.ajax({
		url: "../../ajax/Direcciones/add_usuario.php",
		type: "POST",
		dataType: 'json',
		data: datos,
		success: function (response) {

			if (response.status == 'success') {
				Swal.fire({
					icon: 'success',
					title: 'Éxito',
					draggable: true,
					text: response.message,
					confirmButtonColor: '#28a745'
				});

				$('#addUsuarioModal').modal('hide');
				$("#add_usuario")[0].reset();
				$('#tablaUsuarios').DataTable().ajax.reload();
			} else {
				Swal.fire({
					icon: 'error',
					title: 'Error',
					text: response.message,
					draggable: true,
					timer: 1500,
					showConfirmButton: false
				});
			}
		},
		error: function () {
			Swal.fire({
				icon: 'error',
				title: 'Error del servidor',
				text: 'Ocurrió un problema inesperado'
			});
		},
	});
});

$("#editarUsuario").submit(function (e) {
  e.preventDefault();

  const camposValidos = Object.keys(INPUTS_MAP).filter(
    (id) => id.endsWith("_edit") && document.getElementById(id) !== null,
  );

  if (!validarFormulario(camposValidos)) {
    return;
  }

  let datos = $(this).serialize();

  $.ajax({
    url: "../../ajax/Direcciones/edit_usuario.php",
    type: "POST",
    dataType: "json",
    data: datos,
    success: function (response) {
      if (response.status == "success") {
        Swal.fire({
          icon: "success",
          title: "Éxito",
          draggable: true,
          text: response.message,
          confirmButtonColor: "#28a745",
        });

        $("#editUsuarioModal").modal("hide");
        $("#editarUsuario")[0].reset();
        $("#tablaUsuarios").DataTable().ajax.reload();
      } else {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: response.message,
          draggable: true,
          timer: 1500,
          showConfirmButton: false,
        });
      }
    },
    error: function () {
      Swal.fire({
        icon: "error",
        title: "Error del servidor",
        text: "Ocurrió un problema inesperado",
      });
    },
  });
});

$("#direccion1").on("change", function () {
  const id_direccion = $(this).val();

  const subdirecion = $("#subdireccion1");
  const departamento = $("#departamento1");

  cargarSubdirecciones(id_direccion, subdirecion, departamento);
});

$("#direccion1_edit").on("change", function () {
  let id_direccion = $(this).val();

  const subdirecion = $("#subdireccion1_edit");
  const departamento = $("#departamento1_edit");

  cargarSubdirecciones(id_direccion, subdirecion, departamento);
});

function cargarSubdirecciones(id_direccion, subdireccion, departamento) {
  bloquearSelect(departamento, "Selecciona una subdirección primero");

  if (id_direccion === "" || id_direccion === "0") {
    bloquearSelect(subdireccion, "Selecciona una dirección");
    return;
  }

  bloquearSelect(subdireccion, "Cargando subdirecciones...");

  $.ajax({
    url: "../../ajax/Direcciones/get_subdirecciones.php",
    type: "GET",
    dataType: "json",
    data: { id_direccion: id_direccion },
    success: function (response) {
      if (!response.success) {
        bloquearSelect(subdireccion, "Error: " + response.mensaje);
        return;
      }

      if (response.data.length === 0) {
        bloquearSelect(subdireccion, "No hay subdirecciones disponibles");
        return;
      }

      llenarSelect(subdireccion, response.data, "Selecciona una subdirección");
      subdireccion.prop("disabled", false);
    },
    error: function () {
      bloquearSelect(subdireccion, "Error al cargar las subdirecciones");
      bloquearSelect(departamento, "Selecciona una subdirección primero");
    },
  });
}

$("#subdireccion1").on("change", function () {
  const id_subdireccion = $(this).val();

  const depart = $("#departamento1");
  cargarDepartamentos(id_subdireccion, depart);
});

$("#subdireccion1_edit").on("change", function () {
  let id_subdireccion = $(this).val();

  const depart = $("#departamento1_edit");
  cargarDepartamentos(id_subdireccion, depart);
});

function cargarDepartamentos(id_subdireccion, departamento) {
  if (id_subdireccion === "" || id_subdireccion === "0") {
    bloquearSelect(departamento, "Selecciona una subdirección");
    return;
  }

  bloquearSelect(departamento, "Cargando departamentos...");

  $.ajax({
    url: "../../ajax/Direcciones/get_departamentos.php",
    type: "GET",
    dataType: "json",
    data: { id_subdireccion: id_subdireccion },
    success: function (response) {
      if (!response.success) {
        bloquearSelect(departamento, "Error: " + response.mensaje);
        return;
      }

      if (response.data.length === 0) {
        bloquearSelect(departamento, "No hay departamentos disponibles");
        return;
      }

      llenarSelect(departamento, response.data, "Selecciona un departamento");
      departamento.prop("disabled", false);
    },
    error: function () {
      bloquearSelect(departamento, "Error al cargar los departamentos");
    },
  });
}

function cargarSelectEditar(id_direccion, id_subdireccion, id_departamento) {
  const selDireccion = $("#direccion1_edit");
  const selSubdireccion = $("#subdireccion1_edit");
  const selDepartamento = $("#departamento1_edit");

  selDireccion.val(id_direccion);
  bloquearSelect(selSubdireccion, "Cargando...");
  bloquearSelect(selDepartamento, "Cargando...");

  $.ajax({
    url: "../../ajax/Direcciones/get_subdirecciones.php",
    type: "GET",
    dataType: "json",
    data: { id_direccion: id_direccion },
    success: function (response) {
      if (!response.success || response.data.length === 0) {
        bloquearSelect(selSubdireccion, "No hay subdirecciones");
        bloquearSelect(selDepartamento, "Selecciona una subdirección primero");
        return;
      }

      // Llenar y marcar subdirección
      llenarSelect(
        selSubdireccion,
        response.data,
        "Selecciona una subdirección",
      );
      selSubdireccion.val(id_subdireccion).prop("disabled", false);

      // Con la subdirección ya marcada, cargar departamentos
      $.ajax({
        url: "../../ajax/Direcciones/get_departamentos.php",
        type: "GET",
        dataType: "json",
        data: { id_subdireccion: id_subdireccion },
        success: function (response) {
          if (!response.success || response.data.length === 0) {
            bloquearSelect(selDepartamento, "No hay departamentos");
            return;
          }

          // Llenar y marcar departamento
          llenarSelect(
            selDepartamento,
            response.data,
            "Selecciona un departamento",
          );
          selDepartamento.val(id_departamento).prop("disabled", false);
        },
        error: function () {
          bloquearSelect(selDepartamento, "Error al cargar departamentos");
        },
      });
    },
    error: function () {
      bloquearSelect(selSubdireccion, "Error al cargar subdirecciones");
      bloquearSelect(selDepartamento, "Selecciona una subdirección primero");
    },
  });
}

function llenarSelect(select, datos, placeholder) {
  select.empty().append($("<option>").val("").text(placeholder));

  $.each(datos, function (i, item) {
    select.append($("<option>").val(item.id).text(item.nombre));
  });
}

function bloquearSelect(select, mensaje) {
  select
    .empty()
    .append($("<option>").val("").text(mensaje))
    .prop("disabled", true);
}

const INPUTS_MAP = {
  // Campos del formulario de editar
  nombres_edit: "nombres",
  app_edit: "app",
  apm_edit: "apm",
  nick_name_edit: "nick_name",
  direccion1_edit: "direccion",
  password_edit: "password",

  // Campos del formulario de agregar
  nombres: "nombres",
  app: "app",
  apm: "apm",
  nick_name: "nick_name",
  password: "password",
  direccion1: "direccion",
  subdireccion: "subdireccion",
  departamento: "departamento",
};

const RULES = {
  nombres: {
    min: 4,
    max: 60,
    pattern: /^[\p{L}\s]+$/u,
    msg: "Solo letras y espacios",
  },
  app: {
    min: 4,
    max: 60,
    pattern: /^[\p{L}\s]+$/u,
    msg: "Solo letras y espacios",
  },
  apm: {
    min: 4,
    max: 60,
    pattern: /^[\p{L}\s]+$/u,
    msg: "Solo letras y espacios",
  },
  nick_name: {
    min: 5,
    max: 30,
    pattern: /^[a-zA-Z0-9]+$/,
    msg: "Solo letras y números",
  },
  password: {
    min: 6,
    max: 12,
    pattern: /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).+$/,
    msg: "Debe tener mayúscula, minúscula y número",
  },
  direccion: { select: true, msgEmpty: "Selecciona una dirección" },

  // Selects dinámicos del formulario
  subdireccion: { select: true, msgEmpty: "Selecciona una subdirección" },
  departamento: { select: true, msgEmpty: "Selecciona una departamento" },
};

// Validar un campo
function validarInput(name, value) {
  const input = INPUTS_MAP[name] || name;
  const rule = RULES[input];
  if (!rule) return null;

  // validar para select direccion
  if (rule.select) {
    return !value || value === ""
      ? rule.msgEmpty || "Este campo es obligatorio"
      : null;
  }

  const v = value.trim();

  // Password en edición es opcional
  if (name === "password_edit" && v === "") return null;

  if (v === "") return "Este campo es obligatorio";
  if (rule.min && v.length < rule.min) {
    return `Mínimo ${rule.min} caracteres`;
  }
  if (rule.max && v.length > rule.max) {
    return `Máximo ${rule.max} caracteres`;
  }
  if (rule.pattern && !rule.pattern.test(v)) {
    return rule.msg;
  }

  return null;
}

function setFieldState(inputId, error) {
  const input = document.getElementById(inputId);
  const err = document.getElementById("error-" + inputId);
  if (!input) return;

  input.dataset.touched = "true";

  if (error) {
    input.style.borderColor = "#c0392b";
    input.style.background = "#fdf0ee";
    input.style.boxShadow = "0 0 0 3px rgba(192,57,43,0.08)";
  } else {
    input.style.borderColor = "#1e7e4a";
    input.style.background = "";
    input.style.boxShadow = "";
  }

  if (err) err.textContent = error || "";
}

document.addEventListener("DOMContentLoaded", () => {
  Object.keys(INPUTS_MAP).forEach((name) => {
    const input = document.getElementById(name);
    if (!input) return;

    const rulename = INPUTS_MAP[name];
    const rule = RULES[rulename];
    if (!rule) return;

    // Select usa 'change', inputs usan 'blur' e 'input'
    if (rule.select) {
      input.addEventListener("change", () => {
        setFieldState(name, validarInput(name, input.value));
      });
      return;
    }

    input.addEventListener("blur", () => {
      setFieldState(name, validarInput(name, input.value));
    });

    input.addEventListener("input", () => {
      // Actualizar solo si el campo ya fue tocado
      if (input.dataset.touched === "true") {
        setFieldState(name, validarInput(name, input.value));
      }
    });
  });

  // Botón cancelar e X del modal AGREGAR
  $("#addUsuarioModal").on("hide.bs.modal", function () {
    resetFormulario("add_usuario");
  });

  // Botón cancelar e X del modal EDITAR
  $("#editUsuarioModal").on("hide.bs.modal", function () {
    resetFormulario("editarUsuario");
  });
});

function validarFormulario(inputs) {
  let isValid = true;

  inputs.forEach((name) => {
    const input = document.getElementById(name);
    if (!input) return;

    const error = validarInput(name, input.value);
    if (error) {
      isValid = false;
    }
    setFieldState(name, error);
  });

  return isValid;
}

function resetFormulario(formId) {
  const form = document.getElementById(formId);
  if (!form) return;

  // Resetea los valores nativos del formulario
  form.reset();

  // Limpia los estilos y mensajes de error de cada campo
  Object.keys(INPUTS_MAP).forEach((name) => {
    const el = document.getElementById(name);
    if (!el) return;

    // Limpiar estilos
    el.style.borderColor = "";
    el.style.background = "";
    el.style.boxShadow = "";

    // Limpiar dataset touched
    delete el.dataset.touched;

    // Limpiar mensaje de error
    const err = document.getElementById("error-" + name);
    if (err) err.textContent = "";
  });
}

function Seguimiento() {
  var parametros = new FormData($("#finalizar_Seguimiento")[0]);
  $("#finalizar_Seguimiento")[0].reset();
  $.ajax({
    type: "POST",
    data: parametros,
    url: "../../ajax/Direcciones/Adjuntar_seguimiento.php", //modificar
    contentType: false,
    processData: false,
    beforeSend: function (objeto) {
      $("#resultados12")
        .show()
        .html(
          '<div class="loading"><img src="../../images/cargando.gif" alt="loading" width="30%" /><br/>Un momento, por favor...</div>',
        );
      $("#btnfinalizar").hide();
      $("#btnSeguimiento").hide();
    },
    success: function (datos) {
      $("#resultados").html(datos);
      load(1);
      $("#viewCorrespondenciaModalSeguimiento").modal("hide");
    },
  });
  event.preventDefault();
}
