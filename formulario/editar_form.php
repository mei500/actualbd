<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>INE</title>
    <link rel="shortcut icon" type="image/x-icon" href="../assets/logo.png">
</head>
<body>
    <h1 class="bg-warning p-2 text-white text-center">Editar Asignacion</h1>
    <br>
    <div class="container">
        <form action="../crud/editar.php" method="post">
            <?php 
                include "../config/conexion.php";

                $sql = "SELECT * FROM asignacion_activo WHERE id_asignacion =".$_GET['Id'];
                $resultado = $conectar->query($sql);
                $row5 = $resultado->fetch_assoc();
            ?>
            <input type="hidden" class="form-control" name="IdE" value="<?php echo $row5['id_asignacion'];?>">
            
            <label for="PersonaE" class="form-label">Persona</label>
            <select class="form-select mb-3" aria-label="Default select example" name="PersonaE">
                <option selected disabled>--seleccionar persona--</option>
                <?php 
                    include "../config/conexion.php";
                    $sql = "SELECT * FROM persona WHERE pkpersona=" . $row5['as_persona'];
                    $resultado = $conectar->query($sql);
                    $row = $resultado->fetch_assoc();
                    echo "<option selected value='" . $row['pkpersona'] . "'>" . $row['nombre'] . ' ' . $row['apellidos'] . "</option>";

                    $sql2 = "SELECT * FROM persona";
                    $resultado2 = $conectar->query($sql2);

                    while ($Fila = $resultado2->fetch_array()){
                        echo "<option value='" . $Fila['pkpersona'] . "'>" . $Fila['nombre'] . ' ' . $Fila['apellidos'] . "</option>";  
                    }                  
                ?>
            </select>

            <label for="ActivoE" class="form-label">Activo</label>
            <select class="form-select mb-3" aria-label="Default select example" name="ActivoE">
                <option selected disabled>--seleccionar activo--</option>
                <?php 
                    include "../config/conexion.php";
                    
                    $sql3 = "SELECT * FROM activo_ine WHERE pkactivo=" . $row5['as_activo'];
                    $resultado3 = $conectar->query($sql3);
                    $row3 = $resultado3->fetch_assoc();
                    echo "<option selected value='" . $row3['pkactivo'] . "'>" . $row3['serie'] . "</option>";
                    
                    $sql4 = "SELECT * FROM activo_ine";
                    $resultado4 = $conectar->query($sql4);

                    while ($Fila = $resultado4->fetch_array()){
                        echo "<option value='" . $Fila['pkactivo'] . "'>" . $Fila['serie'] . "</option>";  
                    }                  
                ?>
            </select>

            <div class="mb-3">
                <label for="ubicacionE" class="form-label">Ubicacion</label>
                <input type="text" class="form-control" name="ubicacionE" value="<?php echo $row5['Ubicacion'];?>">
            </div>
            <div class="mb-3">
                <label for="fechaE" class="form-label">Fecha</label>
                <input type="date" class="form-control" name="fechaE" value="<?php echo $row5['Fecha'];?>">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-warning">Guardar</button>
                <a href="../index.php" class="btn btn-secondary">Regresar</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
