<?php
//Muestra una lista de todos los discos registrados y da opciones de eliminación y modificación


//verificar sesion
session_start();
if (isset($_SESSION['valida']) && $_SESSION['valida'] == true){
?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="stylesheet" href="css/estilo1.css" type="text/css"/>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<title>Créditos</title>
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
		<br>
		<div class="card text-white bg-dark">
            <br>
            <br>
            <br>
			<div class="card-body">
                <center>
                    <h1 class="head-cred">Desarrollo de aplicaciones para web 2.0</h1>
                    <h5 class="nombre-cred">Profesora: Aguilar Dominguez Angie</h5>
                    <br>
                    <h1 class="head-cred">Equipo:</h1>
                    <h5 class="nombre-cred">- Moreno Parker Pamela Stephanie</h5>
                    <h5 class="nombre-cred">- Puebla Aldama Diego</h5>
                    <h5 class="nombre-cred">- Rojas Fajardo Ximena</h5>
                    <h5 class="nombre-cred">- Tronco Gamboa Iván Antonio</h5>
                    <br>
                    <h5 class="nombre-cred">Semestre 2022-2</h5>
                </center>
			</div>
            <br>
            <br>
            <br>
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