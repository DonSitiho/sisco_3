<?php if (empty($_SESSION['forzar_cambio_password'])) return; ?>

<div class="modal fade show" id="cambiarPassword" tabindex="-1" style="display:block;" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5"> 🔒 Actualiza tu contraseña</h1><br>
            </div>
            <div class="alert alert-warning" role="alert">
                Tu contraseña actual no es segura. Por favor crea una nueva.
            </div>
            <div class="modal-body">
                <?php
                // Calcula la ruta a cambiar_password.php según desde dónde se incluye la modal
                $rutaActual = $_SERVER['PHP_SELF'];

                if (strpos($rutaActual, 'ofnasrio/vistas') !== false) {
                    // ofnasrio/vistas/oficiosrio.php → sube dos niveles
                    $actionCambiarPassword = '../../php/cambiar_password.php';
                } elseif (
                    strpos($rutaActual, 'vistas/Direcciones') !== false ||
                    strpos($rutaActual, 'vistas/Particular') !== false
                ) {
                    // vistas/Direcciones/*.php o vistas/Particular/*.php → sube dos niveles
                    $actionCambiarPassword = '../../php/cambiar_password.php';
                } else {
                    // raíz: correspondencia.php, dashboard.php → sube un nivel
                    $actionCambiarPassword = 'php/cambiar_password.php';
                }
                ?>

                <form id="password_nuevo" action="<?= $actionCambiarPassword  ?> " method="POST">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="label-material" for="nueva">Nueva contraseña</label>
                            <input type="password" class="form-control" name="nueva" id="nueva" placeholder="Mínimo 6 caracteres">
                        </div>
                        <div class="form-group col-md-12">
                            <label class="label-material" for="confirmar">Confirmar contraseña</label>
                            <input type="password" class="form-control" name="confirmar" id="confirmar" placeholder="Repite la contraseña">
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="alert alert-danger d-none error" id="msgError" role="alert"></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btnGuardar">Guardar</button>
            </div>

        </div>
    </div>
</div>


<script>
    document.getElementById('nueva').addEventListener('blur', function() {
        validarContraseña(this);
    });

    document.getElementById('nueva').addEventListener('input', function() {
        validarContraseña(this);
    });

    document.getElementById('confirmar').addEventListener('blur', function() {
        validarConfirmar(this);
    });

    document.getElementById('confirmar').addEventListener('input', function() {
        validarConfirmar(this);
    });

    // Validar el formulario antes de enviarse.
    document.getElementById('btnGuardar').addEventListener('click', function(e) {
        e.preventDefault();

        const nueva = document.getElementById('nueva');
        const confirmar = document.getElementById('confirmar');

        validarContraseña(nueva);
        validarConfirmar(confirmar);

        if (nueva.classList.contains('is-invalid') || confirmar.classList.contains('is-invalid') || confirmar.value === '') {
            return;
        }

        document.getElementById('password_nuevo').submit();

        /*
        Swal.fire({
            icon: 'success',
            title: '¡Contraseña actualizada!',
            text: 'Tu contraseña se guardó correctamente.',
            confirmButtonText: 'Continuar',
            confirmButtonColor: '#2563eb',
            allowOutsideClick: false,
            allowEscapeKey: false
        }).then(function() {
            document.getElementById('password_nuevo').submit();
        });
        */
    });


    function validarConfirmar(input) {

        const cconfirmar = input.value;
        const cnueva = document.getElementById('nueva').value;
        const errorConf = document.getElementById('msgError');

        if (cconfirmar === '') {
            errorConf.textContent = "Confirma tu nueva contraseña.";
            errorConf.classList.remove('d-none');
            input.classList.add('is-invalid');
            input.classList.remove('is-valid');
        } else if (cconfirmar.length < 6 || cconfirmar.length > 12) {
            errorConf.textContent = "Confirmar contraseña debe tener entre 6 y 12 caracteres.";
            errorConf.classList.remove('d-none');
            input.classList.add('is-invalid');
            input.classList.remove('is-valid');
        } else if (!/[A-Z]/.test(cconfirmar) || !/[a-z]/.test(cconfirmar) || !/[0-9]/.test(cconfirmar)) {
            errorConf.textContent = 'Confirmar contraseña debe contener al menos una mayúscula, una minúscula y un número.';
            errorConf.classList.remove('d-none');
            input.classList.add('is-invalid');
            input.classList.remove('is-valid');
        } else if (cconfirmar !== cnueva) {
            errorConf.textContent = 'Las contraseñas no coinciden.';
            errorConf.classList.remove('d-none');
            input.classList.add('is-invalid');
            input.classList.remove('is-valid');
        } else {
            errorConf.textContent = '';
            errorConf.classList.add('d-none');
            input.classList.add('is-valid');
            input.classList.remove('is-invalid');
        }
    }

    function validarContraseña(input) {
        const cnueva = input.value;
        const errorPass = document.getElementById('msgError');

        if (cnueva === '') {
            errorPass.textContent = "Ingresa tu nueva contraseña.";
            errorPass.classList.remove('d-none');
            input.classList.add('is-invalid');
            input.classList.remove('is-valid');
        } else if (cnueva.length < 6 || cnueva.length > 12) {
            errorPass.textContent = "La nueva contraseña debe tener entre 6 y 12 caracteres.";
            errorPass.classList.remove('d-none');
            input.classList.add('is-invalid');
            input.classList.remove('is-valid');
        } else if (!/[A-Z]/.test(cnueva) || !/[a-z]/.test(cnueva) || !/[0-9]/.test(cnueva)) {
            errorPass.textContent = 'La nueva contraseña debe contener al menos una mayúscula, una minúscula y un número.';
            errorPass.classList.remove('d-none');
            input.classList.add('is-invalid');
            input.classList.remove('is-valid');
        } else {
            errorPass.textContent = '';
            errorPass.classList.add('d-none');
            input.classList.add('is-valid');
            input.classList.remove('is-invalid');
        }

        var confirmar = document.getElementById('confirmar');
        if (confirmar.value !== '') {
            validarConfirmar(confirmar);
        }

    }
</script>