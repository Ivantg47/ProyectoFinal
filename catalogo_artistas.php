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
		<link rel="stylesheet" href="css/estilo1.css" type="text/css"/>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<title>Catalogo de Artistas</title>
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

		</body>
	</html>

<?php }  	else {
		header('Location: index.php?error=1');
	
	}
?>