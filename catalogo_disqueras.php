<?php

//verificar sesion
session_start();
if (isset($_SESSION['valida']) && $_SESSION['valida'] == true){

//Consultar los registros y mostrar los en una tabla
	include 'conexion.php';
	$query = "SELECT d.disquera_id, d.nombre, g.pais FROM disquera d order by d.disquera_id";
	$ejecucion = pg_query($con, $query);

//	var_dump($ejecucion);
?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
		<title>Catalogo de Disqueras</title>
	</head>
	<body>
		<br>
		<div class="card text-white bg-dark">
			<div class="card-header">
				<h1>Catálogo de disqueras</h1>
			</div>
			<div class="card-body">
				<table class="table">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nombre</th>
						<th scope="col">País</th>
					</tr>
					<?php
						while($row = pg_fetch_assoc($ejecucion)){
							echo "<tr>";
							echo "<td>".$row['disquera_id']."</td>";
							echo "<td>".$row['nombre']."</td>";
							echo "<td>".$row['pais']."</td>";
							echo "<td><a class=\"btn btn-outline-secondary\" href='catalogo_discos_desc.php?id=".$row['disquera_id']."'>Editar</a></td>";
							echo "<td><a class=\"btn btn-outline-danger\" href='formularioEl.php?id=".$row['disquera_id']."'>Borrar</a></td>";
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
