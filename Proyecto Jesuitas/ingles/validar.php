<?php
	session_start();
	include 'configdb.php';

	$conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD);
	$conexion->set_charset("utf8");

	$nombre = $_POST["nombre"];
	$codigo = $_POST["codigo"];

	// Buscar idJesuita según nombre y código
	$sql = "SELECT idJesuita, codigo FROM jesuita WHERE nombre = '$nombre'";
	$resultado = $conexion->query($sql);

	if ($resultado->num_rows > 0) {
		$fila = $resultado->fetch_array();
		
		$idJesuita = $fila["idJesuita"];
		$codigohash = $fila["codigo"];
		
	//verificar contraseña hasheada
		
		if(password_verify($codigo,$codigohash)){
			$_SESSION["idJesuita"] = $fila["idJesuita"];
			$_SESSION["nombre"] = $nombre;
			
			echo "<h2>Jesuit Found</h2>";
			echo "<h3>EVERYTHING READY TO VISIT: <a href='seleccionarLugar.php'>Go to PLace</a></h3>";
		}else {
			echo "<h2>Error: Incorrect password</h2>";
			echo "<h3>Return - <a href='inicioSesion.html'>Try again</a></h3>";
		}
		
	}else{
		echo "<h2>Error: Jesuit not found</h2>";
		echo "<h3>Volver - <a href='inicioSesion.html'>Try again</a></h3>";
	}
	$conexion->close();
?>