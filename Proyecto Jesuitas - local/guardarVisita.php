<?php
	
	session_start();
	// Recoge la información de la sesión
	$idJesuita = $_SESSION["idJesuita"];  // Obtener el idJesuita de la sesión
	$nombre = $_SESSION["nombre"];  // Obtener el nombre de la sesión
	$ip = $_POST["ip"];  // Obtener la IP seleccionada del formulario
	
	//visualizar los valores
	echo "idJesuita: " . $idJesuita;
	echo "<br>";
	echo "IP Lugar Visitado: " . $ip;
	echo "<br>";
	
	// Incluir archivo de configuración para la conexión a la base de datos
	include 'configdb.php'; 
	
	$conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD); //Conecta con la base de datos
    $conexion->set_charset("utf8"); //Usa juego caracteres UTF8
	
	//Desactiva errores
	$controlador = new mysqli_driver();
    $controlador->report_mode = MYSQLI_REPORT_OFF;
	
//Cadena de caracteres de la consulta sql	
	$sql = "INSERT INTO visita (idJesuita, ip) VALUES ($idJesuita, '$ip');";   //completa lo que falta
	echo $sql; //envía el contenido de la variable al navegador, o sea, muestra la información en el navegador
	
	//ejecutar la consulta
	$conexion->query($sql);
	
	//verificar si la consulta se ha ejecutado correctamente
	if ($conexion->affected_rows > 0) {
		echo "<h2>Visita realizada</h2>";
		echo '<h3><a href="seleccionarLugar.php">Hacer otra visita</a></h3>';
	} else {
		echo "<h2>La visita no se ha realizado</h2>";
		echo '<h3><a href="seleccionarLugar.php">Vuelve a intentarlo</a></h3>';
	}

	// Cerrar la conexión
	$conexion->close();
?>