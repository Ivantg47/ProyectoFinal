<?php

//Sirve para realizar consultas

include ('conexion.php');

$consulta = "SELECT grupo_id id, nombre from grupos order by 2";
$GrupoEje = pg_query($con,$consulta);
$Grupo = pg_fetch_assoc($GrupoEje, 0);

$consulta = "SELECT productor_id id, nombre || ' ' || apellido nombre from productores order by 2";
$ProductorEje = pg_query($con,$consulta);
$Productor = pg_fetch_assoc($ProductorEje, 0);

$consulta = "SELECT disquera_id id, nombre from disqueras order by 2";
$DisqueraEje = pg_query($con,$consulta);
$Disquera = pg_fetch_assoc($DisqueraEje, 0);

$consulta = "SELECT compositor_id id, nombre || ' ' || apellido nombre from compositores order by 2";
$CompositorEje = pg_query($con,$consulta);
$Compositor = pg_fetch_assoc($CompositorEje, 0);

pg_close($con);
?>
