<?php
include ('conexion.php');

$id = $_POST["id"];
$consulta = "DELETE FROM grupos artistas WHERE artista_id=".$id;
$insercion= pg_query($con,$consulta);
$query = pg_query($con, $insercion);
//var_dump($query);

if($query){
	echo "El registro a sido eliminado de la base de datos";
	echo "<a href='consulta.php'>Regresar a la lista de usuarios</a>";
}else{
	echo "Error en intento de eliminar el registro";
	echo "<a href='consulta.php'>Regresar a la lista de usuarios</a>";
}

pg_close($con);

?>