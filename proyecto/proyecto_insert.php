<?php
 
// Crear conexión con la BD
require('../config/conexion.php');

// Sacar los datos del formulario. Cada input se identifica con su "name"
$id_reserva = $_POST["id_reserva"];
$fecha_reserva = $_POST["fecha_reserva"];
$fecha_cancelacion = $_POST["fecha_cancelacion"];
$valor = $_POST["valor"];
$cliente = $_POST["cliente"];
$cliente_cancela = $_POST["cliente_cancela"];

$fecha_cancelacion = ($fecha_cancelacion == 0) ? NULL : $fecha_cancelacion;
$cliente_cancela = ($cliente_cancela == 0) ? NULL : $cliente_cancela;

// Query SQL a la BD. Si tienen que hacer comprobaciones, hacerlas acá (Generar una query diferente para casos especiales)
$query = "INSERT INTO `reserva`(`id_reserva`,`fecha_reserva`, `fecha_cancelacion`, `valor`, `cliente`, `cliente_cancela`) VALUES ('$id_reserva', '$fecha_reserva', " . ($fecha_cancelacion ? "'$fecha_cancelacion'" : "NULL") . ", '$valor', '$cliente', " . ($cliente_cancela ? "'$cliente_cancela'" : "NULL") . ")";
// Validaciones
$errores = [];

// Validar que la fecha de cancelación sea mayor a la fecha de reserva
if ($fecha_cancelacion && $fecha_cancelacion < $fecha_reserva) {
    $errores[] = "La fecha de cancelación debe ser mayor que la fecha de reserva.";
}

// Validar que el cliente que cancela sea el mismo que hizo la reserva
if ($cliente_cancela && $cliente_cancela == $cliente) {
    $errores[] = "El cliente que cancela debe ser distinto del que realizó la reserva.";
}

if (($cliente_cancela && !$fecha_cancelacion) || (!$cliente_cancela && $fecha_cancelacion)) {
    $errores[] = "Si el cliente cancelo se debe ingresar la fecha de cancelacion y el cliente que cancela.";
}

// Si hay errores, mostrar mensajes de error
if (!empty($errores)) {
    foreach ($errores as $error) {
        echo "<p class='text-danger'>$error</p>";
    }
    // Puedes redirigir de nuevo al formulario o finalizar el script
    exit;
}

// Ejecutar consulta
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

// Redirigir al usuario a la misma pagina
if($result):
    // Si fue exitosa, redirigirse de nuevo a la página de la entidad
	header("Location: proyecto.php");
else:
	echo "Ha ocurrido un error al crear la persona";
endif;

mysqli_close($conn);