<?php

//verificar sesion
session_start();
if (isset($_SESSION['valida']) && $_SESSION['valida'] == true){

//Consultar los registros y mostrar los en una tabla
	include 'conexion.php';
	$query = "SELECT c.compositor_id, c.nombre, c.apellido, c.pais_nacimiento, c.fecha_nacimiento FROM compositores c order by c.compositor_id";
	$ejecucion = pg_query($con, $query);

//	var_dump($ejecucion);
?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/estilo1.css" type="text/css"/>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<title>Catalogo de Compositoes</title>
	</head>
		<body>
		<br>
		<div class="card text-white bg-dark">
			<div class="card-header">
				<h1>Catálogo de Compositores</h1>
			</div>
			<div class="card-body">
				<table class="table">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nombre</th>
						<th scope="col">País de Origen</th>
                        			<th scope="col">Fecha de Nacimiento</th>
                        			<th scope="col">Editar</th>
                        			<th scope="col">Borrar</th>
					</tr>
					<?php
                        $nombre = $row['nombre'] . " " . $row['apellido'];
						while($row = pg_fetch_assoc($ejecucion)){
							echo "<tr>";
							echo "<td>".$row['compositor_id']."</td>";
							echo "<td>".$nombre."</td>";
							echo "<td>".$row['pais_nacimiento']."</td>";
                            				echo "<td>".$row['fecha_nacimiento']."</td>";
							echo "<td><a class=\"btn btn-outline-secondary\" href='catalogo_discos_desc.php?id=".$row['grupo_id']."'>Editar</a></td>";
							echo "<td><a class=\"btn btn-outline-danger\" href='formularioEl.php?id=".$row['grupo_id']."'>Borrar</a></td>";
							echo "</tr>";
						}
					?>	
				</table>
			</div>
		</div>
		<br>
		<center>
			<input class="btn btn-danger" type="submit" onclick="location='salir.php'" value="Salir">
		</center>
	</body>
	</html>

<?php }  	else {
		header('Location: index.php?error=1');
	
	}
?>
