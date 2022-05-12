<?php

//verificar sesion
session_start();
if (isset($_SESSION['valida']) && $_SESSION['valida'] == true){

//Consultar los registros y mostrar los en una tabla
	include 'conexion.php';
	$titulo= $_GET['titulo'];
	$query = "SELECT * FROM catalogo_cancion where titulo ='".$titulo."'";
	$ejecucion = pg_query($con, $query);
	$row = pg_fetch_assoc($ejecucion, 0);
	//var_dump($ejecucion);
?>

	<p><img src="<?php echo $row['portada'];?>" width=100 heigth=100></p>
	<h3><?php echo $row['titulo'];?></h3>
	<p><?php echo $row['grupo'];?></p>
	<table>
		<tr>
			<th>#</th>
			<th>Titulo</th>
			<th>compositor</th>
			<th>Edición</th>
			<th>Borrado</th>
		</tr>
		<?php
			$cont = 1;
			$row = pg_result_seek($ejecucion, 0);
			while($row = pg_fetch_assoc($ejecucion)){
				echo "<tr>";
				echo "<td>".$cont."</td>";
				echo "<td>".$row['cancion']."</td>";
				echo "<td>".$row['compositor']."</td>";
				echo "<td><a href='formularioEd.php?id=".$row['id']."'>Editar</a></td>";
				echo "<td><a href='formularioEl.php?id=".$row['id']."'>Borrar</a></td>";
				echo "</tr>";
				$cont++;
			}
		?>	
	</table>
	<input type="submit" onclick="location='salir.php'" value="Salir">


<?php }  	else {
		header('Location: index.php?error=1');
	
	}
?>