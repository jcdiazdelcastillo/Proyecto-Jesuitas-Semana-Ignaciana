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

		
		if(password_verify($codigo,$codigohash)){
			$_SESSION["idJesuita"] = $fila["idJesuita"];
			$_SESSION["nombre"] = $nombre;
			
			echo "<h2>Jesuita encontrado</h2>";
			echo "<h3>TODO LISTO PARA VISITAR: <a href='seleccionarLugar.php'>Ir a lugares</a></h3>";
		}else {
			echo "<h2>Error: Contraseña incorrecta</h2>";
			echo "<h3>Volver - <a href='inicioSesion.html'>Volver a intentar</a></h3>";
		}
		
	}else{
		echo "<h2>Error: Jesuita no encontrado</h2>";
		echo "<h3>Volver - <a href='inicioSesion.html'>Volver a intentar</a></h3>";
	}
	$conexion->close();
?>