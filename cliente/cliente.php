<?php
include "../includes/header.php";
require('../config/conexion.php');

$query = "SELECT * FROM `asesor`";

$result1 = mysqli_query($conn, $query);
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Entidad análoga a MECANICO (CLIENTE)</h1>   

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <form action="cliente_insert.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="documento_identidad" class="form-label">Documento de Identidad</label>
            <input type="number" class="form-control" id="documento_identidad" name="documento_identidad" required>
        </div>

        <div class="mb-3">
            <label for="nacionalidad" class="form-label">Nacionalidad</label>
            <input type="text" class="form-control" id="nacionalidad" name="nacionalidad" required>
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" required>
        </div>

        <div class="mb-3">
            <label for="año_nacimiento" class="form-label">Año de nacimiento</label>
            <input type="number" class="form-control" id="año_nacimiento" name="año_nacimiento" required>
        </div>

        <div class="mb-3">
            <label for="asesor" class="form-label">Asesor</label>
            <select name="asesor" id="asesor">
                <?php while($row1 = mysqli_fetch_array($result1)):;?>
                    <option><?php echo $row1[0];?></option>
                <?php endwhile;?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Agregar</button>

    </form>
    
</div>

<?php
// Importar el código del otro archivo
require("cliente_select.php");

// Verificar si llegan datos
if($resultadoCliente and $resultadoCliente->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Documento</th>
                <th scope="col" class="text-center">Nacionalidad</th>
                <th scope="col" class="text-center">Nombre</th>
                <th scope="col" class="text-center">Apellido</th>
                <th scope="col" class="text-center">Año de nacimiento</th>
                <th scope="col" class="text-center">Asesor</th>
                <th scope="col" class="text-center">Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoCliente as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["documento_identidad"]; ?></td>
                <td class="text-center"><?= $fila["nacionalidad"]; ?></td>
                <td class="text-center"><?= $fila["nombre"]; ?></td>
                <td class="text-center"><?= $fila["apellido"]; ?></td>
                <td class="text-center"><?= $fila["año_nacimiento"]; ?></td>
                <td class="text-center"><?= $fila["asesor"]; ?></td>
                
                <!-- Botón de eliminar. Debe de incluir la CP de la entidad para identificarla -->
                <td class="text-center">
                    <form action="cliente_delete.php" method="post">
                        <input hidden type="text" name="cedulaEliminar" value="<?= $fila["documento_identidad"]; ?>">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>

            </tr>

            <?php
            // Cerrar los estructuras de control
            endforeach;
            ?>

        </tbody>

    </table>
</div>

<?php
endif;

include "../includes/footer.php";
?>