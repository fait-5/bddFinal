<?php
 
// Crear conexión con la BD
require('../config/conexion.php');

// Sacar los datos del formulario. Cada input se identifica con su "name"
$carnet = $_POST["carnet"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$salario = $_POST["salario"];

// Query SQL a la BD. Si tienen que hacer comprobaciones, hacerlas acá (Generar una query diferente para casos especiales)
$query = "INSERT INTO `asesor`(`carnet`,`nombre`, `apellido`, `salario`) VALUES ('$carnet', '$nombre', '$apellido', '$salario')";

// Ejecutar consulta
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

// Redirigir al usuario a la misma pagina
if($result):
    // Si fue exitosa, redirigirse de nuevo a la página de la entidad
	header("Location: empresa.php");
else:
	echo "Ha ocurrido un error al crear la persona";
endif;

mysqli_close($conn);