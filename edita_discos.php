<?php

//verificar sesion
#session_start();
#if (isset($_SESSION['valida']) && $_SESSION['valida'] == true){

  include 'conexion.php';
  $id = $_GET['id'];
  $consulta = "SELECT d.disco_id, d.titulo AS titulo_disco, g.grupo_id, g.nombre AS nombre_grupo, d.año AS anio_disco, d.genero AS genero_disco, d.costo AS costo_disco, d.portada, d.disquera_id, disc.nombre, prod.productor_id, prod.nombre, prod.apellido AS disquera_nombre, c.cancion_id, c.titulo AS titulo_cancion, c2.compositor_id, c2.nombre AS nombre_compositor, c2.apellido AS apellido_compositor, c2.pais_nacimiento, c2.fecha_nacimiento FROM grupos g INNER JOIN discos d ON d.grupo_id = g.grupo_id INNER JOIN disqueras disc on disc.disquera_id = d.disquera_id INNER JOIN disco_cancion dc ON d.disco_id = dc.disco_id INNER JOIN productores prod ON prod.productor_id = d.productor_id INNER JOIN canciones c ON dc.cancion_id = c.cancion_id INNER JOIN cancion_compositor cc ON c.cancion_id = cc.cancion_id INNER JOIN compositores c2 ON c2.compositor_id=cc.compositor_id WHERE d.disco_id=".$id."order by d.disco_id";
  $resultado = pg_query($con,$consulta);
  $row = pg_fetch_assoc($resultado, 0);
  pg_close($con);
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
	<script src="js/additional-methods.min.js"></script>
	<?php include ('alta_consulta.php'); ?>

	<title>Registro de discos</title>

	
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
		<form name="subir" id="subir" class="row g-3" method="post" enctype="multipart/form-data" action="edicion_discos.php">
			<h4 class="col-12">Edita discos</h4>

			<div class="col-md-6">
				<label for="portada" class="altaLabel">Portada:</label>
                <?php
    				echo "<td><img src=".pg_unescape_bytea($row['portada'])." width=100 heigth=100></td>";
				?>
				<input type="file" class="form-control" name="portada" id="portada">
				<div id="errores"></div>
			</div>	

			<div class="col-md-6">
				<label for="titulo" class="altaLabel">Titulo:</label>	
				<input id="titulo" type="text" class="form-control" name="titulo" value="<?php echo $row['titulo_disco']; ?>">	
			</div>

			<div class="col-md-4">
				<label for="grupo" class="altaLabel">Grupo:</label>
				<select class="form-select" name="grupo" id="grupo">
					<option value="<?php echo $row['grupo_id']; ?>" selected><?php echo $row['nombre_grupo']; ?></option>
					<?php
						while($Grupo = pg_fetch_assoc($GrupoEje)){
							$id = $Grupo ['id'];
							$nombre = $Grupo ['nombre'];
					?>
					<option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
					<?php 
						}
					?>
				</select>				
			</div>	

			<div class="col-md-4">
				<label for="disquera" class="altaLabel">Disquera:</label>
				<select class="form-select" name="disquera" id="disquera">
                <option value="<?php echo $row['disquera_id']; ?>" selected><?php echo $row['disquera_nombre']; ?></option>
					<?php
						while($Disquera = pg_fetch_assoc($DisqueraEje)){
							$id = $Disquera ['id'];
							$nombre = $Disquera ['nombre'];
					?>
					<option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
					<?php 
						}
					?>
				</select>
			</div>

			<div class="col-md-4">
				<label for="productor" class="altaLabel">Productor:</label>
				<select class="form-select" name="productor" id="productor">
                <?php
                    $nombre_prod = $row['nombre']." ".$row['apellido'];
                ?>
                <option value="<?php echo $row['productor_id']; ?>" selected> <?php echo $nombre_prod; ?> </option>
					<?php
						while($Productor = pg_fetch_assoc($ProductorEje)){
							$id = $Productor ['id'];
							$nombre = $Productor ['nombre'];
					?>
					<option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
					<?php 
						}
					?>
				</select>
			</div>

			<div class="col-md-4">	
				<label for="genero" class="altaLabel">Genero:</label>
				<input id="genero" type="text" name="genero" class="form-control" value="<?php echo $row['genero_disco']; ?>">
			</div>

			<div class="col-md-4">				
				<label for="anio" class="altaLabel">Año Publicacion:</label>
				<input id="anio" type="date" name="anio" value="<?php echo $row['anio_disco']; ?>" class="form-control">
			</div>

			<div class="col-md-4">	
				<label for="costo" class="altaLabel">Costo:</label>
				<input id="costo" type="text" name="costo" class="form-control" value="<?php echo $row['costo_disco']; ?>">
			</div>

			<div class="form-group fieldGroup" id="divCancion">

				<h4 class="col-12">Canciones</h4>

    			<div class="input-group">	
					<input type="text" name="tituloCancion[]" id="tituloCancion" class="form-control" placeholder="titulo de canción">
					<select name="compositor[]" id="compositor" class="form-select">
						<option value="" selected disabled hidden>&lt;Seleccione Compositor&gt;</option>
						<?php
							while($Compositor = pg_fetch_assoc($CompositorEje)){
								$id = $Compositor ['id'];
								$nombre = $Compositor ['nombre'];
						?>
						<option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
						<?php 
							}
						?>
					</select>
	            	<a href="javascript:void(0)" class="btn btnAgregar"><span class="icon icon-mas" aria-hidden="true"></span></a>       
		        </div>
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

	<div class="form-group fieldGroupCopy" style="display: none;">
	    <div class="input-group">
	        <input type="text" name="tituloCancion[]" id="tituloCancion" class="form-control" placeholder="titulo de canción"/>
			<select name="compositor[]" id="compositor" class="form-select">
				<option value="" selected disabled hidden>&lt;Seleccione Compositor&gt;</option>
				<?php
					while($row = pg_fetch_assoc($ejecucion)){
						$id = $row['id'];
						$nombre = $row['nombre'];
				?>
				<option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
				<?php 
					}
				?>
			</select>
			<a href="javascript:void(0)" class="btn btnQuitar"><span class="icon icon-menos" aria-hidden="true"></span></a>
	    </div>
	</div>
</body>
</html>