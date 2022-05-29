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
	<div class="form alta">
		<form name="subir" id="subir" class="row g-3" method="post" enctype="multipart/form-data" action="alta_discos.php">
			<h4 class="col-12">Alta discos</h4>

			<div class="col-md-6">
				<label for="portada" class="altaLabel">Portada:</label>
				<input type="file" class="form-control" name="portada" id="portada">
				<div id="errores"></div>
			</div>	

			<div class="col-md-6">
				<label for="titulo" class="altaLabel">Titulo:</label>	
				<input id="titulo" type="text" class="form-control" name="titulo" placeholder="Titulo del disco">	
			</div>

			<div class="col-md-4">
				<label for="grupo" class="altaLabel">Grupo:</label>
				<select class="form-select" name="grupo" id="grupo">
					<option value="" selected disabled hidden>&lt;Seleccione Grupo&gt;</option>
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
					<option value="" selected disabled hidden>&lt;Seleccione Disquera&gt;</option>
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
					<option value="" selected disabled hidden>&lt;Seleccione Productor&gt;</option>
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
				<input id="genero" type="text" name="genero" class="form-control" placeholder="Genero del disco">
			</div>

			<div class="col-md-4">				
				<label for="anio" class="altaLabel">Año:</label>
				<input id="anio" type="date" name="anio" class="form-control">
			</div>

			<div class="col-md-4">	
				<label for="costo" class="altaLabel">Costo:</label>
				<input id="costo" type="text" name="costo" class="form-control" placeholder="$ 0.00">
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
				<button class="form btnbutton">Salir</button>
			</div>
		</form>
	</div>

	<div class="form-group fieldGroupCopy" style="display: none;">
	    <div class="input-group">
	        <input type="text" name="tituloCancion[]" id="tituloCancion" class="form-control" placeholder="titulo de canción"/>
			<select name="compositor[]" id="compositor" class="form-select">
				<option value="" selected disabled hidden>&lt;Seleccione Compositor&gt;</option>
				<?php
					include ('conexion.php');
					$consulta = "SELECT compositor_id id, nombre || ' ' || apellido nombre from compositores";
					$ejecucion = pg_query($con,$consulta);
					$row = pg_fetch_assoc($ejecucion, 0);
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

