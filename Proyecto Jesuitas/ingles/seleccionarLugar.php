<?php
	session_start();
	include 'configdb.php';
	$conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD);
	$conexion->set_charset("utf8");

	$idJesuita = $_SESSION["idJesuita"];
	$nombre = $_SESSION["nombre"];
?>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>VISITS</title>
		<link rel="stylesheet" type="text/css" href="estilos.css">
	</head>
	<body>
		<form method="POST" action="guardarVisita.php">
			<fieldset>
				<legend>VISITS</legend>
				<h2>HELLO, <?php echo $nombre; ?></h2>

				<label for="ipVisitados">Select a place</label>
				<select name="ip" id="ip" required>
					<?php
					include 'configdb.php';
					$conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD);
					$conexion->set_charset("utf8");

					$sql = "SELECT ip, lugar FROM lugar;";
					if ($resultado = $conexion->query($sql))
						while ($fila = $resultado->fetch_array()) {
							echo '<option value="'.$fila["ip"].'">'.$fila["lugar"].'</option>';
						}
					$conexion->close();
					?>
				</select>

				<input type="hidden" name="idJesuita" value="<?php echo $idJesuita; ?>">
				<input type="submit" class="submit-button" value="send">
			</fieldset>
		</form>
	</body>
</html>