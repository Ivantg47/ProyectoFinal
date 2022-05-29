<?php

//verificar sesion
session_start();
if (isset($_SESSION['valida']) && $_SESSION['valida'] == true){

//Consultar los registros y mostrar los en una tabla
	include 'conexion.php';
	$query = "SELECT d.disco_id, d.titulo, g.nombre, d.portada FROM discos d inner join grupos g on d.grupo_id = g.grupo_id order by d.disco_id";
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
		<title>Catalogo de Discos</title>
	</head>
	<body>
		<br>
		<div class="card text-white bg-dark">
			<div class="card-header">
				<h1>Catálogo de discos</h1>
			</div>
			<div class="card-body">
				<table class="table">
					<tr>
						<th scope="col">Portada</th>
						<th scope="col">Titulo</th>
						<th scope="col">Grupo</th>
						<th scope="col">Edición</th>
						<th scope="col">Borrado</th>
					</tr>
					<?php
						while($row = pg_fetch_assoc($ejecucion)){
							echo "<tr>";
							echo "<td><img src=".pg_unescape_bytea($row['portada'])." width=100 heigth=100></td>";
							//echo "<td><img src=img/darth.jpg width=100 heigth=100></td>";
							echo "<td>".$row['titulo']."</td>";
							echo "<td>".$row['nombre']."</td>";
							echo "<td><a class=\"btn btn-outline-secondary\" href='catalogo_discos_desc.php?id=".$row['disco_id']."'>Editar</a></td>";
							echo "<td><a class=\"btn btn-outline-danger\" href='formularioEl.php?id=".$row['disco_id']."'>Borrar</a></td>";
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
