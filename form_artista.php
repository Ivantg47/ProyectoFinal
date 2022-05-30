<?php

//verificar sesion
#session_start();
#if (isset($_SESSION['valida']) && $_SESSION['valida'] == true){
?>	
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="css/estilo1.css" type="text/css"/>
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<script src="js/jquery-3.6.0.js"></script>
	<script src="js/01.js"></script>
	<script src="js/jquery.validate.min.js"></script>
	<script src="js/validar.js"></script>

	<title>Registro de Artista</title>

	
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

	<div class="form alta">
		<form name="subir" id="subir" class="row g-3" method="post" enctype="multipart/form-data" action="alta_discos.php">
			<h4 class="col-12">Alta Artista</h4>

      <div class="col-md-6">
        <label for="nombre" class="altaLabel">Nombre:</label> 
        <input id="nombre" type="text" class="form-control" name="nombre" placeholder="Nombre/s del artista"> 
      </div>

      <div class="col-md-6">
        <label for="apellido" class="altaLabel">Apellido:</label> 
        <input id="apellido" type="text" class="form-control" name="nombre" placeholder="Apellido/s del artista"> 
      </div>
      
      <div class="col-md-6">
        <label for="pais" class="altaLabel">Pais Origen:</label> 
        <input id="pais" type="text" class="form-control" name="nombre" placeholder="Pais de origen"> 
      </div>

      <div class="col-md-6">
        <label for="fechaNac" class="altaLabel">Fecha Nacimiento:</label> 
        <input id="anio" type="date" class="form-control" name="anio" > 
      </div>
			
      <div class="col-md-8">
        <label for="nombreArt" class="altaLabel">Nombre artistico:</label> 
        <input id="nombreArt" type="text" class="form-control" name="nombre" placeholder="Nombre artistico"> 
      </div>
      <div class="col-md-12">
        
      </div>
      <div class="col-md-6">
        <button>Registrar</button>
      </div>

      <div class="col-md-6">
        <button class="form btnbutton">Cancelar</button>
      </div>
      
		</form>
	</div>
</body>
</html>

<?php
/* }  	else {
		header('Location: index.php?error=1');	
	}*/
?>
