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
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<title>Canciones</title>
	</head>
	<body>

		header class="encabezado">  
	    <nav>
	      <a class="nav-a logo" href="catalogo_discos.php"><img class="logo-img" src="logo.png" alt="discos"></a>
	      <ul>
	        <li class="menu"><a class="nav-li-link" href="catalogo_discos.php">Inicio</a></li>
	        <li class="menu"><a href="#">Catalogo</a>
	          <ul>
	            <li><a href="catalogo_artistas.php">Artista</a></li>
	            <li><a href="catalogo_compositores.php">Compositor</a></li>
	            <li><a href="catalogo_discos.php">Disco</a></li>
	            <li><a href="catalogo_disqueas.php">Disquera</a></li>
	            <li><a href="catalogo_grupos.php">Grupo</a></li>
	            <li><a href="catalogo_poductores.php">Productor</a></li>
	          </ul>
	        </li>
	        <li class="menu"><a href="#">Registro</a>
	          <ul>
	            <li><a href="form_artista.php">Artista</a></li>
	            <li><a href="form_compositor.php">Compositor</a></li>
	            <li><a href="form_disco.php">Disco</a></li>
	            <li><a href="form_disquera.php">Disquera</a></li>
	            <li><a href="form_grupo.php">Grupo</a></li>
	            <li><a href="form_productor.php">Productor</a></li>
	          </ul>
	        </li>
	        <li class="menu"><a href="creditos.php">Creditos</a></li>
	        <li class="menu"><a href="salir.php">Salir</a></li>
	      </ul>
	    </nav>
  	</header>
  	
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<center>
						<?php
						echo "<td><img src=".pg_unescape_bytea($row['portada'])." width=100 heigth=100></td>";
						?>
					</center>
				</div>
				<div class="col-md-8">
					<div class="card text-white bg-dark">
						<h5 class="card-header">
							<?php
							echo "<h1>".$disco['titulo']."</h1>";
							?>
						</h5>
						<div class="card-body">
							<p class="card-text">
								<?php
									echo "<p>".r$ow['grupo']."</p>";
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
