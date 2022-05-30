<?php
include ('conexion.php');

$consulta = "SELECT artista_id id, CASE WHEN nombre_artistico is NULL THEN 
				nombre || ' ' || apellido ELSE 
				nombre_artistico || '(' || nombre || ' ' || apellido || ')'
				END AS nombre
					from artistas order by 2";
$ArtistaEje = pg_query($con,$consulta);
$Artista = pg_fetch_assoc($ArtistaEje, 0);

pg_close($con);
?>