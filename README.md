# Actualización de la base de datos: tabla `usuarios`
## Descripción del cambio
Se requiere actualizar la estructura de la tabla `usuarios` con los siguientes cambios:

| Acción | Campo | Antes | Después |
|--------|-------|-------|---------|
| Agregar | `is_active` | No existía | `TINYINT(1) NOT NULL DEFAULT 1` |
| Modificar | `contrasena_usr` | `VARCHAR(25)` | `VARCHAR(255)` |

- **`is_active`**: nuevo campo que indica si el usuario está activo (`1`) o inactivo (`0`).
  Los registros existentes quedan como activos por defecto.
- **`contrasena_usr`**: se amplía la longitud a 255 caracteres para almacenar contraseñas
  cifradas con `password_hash()` de PHP, que generan cadenas largas.
