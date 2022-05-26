<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!--<link rel="stylesheet" href="css/estilo1.css" type="text/css" />-->
	<script src="js/jquery-3.6.0.js"></script>
	<title></title>
</head>
<body>
	<!--<div class="form">-->
		<form name="subir" method="post" enctype="multipart/form-data" action="subir.php">
			<h4>Alta discos</h4>
			<label for="nombre">Portada:</label>
			<input type="file" name="archivo">
			<br />
			<label for="nombre">Titulo:</label>
			<input type="text" name="titulo">
			<br />
			<label for="nombre">Grupo:</label>
			<input type="text" name="grupo">
			<br />
			<div>
				<form name="cancionForm" id="cancionForm">
					<table id="campo_dinamico">
						<tr>
							<td><input type="text" name="tituloCancion[]" id="tituloCancion" placeholder="titulo de cancion"></td>
							<td><input type="text" name="compositor[]" id="compositor" placeholder="compositor"></td>
							<td><button name="mas" id="mas">+</button></td>
						</tr>
					</table>
				</form>
			</div>
			<input type="submit" name="enviar" value="Subir archivo">
		</form>
	<!--</div>-->
</body>
</html>

<script>
$(document).ready(function(){
	var i = 1;
	$('#mas').click(function(){
		i++;
		$('#campo_dinamico').append('<tr id="row'+i+'"><td><input type="text" name="tituloCancion[]" id="tituloCancion" placeholder="titulo de cancion"></td><td><input type="text" name="compositor[]" id="compositor" placeholder="compositor"></td><td><button name="menos" id="'+i+'" class="btn_remove">X</button></td></tr>')
	});
	$(document).on('click', '.btn_remove', function(){
		var button_id = $(this).attr("id");
		$('#row'+button_id+'').remove();
	});
});

</script>