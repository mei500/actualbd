<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>INE</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="assets/logo.png">
    <style>
        .table-container {
            max-height: 520px; /* Altura máxima del contenedor */
            overflow-y: auto; /* Activar desplazamiento vertical */
        }
        
        
        /* Puedes añadir estilos personalizados aquí si es necesario */
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center" style="background-color: #2a4797; color:white; border-radius:1px;">LISTADO DE ASIGNACIONES</h2>
</div>
<div class="container mt-3">
    <?php if(isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="max-width: 307px; font-size: 14px; display: none;">
            Asignación eliminada exitosamente.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
    <div class="container">
        <a href="formulario/agregar_form.php" class="btn btn-success float-right">Agregar Asignación</a>
    </div>
    <br>
    <br>

    <div class="container table-container">
    <table class="table table-bordered">
        <thead class="table-dark sticky-top" style="background-color:  #2a4797; color:white;">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Persona</th>
                <th scope="col">Activo</th>
                <th scope="col">Ubicación</th>
                <th scope="col">Fecha</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require("config/conexion.php");

            $sql = $conectar->query("SELECT * FROM asignacion_activo
                                 INNER JOIN persona ON asignacion_activo.as_persona = persona.pkpersona
                                 INNER JOIN activo_ine ON asignacion_activo.as_activo = activo_ine.pkactivo
                                 ORDER BY id_asignacion asc");

            while ($resultado =$sql->fetch_assoc()) {
                ?>
                <tr>
                    <th scope="row"> <?php echo $resultado['id_asignacion'] ?> </th>
                    <td scope="row"> <?php echo $resultado['nombre'] . ' ' . $resultado['apellidos']; ?> </td>
                    <td scope="row"> <?php echo $resultado['serie'] ?> </th>
                    <td scope="row"> <?php echo $resultado['Ubicacion'] ?> </td>
                    <td scope="row"> <?php echo $resultado['Fecha'] ?> </td>
                    <th>
                        <a href="formulario/editar_form.php?Id=<?php echo $resultado['id_asignacion'] ?>" class="btn btn-warning">Editar</a>
                        <button data-toggle="modal" data-target="#eliminarModal" style="background-color:  #a1221e; color:white;" class="btn"  data-id="<?php echo $resultado['id_asignacion']; ?>">Eliminar</button>
                    </th>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="eliminarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminarModalLabel">Confirmar Eliminación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Está seguro de eliminar el dato?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <a id="eliminarLink" href="#" class="btn btn-danger">Eliminar</a>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $('#eliminarModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var modal = $(this);
        modal.find('#eliminarLink').attr('href', '../crud/eliminar.php?Id=' + id);
    });

    document.addEventListener("DOMContentLoaded", function() {
        <?php if(isset($_GET['success'])): ?>
        var alertElement = document.querySelector('.alert');
        alertElement.style.display = 'block'; // Mostrar el mensaje

        setTimeout(function() {
            alertElement.style.transition = 'opacity 1s';
            alertElement.style.opacity = '0'; // Cambiar la opacidad a 0 para desvanecer
            setTimeout(function() {
                alertElement.style.display = 'none'; // Ocultar el mensaje después de 1 segundo
            }, 1000);
        }, 3000); // Desvanecer el mensaje después de 3 segundos
        <?php endif; ?>
    });
</script>
</body>
</html>
