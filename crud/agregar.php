<?php
include "../config/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se han seleccionado categoría y marca
    if (isset($_POST['Persona'], $_POST['Activo']) && $_POST['Persona'] != "" && $_POST['Activo'] != "") {

        // Sanitizar y obtener datos del formulario
        $persona = mysqli_real_escape_string($conectar, $_POST['Persona']);
        $activo = mysqli_real_escape_string($conectar, $_POST['Activo']);
        $ubicacion = mysqli_real_escape_string($conectar, $_POST['ubicacion']);
        $fecha = mysqli_real_escape_string($conectar, $_POST['fecha']);
        

        // Insertar datos en la base de datos
        $sql = "INSERT INTO asignacion_activo (as_persona, as_activo, Ubicacion, Fecha) 
                VALUES ('$persona', '$activo', '$ubicacion', '$fecha')";

        if (mysqli_query($conectar, $sql)) {
            header("location: ../index.php");
            exit(); // ¡Asegúrate de salir después de la redirección!
        } else {
            echo "Error al agregar el producto: " . mysqli_error($conectar);
        }
    } else {
        echo "Por favor, asegúrate de seleccionar una categoría y una marca.";
    }
} else {
    echo "Acceso denegado.";
}
?>
