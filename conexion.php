<?php 
	//conexion al manejador de base de datos
//echo "Intentar la conexion";
	$con = pg_connect("dbname=bdrecords user=discos_oper password=hola port=5432") or die (pg_last_error());
//var_dump($con);
//echo "hola";
 ?>