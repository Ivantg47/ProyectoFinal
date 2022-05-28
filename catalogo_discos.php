<?php

//verificar sesion
session_start();
if (isset($_SESSION['valida']) && $_SESSION['valida'] == true){

//Consultar los registros y mostrar los en una tabla
	include 'conexion.php';
	$query = "SELECT d.disco_id, d.titulo, g.nombre, d.portada FROM discos d inner join grupos g on d.grupo_id = g.grupo_id order by d.disco_id";
	$ejecucion = pg_query($con, $query);

//	var_dump($ejecucion);
?>
	<table>
		<tr>
			<th>Portada</th>
			<th>Titulo</th>
			<th>Grupo</th>
			<th>Edición</th>
			<th>Borrado</th>
		</tr>
		<?php
			while($row = pg_fetch_assoc($ejecucion)){
				echo "<tr>";
				echo "<td><img src=".pg_unescape_bytea($row['portada'])." width=100 heigth=100></td>";
				//echo "<td><img src=img/darth.jpg width=100 heigth=100></td>";
				echo "<td>".$row['titulo']."</td>";
				echo "<td>".$row['nombre']."</td>";
				echo "<td><a href='catalogo_discos_desc.php?id=".$row['disco_id']."'>Editar</a></td>";
				echo "<td><a href='formularioEl.php?id=".$row['disco_id']."'>Borrar</a></td>";
				echo "</tr>";
			}
		?>	
	</table>
	<input type="submit" onclick="location='salir.php'" value="Salir">


<?php }  	else {
		header('Location: index.php?error=1');
	
	}
?>