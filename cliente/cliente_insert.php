<?php
 
// Crear conexión con la BD
require('../config/conexion.php');

// Sacar los datos del formulario. Cada input se identifica con su "name"
$documento_identidad = $_POST["documento_identidad"];
$nacionalidad = $_POST["nacionalidad"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$año_nacimiento = $_POST["año_nacimiento"];
$asesor = $_POST["asesor"];

// Query SQL a la BD. Si tienen que hacer comprobaciones, hacerlas acá (Generar una query diferente para casos especiales)
$query = "INSERT INTO `cliente`(`documento_identidad`,`nacionalidad`, `nombre`, `apellido`, `año_nacimiento`, `asesor`) VALUES ('$documento_identidad','$nacionalidad', '$nombre', '$apellido', '$año_nacimiento', '$asesor')";

// Ejecutar consulta
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

// Redirigir al usuario a la misma pagina
if($result):
    // Si fue exitosa, redirigirse de nuevo a la página de la entidad
	header("Location: cliente.php");
else:
	echo "Ha ocurrido un error al crear la persona";
endif;

mysqli_close($conn);