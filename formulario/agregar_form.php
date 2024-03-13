<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/logo.png">
</head>

<body>
    <h1 class="bg-success p-2 text-white text-center">Agregar Asignacion</h1>
    <br>
    <div class="container">
        <form id="productForm" action="../crud/agregar.php" method="post">
            <div class="mb-3">
                <label for="CategoriaP" class="form-label">Categorias</label>
                <select class="form-select" id="CategoriaP" name="Persona" required>
                    <option value="" selected disabled>--seleccionar persona--</option>
                    <?php
                    include "../config/conexion.php";
                    $sql = $conectar->query("SELECT * FROM persona");
                    while ($resultado = $sql->fetch_assoc()) {
                        echo "<option value='" . $resultado['pkpersona'] . "'>" . $resultado['nombre'] . ' ' . $resultado['apellidos'] . "</option>";
                    }
                    ?>
                </select>
                <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($_POST["Persona"])) : ?>
                    <div class="text-danger">Por favor, selecciona una persona.</div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="MarcaP" class="form-label">Activo</label>
                <select class="form-select" id="MarcaP" name="Activo" required>
                    <option value="" selected disabled>--seleccionar activo--</option>
                    <?php
                    $sql = $conectar->query("SELECT * FROM activo_ine");
                    while ($resultado = $sql->fetch_assoc()) {
                        echo "<option value='" . $resultado['pkactivo'] . "'>" . $resultado['serie'] . "</option>";
                    }
                    ?>
                </select>
                <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($_POST["Activo"])) : ?>
                    <div class="text-danger">Por favor, selecciona un activo.</div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Ubicacion</label>
                <input type="text" class="form-control" name="ubicacion" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Fecha</label>
                <input type="date" class="form-control" name="fecha" required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">Agregar</button>
                <a href="../index.php" class="btn btn-secondary">Regresar</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
