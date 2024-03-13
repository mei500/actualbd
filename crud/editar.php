<?php 
include_once "../config/conexion.php";

// Obtener los datos del formulario
$id = $_POST['IdE'];
$persona = $_POST['PersonaE'];
$activo = $_POST['ActivoE'];
$ubicacion = $_POST['ubicacionE'];
$fecha = $_POST['fechaE'];

// Verificar si es una nueva asignación o una modificación
if (empty($id)) {
    // Es una nueva asignación
    // Obtener el último ID de asignación y sumar 1 para el nuevo ID
    $sqlLastID = "SELECT MAX(id_asignacion) AS last_id FROM asignacion_activo";
    $resultadoLastID = mysqli_query($conectar, $sqlLastID);
    $filaLastID = mysqli_fetch_assoc($resultadoLastID);
    $new_id = $filaLastID['last_id'] + 1;

    // Insertar los datos en la tabla asignacion_activo
    $sqlInsert = "INSERT INTO asignacion_activo (id_asignacion, as_persona, as_activo, Ubicacion, Fecha) VALUES ('$new_id', '$persona', '$activo', '$ubicacion', '$fecha')";
    $resultadoInsert = mysqli_query($conectar, $sqlInsert);
    
    // Insertar los datos en el historial solo si es una nueva asignación
    $sqlHistorial = "INSERT INTO historial_asignacion_activo (id_asignacion, as_persona_nuevo, as_activo_nuevo, ubicacion_nuevo, fecha_nuevo) 
                    VALUES ('$new_id', '$persona', '$activo', '$ubicacion', '$fecha')";
    $resultadoHistorial = mysqli_query($conectar, $sqlHistorial);
} else {
    // Es una modificación de una asignación existente
    // Obtener los datos originales de la asignación
    $sqlOriginal = "SELECT * FROM asignacion_activo WHERE id_asignacion = $id";
    $resultadoOriginal = mysqli_query($conectar, $sqlOriginal);
    $filaOriginal = mysqli_fetch_assoc($resultadoOriginal);

    // Insertar los datos modificados en el historial
    $sqlHistorialModificado = "INSERT INTO historial_asignacion_activo (id_asignacion, as_persona_nuevo, as_activo_nuevo, ubicacion_nuevo, fecha_nuevo, id_asignacion_antiguo, as_persona_antiguo, as_activo_antiguo, ubicacion_antiguo, fecha_antiguo) 
                                VALUES ('$id', '$persona', '$activo', '$ubicacion', '$fecha', '$id', '{$filaOriginal['as_persona']}', '{$filaOriginal['as_activo']}', '{$filaOriginal['Ubicacion']}', '{$filaOriginal['Fecha']}')";
    $resultadoHistorialModificado = mysqli_query($conectar, $sqlHistorialModificado);

    // Actualizar los datos en la tabla principal
    $sqlUpdate = "UPDATE asignacion_activo SET as_persona='$persona', as_activo='$activo', Ubicacion='$ubicacion', Fecha='$fecha' WHERE id_asignacion='$id'";
    $resultadoUpdate = mysqli_query($conectar, $sqlUpdate);
}

// Verificar si las consultas se realizaron con éxito
if ((isset($resultadoInsert) && $resultadoInsert) || (isset($resultadoHistorial) && $resultadoHistorial && isset($resultadoUpdate) && $resultadoUpdate && isset($resultadoHistorialModificado) && $resultadoHistorialModificado)) {
    header("location:../index.php");
} else {
    echo "Error al actualizar los datos.";
} 