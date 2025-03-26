<?php
	
	// Recoge la información del formulario
	$nombre = $_POST["nombre"];  // Obtener el nombre del jesuita
	$codigo = $_POST["codigo"];  // Obtener el codigo
	$nombreAlumno = $_POST["nombreAlumno"]; //obtener el nombre del alumno
	$firma = $_POST["firma"];  // Obtener la firma
	$firmaIngles = $_POST["firmaIngles"]; // Obtener la firma en ingles
	
	$codigohash=password_hash($codigo, PASSWORD_DEFAULT);
	
	// Incluir archivo de configuración para la conexión a la base de datos
	include 'configdb.php'; 
	
	$conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD); //Conecta con la base de datos
    $conexion->set_charset("utf8"); //Usa juego caracteres UTF8
	
	//Desactiva errores
	$controlador = new mysqli_driver();
    $controlador->report_mode = MYSQLI_REPORT_OFF;
	
//Cadena de caracteres de la consulta sql	
	$sql = "INSERT INTO jesuita (nombre, codigo, nombreAlumno, firma, firmaIngles) VALUES ('$nombre', '$codigohash', '$nombreAlumno', '$firma', '$firmaIngles');";   //completa lo que falta
	echo $sql; //envía el contenido de la variable al navegador, o sea, muestra la información en el navegador
	
	//ejecutar la consulta
	$conexion->query($sql);
	
	//verificar si la consulta se ha ejecutado correctamente
	if ($conexion->affected_rows > 0) {
		echo "<h2>Jesuita guardado</h2>";
		echo '<h3><a href="anadirJesuitas.html">Añadir otro Jesuita</a></h3>';
	} else {
		echo "<h2>Error. Jesuita no añadido</h2>";
		echo '<h3><a href="anadirJesuitas.html">Vuelve a intentarlo</a></h3>';
	}

	$conexion->close();
?>