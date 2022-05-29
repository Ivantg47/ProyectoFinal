<?php

//verificar sesion
session_start();
if (isset($_SESSION['valida']) && $_SESSION['valida'] == true){

//Consultar los registros y mostrar los en una tabla
	include 'conexion.php';
	$query = "SELECT d.disco_id, d.titulo, g.nombre, d.portada FROM discos d inner join grupos g on d.grupo_id = g.grupo_id order by d.disco_id";
	$ejecucion = pg_query($con, $query);
	$disco = pg_query($con, $query);
	$id= $_GET['id'];
	$query = "SELECT * FROM catalogo_cancion where disco_id ='".$id."'";
	$ejecucion = pg_query($con, $query);
	$row = pg_fetch_assoc($ejecucion, 0);
	//var_dump($ejecucion);
?>

	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
		<title>Canciones</title>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<center>
						<?php
						echo "<td><img src=".pg_unescape_bytea($disco['portada'])." width=100 heigth=100></td>";
						?>
					</center>
				</div>
				<div class="col-md-8">
					<div class="card text-white bg-dark">
						<h5 class="card-header">
							<?php
							echo "<td><img src=".pg_unescape_bytea($disco['titulo'])." width=100 heigth=100></td>";
							?>
						</h5>
						<div class="card-body">
							<p class="card-text">
								<?php
									echo "<td><img src=".pg_unescape_bytea($disco['nombre'])." width=100 heigth=100></td>";
								?>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br>
		<div class="container">

		</div>
	<br>
			<div class="card text-white bg-dark">
				<div class="card-header">
					<h1>Catálogo de discos</h1>
				</div>
				<div class="card-body">
					<table class="table">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Titulo</th>
							<th scope="col">Compositor</th>
							<th scope="col">Edición</th>
							<th scope="col">Borrado</th>
						</tr>
						<?php
							$cont = 1;
							$row = pg_result_seek($ejecucion, 0);
							while($row = pg_fetch_assoc($ejecucion)){
								echo "<tr>";
								echo "<td>".$cont."</td>";
								echo "<td>".$row['cancion']."</td>";
								echo "<td>".$row['compositor']."</td>";
								echo "<td><a class=\"btn btn-outline-secondary\" href='catalogo_discos_desc.php?id=".$row['id']."'>Editar</a></td>";
								echo "<td><a class=\"btn btn-outline-danger\" href='formularioEl.php?id=".$row['id']."'>Borrar</a></td>";
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
