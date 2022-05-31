<?php
session_start();
if (isset($_SESSION['valida']) && $_SESSION['valida'] == true){
include ('conexion.php');

$id = $_POST["id"];
$consulta = "DELETE FROM compositores WHERE compositor_id=".$id;
#var_dump($consulta);
$query = pg_query($con, $consulta);
//var_dump($query);

if($query){
	pg_close($con);
	echo'<script type="text/javascript">
        alert("Registro eliminado con exito");
        window.location.href="catalogo_compositores.php";
        </script>';
#	header('Location: catalogo_artistas.php');
}else{
	pg_close($con);
	echo'<script type="text/javascript">
        alert("Error en intento de eliminar el registro");
        window.location.href="baja_compositor.php?id='.$id.'";
        </script>';
}

pg_close($con);
}

?>