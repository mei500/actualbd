<?php
include '../config/conexion.php';

$id = $_GET['Id'];

// Consulta para obtener el nombre del chofer antes de eliminarlo
$sql = "SELECT as_persona FROM asignacion_activo WHERE id_asignacion = $id";
$resultado = mysqli_query($conectar, $sql);
$name = mysqli_fetch_assoc($resultado)['as_persona'];

// Eliminación del chofer de la base de datos
$query_eliminar = "DELETE FROM asignacion_activo WHERE id_asignacion = $id";
mysqli_query($conectar, $query_eliminar);

// Redirección a index.php con un mensaje de éxito
header("Location: ../index.php?success=1&nombre=" . $name);
?>