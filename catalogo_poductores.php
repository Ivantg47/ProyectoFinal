<?php

//verificar sesion
//Permite mostrar a los productores.

session_start();
if (isset($_SESSION['valida']) && $_SESSION['valida'] == true){

//Consultar los registros y mostrar los en una tabla
	include 'conexion.php';
	$query = "SELECT p.productor_id, p.nombre, p.apellido, p.fecha_nacimiento FROM productores p order by p.productor_id";
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
		<title>Catalogo de Productores</title>
	</head>
		<body>
			<header class="encabezado">  
			    <nav>
			      <a class="nav-a logo" href="catalogo_discos.php"><img class="logo-img" src="logo.png" alt="discos"></a>
			      <ul>
			        <li class="menu"><a class="nav-li-link" href="catalogo_discos.php">Inicio</a></li>
			        <li class="menu"><a href="#">Catalogo</a>
			          <ul>
			            <li><a href="catalogo_artistas.php">Artista</a></li>
			            <li><a href="catalogo_compositores.php">Compositor</a></li>
			            <li><a href="catalogo_discos.php">Disco</a></li>
			            <li><a href="catalogo_disqueras.php">Disquera</a></li>
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
			<br>
			<div class="card text-white bg-dark">
			<div class="card-header">
				<h1>Cat??logo de productores</h1>
			</div>
			<div class="card-body">
				<table class="table">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nombre</th>
						<th scope="col">Fecha de Nacimiento</th>
						<th scope="col">Editar</th>
                        <th scope="col">Borrar</th>
					</tr>
					<?php
						
						while($row = pg_fetch_assoc($ejecucion)){
							$nombre = $row['nombre']." ".$row['apellido'];
							echo "<tr>";
							echo "<td>".$row['productor_id']."</td>";
							echo "<td>".$nombre."</td>";
							echo "<td>".$row['fecha_nacimiento']."</td>";
							echo "<td><a class=\"btn btn-outline-secondary\" href='edita_productor.php?id=".$row['productor_id']."'>Editar</a></td>";
							echo "<td><a class=\"btn btn-outline-danger\" href='baja_productor.php?id=".$row['productor_id']."'>Borrar</a></td>";
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
