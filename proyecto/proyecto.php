<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Entidad análoga a REPARACION (RESERVA)</h1>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <form action="proyecto_insert.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="id_reserva" class="form-label">ID</label>
            <input type="number" class="form-control" id="id_reserva" name="id_reserva" required>
        </div>

        <div class="mb-3">
            <label for="fecha_reserva" class="form-label">Fecha de reserva</label>
            <input type="date" class="form-control" id="fecha_reserva" name="fecha_reserva" required>
        </div>

        <div class="mb-3">
            <label for="fecha_cancelacion" class="form-label">Fecha de cancelacion</label>
            <input type="date" class="form-control" id="fecha_cancelacion" name="fecha_cancelacion">
        </div>

        <div class="mb-3">
            <label for="valor" class="form-label">Valor</label>
            <input type="number" class="form-control" id="valor" name="valor" required>
        </div>
        
        <!-- Consultar la lista de clientes y desplegarlos -->
        <div class="mb-3">
            <label for="cliente" class="form-label">Cliente</label>
            <select name="cliente" id="cliente" class="form-select" required>

                <?php
                // Importar el código del otro archivo
                require("../cliente/cliente_select.php");
                
                // Verificar si llegan datos
                if($resultadoCliente):
                    
                    // Iterar sobre los registros que llegaron
                    foreach ($resultadoCliente as $fila):
                ?>

                <!-- Opción que se genera -->
                <option value="<?= $fila["documento_identidad"]; ?>"><?= $fila["nombre"]; ?> - C.C. <?= $fila["documento_identidad"]; ?></option>

                <?php
                        // Cerrar los estructuras de control
                    endforeach;
                endif;
                ?>
            </select>
        </div>

        <!-- Consultar la lista de clientes y desplegarlos -->
        <div class="mb-3">
            <label for="cliente_cancela" class="form-label">Cliente Cancela</label>
            <select name="cliente_cancela" id="cliente_cancela" class="form-select">
                
                <!-- Option por defecto -->
                <option value="" selected disabled></option>

                <?php
                // Importar el código del otro archivo
                require("../cliente/cliente_select.php");
                
                // Verificar si llegan datos
                if($resultadoCliente):
                    
                    // Iterar sobre los registros que llegaron
                    foreach ($resultadoCliente as $fila):
                ?>

                <!-- Opción que se genera -->
                <option value="<?= $fila["documento_identidad"]; ?>"><?= $fila["nombre"]; ?> - C.C. <?= $fila["documento_identidad"]; ?></option>

                <?php
                        // Cerrar los estructuras de control
                    endforeach;
                endif;
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Agregar</button>

    </form>
    
</div>

<?php
// Importar el código del otro archivo
require("proyecto_select.php");
            
// Verificar si llegan datos
if($resultadoProyecto and $resultadoProyecto->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">ID</th>
                <th scope="col" class="text-center">Fecha de reserva</th>
                <th scope="col" class="text-center">Fecha de cancelacion</th>
                <th scope="col" class="text-center">Valor</th>
                <th scope="col" class="text-center">Cliente</th>
                <th scope="col" class="text-center">Cliente Cancela</th>
                <th scope="col" class="text-center">Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoProyecto as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["id_reserva"]; ?></td>
                <td class="text-center"><?= $fila["fecha_reserva"]; ?></td>
                <td class="text-center"><?= $fila["fecha_cancelacion"]; ?></td>
                <td class="text-center">$<?= $fila["valor"]; ?></td>
                <td class="text-center">C.C: <?= $fila["cliente"]; ?></td>
                <td class="text-center">C.C: <?= $fila["cliente_cancela"]; ?></td>
                
                <!-- Botón de eliminar. Debe de incluir la CP de la entidad para identificarla -->
                <td class="text-center">
                    <form action="proyecto_delete.php" method="post">
                        <input hidden type="text" name="codigoEliminar" value="<?= $fila["id_reserva"]; ?>">
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