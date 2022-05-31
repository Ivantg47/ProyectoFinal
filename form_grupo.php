

<?php
//form_grupo.php: Formato para registrar un grupo.
//verificar sesion
session_start();
if (isset($_SESSION['valida']) && $_SESSION['valida'] == true){

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

	<title>Registro de Grupo</title>

	
</head>
<body>
	<header class="encabezado">  
    <nav>
      <a class="nav-a logo" href="#"><img class="logo-img" src="logo.png" alt="discos"></a>
      <ul>
        <li class="menu"><a class="nav-li-link" href="#">Inicio</a></li>
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
		<form name="subir" id="subir" class="row g-3" method="post" enctype="multipart/form-data" action="alta_grupo.php">
			<h4 class="col-12">Alta Grupo</h4> <!--//En esta sección se da de alta a los grupos y se piden los datos necesarios.-->

			<div class="col-md-6">
        <label for="nombre" class="altaLabel">Nombre:</label> 
        <input id="nombre" type="text" class="form-control" name="nombre" placeholder="Nombre del grupo"> 
      </div>

      <div class="col-md-6">
        <label for="pais" class="altaLabel">Pais Origen:</label> 
        <input id="pais" type="text" class="form-control" name="pais" placeholder="Pais de origen"> 
      </div>
      
      <div class="form-group fieldGroup" id="divCancion">

        <h4 class="col-12">Canciones</h4>

	   <!--// Esta parte se utiliza para que se pueda agregar el artista correspondiente al grupo que se esta registrando.-->
	      
          <div class="input-group"> 
            <select name="artista[]" id="artista" class="form-select">
              <option value="" selected disabled hidden>&lt;Seleccione Artista&gt;</option>
              <?php
                include ('conex_artista.php');
                while($Artista = pg_fetch_assoc($ArtistaEje)){
                  $id = $Artista ['id'];
                  $nombre = $Artista ['nombre'];
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
        <button class="btMar">Registrar</button> <!--// se hace uso de un botón para registrar los datos del productor (estos datos se mandan a alta_grupo.php).-->
      </div>

      <div class="col-md-6">
        <button class="form btnbutton btMar" onclick="window.location='catalogo_discos.php';return false;">Cancelar</button> <!--// se hace uso de un botón para cancelar el registro de productores.-->
      </div>
		</form>
	</div>

  <div class="form-group fieldGroupCopy" style="display: none;">
    <div class="input-group">
      <select name="artista[]" id="artista" class="form-select">
        <option value="" selected disabled hidden>&lt;Seleccione Artista&gt;</option>
        <?php
          include ('conex_artista.php');
          while($Artista = pg_fetch_assoc($ArtistaEje)){
            $id = $Artista ['id'];
            $nombre = $Artista ['nombre'];
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
<?php 

}  	else {
		header('Location: index.php?error=1');	
	}
  
?>
